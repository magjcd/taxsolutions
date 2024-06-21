
<?php
	$viewClients = $ContObj->viewClints();
?>
<div class="row">
	<div class="col-12">
	<h1 class="heading-big">Registered Clients</h1>
	<div class="clientSearch">
		<input type="text" id="clSearch" name="clSearch" placeholder="Search Term Here">
	</div>
	<table id="users">
	<tr><th>Clint Name</th><th>CNIC</th><th>City</th><th>Status</th><th colspan="3">Action</th></tr>
	<?php
	if($viewClients){
		foreach ($viewClients as $data) {
			if(isset($_SESSION['admin'])){
				if($data['status'] != 'inactive'){			
					echo "<tr><td>".$data['clientNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					<a href='index.php?page=ClientUpd&eid=".$data['id']."' id='edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					<a href='index.php?page=viewSClient&vid=".$data['id']."' id='recView'>
					<i class='fa fa-eye fa-lg fa-fw'></i></a></td><td style='width:30px;'> 
					<a href='index.php?page=chgClStat&sid=".$data['id']."&stat=".$data['status']."' id='cs'>
					<i class='fa fa-refresh fa-lg fa-fw'></i></a></td></tr>";
				}else{
					// echo "<tr style='color: red;'><td>".$data['clientNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					// <a href='index.php?page=ClientUpd&eid=".$data['id']."' id='edit' alt='Edit'>
					// <i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					// <a href='index.php?page=viewSClient&vid=".$data['id']."' id='recView' alt='Edit'>
					// <i class='fa fa-eye fa-lg fa-fw'></i></a></td><td style='width:30px;'> 
					// <a href='index.php?page=chgClStat&sid=".$data['id']."&stat=".$data['status']."' id='cs'>
					// <i class='fa fa-refresh fa-lg fa-fw'></i></a></td></tr>";
					echo "<tr style='color: red;'><td>".$data['clientNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					<a id='btn-disable' alt='Edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					<a href='index.php?page=viewSClient&vid=".$data['id']."' id='recView' alt='Edit'>
					<i class='fa fa-eye fa-lg fa-fw'></i></a></td><td style='width:30px;'> 
					<a href='index.php?page=chgClStat&sid=".$data['id']."&stat=".$data['status']."' id='cs'>
					<i class='fa fa-refresh fa-lg fa-fw'></i></a></td></tr>";
				}
			}else{
				if($data['status'] != 'inactive'){			
					echo "<tr><td>".$data['clientNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					<a href='index.php?page=ClientUpd&eid=".$data['id']."' id='edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					<a href='index.php?page=viewSClient&vid=".$data['id']."' id='recView'>
					<i class='fa fa-eye fa-lg fa-fw'></i></a></td></tr>";
				}else{
					// echo "<tr style='color: red;'><td>".$data['clientNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					// <a href='index.php?page=ClientUpd&eid=".$data['id']."' id='edit' alt='Edit'>
					// <i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					// <a href='index.php?page=viewSClient&vid=".$data['id']."' id='recView' alt='Edit'>
					// <i class='fa fa-eye fa-lg fa-fw'></i></a></td></tr>";
					echo "<tr style='color: red;'><td>".$data['clientNm']."</td><td>".$data['cnicNo']."</td><td>".$data['cityNm']."</td><td>".ucfirst($data['status'])."</td><td style='width: 30px;'>
					<a id='btn-disable' alt='Edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a></td><td style='width: 30px;'>
					<a href='index.php?page=viewSClient&vid=".$data['id']."' id='recView' alt='Edit'>
					<i class='fa fa-eye fa-lg fa-fw'></i></a></td></tr>";
				}
			}
		}
	}else{
		echo "<div class='message'>No Client is Added yet.</div>";
	}

	?>
	</table>
</div>
</div>
<br /><br /><br />