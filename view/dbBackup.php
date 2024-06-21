<?php
//$ContObj->adminLogChk();
date_default_timezone_set("Asia/Karachi");
require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';


$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'localhost';
$mail->Port = 25;
$mail->SMTPSecure = false;
$mail->SMTPAutoTLS = false;
$mail->SMTPAuth = false;  
$mail->Username = 'dbbackup@sawrevataxsolution.com';
$mail->Password = 'Yop%xU5UeKBr';

$mail->setFrom('dbbackup@sawrevataxsolution.com', 'DB Backup');
$mail->addAddress('magjcd@gmail.com', 'Receiver: Ali');     // Add a recipient
$mail->addCC('sawrevadata@gmail.com');

$filePath = realpath(__DIR__.'/..'.'/backupDB/sawreva.sql');
$mail->addAttachment($filePath, 'sawreva '.date('d/m/Y h:i:s A').'.sql');    // 
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Sawreva DB Backup '.date('d/m/Y h:i:s A');
$mail->Body    = "Dear Receiver<br /><br />
This is <b><u>SAWREVA Tax Solution's</b></u> Database Backup for 
<b>".date('d/m/Y h:i:s A').'</b><br /><br /><br /> By '.'magTech<br />'.'+92 333 244 5283';

if(!$mail->send()) {
    echo 'Backup could not be sent.';
    echo "<div class='message'>Mailer Error: " . $mail->ErrorInfo."</div>";
} else {
    echo "<div class='success-msg'>Backup has been sent at given email address.</div>";
}
?>