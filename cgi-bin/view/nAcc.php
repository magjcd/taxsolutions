<?php
$vSHdAcc = $ContObj->vShdAcc();
$vCity = $ContObj->viewCity();

if(isset($_POST['subHead'])){
	$ContObj->nAccount($_POST['accNm'],$_POST['subHead'],$_POST['city']);
}
?>
<div class="row single-column">
	<h1 class="heading-big">Account</h1>
	<div class="col-12">
		<form action="index.php?page=nAcc" method="post" style="text-align: center;">
			<select name="subHead">
				<option value="">Select a Sub Header</option>
				<option disabled="disabled">--------------------------------------</option>
				<?php
				foreach ($vSHdAcc as $data) {
				?>
				<option value="<?php echo $data['id']?>|<?php echo $data['subHeadNm']?>|<?php echo $data['hdId']?>|<?php echo $data['headNm']?>"><?php echo $data['subHeadNm']?></option>
				<?php
				}
				?>
			</select>
			<input type="text" name="accNm" placeholder="Account Name"><br />
			<select name="city">
				<option value="">Select a City</option>
				<option disabled="disabled">--------------------------------------</option>
				<?php foreach($vCity as $ctData){ ?>
				<option value="<?php echo $ctData['id']; ?>|<?php echo $ctData['cityNm']; ?>">
					<?php echo $ctData['cityNm']; ?></option>
			<?php } ?>
			</select>
			<input type="submit" value="Add">
		</form>
	</div>
</div>