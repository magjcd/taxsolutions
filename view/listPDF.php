<?php 

$pdfFiles = glob('./pdf/*.pdf');
//$pdfFiles = scandir('./pdf/');

foreach($pdfFiles as $pdfFile){
	$cnt = 1;
	if($cnt <=2){
		echo "<a href='".$pdfFile."'>".str_replace('./pdf/','',$pdfFile).'</a>';
		echo '<br/>';
	}else{
		echo "<a href='".$pdfFile."'>".$pdfFile.'</a>';
	}

}
?>