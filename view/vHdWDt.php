<div class="row full-column">
	<?php 
	// $ContObj->dirLogChk();
	$vShdAcc = $ContObj->vShdAcc();
	// echo '<pre>';
	// print_r($vShdAcc);

	if(isset($_POST['msg']) && $_POST['msg'] != ''){
		$msgRes = $ContObj->dirMsg($_POST['msg']);
	}
	?>
	<h1 class="heading-big" style="">Sub-Header Wise Report</h1>
	<div class="col-12" style="text-align: center;">
		<form action="index.php?page=msg" method="post" id="hdWDt" style="text-align: center;">
		<input type="date" id="fd" name="fd" value="<?php echo date('Y-01-01'); ?>">
		<input type="date" id="td" name="td" value="<?php echo date('Y-m-d'); ?>">
		
		<input type="text" id="hdDet" name="hdDet" list="hdData" autofocus="autofocus">
		<datalist id="hdData">
			<?php 
			if($vShdAcc){
				foreach($vShdAcc as $vShdAccDet){
					?>
					<option value="<?php echo $vShdAccDet['id']; ?>|<?php echo $vShdAccDet['subHeadNm']; ?>"><?php echo $vShdAccDet['subHeadNm']; ?></option>
					<?php
				}
			}
				?>
		</datalist>
		<br />
		<!-- <input type="submit" name="" value="SEND"> -->
		</form>
	

	<div class="sDwAcc">

	<!-- <div id="box">
		<div id="loader"></div>
		<h3 id="loaderNm">SAWREVA</h3>
		<h6 id="loadingNm">Loading...</h6>
	</div> -->		
	</div>
	</div>
	<a href="#" class="scrollTop"><i class="fas fa-arrow-up"></i></a>
</div>