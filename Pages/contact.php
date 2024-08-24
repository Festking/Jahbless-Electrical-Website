<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : 'No Subject';

    // Gmail SMTP server configuration
    $smtpHost = 'smtp.gmail.com';
    $smtpPort = 587; // Use 587 for TLS or 465 for SSL
    $username = 'jahblesselectricals@gmail.com';
    $password = 'gfqo qlwh qkcx vxcv'; // Use app-specific password if 2FA is enabled

    // Email content
    $to = 'jahblesselectricals@gmail.com';
    $emailSubject = "Contact Form Submission: $subject";
    $body = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'tls'; // Use 'ssl' for port 465
        $mail->Port = $smtpPort;

        $mail->setFrom($username, 'Contact Form');
        $mail->addAddress($to);

        $mail->isHTML(false);
        $mail->Subject = $emailSubject;
        $mail->Body = $body;

        $mail->send();
        // Redirect with a query parameter indicating success
        header("Location: contact.html?status=success");
        exit(); // Make sure to call exit() after header() to stop further script execution

    } catch (Exception $e) {
        // Redirect with a query parameter indicating failure
        header("Location: contact.html?status=error");
        exit();
    }
} else {
    echo 'Invalid request method.';
}

?>