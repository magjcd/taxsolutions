<?php
$vSHeadAcc = $ContObj->vShdAcc();
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



<div class="row">
	<div class="col-12">
		<?php
		// if Data is available inside $RepCntObj-> Object for listing of BOs
		if($vSHeadAcc){
			?>
	<h1 class="heading-big">Sub-Account</h1>

	<div style="overflow-x:auto;">
	<table id="users">
	<tr><th>Sub-Header Name</th><th>Header Name</th><th style="text-align: center;">Action</th></tr>	
	<?php
	//if(isset($_SESSION['admin'])){

	// OLD APPROACH

		foreach ($vSHeadAcc as $data) {
			// if($data['subHeadNm'] != 'Services' && $data['subHeadNm'] != 'Accounts Receivable' && $data['subHeadNm'] != 'Banks'){
			// 	echo "<tr><td>".$data['subHeadNm']."</td><td>".$data['headNm']."</td>

			// 	<td style='width: 30px;'>
			// 	<a href='index?page=updSubHd&eid=".$data['id']."&subHd=".$data['subHeadNm']."&hdId=".$data['hdId']."&hdNm=".$data['headNm']."' id='edit'>
			// 	<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
			// }else{
			// 	echo "<tr><td>".$data['subHeadNm']."</td><td>".$data['headNm']."</td><td></td>";				
			// }


			// NEW APPROACH

				if($data['registerarNm'] != 'SYSTEM GENERATED'){
				echo "<tr><td>".$data['subHeadNm']."</td><td>".$data['headNm']."</td>

				<td style='width: 30px; text-align: center;'>
				<a href='index?page=updSubHd&eid=".$data['id']."&subHd=".$data['subHeadNm']."&hdId=".$data['hdId']."&hdNm=".$data['headNm']."' id='edit'>
				<i class='fa fa-edit fa-lg fa-fw'></i></a></td></tr>";
			}else{
				echo "<tr><td>".$data['subHeadNm']."</td><td>".$data['headNm']."</td><td style='width: 200px; text-align: center;'>".$data['registerarNm']."</td>";				
			}
		}
	?>
	</table>
	</div>
	<?php
	}else{
		echo "<div class='success-msg'>No Sub Header is available/div>";
	}
	?>
	<div class="bott-height"></div>
</div>
</div>