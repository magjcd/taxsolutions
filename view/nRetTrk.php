<?php
$retTpDet = $ContObj->retTpData();
$revEarnDet = $ContObj->revEarnData();

// echo '<pre>';
// print_r($revEarnDet);
// echo '</pre>';
		
		// Sending Representative information for saving in Database in order to recongnize transaction
		// $repDet = explode("_",$_SESSION['taxmagrep']);
		// $repId = $repDet[0];
		// $repNm = $repDet[1];
?>
<div class="full-width">
	<div class="col-12">
		<h1 class="heading-big">Return Tracker</h1>
		<form id="retTrk">
		<input type="date" class="gjFldL" id="retTDt" value="<?php echo date('Y-m-d'); ?>" dir="rtl" >
		<br />
			<select id="retType" class="gjFldL" autofocus="autofocus">
				<option value="">Select Return Type</option>
				<option disabled="disabled">----------------------------</option>
				<?php
				if($retTpDet){
					foreach ($retTpDet as $retTpDet) {
						?>
						<option value="<?php echo $retTpDet['id']; ?>|<?php echo $retTpDet['feeTp']; ?>">
							<?php echo $retTpDet['feeTp']; ?>
						</option>
						<?php
					}
				}
				?>
			</select>
			<br />
			<!-- <input type="number" min="2000" max="2050" step="1" class="gjFldL" id="taxYr" placeholder="2021" dir="rtl"><br /> -->

			<select id="taxYr" class="gjFldL" dir="rtl">
				<option value="">Select Tax Year</option>
				<?php
				$txyear = 2000;
				for($i = $txyear; $i <= 2050; $i++){
				?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select><br />

<!-- 			<select id="clientDet" class="gjFldL">
			</select>
 -->			<!-- <input id="clientDet" list="clientDet" name="clientDt" class="gjFldL">
			<datalist id="clientDet">
				
			</datalist>-->
		<input type="text" id="clientDt" list="clientDet" name="clientDet" class="gjFldL" 
		autofocus="autofocus" onclick="this.select();" autocomplete="off">
		<datalist id="clientDet">
		</datalist>
		
			<input type="number" class="gjFldL" id="barCd" value="" placeholder="123456789123456" dir="rtl">
			<input type="date" class="gjFld" id="subDt" value="<?php echo date('Y-m-d'); ?>">
			<input type="number" class="gjFld" id="payfee" value="0" dir="rtl">
			<input type="text" class="gjFldL" id="rem" placeholder="Remarks">
			<div id="feetext" style="display: none;"></div>


			<select id="earnedRev" style="display: none;">
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

			<!-- <input type="number" name="sesId" id="sesId" value="<?php //echo $repId; ?>" style="display: none;">
			<input type="text" name="sesNm" id="sesNm" value="<?php //echo $repNm; ?>" style="display: none;"> -->

			<!-- <input type="submit" class="gjFldL" id="pay" value="Save"> -->
			<button type="submit" id="pay" class="gjFldL" accesskey="s">Save</button>

		</form>

		<table id="fb">
		</table>

		<div style="width: 100%; overflow-x: auto;">
			<table id="retTrkData">
				<div id="box">
					<div id="loader"></div>
					<h3 id="loaderNm">SAWREVA</h3>
					<h6 id="loadingNm">Loading...</h6>
				</div>
			</table>
		</div>
	</div>
	<br /><br />
</div>
