<div class="row single-column">
<h1 class="heading-big">Branch office</h1>
<div class="col-12">
	<form action="index.php?page=bo" method="post" style="margin-left: auto; margin-right: auto;">
	<input type="text" name="boNm" placeholder="Branch Office"><br />
	<input type="submit" name="" value="Add">
	</form>
</div>
</div>

<?php
if(isset($_POST['boNm'])){
	$ContObj->bo($_POST['boNm']);
}
?>



<?php
// Creating Object for Listing Branch Offices
$vBrOff = $ContObj->viewBrOff();
?>

<div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of BOs
		if($vBrOff){
			?>
	<h1 class="heading-big">Branch Offices List</h1>

	<div style="overflow-x:auto;">
	<table id="users">
	<tr><th>Tax Off. Unit Name</th><th>Action</th></tr>	
	<?php
	if(isset($_SESSION['admin'])){
		foreach ($vBrOff as $data) {

			echo "<tr><td>".$data['brOffNm']."</td><td style='width: 30px;'>
			<a href='index.php?page=updBo&eid=".$data['id']."&eNm=".$data['brOffNm']."' id='edit'>
			<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
		}
	}else{
		foreach ($vBrOff as $data) {
			echo "<tr><td>".$data['brOffNm']."</td><td style='width: 30px;'></td></tr>";
		}
	}
	?>
	</table>
	</div>
	<?php
	}else{
		echo "<div class='success-msg'>No Branch Office is Available</div>";
	}
	?>
</div>
</div>