<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap' rel='stylesheet'>
</head>
<body>

</body>
</html>
<?php 

$rTrkPrnDt = $_GET['rTrkPrnDt'];
$rTrkPrnIdDet = $ContObj->rTrkPrnIdDet($rTrkPrnDt);

// echo '<pre>';
// print_r($rTrkPrnIdDet);
// echo '</pre>';
$repDet = explode("_",$_SESSION['representative']);
$repId = $repDet[0];
$repNm = $repDet[1];

	if($rTrkPrnIdDet){		
		$html = "<div style='width: 100%;font-family: Josefin Sans, sans-Serif;'>
		<span style='font-size: 18px; font-weight: bold;'>SAWREVA</span><br />
		<span style='font-size: 10px;'>Tax Solution</span><br /><br />
		</div>";
		$html .= '<div style="width: 100%; overflow-x: auto;">
			<table style="width: 100%;font-family: Josefin Sans, sans-Serif;">
			<tr><td colspan="4" style="font-size: 10px;">Return Tracker Entries for Date: '.$rTrkPrnDt.'<hr />
			</td><td colspan="4" style="font-size: 10px; text-align: right;">Representative: '.$repNm.'<hr /></td></tr>
				<tr style="border-bottom: 3px dotted #000;">
					 <th style="font-size: 10px;">Time</th>
					<th style="font-size: 10px; text-align: left;">Account Name</th>
					<th style="font-size: 10px; text-align: left;">Bus. Name</th>
					<th style="font-size: 10px;">City</th>
					<th style="font-size: 10px;">Fees</th>
					<th style="font-size: 10px;">Bar Code</th>
					<th style="font-size: 10px;">Amount</th>
				</tr>';

				foreach ($rTrkPrnIdDet as $data) {
					$userNm = $data['repNm'];
					$html .= "<tr style='font-size: 9px;'>
						<td style='font-size: 9px;'>".$data['gjTm']."</td>
						<td style='font-size: 9px;'>".$data['clientNm']."</td>
						<td style='font-size: 9px;'>".$data['busNm']."</td>
						<td style='font-size: 9px;'>".$data['cityNm']."</td>
						<td style='font-size: 9px; text-align: center;'>".$data['feeTp']." ".$data['feeYr']."</td>
						<td style='font-size: 9px;'>".$data['barCd']."</td>
						<td style='text-align: right;font-size: 9px;'>".number_format($data['drAmt'],0)."</td>
					</tr>";
					
				}

				
				$totDrCr = $ContObj->totDrCrRTDt($rTrkPrnDt);
				foreach ($totDrCr as $DrCr) {
				$gjCurBl = ($DrCr['drAmt']-$DrCr['crAmt']);	
				
				$html .= "<tr><th colspan='6' style='text-align: center;font-size: 10px;'>Total Amount</th>
					<th style='text-align: right;font-size: 10px;'>".number_format($DrCr['drAmt'],0)."</th>
					<th style='text-align: right;font-size: 10px;'></th><th></th></tr>";
				 } 
			$html .= "</table>";
				$html .= "<hr /><p style='text-align: center; font-size: 9px;font-family: Josefin Sans, sans-Serif;'>Copy Right &copy;".date('Y')."-2021 - Design & Developed by magTech | +92 333 244 5283</p>";
			?>
		</div>
	<br /><br /><br />
		<?php
	}


include('vendor/autoload.php');
$mpdf = new \Mpdf\Mpdf();
$mpdf->debug = true;
$mpdf->WriteHTML($html);
//$file = './pdf/'.$userNm.' '.date('d_m_Y_h_i_s_A').'.pdf';
$file = $userNm.' '.date('d_m_Y_h_i_s_A').'.pdf';
ob_clean();
$mpdf->Output($file,'D');	
//header('location: index?page=DWvRetTrk');
?>