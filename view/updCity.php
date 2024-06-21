<?php
if(isset($_GET['eid'])){
	$uCtId = $_GET['eid'];
	$uCtNm = $_GET['eNm'];
?>
<div class="row">
<h1 class="heading-big">City</h1>
	<!-- <div class="col-md-6"> -->
		<form action="index.php?page=updCity&eid=<?php echo $_GET['eid']; ?>
		&eNm=<?php echo $_GET['eNm']; ?>" 
			method="post" style="margin-left: auto; margin-right: auto;">
		<input type="text" name="ctNm" placeholder="City Name" value="<?php echo $uCtNm; ?>"><br />
		<input type="submit" name="" value="Update">
		</form>
	<!-- </div> -->
</div>


<?php
if(isset($_POST['ctNm'])){
	$ContObj->updCity($uCtId, $_POST['ctNm']);
}

// end main IF
}
?>