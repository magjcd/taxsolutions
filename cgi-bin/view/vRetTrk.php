<?php
session_start();
include('../autoLoad.php');
$ContObj = new Controller();
$viewRetTrk = $ContObj->viewRetTrk();
if($viewRetTrk){
?>
		
<tr>
	<th>Prop Name</th><th>Bussiness Name</th><th>City</th><th>Type</th><th>Tax Year</th>
	<th>Sub. Date</th><th>Description</th><th>Action</th>
</tr>
	<?php
	foreach($viewRetTrk as $retTrkData){
	?>

 	<tr id="retClDet">
		<td><?php echo $retTrkData['clientNm']; ?></td>
		<td><?php echo $retTrkData['busNm']; ?></td>
		<td><?php echo $retTrkData['cityNm']; ?></td>
		<td><?php echo $retTrkData['feeTp']; ?></td>
		<td><?php echo $retTrkData['feeYr']; ?></td>
		<td><?php echo $retTrkData['subDt']; ?></td>
		<td><?php echo $retTrkData['description']; ?></td>
		<td>
		<?php

		echo "<a href='index?page=retTrkUpd&rTrkEid=".$retTrkData['id']."' id='edit'>
			<i class='fa fa-edit fa-lg fa-fw'></i></a>";
			?>
		</td>
	</tr>

	<?php
}}
?>	

