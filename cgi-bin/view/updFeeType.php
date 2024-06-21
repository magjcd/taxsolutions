<?php
if(isset($_GET['eid'])){
$eid = $_GET['eid'];
$eNm = $_GET['eNm'];
?>
<div class="row">
<h1 class="heading-big">Fees Type</h1>
	<form action="index?page=UpdFeeType&eid=<?php echo $eid; ?>&eNm=<?php echo $eNm; ?>" method="post" style="margin-left: auto; margin-right: auto;">
	<input type="text" name="feeTp" placeholder="Fees Type" value="<?php echo $eNm; ?>"><br />
	<input type="submit" name="" value="Update">
	</form>
</div>
<?php
if(isset($_POST['feeTp'])){
	$ContObj->UpdFeeTp($eid,$_POST['feeTp']);
}

// end mai IF
}
?>