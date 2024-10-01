<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    //$phone = htmlspecialchars($_POST['phone']);
    $full_phone = htmlspecialchars($_POST['full_phone']);
    $company = htmlspecialchars($_POST['company']);
    $country = htmlspecialchars($_POST['country']);

    // Email content formatting
    $emailBody = "
    <h2>Contact Information</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $full_phone</p>
    <p><strong>Company:</strong> $company</p>
    <p><strong>Country:</strong> $country</p>
    <h3>Message</h3>
    <p>$message</p>
    ";

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                             // Enable SMTP authentication
        $mail->Username = 'youngict2014@gmail.com';           // SMTP username (your Gmail address)
        $mail->Password = 'ovokuhsfiftpjpnj';            // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                  // TCP port to connect to

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        // Sender and Recipient
        $mail->setFrom($email, $name);
        $mail->addAddress('youngict2014@gmail.com');

        // Email subject and body
        $mail->Subject = $subject;
        $mail->isHTML(true); // Set email format to HTML
        $mail->Body = $emailBody;

        // Send the email
        $mail->send();
        echo "<script LANGUAGE='JavaScript'>
                window.alert('Thank you " . $name . "! We will contact you shortly!');
                window.location.href='index.html';
            </script>";
    } catch (Exception $e) {
        echo "Error sending email: " . $mail->ErrorInfo;
    }
}
?>