<?php
require('PHPMailer/class.phpmailer.php');
require("PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 4; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->Username = "josem.daw2@gmail.com";
$mail->Password = "j130108l";
$mail->SetFrom("josem.daw2@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("josem.mateo.ortega@gmail.com");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
?>