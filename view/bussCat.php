<div class="row single-column">
<h1 class="heading-big">Business Category</h1>
<div class="col-12">
	<form action="index.php?page=bussCat" method="post" style="margin-left: auto; margin-right: auto;">
	<input type="text" name="bussCat" placeholder="Business Category"><br />
	<input type="submit" name="" value="Add">
	</form>
</div>
</div>




<?php
if(isset($_POST['bussCat'])){
	$ContObj->busCat($_POST['bussCat']);
}
?>



<?php
// Creating Object for Listing Status
$vBussCat = $ContObj->viewBussCat();
?>

<div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of Status
		if($vBussCat){
			?>
	<h1 class="heading-big">Business Category List</h1>

	<div style="overflow-x:auto;">
	<table id="users">
	<tr><th>Bussiness Category</th><th>Action</th></tr>	
	<?php
	if(isset($_SESSION['admin'])){
		foreach ($vBussCat as $data) {

			echo "<tr><td>".$data['busCatNm']."</td><td style='width: 30px;'>
			<a href='index?page=updBussCat&eid=".$data['id']."&eNm=".$data['busCatNm']."' id='edit'>
			<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
		}
	}else{
		foreach ($vBussCat as $data) {
			echo "<tr><td>".$data['busCatNm']."</td><td style='width: 30px;'></td></tr>";
		}
	}
	?>
	</table>
	</div>
	<?php
	}else{
		echo "<div class='success-msg'>No Business Category is Available</div>";
	}
	?>
</div>
</div>