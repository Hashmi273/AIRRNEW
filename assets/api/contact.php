<?php
// Agar form submit hua hai tabhi process karo
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ---------- 1. DATA SANITIZE KARO ----------
    $name    = htmlspecialchars(strip_tags(trim($_POST['name'] ?? '')));
    $email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone   = htmlspecialchars(strip_tags(trim($_POST['phone'] ?? '')));
    $subject = htmlspecialchars(strip_tags(trim($_POST['subject'] ?? 'New Contact Form Submission')));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'] ?? '')));

    // Email valid hai ya nahi check karo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // ---------- 2. RECIPIENT (JAHAN MAIL JANI CHAHIYE) ----------
    $to = "support@immensesmartsolutions.com"; // ✅ Exact destination email ID

    // ---------- 3. EMAIL BODY (HTML) ----------
    $body = "<!DOCTYPE html>
    <html>
    <head>
        <meta charset='utf-8'>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f6f9; padding: 20px; color: #060D1E; }
            .card { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 10px; padding: 30px; border: 1px solid #e2e8f0; }
            .header { border-bottom: 3px solid #FF6A00; padding-bottom: 15px; margin-bottom: 20px; }
            .header h2 { color: #060D1E; margin: 0; }
            .header span { color: #FF6A00; }
            p { font-size: 14px; line-height: 1.6; }
            .label { font-weight: bold; color: #475569; }
        </style>
    </head>
    <body>
        <div class='card'>
            <div class='header'>
                <h2>Immense <span>Smart Solutions</span></h2>
                <p><strong>New Contact Form Submission</strong></p>
            </div>
            <p><span class='label'>Name:</span> $name</p>
            <p><span class='label'>Email:</span> <a href='mailto:$email'>$email</a></p>
            <p><span class='label'>Phone:</span> $phone</p>
            <p><span class='label'>Subject:</span> $subject</p>
            <p><span class='label'>Message:</span><br>" . nl2br($message) . "</p>
        </div>
    </body>
    </html>";

    // ---------- 4. SMTP (PHPMailer) SETUP ----------
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Smart Autoload Path Detection (Composer or Manual Include)
    if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
        require __DIR__ . '/../../vendor/autoload.php';
    } elseif (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require __DIR__ . '/vendor/autoload.php';
    } elseif (file_exists(__DIR__ . '/PHPMailer/src/PHPMailer.php')) {
        require_once __DIR__ . '/PHPMailer/src/Exception.php';
        require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
        require_once __DIR__ . '/PHPMailer/src/SMTP.php';
    } else {
        @include_once 'vendor/autoload.php';
    }

    $mail = new PHPMailer(true);

    try {
        // ----- SMTP SERVER CONFIGURATION -----
        $mail->isSMTP();
        $mail->Host       = 'mail.immensesmartsolutions.com';   // ✅ SMTP HOST
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@immensesmartsolutions.com'; // ✅ SMTP USERNAME
        $mail->Password   = getenv('SMTP_PASSWORD') ? getenv('SMTP_PASSWORD') : 'YOUR_SMTP_PASSWORD'; // ✅ SMTP PASSWORD
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // 587 (TLS) or 465 (SMTPS)
        $mail->Port       = 587; // Port 587 or 465

        // ----- RECIPIENTS -----
        $mail->setFrom('support@immensesmartsolutions.com', 'Immense Air Pvt Ltd');
        $mail->addAddress($to);
        $mail->addReplyTo($email, $name);

        // ----- CONTENT -----
        $mail->isHTML(true);
        $mail->Subject = $subject ?: 'New Contact Form Submission';
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        // ----- SEND -----
        $mail->send();
        
        // Success: Redirect to thank you page
        header("Location: ../../thankyou.html");
        exit();

    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }

} else {
    // Direct access redirect to home page
    header("Location: ../../index.html");
    exit();
}
?>
