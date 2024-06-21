<?php

if(isset($_POST['rtoNm'])){
	$ContObj->rto($_POST['rtoNm']);
}
?>

<div class="row single-column">
<h1 class="heading-big">RTO</h1>
	<form action="index.php?page=rto" method="post" style="margin-left: auto; margin-right: auto;">
	<input type="text" name="rtoNm" placeholder="RTO"><br />
	<input type="submit" name="" value="Add">
	</form>
</div>


<?php

// Creating Object for Listing RTOs
$vRtos = $ContObj->viewRtos();
?>

<div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of RTOs
		if($vRtos){
			?>
	<h1 class="heading-big">RTOs List</h1>

	<!-- <div style="overflow-x: hidden; overflow-y: scroll; "> -->
	<table id="users" class="table table.strip">
	<tr><th>RTO Name</th><th>Action</th></tr>	
	<?php
	if(isset($_SESSION['admin'])){
		foreach ($vRtos as $data) {

			echo "<tr><td>".$data['rtoName']."</td><td style='width: 30px;'>
			<a href='index.php?page=editRto&eid=".$data['id']."' id='edit'>
			<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
		}
	}else{
		foreach ($vRtos as $data) {
			echo "<tr><td>".$data['rtoName']."</td><td style='width: 30px;'></td></tr>";
		}
	}
	?>
	</table>
	<!-- </div> -->
	<?php
	}else{
		echo "<div class='success-msg'>No RTO is Available</div>";
	}
	?>
</div>
</div>