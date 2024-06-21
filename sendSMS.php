<?php 
$username = "923153170285";///Your Username
$password = "Titoo#02";///Your Password
$mobile = "923332445283";///Recepient Mobile Number
$sender = "SenderID";
$message = "Hellow World,<br /> I am Ali,<br /> This is a Test SMS From sendpk.com";
 
////sending sms
 
$post = "sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message)."";
$url = "https://sendpk.com/api/sms.php?username=".$username."&password=".$password."";
$ch = curl_init();
$timeout = 10; // set to zero for no timeout
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$result = curl_exec($ch); 
/*Print Responce*/
//echo $result; 
?>