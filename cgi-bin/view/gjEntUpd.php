<?php
if(isset($_GET['gjEid'])){
//include("./autoLoad.php");
//include(realpath(__DIR__.'/..')."../autoLoad.php");
$ContObj = new Controller();
	$gjEid = $_GET['gjEid'];
	$gjEidDt = $ContObj->modiGjEnt($gjEid);
	// Grab Accounts Data
	$ClientDt = $ContObj->viewClints();

	// Grabbing Fees Type
	$vFeeTp = $ContObj->viewFeeTp();

	// echo "<pre>";
	// print_r($gjEidDt);
	// echo "</pre>";
	foreach ($gjEidDt as $gjEdt) {
?>

<div style="text-align: center; font-weight: bold;"><?php echo date('l jS F Y'); ?></div>
<h1 class="heading-big">Update General Journal Entry</h1>
<form action="index.php?page=gjEntUpd&gjEid=<?php echo $_GET['gjEid']; ?>" method="post" style="text-align: center;">
	<input type="date" name="gjDt" class="gjFldM" value="<?php echo $gjEdt['gjDt']; ?>">
	<select name="accDet" class="gjFldL">
		<option value="">Select an Account</option>
		<option disabled="disabled">-------------------------------------------</option>
		<?php
		foreach ($ClientDt as $AccData) {
			?>
			<option <?php if($gjEdt['clientId'] == $AccData['id']){?> selected="selected" <?php } ?> value="<?php echo $AccData['id']; ?>|<?php echo $AccData['clientNm']; ?>|<?php echo $AccData['cityId']; ?>|<?php echo $AccData['cityNm']; ?>">
				<?php echo $AccData['clientNm']; ?> - <?php echo $AccData['busNm']; ?> - <?php echo $AccData['cnicNo']; ?> - <?php echo $AccData['cityNm']; ?></option>
			<?php
		}
			?>
		</select>
		<select name="fTp" class="gjFldM">
		<option value="">Fees Type</option>
		<option disabled="disabled">-------------------------------------------</option>
		<?php
		if($vFeeTp){
			foreach($vFeeTp as $vFeeData){
		?>
			<option <?php if($gjEdt['feeTpId'] == $vFeeData['id']){?> selected="selected" <?php } ?> value="<?php echo $vFeeData['id']; ?>|<?php echo $vFeeData['feeTp']; ?>">
				<?php echo $vFeeData['feeTp']; ?></option>
		<?php }} ?>
		</select>
		
		<!-- <input type="number" name="fYr" placeholder="2020" dir="rtl" class="gjFld" value="<?php echo $gjEdt['feeYr']; ?>"> -->

			<select name="fYr" class="gjFld" dir="rtl">
				<option>Year</option>
				<?php
				$txyear = 2000;
				for($i = $txyear; $i <= 2050; $i++){
				?>
					<option <?php if($gjEdt['feeYr'] == $i){ ?> selected="selected" <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>

		<input type="text" name="desc" placeholder="Description" class="gjFldL" value="<?php echo $gjEdt['description']; ?>">
		<input type="number" name="dr" placeholder="Debit" dir="rtl" class="gjFld" value="<?php echo $gjEdt['drAmt']; ?>">
		<input type="number" name="cr" placeholder="Credit" dir="rtl" class="gjFld" value="<?php echo $gjEdt['crAmt']; ?>">
	<?php } ?>
		<input type="submit" name ="addGj" value="Update" class="gjFld">
</form>

<?php
if(isset($_POST['desc'])){
// Sending Form Data for Updation
$ContObj->gjEntUpd($gjEid,$_POST['gjDt'],$_POST['accDet'],$_POST['fTp'],$_POST['fYr'],$_POST['desc'],$_POST['dr'],$_POST['cr']);
}
}
?>