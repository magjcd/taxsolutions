<?php
$accDet = $ContObj->vSAcc();
$dt = date('Y-m-d', strtotime('+100 day'));
?>
<div class="full-width">
	<h1 class="heading-big">View Account</h1>
	<form style="text-align: center;">
		<input type="date" name="fd" id="fd" value="<?php echo date('Y-01-01'); ?>">
		<input type="date" name="td" id="td" value="<?php echo date('Y-m-d'); ?>">

<!-- 		<select name="vSAcc" id="vSAcc" autofocus="">
			<option value="">Select an Account</option>
			<option disabled="">---------------------------------------</option>
			<?php foreach ($accDet as $accDtDet) { ?>
			<option value="<?php echo $accDtDet['id']; ?>|<?php echo $accDtDet['clientNm']; ?>|<?php echo $accDtDet['busNm']; ?>|<?php echo $accDtDet['cityNm']; ?>">
				<?php echo $accDtDet['clientNm']; ?> - <?php echo $accDtDet['busNm']; ?> - <?php echo $accDtDet['cityNm']; ?></option>
			<?php } ?>
		</select>
 -->

		<input type="text" id="vSAcc" list="vSAccc" name="vSAcc" class="gjFldL" 
		autofocus="autofocus" onclick="this.select();">
		<datalist id="vSAccc">

			<?php foreach ($accDet as $accDtDet) { ?>
			<option value="<?php echo $accDtDet['id']; ?>|<?php echo $accDtDet['clientNm']; ?>|<?php echo $accDtDet['busNm']; ?>|<?php echo $accDtDet['cityNm']; ?>">
				<?php echo $accDtDet['clientNm']; ?> - <?php echo $accDtDet['busNm']; ?> - <?php echo $accDtDet['headNm']; ?> - <?php echo $accDtDet['cnicNo']; ?> - <?php echo $accDtDet['sHdNm']; ?> - <?php echo $accDtDet['cityNm']; ?></option>
			<?php } ?>

		</datalist>
	</form>
<!-- </div> -->




	<div class="sDwAcc">

	<div id="box">
		<div id="loader"></div>
		<h3 id="loaderNm">SAWREVA</h3>
		<h6 id="loadingNm">Loading...</h6>
	</div>		
	
	</div>
</div>

<?php //include(realpath(__DIR__.'/..').'/public/js/myfunc.js'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		// $("#vSAcc").change(function(){
		// 	var fd = $("#fd").val();
		// 	var td = $("#td").val();
		// 	var vSAcc = $("#vSAcc").val();
		// 	$.ajax({
		// 		url : 'view/vAccDet.php',
		// 		//url : 'index.php?page=vAccDet',
		// 		type : 'POST',
		// 		data : {fd:fd,td:td,vSAcc:vSAcc},
		// 		beforeSend: function(){
		// 			$("#box").show();
		// 		},
		// 		success : function(data){
		// 			$("#box").hide();
		// 			$(".full-width").html(data);
		// 		}
		// 	});
		// });
	});
</script>