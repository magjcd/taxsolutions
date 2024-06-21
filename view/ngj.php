<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
<script type="text/javascript" src="./public/js/jquery-3.5.1.js"></script>
<script type="text/javascript" src="./public/js/myfunc.js"></script>
</head>
<body>
<?php
$ClientDt = $ContObj->viewGjClients();
$repPrevBal = $ContObj->prevBalRep();
// Creating Object for Listing Status
$vFeeTp = $ContObj->viewFeeTp();
$repLedAccs = $ContObj->repLedAccs();
// echo '<pre>';
// print_r($repLedAccs);
if($ClientDt){

	$jdt = isset($_POST['gjDt']) ? $_POST['gjDt'] : "";
	// $clNm = isset($_POST['id']) ? $_POST['id'] : "";
	$ft = isset($_POST['fTp']) ? $_POST['fTp'] : "";
	$fYr = isset($_POST['fYr']) ? $_POST['fYr'] : "";
	$desc = isset($_POST['desc']) ? $_POST['desc'] : "";
	$dr = isset($_POST['dr']) ? $_POST['dr'] : "";
	$cr = isset($_POST['cr']) ? $_POST['cr'] : "";
	$repLedAcc = isset($_POST['repLedAcc']) ? $_POST['repLedAcc'] : "";

	if(isset($_POST['accNm'])){

		// Sending Representative information for saving in Database in order to recongnize transaction
		$repDet = explode("_",$_SESSION['taxmagrep']);
		$repId = $repDet[0];
		$repNm = $repDet[1];
		echo gettype($dr);
		echo gettype($cr);
		// return;
		// Sending information to Controller for saving in Database alongwith Representative information
		// $ContObj->nGj($jdt,$_POST['accNm'],$ft,$fYr,$desc,$dr,$cr,$repId,$repNm,$repLedAcc);
	}
?>
<div class="full-width">
<div style="text-align: center; font-weight: bold;"><?php echo date('l jS F Y'); ?></div>
<h1 class="heading-big">General Journal</h1>
<?php if($repPrevBal){
	foreach($repPrevBal as $repPrevData){
		//if($repPrevData['bal'] < 0){
	$gjPrBl = $repPrevData['bal'];	
	?>
<div id="repPrevBal" style="padding: 5px; margin-bottom: 5px;">Your Previous Balance is: <?php echo number_format($repPrevData['bal'],2); ?></div>
<?php }}//} ?>
<span id="bal"></span>
<form action="index.php?page=ngj" method="post" style="text-align: center;">

	<!-- HIDDEN Account of Representative -->
	<select name="repLedAcc" hidden="true">
		<?php 
		if($repLedAccs){
			foreach($repLedAccs as $repLedAcc){
				?>
				<option value="<?php echo $repLedAcc['id']; ?>|<?php echo $repLedAcc['hdId']; ?>|<?php echo $repLedAcc['headNm']; ?>|<?php echo $repLedAcc['sHdId']; ?>|<?php echo $repLedAcc['sHdNm']; ?>|<?php echo $repLedAcc['clientNm']; ?>"><?php echo $repLedAcc['clientNm']; ?></option>
				<?php 
			}
		}
			?>
	</select>

	<input type="date" name="gjDt" class="gjFldM" value="<?php echo date('Y-m-d'); ?>">
	<!-- <input type="text" name="gjDt" id="gjFld" value="<?php //echo date('d/m/Y');?>" disabled> -->

<!-- 	<select name="accNm" class="gjFldL" autofocus="autofocus">
		<option value="">Select an Account</option>
		<option disabled="disabled">-------------------------------------------</option>
		<?php
		foreach ($ClientDt as $data) {
			?>
			<option value="<?php echo $data['id']; ?>|<?php echo $data['clientNm']; ?>|<?php echo $data['cityId']; ?>|<?php echo $data['cityNm']; ?>|<?php echo $data['hdId']; ?>|<?php echo $data['headNm']; ?>|<?php echo $data['sHdId']; ?>|<?php echo $data['sHdNm']; ?>"><?php echo $data['clientNm']; ?> - <?php echo $data['cityNm']; ?></option>
			<?php
		}
			?>
		</select> -->

		<input type="text" list="accNm" name="accNm" id="accNmDet" class="gjFldL" autofocus="autofocus" 
		onclick="this.select();">
		<datalist id="accNm">
		<?php
		foreach ($ClientDt as $data){
			?>
			<option value="<?php echo $data['id']; ?>|<?php echo $data['clientNm']; ?>|<?php echo $data['cityId']; ?>|<?php echo $data['cityNm']; ?>|<?php echo $data['hdId']; ?>|<?php echo $data['headNm']; ?>|<?php echo $data['sHdId']; ?>|<?php echo $data['sHdNm']; ?>|<?php echo $data['busNm']; ?>">
				<?php echo $data['clientNm']; ?> - <?php echo $data['busNm']; ?> - <?php echo $data['cnicNo']; ?> - <?php echo $data['cityNm']; ?>
				</option>
			<?php
		}
			?>
		</datalist>

		<select name="fTp" class="gjFldM">
		<option value="">Fees Type</option>
		<option disabled="disabled">-------------------------------------------</option>
		<?php 
		if($vFeeTp){
			foreach($vFeeTp as $vFeeData){
		?>
		<option value="<?php echo $vFeeData['id']; ?>|<?php echo $vFeeData['feeTp']; ?>">
			<?php echo $vFeeData['feeTp']; ?></option>
		<?php }} ?>
		</select>
		<!-- <input type="number" name="fYr" placeholder="2020" dir="rtl" class="gjFld" value="<?php echo $fYr; ?>"> -->


 			<select name="fYr" class="gjFld" dir="rtl">
				<option>Year</option>
				<?php
				$txyear = 2000;
				for($i = $txyear; $i <= 2050; $i++){
				?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>

<!--  		<?php 
 		$txyear = 2002; 
 		?>
 		<input type="number" list="txYr" name="fYr" id="txyear" class="gjFld">
 		<datalist id="txYr">
 			<?php
 			for($i = $txyear; $i <= 2050; $i++){
 				?>
 					<option value="<?php echo $i; ?>">
 				<?php 
 			}	
 			?>
 		</datalist> -->

		<input type="text" name="desc" placeholder="Description" class="gjFldL" value="<?php echo $desc; ?>">
		<input type="number" name="dr" placeholder="Debit" dir="rtl" class="gjFld" value="<?php echo $dr; ?>">
		<input type="number" name="cr" placeholder="Credit" dir="rtl" class="gjFld" value="<?php echo $cr; ?>">
		<!-- <input type="submit" name ="addGj" value="Add" class="gjFld"> -->
		<button type="submit" name ="addGj" value="Add" class="gjFld">Add</button>
		<!-- class="addGj" -->
</form>
<div class="rowGap">&nbsp;</div>
<?php
}

// else{
// 	echo "No record is availale.";
// }

$vGjEnt = $ContObj->vGjEnt();
if($vGjEnt){
	?>
	<!-- <div class="full-width"> -->
		<!-- <h1 class="heading-big">General Journal Entries</h1> -->

		<div style="width: 100%; overflow-x: auto;">
		<table style="width: 100%;">

			<tr>
				<th>Account Name</th>
				<th>Trans. Date & Time</th>
				<th>Bus. Name</th>
				<th>City</th>
				<th>Fees Type</th>
				<th>Fees Year</th>
				<th>Description</th>
				<th>Debit</th>
				<th>Credit</th>
				<th>Action</th>
			</tr>

			<?php
			foreach ($vGjEnt as $data) {
				?>
				<tr><td><?php echo $data['clientNm']; ?></td><td><?php echo $data['gjDt'].' '.$data['gjTm']; ?></td><td><?php echo $data['busNm']; ?></td><td><?php echo $data['cityNm']; ?></td><td><?php echo $data['feeTp']; ?></td><td><?php echo $data['feeYr']; ?></td><td><?php echo $data['description']; ?></td><td><?php echo number_format($data['drAmt'],0); ?></td><td><?php echo number_format($data['crAmt'],0); ?></td>
					<td>
						<?php echo "
						<a href='index.php?page=gjEntUpd&gjEid=".$data['id']."' id='edit'>
				<i class='fa fa-edit fa-lg fa-fw'></i></a>"; 
				?>
				</td>
				</tr>
				<?php
			}
			$totDrCr = $ContObj->totDrCrgj();
			foreach ($totDrCr as $DrCr) {
			$gjCurBl = ($DrCr['drAmt']-$DrCr['crAmt']);	
			?>
			<tr><th colspan="7" style="text-align: center;">Total Amount</th><th><?php echo number_format($DrCr['drAmt'],0); ?></th><th><?php echo number_format($DrCr['crAmt'],0); ?></th><th></th></tr>
			<?php } ?>
		</table>
	</div>
		<div id="repPrevBal" style="padding: 5px; margin-top: 5px;">Your Current Balance is: <?php echo (number_format($gjPrBl+$gjCurBl,0)); ?></div>
	</div>
	<?php
}
?>
<!-- </div> -->
</body>
</html>