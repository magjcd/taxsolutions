<?php
if(isset($_GET['eid'])){
	$eId = $_GET['eid'];
	$eNm = $_GET['eNm'];
?>
<div class="row">
<h1 class="heading-big">Update Business Category</h1>
	<!-- <div class="col-md-6"> -->
		<form action="index.php?page=updBussCat&eid=<?php echo $_GET['eid']; ?>
		&eNm=<?php echo $_GET['eNm']; ?>" 
			method="post" style="margin-left: auto; margin-right: auto;">
		<input type="text" name="ctNm" placeholder="Business Category" value="<?php echo $eNm; ?>"><br />
		<input type="submit" name="" value="Update">
		</form>
	<!-- </div> -->
</div>


<?php
if(isset($_POST['ctNm'])){
	$ContObj->updBussCat($eId, $_POST['ctNm']);
}

// end main IF
}
?>