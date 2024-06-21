<?php
//session_start();
//include("../autoLoad.php");
//include(realpath(__DIR__.'/..')."../autoLoad.php");
//$ContObj = new Controller();
$conn = mysqli_connect("184.168.102.151","sawrevajcd","Titoo#02Dhonta","sawreva");

// $conn = mysqli_connect("localhost","root","","sawreva");
if(!mysqli_connect_errno()){

if(isset($_GET['vSAcc']) && $_GET['vSAcc'] != ""){

	$acId = $_GET['vSAcc'];
	$acNm = $_GET['vAccNm'];
	$busNm = $_GET['busNm'];
	$acCt = $_GET['acCat'];
	$fd = $_GET['fd'];
	$td = $_GET['td'];
	// $accData = $ContObj->sAccData($acId,$_POST['fd'],$_POST['td']);
	$sqlAccDet = ("SELECT * FROM ledger WHERE clientId=".$acId." AND gjDt>='".$fd."' AND gjDt<='".$td."'");
	$accData = mysqli_query($conn,$sqlAccDet);

	$sqlPrevBalDet = ("SELECT sum(drAmt-crAmt) as bal FROM ledger WHERE clientId=".$acId." AND gjDt<'".$fd."'");
	$accPrvBal = mysqli_query($conn,$sqlPrevBalDet);

	//$drcrTbal = $ContObj->DrCrTbal($acId,$_POST['fd'],$_POST['td']);
	$sqlPrevTBalDet = ("SELECT sum(drAmt) as drAmt,sum(crAmt) as crAmt,sum(drAmt-crAmt) as Tbal FROM ledger WHERE clientId=".$acId." AND gjDt>='".$fd."' AND gjDt<='".$td."'");
	$drcrTbal = mysqli_query($conn,$sqlPrevTBalDet);

	if($accData || $accPrvBal || $drcrTbal){
		$html = '
		<table>
			<tr>
				<th>Date: '.date('d/m/Y').'</th><th></th><th></th>
					<th>'.$acNm. '<u>('.$busNm.')</u> '.$acCt.'</th>				
					</tr>
					<tr><th></th></tr>
					<tr>
						<th>Date</th>
						<th>Doc. Type</th>
						<th>Description</th>
						<th>Fee Coll.</th>
						<th>Fees Type</th>
						<th>Fees Year</th>
						<th style="text-align: right;">Debit</th>
						<th style="text-align: right;">Credit</th>
						<th style="text-align: right;">Balance</th>
					</tr>';

			if($accPrvBal){
				foreach ($accPrvBal as $prevData) {
					$html .='<tr style="font-weight: bold;"><td colspan="7" style="text-align: right;">Previous Balance</td><td style="text-align: right;" colspan="2">'.number_format($prevData['bal'],2).'</td></tr>';
					$tot = 0;
					$tot = ($tot + $prevData['bal']);
				}
			} 

			if($accData){
			foreach($accData as $vData){
				// Calculating Running Balance
				$tot+=($vData['drAmt']-$vData['crAmt']);

				$html .='<tr>
				<td style="text-align: left; width: 10%;">'.$vData['gjDt'].'</td>
				<td style="text-align: left; width: 10%;">'.$vData['retGj'].'</td>
				<td style="text-align: left; width: 30%;">'.$vData['description'].'</td>
				<td style="text-align: left; width: 10%;">'.$vData['repNm'].'</td>
				<td style="text-align: left; width: 10%;">'.$vData['feeTp'].'</td>
				<td style="text-align: center; width: 10%;">'.$vData['feeYr'].'</td>
				<td style="text-align: right; width: 10%;">'.number_format($vData['drAmt'],2).'
				<td style="text-align: right; width: 10%;">'.number_format($vData['crAmt'],2).'</td>
				<td style="text-align: right; width: 10%;">'.number_format($tot,2).'</td>
			</tr>';
			 }} 


			// DR CR and Total Balance Data for Footer
			 if($drcrTbal){
			 		foreach($drcrTbal as $dctData){

						$html .= '
						<tr>
						<td></td><td></td><td></td><td></td><th>Balance</th><td></td>				
						<th style="text-align: right; border-top:1px solid #000;border-bottom:3px double #000;">'.number_format($dctData['drAmt'],2).'</th>
						<th style="text-align: right; border-top:1px solid #000;border-bottom:3px double #000;">'.number_format($dctData['crAmt'],2).'</th>
						<th style="text-align: right; border-top:1px solid #000;border-bottom:3px double #000;">'.number_format($tot,2).'</th>
						</tr>';
					 }
				}

			 $html .= '
			 </table>';
}
}
}
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=".$acNm.' '.date('d-m-Y_h:i:s_A').".xls");
echo $html;
exit();
?>


























