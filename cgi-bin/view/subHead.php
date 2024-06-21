<?php
$vHeadAcc = $ContObj->vHdAcc();

if(isset($_POST['subHead'])){
	$ContObj->nSubHead($_POST['hdAcc'],$_POST['subHead']);
}
?>
<div class="row single-column">
	<h1 class="heading-big">Sub Header</h1>
	<div class="col-12">
		<form action="index.php?page=subHead" method="post" style="text-align: center;">
			<select name="hdAcc">
				<option value="">Select a Header</option>
				<option disabled="disabled">--------------------------------------</option>
				<?php
				foreach ($vHeadAcc as $data) {
				?>
				<option value="<?php echo $data['id']?>|<?php echo $data['headNm']?>"><?php echo $data['headNm']?></option>
				<?php
				}
				?>
			</select>
			<input type="text" name="subHead" placeholder="Sub Header"><br />
			<input type="submit" value="Add">
		</form>
	</div>
</div>



<!-- <div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of BOs
		if($vCity){
			?>
	<h1 class="heading-big">Sub-Account</h1>

	<div style="overflow-x:auto;">
	<table id="users">
	<tr><th>Sub-Acocunt Name</th><th>Action</th></tr>	
	<?php
	if(isset($_SESSION['admin'])){
		foreach ($vCity as $data) {

			echo "<tr><td>".$data['cityNm']."</td><td style='width: 30px;'>
			<a href='index.php?page=modiSingFld&eid=".$data['id']."' id='edit'>
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
		echo "<div class='success-msg'>No Branch Office is Available</div>";
	}
	?>
</div>
</div> -->