<?php
if(isset($_GET['eid'])){
	$eId = $_GET['eid'];
	$subHd = $_GET['subHd'];
	$hdId = $_GET['hdId'];
	$hdNm = $_GET['hdNm'];

	include('./autoLoad.php');
	$ContObj = new Controller();
	$hdAccDet = $ContObj->vHdAcc();
	// echo '<pre>';
	// print_r($hdAccDet);
?>

<div class="row single-column">
<h1 class="heading-big">Update Sub Header Account</h1>
	<div class="col-md-12">
		<form action="index?page=updSubHd&eid=<?php echo $_GET['eid']; ?>&subHd=<?php echo $_GET['subHd']; ?>&hdId=<?php echo $_GET['hdId']; ?>&hdNm=<?php echo $_GET['hdNm']; ?>" method="post"  style="text-align: center;">
		
		<input type="text" name="updSHdNm" value="<?php echo $subHd; ?>"><br />
		<select name="updHdNm">
			<?php
			if($hdAccDet){
				foreach($hdAccDet as $hdAccDetData){	
					?>
					<option <?php if($hdId == $hdAccDetData['id']){ ?> selected="selected" <?php } ?>

					 value="<?php echo $hdAccDetData['id']; ?>|<?php echo $hdAccDetData['headNm']; ?>"><?php echo $hdAccDetData['headNm']; ?>
					</option>
					<?php 
				}
			}
				?>
		</select>
			<br />

		<input type="submit" name="update" value="Update">
		</form>
	</div>
</div>


<?php

if(isset($_POST['update'])){
	$ContObj->updSHdAcc($eId,$_POST['updSHdNm'],$_POST['updHdNm']);
}

//end main IF
}
?>