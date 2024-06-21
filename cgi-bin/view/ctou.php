<div class="row single-column">
<h1 class="heading-big">Tax Office Unit</h1>
<div class="col-12">
	<form action="index.php?page=ctou" method="post" style="margin-left: auto; margin-right: auto;">
		<input type="text" name="touNm" placeholder="Tax Office Unit Name"><br />
		<input type="submit" name="" value="Add">
	</form>
</div>
</div>


<?php
if(isset($_POST['touNm'])){
	$ContObj->ctou($_POST['touNm']);
}
?>



<?php
// Creating Object for Listing TOUs
$vTous = $ContObj->viewCtous();
?>

<div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of RTOs
		if($vTous){
			?>
	<h1 class="heading-big">Tax Office Unit List</h1>

	<!-- <div style="overflow-x: hidden; overflow-y: scroll; "> -->
	<table id="users">
	<tr><th>Tax Off. Unit Name</th><th>Action</th></tr>	
	<?php
	if(isset($_SESSION['admin'])){
		foreach ($vTous as $data) {

			echo "<tr><td>".$data['taxOffName']."</td><td style='width: 30px;'>
			<a href='index?page=updTou&eid=".$data['id']."&eNm=".$data['taxOffName']."' id='edit'>
			<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
		}
	}else{
		foreach ($vTous as $data) {
			echo "<tr><td>".$data['taxOffName']."</td><td style='width: 30px;'></td></tr>";
		}
	}
	?>
	</table>
	<!-- </div> -->
	<?php
	}else{
		echo "<div class='success-msg'>No Tax Office Unit is Available</div>";
	}
	?>
</div>
</div>