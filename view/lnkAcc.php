<div class="row single-column">
<h1 class="heading-big">Linked Account</h1>
<div class="col-12">
	<form action="index.php?page=lnkAcc" method="post" style="margin-left: auto; margin-right: auto;">
		<input type="text" name="lnkAcc" placeholder="Linked Account Name"><br />
		<input type="submit" name="" value="Add">
	</form>
</div>
</div>






<?php
if(isset($_POST['lnkAcc'])){
	$ContObj->lnkAcc($_POST['lnkAcc']);
}
?>



<?php
// Creating Object for Listing Link Account
$vLnkAcc = $ContObj->viewLnkAcc();
?>

<div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of Linked Accounts
		if($vLnkAcc){
			?>
	<h1 class="heading-big">Linked Account List</h1>

	<div style="overflow-x:auto;">
	<table id="users">
	<tr><th>Linked Accounts</th><th>Action</th></tr>	
	<?php
	if(isset($_SESSION['admin'])){
		foreach ($vLnkAcc as $data) {

			echo "<tr><td>".$data['linkNm']."</td><td style='width: 30px;'>
			<a href='index.php?page=updLnkAcc&eid=".$data['id']."&eNm=".$data['linkNm']."' id='edit'>
			<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
		}
	}else{
		foreach ($vLnkAcc as $data) {
			echo "<tr><td>".$data['linkNm']."</td><td style='width: 30px;'></td></tr>";
		}
	}
	?>
	</table>
	</div>
	<?php
	}else{
		echo "<div class='success-msg'>No Linked Account is Available</div>";
	}
	?>
</div>
</div>