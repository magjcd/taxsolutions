<?php
$vSHdAcc = $ContObj->vShdAcc();
$vCity = $ContObj->viewCity();
$vAcc = $ContObj->vAcc();

if(isset($_POST['subHead'])){
	$ContObj->nAccount($_POST['accNm'],$_POST['subHead'],$_POST['city']);
}
?>
<div class="row single-column">
	<h1 class="heading-big">Account</h1>
	<div class="col-12">
		<form action="index?page=nAcc" method="post" style="text-align: center;">
			<select name="subHead">
				<option value="">Select a Sub Header</option>
				<option disabled="disabled">--------------------------------------</option>
				<?php
				foreach ($vSHdAcc as $data) {
				?>
				<option value="<?php echo $data['id']?>|<?php echo $data['subHeadNm']?>|<?php echo $data['hdId']?>|<?php echo $data['headNm']?>"><?php echo $data['subHeadNm']?></option>
				<?php
				}
				?>
			</select>
			<input type="text" name="accNm" placeholder="Account Name"><br />
			<select name="city">
				<option value="">Select a City</option>
				<option disabled="disabled">--------------------------------------</option>
				<?php foreach($vCity as $ctData){ ?>
				<option value="<?php echo $ctData['id']; ?>|<?php echo $ctData['cityNm']; ?>">
					<?php echo $ctData['cityNm']; ?></option>
			<?php } ?>
			</select>
			<input type="submit" value="Add">
		</form>
	</div>
</div>


<div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of BOs
		if($vAcc){
			?>
	<h1 class="heading-big">Sub-Account</h1>

	<div style="overflow-x:auto;">
	<table id="users">
	<tr><th>Sub-Header Name</th><th>Header Name</th><th style="text-align: center;">Action</th></tr>	
	<?php
	//if(isset($_SESSION['admin'])){
		foreach ($vAcc as $data) {


			// OLD APPROACH

			// if($data['clientNm'] != 'Revenue Earned - Services'){
			// 	echo "<tr><td>".$data['clientNm']."</td><td>".$data['sHdNm']."</td>
			// 	<td style='width: 30px;'>
			// 	<a href='index?page=updLedAcc1&eid=".$data['id']."&subHd=".$data['sHdNm']."&hdId=".$data['hdId']."&hdNm=".$data['headNm']."' id='edit'>
			// 	<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
			// }else{
			// 	echo "<tr><td>".$data['clientNm']."</td><td>".$data['sHdNm']."</td><td></td></tr>";
			// }

			
			// NEW APPROACH

			if($data['registerarNm'] != 'SYSTEM GENERATED'){
				echo "<tr><td>".$data['clientNm']."</td><td>".$data['sHdNm']."</td>
				<td style='width: 30px; text-align: center;'>
				<a href='index?page=updLedAcc&eid=".$data['id']."&accNm=".$data['clientNm']."&subHdId=".$data['sHdId']."&subHdNm=".$data['sHdNm']."&hdId=".$data['hdId']."&hdNm=".$data['headNm']."&ctId=".$data['cityId']."&ctNm=".$data['cityNm']."' id='edit'>
				<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
			}else{
				echo "<tr><td>".$data['clientNm']."</td><td>".$data['sHdNm']."</td><td style='width: 200px; text-align: center;'>".$data['registerarNm']."</td></tr>";
			}

		}
	// }else{
	// 	foreach ($vCity as $data) {
	// 		echo "<tr><td>".$data['cityNm']."</td><td style='width: 30px;'></td></tr>";
	// 	}
	//}
	?>
	</table>
	</div>
	<?php
	}else{
		echo "<div class='success-msg'>No Branch Office is Available</div>";
	}
	?>
	<div class="bott-height"></div>
</div>
</div>