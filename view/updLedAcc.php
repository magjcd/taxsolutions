<?php
if(isset($_POST['subHead'])){
		$ContObj->updLedAcc($_POST['accId'],$_POST['subHead'],$_POST['accNm'],$_POST['city']);
	}
if(isset($_GET['eid'])){
	$vSHdAcc = $ContObj->vShdAcc();
	$vCity = $ContObj->viewCity();
	$vAcc = $ContObj->vAcc();
	$eId = $_GET['eid'];
	$accNm = $_GET['accNm'];
	$sHdId = $_GET['subHdId'];
	$sHdNm = $_GET['subHdNm'];
	$hdId = $_GET['hdId'];
	$hdNm = $_GET['hdNm'];
	$ctId = $_GET['ctId'];
	$ctNm = $_GET['ctNm'];
	?>
	<div class="row single-column">
	<h1 class="heading-big">Edit Account</h1>
	<div class="col-12">
		<form action="index?page=updLedAcc&eid=<?php echo $eId; ?>&accNm=<?php echo $accNm; ?>&subHdId=<?php echo $sHdId; ?>&subHdNm=<?php echo $sHdNm; ?>&hdId=<?php echo $hdId; ?>&hdNm=<?php echo $hdNm; ?>&ctId=<?php echo $ctId; ?>&ctNm=<?php echo $ctNm; ?>" method="post" style="text-align: center;">
			
			<select name="subHead">
				<?php
				foreach ($vSHdAcc as $data) {
				?>

				<option <?php if($sHdId == $data['id']){ echo 'selected="selected"'; } ?> value="<?php echo $data['id']; ?>|<?php echo $data['subHeadNm']; ?>|<?php echo $data['hdId']; ?>|<?php echo $data['headNm']; ?>"><?php echo $data['subHeadNm']; ?></option>
				<?php
				}
				?>
			</select>

			<input type="text" name="accId" value="<?php echo $eId; ?>" hidden="true"><br />			
			<input type="text" name="accNm" placeholder="Account Name" value="<?php echo $accNm; ?>"><br />
			
			<select name="city">
				<?php foreach($vCity as $ctData){ ?>
				<option <?php if($ctId == $ctData['id']){ echo 'selected="selected"'; } ?> value="<?php echo $ctData['id']; ?>|<?php echo $ctData['cityNm']; ?>">
					<?php echo $ctData['cityNm']; ?></option>
			<?php } ?>
			</select>
			<input type="submit" value="UPDATE">
		</form>
	</div>
</div>
	<?php
}
?>