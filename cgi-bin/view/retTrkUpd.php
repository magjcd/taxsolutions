<?php
$idUpd = $_GET['rTrkEid'];
$retTpDetUpd = $ContObj->retTpPrvData($idUpd);
$retTpDet = $ContObj->retTpData();

if($retTpDetUpd){
	foreach($retTpDetUpd as $retTpDetUpdS){
?>
<div class="full-width">
	<div class="col-12">
		<h1 class="heading-big">Update Return Tracker</h1>
		<form id="retTrkUpd">
		<input type="date" class="gjFldL" id="retTDtUpd" value="<?php echo date('Y-m-d'); ?>" dir="rtl" >
		<br />
			<select id="retTypeUpd" class="gjFldL" autofocus="autofocus">
				<option value="">Select Return Type</option>
				<option disabled="disabled">----------------------------</option>
				<?php
				foreach($retTpDet as $clDtUpd){
					?>
					<option <?php if($retTpDetUpdS['feeTpId'] == $clDtUpd['id']){ ?> selected="selected" <?php } ?> value="<?php echo $clDtUpd['id']; ?>|<?php echo $clDtUpd['feeTp']; ?>"><?php echo $clDtUpd['feeTp']; ?></option>
					<?php
				}
				?>
			</select>
			<br />
			<!-- <input type="text" class="gjFldL" id="taxYrUpd" value="<?php echo $retTpDetUpdS['feeYr']; ?>" dir="rtl"><br /> -->


			<select id="taxYrUpd" class="gjFldL" dir="rtl">
				<option>Select Tax Year</option>
				<?php
				$txyear = 2000;
				for($i = $txyear; $i <= 2050; $i++){
				?>
					<option <?php if($retTpDetUpdS['feeYr'] == $i){ ?> selected="selected" <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select><br />


			<select id="clientDetUpd" class="gjFldL">
				<option><?php echo $retTpDetUpdS['clientNm']; ?></option>
			</select>
			<input type="number" class="gjFldL" id="barCdUpd" value="<?php echo $retTpDetUpdS['barCd']; ?>" dir="rtl">
			<input type="date" class="gjFld" id="subDtUpd" value="<?php echo $retTpDetUpdS['subDt']; ?>">
			<input type="number" class="gjFld" id="payfeeUpd" value="<?php echo $retTpDetUpdS['drAmt']; ?>" dir="rtl">
			<input type="text" class="gjFldL" id="remUpd" value="<?php echo $retTpDetUpdS['description']; ?>">
			<div id="feetext" style="display: none;"></div>
			<input type="text" id="idUpd" value="<?php echo $idUpd; ?>"  style="display: none;">
			<input type="submit" class="gjFldL" id="payUpd" value="Update">
		</form>

		<table>
		</table>

	<table id="retTrkDataUpd">
		
	</table>
	<div id="fb"></div>
</div>
<br /><br />
</div>

<?php }} ?>