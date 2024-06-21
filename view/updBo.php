<?php
if(isset($_GET['eid'])){
	$eId = $_GET['eid'];
	$eNm = $_GET['eNm'];
?>
<div class="row">
<h1 class="heading-big">Update Branch Office</h1>
	<!-- <div class="col-md-6"> -->
		<form action="index?page=updBo&eid=<?php echo $_GET['eid']; ?>
		&eNm=<?php echo $_GET['eNm']; ?>" 
			method="post" style="margin-left: auto; margin-right: auto;">
		<input type="text" name="ctNm" placeholder="Branch office Name" value="<?php echo $eNm; ?>"><br />
		<input type="submit" name="" value="Update">
		</form>
	<!-- </div> -->
</div>


<?php
if(isset($_POST['ctNm'])){
	$ContObj->updBrOff($eId, $_POST['ctNm']);
}

// end main IF
}
?>