<?php
$gjDet = $ContObj->vGjEntDt();
?>
<div class="full-width">
	<div class="GenJounMessage"></div>	
	<h1 class="heading-big">View Date wise General Journal</h1>
	<div style="text-align: center;">

		<input type="text" name="vgj" id="vgj" list="vgjv" autofocus>
		<datalist id="vgjv">
			<?php if($gjDet){
				foreach($gjDet as $gjData){
				?>

			<option value="<?php echo $gjData['gjDt'] ?>"><?php echo $gjData['gjDt'] ?></option>
		<?php }}?>
		</datalist>
	</div>
	<div id="fb">

	<div id="box">
		<div id="loader"></div>
		<h3 id="loaderNm">SAWREVA</h3>
		<h6 id="loadingNm">Loading...</h6>
	</div>		

	</div>
</div>