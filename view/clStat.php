<div class="row single-column">
	<h1 class="heading-big" style="text-align: center;">Add Client Status</h1>
	<div class="col-12">
		<form action="index?page=clStat" method="post" style="margin-left: auto; margin-right: auto;">
			<input type="text" name="cStatus" placeholder="Indivisual"><br />
			<input type="submit" name="" value="Add">
		</form>
	</div>
</div>


<?php
if(isset($_POST['cStatus'])){
	$ContObj->cStatus($_POST['cStatus']);
}
?>



<?php
// Creating Object for Listing Status
$vStatus = $ContObj->viewStatus();
?>

<div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of Status
		if($vStatus){
			?>
	<h1 class="heading-big">Status List</h1>

	<div style="overflow-x:auto;">
	<table id="users">
	<tr><th>Status Name</th><th>Action</th></tr>	
	<?php
	if(isset($_SESSION['admin'])){
		foreach ($vStatus as $data) {

			echo "<tr><td>".$data['statNm']."</td><td style='width: 30px;'>
			<a href='index.php?page=updClStat&eid=".$data['id']."&eNm=".$data['statNm']."' id='edit'>
			<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
		}
	}else{
		foreach ($vStatus as $data) {
			echo "<tr><td>".$data['statNm']."</td><td style='width: 30px;'></td></tr>";
		}
	}
	?>
	</table>
	</div>
	<?php
	}else{
		echo "<div class='success-msg'>No Status is Available</div>";
	}
	?>
</div>
</div>