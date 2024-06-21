<?php
date_default_timezone_set("Asia/Karachi");
require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';


$mail = new PHPMailer;

$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
// $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->Host = 'dbbackup@sawrevataxsolution.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = 'magtechtestacc@gmail.com';                 // SMTP username
// $mail->Password = 'Titoo#02';                           // SMTP password
$mail->Username = 'dbbackup@sawrevataxsolution.com';                 // SMTP username
$mail->Password = 'Yop%xU5UeKBr';                           // SMTP password

$mail->SMTPSecure = 'tls';//'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; //587;                                    // TCP port to connect to

$mail->setFrom('magjcd@gmail.com', 'DB Backup');
$mail->addAddress('magjcd@gmail.com', 'Receiver: Ali');     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$filePath = realpath(__DIR__.'/..'.'/backupDB/sawreva.sql');
// $mail->addAttachment('../backupDB/sawreva.sql', 'sawreva '.date('d/m/Y h:i:s A').'.sql');    // Optional name
$mail->addAttachment($filePath, 'sawreva '.date('d/m/Y h:i:s A').'.sql');    // 
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Sawreva DB Backup '.date('d/m/Y h:i:s A');
$mail->Body    = "Dear Receiver<br /><br />
This is the <b><u>SAWREVA Tax Solutions'</b></u> auto Generated Database Backup for 
<b>".date('d/m/Y h:i:s A').'</b><br /><br /><br /> By '.'magTech<br />'.'+92 333 244 5283';
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Backup could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Backup has been sent at given email address.';
}
