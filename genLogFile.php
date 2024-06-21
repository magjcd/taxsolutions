<?php
date_default_timezone_set('Asia/Karachi');
$logFile = 'generalLog.txt';
if(!file_exists($logFile)){

	$ip = $_SERVER['REMOTE_ADDR'];
	$time = date('d/m/Y h:mA',time());
	$contents = "$ip\t$time\r\n";

	if(file_put_contents('generalLog.txt', $contents)){
		//echo 'File created and updated successfully.';
	}else{
		echo 'File created and updated successfully.';
	}
}else{

	$contents = file_get_contents('generalLog.txt');

	$ip = $_SERVER['REMOTE_ADDR'];
	$time = date('d/m/Y h:mA',time());
	$contents .= "$ip\t$time\r\n";

	if(file_put_contents('generalLog.txt', $contents)){
	//echo 'File updated successfully.';
	}else{
		echo "File couldn't be updated successfully.";
	}
}
