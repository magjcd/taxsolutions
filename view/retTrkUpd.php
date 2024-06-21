<?php
$idUpd = $_GET['rTrkEid'];
$retTpDetUpd = $ContObj->retTpPrvData($idUpd);
$retTpDet = $ContObj->retTpData();
$revEarnDet = $ContObj->revEarnData();

// Sending Representative information for saving in Database in order to recongnize transaction
// $repDet = explode("_",$_SESSION['taxmagrep']);
// $repId = $repDet[0];
// $repNm = $repDet[1];

// echo '<pre>';
// print_r($retTpDetUpd);
// echo '</pre>';
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
				<!-- <option value="">Select Return Type</option> -->
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


			<select id="taxYrUpd" class="gjFldL" dir="rtl">
				<!-- <option>Select Tax Year</option> -->
				<?php
				$txyear = 2000;
				for($i = $txyear; $i <= 2050; $i++){
				?>
					<option <?php if($retTpDetUpdS['feeYr'] == $i){ ?> selected="selected" <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select><br />


			<!-- <select id="clientDetUpd" class="gjFldL">
				<option><?php echo $retTpDetUpdS['clientNm']; ?></option>
			</select> -->
			<input type="text" id="clientDtUpd" list="clientDetUpd" name="clientDetUpd" class="gjFldL" 
			autofocus="autofocus" onclick="this.select()" autocomplete="off">
			<datalist id="clientDetUpd">
<!-- 				<option value="<?php echo $retTpDetUpdS['clientNm']; ?>">
					<?php echo $retTpDetUpdS['clientNm']; ?></option> -->
			</datalist>

			<input type="number" class="gjFldL" id="barCdUpd" value="<?php echo $retTpDetUpdS['barCd']; ?>" dir="rtl">
			<input type="date" class="gjFld" id="subDtUpd" value="<?php echo $retTpDetUpdS['subDt']; ?>">
			<input type="number" class="gjFld" id="payfeeUpd" value="<?php echo $retTpDetUpdS['drAmt']; ?>" dir="rtl">
			<input type="text" class="gjFldL" id="remUpd" value="<?php echo $retTpDetUpdS['description']; ?>">
			<div id="feetext" style="display: none;"></div>
			<input type="text" id="idUpd" value="<?php echo $idUpd; ?>"  style="display: none;">

			<select id="earnedRevUpd" style="display: none;">
				<?php 
					foreach($revEarnDet as $revEarned){
				?>
					<option <?php echo $revEarned['hdId']; ?>|<?php echo $revEarned['headNm']; ?>|<?php echo $revEarned['sHdId']; ?>|<?php echo $revEarned['sHdNm']; ?>|<?php echo $revEarned['id']; ?>|<?php echo $revEarned['clientNm']; ?>>
						<?php echo $revEarned['hdId']; ?>|<?php echo $revEarned['headNm']; ?>|<?php echo $revEarned['sHdId']; ?>|<?php echo $revEarned['sHdNm']; ?>|<?php echo $revEarned['id']; ?>|<?php echo $revEarned['clientNm']; ?>
					</option>
				<?php 
					}
				?>
			</select>

			<!-- <input type="number" name="sesIdUpd" id="sesIdUpd" value="<?php //echo $repId; ?>" style="display: none;">
			<input type="text" name="sesNmUpd" id="sesNmUpd" value="<?php //echo $repNm; ?>" style="display: none;"> -->

			<input type="submit" class="gjFldL" id="payUpd" value="Update" accesskey="u">
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