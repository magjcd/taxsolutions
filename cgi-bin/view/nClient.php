<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="../public/js/myfunc.js"></script>
</head>
<body>


<?php
include 'controller/nClientConfig.php';
?>

<?php
// Object for sending Form Data to Controller
if(isset($_POST['busStatus'])){
	$ContObj->nClient($_POST['busStatus'],$cName,$cnicNo,$_POST['cCity'],$bussName,$_POST['accNat']);	
}
?>
	<div class="row single-column">
		<h1 class="heading-big" style="">Client Profile Registration</h1>
		<div class="col-12" style="text-align: center;">
			<form action="index.php?page=nClient" method="post" style="text-align: center;">

			<!-- <span class="">*</span> -->
			<select name="busStatus" autofocus>
				<option value="">Select Business Status</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($drpDnStat){
					foreach ($drpDnStat as $data) {
				?>
					<option value="<?php echo $data['id']; ?> | <?php echo $data['statNm']; ?>">
						<?php echo $data['statNm']; ?></option>
				<?php
					}
				}
				?>

			</select><br />
			<input type="text" name="cName" placeholder="Client Name" value="<?php echo $cName; ?>"><br />

			<input type="number" id="cnicNo" name="cnicNo" placeholder="CNIC without Dashes" value="<?php echo $cnicNo; ?>" pattern="^[\d]{13}$" title="4310212345671">
			<br />
			<select name="cCity">
				<option value="">Select City</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($drpDnCity){
					foreach ($drpDnCity as $data) {
				?>
					<option value="<?php echo $data['id']; ?>|<?php echo $data['cityNm']; ?>"><?php echo $data['cityNm']; ?></option>
				<?php
					}
				}
				?>

			</select><br />
			<input type="text" name="bussName" placeholder="Business Name" value="<?php echo $bussName; ?>"><br />
			<?php 
			if($hidAccNat){
				?>
			<select name="accNat" style="display: none;">
				<?php
				foreach($hidAccNat as $hidAccNatData){
					?>
					<option value="<?php echo $hidAccNatData['hdId']; ?>|<?php echo $hidAccNatData['headNm']; ?>|<?php echo $hidAccNatData['id']; ?>|<?php echo $hidAccNatData['subHeadNm']; ?>"></option>
					<?php
				}	
				?>
			</select>
			<?php
			}
			?>

			<?php
			// echo '<pre>';
			// print_r($hidAccNat);
			// echo '</pre>';
			?>


		</div>

		<div class="col-12" style="text-align: center;">
			<button type="submit" name="AddClient">Add</button>
			<!-- <input type="submit" name="AddClient" value="Add"> --><br />
			<input type="reset" name="reset" value="Reset">
		</div>
	</div>
</form>
<br /><br /><br />
</body>
</html>