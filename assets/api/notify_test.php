<?php
/**
 * IMMENSE AIR PVT LTD
 * Live API Testing Email Notification Handler for PHP Environments
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $channel = htmlspecialchars(strip_tags(trim($_POST['channel'] ?? $_GET['channel'] ?? 'SMS/RCS/WhatsApp API')));
    $phone   = htmlspecialchars(strip_tags(trim($_POST['phone'] ?? $_GET['phone'] ?? 'N/A')));
    $status  = htmlspecialchars(strip_tags(trim($_POST['status'] ?? 'DELIVERED')));
    $to      = "support@immensesmartsolutions.com";

    if (empty($phone)) {
        header('Content-Type: application/json');
        echo json_encode(["success" => false, "error" => "Phone number required"]);
        exit();
    }

    $submissionTime = date('Y-m-d H:i:s') . ' IST';
    $clientIP       = $_SERVER['REMOTE_ADDR'] ?? 'N/A';

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
                <p><strong>⚡ NEW API TEST DEMO LOGGED</strong></p>
            </div>
            <p><span class='label'>Tested Service:</span> <strong style='color:#FF6A00;'>" . strtoupper($channel) . " API Testing</strong></p>
            <p><span class='label'>User Phone Number:</span> <a href='tel:$phone'><strong>$phone</strong></a></p>
            <p><span class='label'>Delivery Status:</span> <strong style='color:#10B981;'>$status</strong></p>
            <p><span class='label'>Date & Time:</span> $submissionTime</p>
            <p><span class='label'>Visitor IP:</span> $clientIP</p>
        </div>
    </body>
    </html>";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
        require __DIR__ . '/../../vendor/autoload.php';
    } elseif (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require __DIR__ . '/vendor/autoload.php';
    } elseif (file_exists(__DIR__ . '/PHPMailer/src/PHPMailer.php')) {
        require_once __DIR__ . '/PHPMailer/src/Exception.php';
        require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
        require_once __DIR__ . '/PHPMailer/src/SMTP.php';
    }

    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'mail.immensesmartsolutions.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'support@immensesmartsolutions.com';
            $mail->Password   = getenv('SMTP_PASSWORD') ? getenv('SMTP_PASSWORD') : 'YOUR_SMTP_PASSWORD';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('support@immensesmartsolutions.com', 'Immense Air Pvt Ltd');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = "⚡ New API Test Alert — " . strtoupper($channel) . " ($phone)";
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
        } catch (Exception $e) {
            // Log error silently
        }
    }

    header('Content-Type: application/json');
    echo json_encode(["success" => true, "message" => "API Test notification logged"]);
}
?>
