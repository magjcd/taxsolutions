<?php
$logFile = 'log.txt';
if(!file_exists($logFile)){

	$ip = $_SERVER['REMOTE_ADDR'];
	$time = date('d/m/Y h:mA',time());
	$contents = "$ip\t$time\r\n";

	if(file_put_contents('log.txt', $contents)){
		echo 'File created and updated successfully.';
	}
}else{

	$contents = file_get_contents('log.txt');

	$ip = $_SERVER['REMOTE_ADDR'];
	$time = date('d/m/Y h:mA',time());
	$contents .= "$ip\t$time\r\n";

	if(file_put_contents('log.txt', $contents)){
	echo 'File updated successfully.';
	}
}
