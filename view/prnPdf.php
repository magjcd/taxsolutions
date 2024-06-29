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
if(isset($_GET['rTrkPrnDt'])){
$rTrkPrnDt = $_GET['rTrkPrnDt'];
$tp = 'retTrk';
$rTrkPrnIdDet = $ContObj->rTrkPrnIdDet($rTrkPrnDt,$tp);

$repDet = explode("_",$_SESSION['taxmagrep']);
$repId = $repDet[0];
$repNm = $repDet[1];

	if($rTrkPrnIdDet){		
		$html = "<div style='width: 100%;font-family: Josefin Sans, sans-Serif;'>
		<span style='font-size: 18px; font-weight: bold;'>SAWREVA</span><br />
		<span style='font-size: 10px;'>Tax Solution</span><br /><br />
		<div style='width: 200px; margin: auto; padding: 10px; font-size: 15px; font-weight: bold; font-variant: small-caps; text-align: center; border: 1px dotted #000;'>Return Tracker</div>
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
						<td style='font-size: 9px;'>".$data['gjDt']."</td>
						<td style='font-size: 9px;'>".$data['clientNm']."</td>
						<td style='font-size: 9px;'>".$data['busNm']."</td>
						<td style='font-size: 9px;'>".$data['cityNm']."</td>
						<td style='font-size: 9px; text-align: center;'>".$data['feeTp']." ".$data['feeYr']."</td>
						<td style='font-size: 9px;'>".$data['barCd']."</td>
						<td style='text-align: right;font-size: 9px;'>".number_format($data['drAmt'],0)."</td>
					</tr>";
					
				}

				
				$totDrCr = $ContObj->totDrCrRTDt($rTrkPrnDt,$tp);
				foreach ($totDrCr as $DrCr) {
				$gjCurBl = ($DrCr['drAmt']-$DrCr['crAmt']);	
				
				$html .= "<tr><th colspan='6' style='text-align: center;font-size: 10px;'>Total Amount</th>
					<th style='text-align: right;font-size: 10px; border-top: 1px solid #000; border-bottom: 3px double #000;'>".number_format($DrCr['drAmt'],0)."</th>
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
$file = $userNm.' '.date('d_m_Y_h_i_s_A').'.pdf';
ob_clean();
$mpdf->Output($file,'I');
}else{



$gjPrnDt = $_GET['gjPrnDt'];
$tp = 'GJ';
$repPrevBal = $ContObj->prevBalRepDTW($gjPrnDt);
$rTrkPrnIdDet = $ContObj->rTrkPrnIdDet($gjPrnDt,$tp);

$repDet = explode("_",$_SESSION['taxmagrep']);
$repId = $repDet[0];
$repNm = $repDet[1];

	if($rTrkPrnIdDet){		
		$html = "<div style='width: 100%;font-family: Josefin Sans, sans-Serif;'>
		<span style='font-size: 18px; font-weight: bold;'>SAWREVA</span><br />
		<span style='font-size: 10px;'>Tax Solution</span><br /><br />
		<div style='width: 200px; margin: auto; padding: 10px; font-size: 15px; font-weight: bold; font-variant: small-caps; text-align: center; border: 1px dotted #000;'>General Journal</div>
		</div>";
		$html .= '<div style="width: 100%; overflow-x: auto;">
			<table style="width: 100%;font-family: Josefin Sans, sans-Serif;">
			<tr><td colspan="4" style="font-size: 10px;">General Journal Entries for Date: '.$gjPrnDt.'<hr />
			</td><td colspan="4" style="font-size: 10px; text-align: right;">Representative: '.$repNm.'<hr /></td></tr>
				<tr style="border-bottom: 3px dotted #000;">
					 <th style="font-size: 10px;">Time</th>
					<th style="font-size: 10px; text-align: left;">Account Name</th>
					<th style="font-size: 10px; text-align: left;">Bus. Name</th>
					<th style="font-size: 10px;">City</th>
					<th style="font-size: 10px;">Fees</th>
					<th style="font-size: 10px; text-align: left;">Description</th>
					<th style="font-size: 10px;">DR</th>
					<th style="font-size: 10px;">CR</th>
				</tr>';

				if($repPrevBal){
					foreach($repPrevBal as $repPrevBalData){
						$prevBalRep = $repPrevBalData['bal'];

						$html .= "<tr><th colspan='7' style='text-align: center;font-size: 10px;'>Previous Balance</th><th style='text-align: right;font-size: 10px;'>".number_format($repPrevBalData['bal'],2)."</th></tr>";
					}
				}

				foreach ($rTrkPrnIdDet as $data) {
					$userNm = $data['repNm'];
					$html .= "<tr style='font-size: 9px;'>
						<td style='font-size: 9px;'>".$data['gjDt']."</td>
						<td style='font-size: 9px;'>".$data['clientNm']."</td>
						<td style='font-size: 9px;'>".$data['busNm']."</td>
						<td style='font-size: 9px;'>".$data['cityNm']."</td>
						<td style='font-size: 9px; text-align: center;'>".$data['feeTp']." ".$data['feeYr']."</td>
						<td style='font-size: 9px;'>".$data['description']."</td>
						<td style='text-align: right;font-size: 9px;'>".number_format($data['drAmt'],2)."</td>
						<td style='text-align: right;font-size: 9px;'>".number_format($data['crAmt'],2)."</td>
					</tr>";
					
				}

				
				$totDrCr = $ContObj->totDrCrRTDt($gjPrnDt,$tp);
				foreach ($totDrCr as $DrCr) {
				$gjCurBl = ($DrCr['drAmt']-$DrCr['crAmt']);	
				
				$html .= "<tr><th colspan='6' style='text-align: center;font-size: 10px;'>Total Amount</th>
					<th style='text-align: right;font-size: 10px; border-top: 1px solid #000; border-bottom: 3px double #000;'>".number_format($DrCr['drAmt'],0)."</th>
					<th style='text-align: right;font-size: 10px; border-top: 1px solid #000; border-bottom: 3px double #000;'>".number_format($DrCr['crAmt'],0)."</th>					
					<th style='text-align: right;font-size: 10px;'></th><th></th></tr>";
				 }

				 $html .= "<tr><th colspan='6' style='text-align: center;font-size: 10px;'>This GJ Amount</th>
				 <th></th>
				 <th style='text-align: right;font-size: 10px;'>".number_format($gjCurBl,2)."</th></tr>
				 <tr><th colspan='6' style='text-align: center;font-size: 10px;'>Current Balance</th>
				 <th></th>
				 <th style='text-align: right;font-size: 10px; border-top: 1px solid #000; border-bottom: 3px double #000;'>".number_format($prevBalRep + $gjCurBl,2)."</th></tr>
				 </table>";
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
$file = $userNm.' '.date('d_m_Y_h_i_s_A').'.pdf';
ob_clean();
$mpdf->Output($file,'I');	
}
?>