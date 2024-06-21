<div class="row single-column">
<h1 class="heading-big">Fees Type</h1>
<div class="col-12">
	<form action="index?page=feeType" method="post" style="margin-left: auto; margin-right: auto;">
	<input type="text" name="feeTp" placeholder="Fees Type"><br />
	<input type="submit" name="" value="Add">
	</form>
</div>
</div>




<?php
if(isset($_POST['feeTp'])){
	$ContObj->feeTp($_POST['feeTp']);
}
?>



<?php
// Creating Object for Listing Status
$vFeeTp = $ContObj->viewFeeTp();
?>

<div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of Status
		if($vFeeTp){
			?>
	<h1 class="heading-big">Fees Type List</h1>

	<div style="overflow-x:auto;">
	<table id="users">
	<tr><th>Fees Type</th><th>Action</th></tr>	
	<?php
	if(isset($_SESSION['admin'])){
		foreach ($vFeeTp as $data) {

			echo "<tr><td>".$data['feeTp']."</td><td style='width: 30px;'>
			<a href='index?page=updFeeType&eid=".$data['id']."&eNm=".$data['feeTp']."' id='edit'>
			<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
		}
	}else{
		foreach ($vFeeTp as $data) {
			echo "<tr><td>".$data['feeTp']."</td><td style='width: 30px;'></td></tr>";
		}
	}
	?>
	</table>
	</div>
	<?php
	}else{
		echo "<div class='success-msg'>No Fees Type is Available</div>";
	}
	?>
</div>
</div>