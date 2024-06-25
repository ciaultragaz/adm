<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$email = 'teste@nhid.com.br';

switch ($section) {
    case 'email':
        $emailTo = $_REQUEST['emailTo'];
        $token = $_REQUEST['token'];
        $email = $emailTo;
        $link = "https://auto.ultragaz24horas.com/?page=r&token=".$token;
        $subject = 'Recadastrar Senha !';
        $body    = 'Para recadastrar a senha <b><a href="'.$link.'" target="_blank">Clique aqui</a></b>';
        $altBody = 'Para recadastrar a senha Clique aqui no link abaixo '.$link;  
        break;
    
    default:
        //$email = ['camilo@nhid.com.br', 'Camilo'];
        $subject = 'Assunto';
        $body    = 'Aqui com <b>html</b>';
        $altBody = 'Sem HTML!';    
        break;
}
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->CharSet = 'UTF-8';
    $mail->Host       = 'mail.nhid.com.br';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'sender@nhid.com.br';                  // SMTP username
    $mail->Password   = 'l#SqF3-ze;~N';                            // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('sender@nhid.com.br', 'Ultragaz 24 Horas');
    $mail->addAddress($email);     // Add a recipient

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body   ;
    $mail->AltBody = $altBody;

    $mail->send();
    echo 'OK';
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }