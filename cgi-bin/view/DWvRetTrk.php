<?php
$gjDet = $ContObj->vGjEntDt(); //This function works for both GJ and for Return Tracker
?>
<div class="full-width">
	<h1 class="heading-big">View Date wise Return Tracker</h1>
	<div style="text-align: center;">
		<select id="retTrk" autofocus>
			<option value="">Select a Date</option>
			<option disabled="disabled">-------------------------------------</option>
			<?php if($gjDet){
				foreach($gjDet as $gjData){
				?>

			<option value="<?php echo $gjData['gjDt'] ?>"><?php echo $gjData['gjDt'] ?></option>
		<?php }}?>
		</select>
	</div>
	<div id="vRetTrk" style="width: 100%;">

	<div id="box">
		<div id="loader"></div>
		<h3 id="loaderNm">SAWREVA</h3>
		<h6 id="loadingNm">Loading...</h6>
	</div>		

	</div>
</div>