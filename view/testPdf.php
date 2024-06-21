<?php 
include('vendor/autoload.php');
$mpdf = new \Mpdf\Mpdf();
$mpdf->debug = true;
$mpdf->WriteHTML('../pdf/Hello World!');
$mpdf->Output('myPDFFile.pdf');
?>