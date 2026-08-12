/**
 * IMMENSE AIR PVT LTD - Professional Motion & Data Opt-In Engine
 */

document.addEventListener('DOMContentLoaded', () => {
  // Initialize Lenis Smooth Scroll
  const lenis = initLenis();

  // Initialize Smooth Stagger Animations
  initGSAPAnimations();

  // Initialize Smooth Anchor Link Gliding
  initSmoothAnchorLinks(lenis);

  // Initialize Number Counters
  initCounters();

  // Initialize Navbar Scroll Listener
  initNavbarScroll();

  // Initialize Data Privacy Opt-In Consent Banner
  initOptInBanner();
});

/* ==========================================================================
   1. LENIS SMOOTH SCROLLING ENGINE
   ========================================================================== */
function initLenis() {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return null;

  if (typeof Lenis !== 'undefined') {
    const lenis = new Lenis({
      duration: 1.4,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      orientation: 'vertical',
      smoothWheel: true,
      wheelMultiplier: 1.0,
      touchMultiplier: 1.5
    });

    function raf(time) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    return lenis;
  }
  return null;
}

/* ==========================================================================
   2. SMOOTH ANCHOR LINK GLIDING
   ========================================================================== */
function initSmoothAnchorLinks(lenis) {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#' || !targetId) return;

      const targetEl = document.querySelector(targetId);
      if (targetEl) {
        e.preventDefault();
        if (lenis) {
          lenis.scrollTo(targetEl, {
            offset: -75,
            duration: 1.4
          });
        } else {
          targetEl.scrollIntoView({ behavior: 'smooth' });
        }
      }
    });
  });
}

/* ==========================================================================
   3. SUBTLE STAGGER ANIMATIONS (OPTIMIZED GPU-FRIENDLY REVEAL)
   ========================================================================== */
function initGSAPAnimations() {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    // Hero Section Immediate Light Reveal
    if (document.querySelector('.hero-headline-mockup')) {
      gsap.from('.hero-subtitle-orange, .hero-headline-mockup, .hero-para-mockup, .btn-orange-filled, .btn-dark-outline, .hero-check-pill', {
        y: 15,
        opacity: 0,
        duration: 0.5,
        stagger: 0.06,
        ease: 'power2.out',
        clearProps: 'all'
      });
    }

    // Solutions Cards Reveal
    if (document.querySelector('.card-solution-mockup')) {
      gsap.from('.card-solution-mockup', {
        scrollTrigger: {
          trigger: '.solutions-section',
          start: 'top 88%',
          toggleActions: 'play none none none'
        },
        y: 20,
        opacity: 0,
        duration: 0.5,
        stagger: 0.06,
        ease: 'power2.out',
        clearProps: 'all'
      });
    }

    // Industry Cards Reveal
    if (document.querySelector('.industry-pill')) {
      gsap.from('.industry-pill', {
        scrollTrigger: {
          trigger: '.sectors-section',
          start: 'top 88%',
          toggleActions: 'play none none none'
        },
        y: 15,
        opacity: 0,
        duration: 0.45,
        stagger: 0.04,
        ease: 'power2.out',
        clearProps: 'all'
      });
    }

    // How It Works Step Cards Reveal
    if (document.querySelector('.step-card')) {
      gsap.from('.step-card', {
        scrollTrigger: {
          trigger: '.how-it-works-section',
          start: 'top 88%',
          toggleActions: 'play none none none'
        },
        y: 20,
        opacity: 0,
        duration: 0.5,
        stagger: 0.08,
        ease: 'power2.out',
        clearProps: 'all'
      });
    }

    // Channel Flow Cards Reveal
    if (document.querySelector('.channel-card-item')) {
      gsap.from('.channel-card-item', {
        scrollTrigger: {
          trigger: '.omnichannel-section',
          start: 'top 88%',
          toggleActions: 'play none none none'
        },
        y: 15,
        opacity: 0,
        duration: 0.45,
        stagger: 0.06,
        ease: 'power2.out',
        clearProps: 'all'
      });
    }
  }
}

/* ==========================================================================
   4. LIGHTWEIGHT ANIMATED COUNTERS
   ========================================================================== */
function initCounters() {
  const counterElements = document.querySelectorAll('.stat-number');
  if (!counterElements.length) return;

  const counterObserver = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateSingleCounter(entry.target);
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.3 });

  counterElements.forEach(el => counterObserver.observe(el));
}

function animateSingleCounter(element) {
  const textVal = element.getAttribute('data-target') || element.innerText;
  const isPercentage = textVal.includes('%');
  const isPlus = textVal.includes('+');
  const numericVal = parseFloat(textVal.replace(/[^0-9.]/g, ''));

  if (isNaN(numericVal)) return;

  let current = 0;
  const duration = 1000;
  const stepTime = 25;
  const totalSteps = duration / stepTime;
  const increment = numericVal / totalSteps;

  const timer = setInterval(() => {
    current += increment;
    if (current >= numericVal) {
      current = numericVal;
      clearInterval(timer);
    }

    let formatted = numericVal >= 1000 ? Math.floor(current).toLocaleString() : (isPercentage ? current.toFixed(1) : Math.floor(current));
    if (textVal.includes('B')) formatted = Math.floor(current) + 'B';
    
    element.innerText = formatted + (isPlus ? '+' : '') + (isPercentage ? '%' : '');
  }, stepTime);
}

/* ==========================================================================
   5. NAVBAR SCROLL EFFECT (PASSIVE EVENT LISTENER)
   ========================================================================== */
function initNavbarScroll() {
  const navbar = document.getElementById('mainNav');
  if (!navbar) return;

  let ticking = false;
  window.addEventListener('scroll', () => {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        if (window.scrollY > 40) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
}

/* ==========================================================================
   6. OPT-IN DATA PRIVACY & CONSENT SYSTEM (DPDP ACT & DLT COMPLIANT)
   ========================================================================== */
function initOptInBanner() {
  const banner = document.getElementById('optInGlobalBanner');
  if (!banner) return;

  const optInStatus = localStorage.getItem('immense_data_optin');
  if (!optInStatus) {
    setTimeout(() => {
      banner.classList.remove('hidden');
    }, 1000);
  } else {
    banner.classList.add('hidden');
  }
}

function acceptDataOptIn() {
  localStorage.setItem('immense_data_optin', 'accepted_' + new Date().toISOString());
  const banner = document.getElementById('optInGlobalBanner');
  if (banner) banner.classList.add('hidden');
}

function declineDataOptIn() {
  localStorage.setItem('immense_data_optin', 'necessary_only_' + new Date().toISOString());
  const banner = document.getElementById('optInGlobalBanner');
  if (banner) banner.classList.add('hidden');
}
