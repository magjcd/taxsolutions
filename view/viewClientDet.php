<?php
session_start();
include("../autoLoad.php");
//include(realpath(__DIR__.'/..')."../autoLoad.php");
$ContObj = new Controller();
	$viewClients = $ContObj->viewClints();
?>

<!-- <div class="row">
	<div class="col-12" style="overflow-x: auto;">
 -->
	<?php

	if($viewClients){
	//Counting Total cities of Clients
	$arrCol = (array_column($viewClients, 'cityId'));
	$arrUni = (array_unique($arrCol));

	// $arrColRep = (array_column($viewClients, 'cnicNo'));
	// $arrUniRep = (array_unique($arrColRep));	
	// print_r($arrUniRep);

	//Counting Total Representatives who added records in DB
	$arrColRep = (array_column($viewClients, 'registerarId'));
	$arrUniRep = (array_unique($arrColRep));

	//Counting Total Clients Added by a Representative
	// $repIdArr = explode("")
	// $sql = "SELECT * FROM client WHERE repId=".$;
	// while($row=$viewClients->fetch_assoc()){

	// }
	//print_r($_SESSION);

	echo '
	<tr>
	<th colspan="7" style="background:#fff; color: #000;">
	Total 
	<span style="font-weight:bold; font-size: 16px; background:#006699; color:#fff; text-align:center; border-radius: 30px;">&nbsp;'.count($viewClients).'&nbsp;</span> 
	Client(s) from 
	<span style="font-weight:bold; font-size: 16px; background:#006699; color:#fff; text-align:center; border-radius: 30px;">&nbsp;'.count($arrUni).'&nbsp;</span> Cities added by 
	<span style="font-weight:bold; font-size: 16px; background:#006699; color:#fff; text-align:center; border-radius: 30px;">&nbsp;'.count($arrUniRep).'&nbsp;</span> Representative(s)
	</th>
	</tr>
	';

	?>
	<tr><th>Clint Name</th><th>Bus. Name</th><th>CNIC</th><th>City</th><th>Status</th><th colspan="3">Action</th></tr>

	<?php
			foreach ($viewClients as $data) {
			if(isset($_SESSION['taxmagadmin'])){
				if($data['status'] != 'inactive'){			
					echo "<tr><td>".$data['clientNm']."</td><td>".$data['busNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					<a href='index?page=ClientUpd&eid=".$data['id']."' id='edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					<a href='index?page=viewSClient&vid=".$data['id']."' id='recView'>
					<i class='fa fa-eye fa-lg fa-fw'></i></a></td><td style='width:30px;'> 
					<a href='index?page=chgClStat&sid=".$data['id']."&stat=".$data['status']."' id='cs'>
					<i class='fa fa-refresh fa-lg fa-fw'></i></a></td></tr>";
				}else{
					// echo "<tr style='color: red;'><td>".$data['clientNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					// <a href='index?page=ClientUpd&eid=".$data['id']."' id='edit' alt='Edit'>
					// <i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					// <a href='index?page=viewSClient&vid=".$data['id']."' id='recView' alt='Edit'>
					// <i class='fa fa-eye fa-lg fa-fw'></i></a></td><td style='width:30px;'> 
					// <a href='index?page=chgClStat&sid=".$data['id']."&stat=".$data['status']."' id='cs'>
					// <i class='fa fa-refresh fa-lg fa-fw'></i></a></td></tr>";
					echo "<tr style='color: red;'><td>".$data['clientNm']."</td><td>".$data['busNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					<a id='btn-disable' alt='Edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					<a href='index?page=viewSClient&vid=".$data['id']."' id='recView' alt='Edit'>
					<i class='fa fa-eye fa-lg fa-fw'></i></a></td><td style='width:30px;'> 
					<a href='index?page=chgClStat&sid=".$data['id']."&stat=".$data['status']."' id='cs'>
					<i class='fas fa-refresh fa-lg fa-fw'></i></a></td></tr>";
				}
			}else{
				if($data['status'] != 'inactive'){			
					echo "<tr><td>".$data['clientNm']."</td><td>".$data['busNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					<a href='index?page=ClientUpd&eid=".$data['id']."' id='edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					<a href='index?page=viewSClient&vid=".$data['id']."' id='recView'>
					<i class='fa fa-eye fa-lg fa-fw'></i></a></td></tr>";
				}else{
					// echo "<tr style='color: red;'><td>".$data['clientNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					// <a href='index?page=ClientUpd&eid=".$data['id']."' id='edit' alt='Edit'>
					// <i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					// <a href='index?page=viewSClient&vid=".$data['id']."' id='recView' alt='Edit'>
					// <i class='fa fa-eye fa-lg fa-fw'></i></a></td></tr>";
					echo "<tr style='color: red;'><td>".$data['clientNm']."</td><td>".$data['busNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					<a id='btn-disable' alt='Edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					<a href='index?page=viewSClient&vid=".$data['id']."' id='recView' alt='Edit'>
					<i class='fa fa-eye fa-lg fa-fw'></i></a></td></tr>";
				}
			}
		}
	}else{
		echo "<div class='message'>No Client is Added yet.</div>";
	}

	?>
<!-- </div>
</div> -->