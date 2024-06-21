<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap' rel='stylesheet'>
	<meta charset="utf-8">

	<title></title>
</head>
<body>

</body>
</html>
<?php 

//$phpPdfDet = $ContObj->phpToPdf();

//$conn = mysqli_connect('184.168.102.151','sawrevajcd','Titoo#02Dhonta','sawreva');
$conn = mysqli_connect('localhost','root','','sawreva');

$sql = "SELECT * FROM `broff`";
$result = mysqli_query($conn,$sql);

ob_start();
$html = "";
$html='<table style="font-family: Josefin Sans, sans-Serif">';
$html.="<tr><th colspan='5' style='background: #006699; color: #fff;'><h5 style='text-align: right;'>Total Clients are Registered</h5></th></tr>";
$html.="<tr style='background: #006699; color: #fff; font-size:14px;'><th style='color: #fff;'>Branch Office</th></tr>";
while($row=mysqli_fetch_assoc($result)) {
	$html.="<tr><td>".$row['brOffNm']."</td></tr>";
}

$html.="</table>";
ob_end_flush();

echo $html;

$user = $_SESSION['representative'];
$userArr = explode('_', $user);
$userId = $userArr[0];
$userNm = $userArr[1];

include('vendor/autoload.php');
$mpdf = new \Mpdf\Mpdf();
$mpdf->debug = true;
$mpdf->WriteHTML($html);
$file = './pdf/'.$userNm.' '.date('d_m_Y_h_i_s_A').'.pdf';
//$mpdf->Output('clientDet.pdf');
$mpdf->Output($file);


?>












