<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // Use 587 for TLS
$mail->SMTPSecure = "ssl"; // Use "tls" for TLS
$mail->Username = "ivankiew0310@gmail.com"; // Replace with your Gmail email address
$mail->Password = "ibtw tucl gfov cowg"; // Replace with your Gmail account password
$mail->SMTPAuth = true;

$mail->isHtml(true);

return $mail;
