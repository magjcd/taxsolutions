<div class="row single-column">
<h1 class="heading-big">City</h1>
	<div class="col-12">
		<form action="index.php?page=nCity" method="post" style="margin-left: auto; margin-right: auto;">
		<input type="text" name="ctNm" placeholder="City Name"><br />
		<input type="submit" name="" value="Add">
		</form>
	</div>
</div>


<?php
if(isset($_POST['ctNm'])){
	$ContObj->nCity($_POST['ctNm']);
}
?>



<?php
// Creating Object for Listing Branch Offices
$vCity = $ContObj->viewCity();
?>

<div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of BOs
		if($vCity){
			?>
	<h1 class="heading-big">City List</h1>

	<div style="overflow-x:auto;">
	<table>
	<tr><th>City Name</th><th>Action</th></tr>	
	<?php
	if(isset($_SESSION['admin'])){
		foreach ($vCity as $data) {

			echo "<tr><td>".$data['cityNm']."</td><td style='width: 30px;'>
			<a href='index?page=updCity&eid=".$data['id']."&eNm=".$data['cityNm']."' id='edit'>
			<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
		}
	}else{
		foreach ($vCity as $data) {
			echo "<tr><td>".$data['cityNm']."</td><td style='width: 30px;'></td></tr>";
		}
	}
	?>
	</table>
	</div>
	<?php
	}else{
		echo "<div class='success-msg'>No City is Available</div>";
	}
	?>
</div>
</div>