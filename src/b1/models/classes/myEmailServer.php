<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require(realpath($_SERVER['DOCUMENT_ROOT']) . "/btth3-b1/vendor/autoload.php");

include_once("models/interfaces/IEmailService.php");
class MyEmailServer implements EmailServerInterface
{
  public function sendEmail($to, $subject, $message)
  {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->Username = 'chicong422002@gmail.com';
    $mail->Password = '';
    $mail->setFrom("chicong422002@gmail.com", "Chi Cong");
    $mail->addAddress($to, "Cong");
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->send()) {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
      echo 'Message sent!';
    }
  }
}
