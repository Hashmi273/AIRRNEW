# Immense Air Pvt Ltd / Immense Air Pvt Ltd — Enterprise Web Application

Production-ready web application for Immense Air Pvt Ltd / Immense Air Pvt Ltd, optimized for **FREE GitHub Pages Hosting** with custom domain readiness (`https://immensesmartsolutions.com`).

---

## 🚀 Key Technical Features
- **Frontend Tech Stack**: HTML5, Vanilla CSS3 / Bootstrap 5.3.2, Vanilla JavaScript (ES6+), Font Awesome 6.5.1.
- **Backend / API Gateway**: Express.js server (`server.js`) with Nodemailer SMTP, Multer memory buffer uploads, cpassweb.in SMS/RCS gateway integration, and sms4power WhatsApp API connection.
- **GitHub Pages Ready**: 100% relative asset paths (`./`, `../`), static form fallbacks (`contact.html`, `careers.html`), and GitHub Actions deployment pipeline (`.github/workflows/deploy.yml`).
- **SEO & Performance**: Open Graph metadata, Canonical tags, `robots.txt`, `sitemap.xml`, GPU hardware-accelerated animations (`translate3d`), CLS optimization, and passive scroll listeners.

---

## 🛠️ Local Development & Testing

```bash
# 1. Install dependencies
npm install

# 2. Run local development server
npm start
```
Open `http://localhost:8080` in your web browser.

---

## 📤 Production Deployment to GitHub Pages

### Step 1: Initialize Git & Push Repository to GitHub
Run the following commands in your terminal inside the project directory:

```bash
# 1. Initialize Git repository
git init

# 2. Add all production files
git add .

# 3. Commit files
git commit -m "Production release: Prepared Immense website for GitHub Pages hosting"

# 4. Rename branch to main
git branch -M main

# 5. Connect your GitHub Repository (Replace USERNAME and REPOSITORY)
git remote add origin https://github.com/USERNAME/REPOSITORY.git

# 6. Push to GitHub
git push -u origin main
```

---

### Step 2: Enable GitHub Pages in Repository Settings
1. Open your repository on GitHub: `https://github.com/USERNAME/REPOSITORY`.
2. Go to **Settings** → **Pages** (in the left sidebar).
3. Under **Build and deployment** → **Source**, select **GitHub Actions**.
4. GitHub Actions will automatically run `.github/workflows/deploy.yml` and publish your live website at:
   `https://USERNAME.github.io/REPOSITORY/`

---

## 🌐 Connecting a Custom Domain (`immensesmartsolutions.com`)

When you are ready to connect your custom domain to GitHub Pages:

### Step 1: Add CNAME file or enter Custom Domain in GitHub Pages
In GitHub Repository **Settings** → **Pages** → **Custom domain**, enter:
`immensesmartsolutions.com` (or `www.immensesmartsolutions.com`) and click **Save**.

### Step 2: Configure DNS Records at your Domain Provider (GoDaddy / Namecheap / Cloudflare)
Add the following DNS records in your domain registrar's DNS management panel:

| Type | Name / Host | Target / Value | TTL |
|---|---|---|---|
| **A** | `@` | `185.199.108.153` | Automatic / 3600 |
| **A** | `@` | `185.199.109.153` | Automatic / 3600 |
| **A** | `@` | `185.199.110.153` | Automatic / 3600 |
| **A** | `@` | `185.199.111.153` | Automatic / 3600 |
| **CNAME** | `www` | `USERNAME.github.io.` | Automatic / 3600 |

### Step 3: Enable Enforce HTTPS
In GitHub Repository **Settings** → **Pages**, check the box **Enforce HTTPS**.

---

## 📋 Form & Backend Server Handling on GitHub Pages
- **GitHub Pages Hosting**: As a static hosting platform, GitHub Pages serves static HTML/CSS/JS. For form processing on static GitHub Pages hosting, you can connect static form services (e.g. Formspree, Web3Forms, or Mailchimp) or host `server.js` / `assets/api/contact.php` on Node.js / cPanel hosting.
- **Node.js / cPanel Hosting**: When hosted on a Node server or PHP cPanel host, `server.js` / `contact.php` processes all inquiries and resume uploads directly via SMTP to `support@immensesmartsolutions.com`.
