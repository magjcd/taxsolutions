<?php
session_start();
include("../autoLoad.php");
//include(realpath(__DIR__.'/..')."../autoLoad.php");
$ContObj = new Controller();

if(isset($_POST['vSAcc']) && $_POST['vSAcc'] != ""){
	$vSAccArr = explode("|",$_POST['vSAcc']);
	$acId = $vSAccArr[0];
	$acNm = $vSAccArr[1];
	$busNm = $vSAccArr[2];
	$acCt = $vSAccArr[3];
	$accData = $ContObj->sAccData($acId,$_POST['fd'],$_POST['td']);
	$accPrvBal = $ContObj->accPrevBal($acId,$_POST['fd']);
	$drcrTbal = $ContObj->DrCrTbal($acId,$_POST['fd'],$_POST['td']);
	if($accData || $accPrvBal || $drcrTbal){
	?>
	<div class="accTbl" style="width: 100%; overflow-x: auto;">
		<table id="full-width">
			<tr style="background: rgba(0,0,0,0.7); color: #fff;">
				<td colspan="2">Date: <?php echo date('d/m/Y'); ?></td>
					<td style="text-align: center; font-weight: bold;" colspan="6"><?php echo $acNm.' <u>('.$busNm.')</u> '.$acCt; ?></td>				
				<td colspan="2">&nbsp; <a href="view/vAccDetExcel.php?vSAcc=<?php echo $acId; ?>&vAccNm=<?php echo $acNm; ?>&busNm=<?php echo $busNm; ?>&acCat=<?php echo $acCt; ?>&fd=<?php echo $_POST['fd'] ?>&td=<?php echo $_POST['td'] ?>" style='color: #fff;' accesskey='p' id='excelPrn'><i class='fa fa-file-excel-o fa-lg fa-fw'></i></a></td>
			</tr>
			<tr style="text-align: center; margin: 0 auto;">
				<th>Date</th>
				<th>Trans. Dt</th>
				<th>Doc. Type</th>
				<th>Description</th>
				<th>Fee Coll.</th>
				<th>Fees Type</th>
				<th>Fees Year</th>
				<th style="text-align: right;">Debit</th>
				<th style="text-align: right;">Credit</th>
				<th style="text-align: right;">Balance </th>
			</tr>
			<?php 
			if($accPrvBal){
				foreach ($accPrvBal as $prevData) {
			?>
				<tr style="/*background: rgba(133,0,0,0.7); color: #fff;*/ font-weight: bold;"><td colspan="7" style="text-align: right;">Previous Balance</td><td style="text-align: right;" colspan="2"><?php echo number_format($prevData['bal'],2); ?></td></tr>
			<?php 
			$tot = 0;
			$tot = ($tot + $prevData['bal']);
			}} ?>
			<tr>
			<?php
			if($accData){
			foreach($accData as $vData){
				// Calculating Running Balance
				$tot+=($vData['drAmt']-$vData['crAmt']);
			?>
				<td style="text-align: left; width: 10%;"><?php echo $vData['gjDt']; ?></td>
				<td style="text-align: left; width: 10%;"><?php echo $vData['transDt']; ?></td>
				<td style="text-align: left; width: 10%;"><?php echo $vData['retGj']; ?></td>
				<td style="text-align: left; width: 30%;"><?php echo $vData['description']; ?></td>
				<td style="text-align: left; width: 10%;"><?php echo $vData['repNm']; ?></td>
				<td style="text-align: left; width: 10%;"><?php echo $vData['feeTp']; ?></td>
				<td style="text-align: center; width: 10%;"><?php echo $vData['feeYr']; ?></td>
				<td style="text-align: right; width: 10%;"><?php echo number_format($vData['drAmt'],2); ?>
				<td style="text-align: right; width: 10%;"><?php echo number_format($vData['crAmt'],2); ?></td>
				<td style="text-align: right; width: 10%;"><?php echo number_format($tot,2); ?></td>
			</tr>
			<?php }} 


			// DR CR and Total Balance Data for Footer
			foreach($drcrTbal as $dctData){
			?>

			<tr style="background: rgba(0,0,0,0.7); color: #fff; font-weight: bold;">
				<td style="text-align: center;" colspan="7">Balance</td>				
				<td style="text-align: right;"><?php echo number_format($dctData['drAmt'],2); ?></td><td style="text-align: right;"><?php echo number_format($dctData['crAmt'],2); ?></td><td style="text-align: right;"><?php echo number_format($tot,2); ?></td>
			</tr>
			<?php } ?>

		</table>
</div>


 <?php 
}
}
?>