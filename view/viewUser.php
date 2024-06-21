<?php
	$ContObj->adminLogChk();
	$viewUsers = $ContObj->viewUsersC();
?>
<div class="row full-width">
	<div class="col-12">
	<h1 class="heading-big">Registered Representative</h1>

	<div style="overflow-x:auto;">
	<table>
	<tr><th>Full Name</th><th>User Name</th><th>Email</th><th>Status</th><th>Role</th><th colspan="2">Action</th></tr>
	<?php
	foreach ($viewUsers as $data) {

		if($data['role'] != 'taxmagadmin'){
			if($data['status'] != 'inactive'){			
				echo "<tr>
				<td>".$data['name']."</td><td>".$data['userName']."</td><td>".$data['userEmail']."</td><td>".ucfirst($data['status'])."</td><td>".ucfirst($data['role'])."</td>&nbsp;&nbsp;<td style='width: 30px;'>
				<a href='index.php?page=updUser&eid=".$data['id']."' id='edit'>
				<i class='fa fa-edit fa-lg fa-fw'></i></a></td>
				
				<td style='width:30px;'> 
				<a href='index.php?page=chgStat&sid=".$data['id']."&stat=".$data['status']."' id='cs'>
				<i class='fas fa-user-slash fa-lg fa-fw'></i></a></td>

				<td style='width:30px;'> 
				<a href='index.php?page=resetPass&rid=".$data['id']."' id='cs' style='color: #006699;'>
				<i class='fa fa-exchange fa-lg fa-fw'></i></a></td>
				
				</tr>";
			}else{
				echo "<tr style='color: red;'><td>".$data['name']."</td><td>".$data['userName']."</td><td>".$data['userEmail']."</td><td>".ucfirst($data['status'])."</td><td>".ucfirst($data['role'])."</td><td style='width: 30px;'>
				<a href='index.php?page=updUser&eid=".$data['id']."' id='edit' alt='Edit'>
				<i class='fa fa-edit fa-lg fa-fw'></i></a></td>
				
				<td style='width:30px;'> 
				<a href='index.php?page=chgStat&sid=".$data['id']."&stat=".$data['status']."' id='cs'>
				<i class='fas fa-user-slash fa-lg fa-fw'></i></a></td>
				
				<td style='width:30px;'> 
				<a href='index.php?page=resetPass&rid=".$data['id']."' id='cs' style='color: #006699;'>
				<i class='fa fa-exchange fa-lg fa-fw'></i></a></td>

				</tr>";
			}
		}else{
			echo "<tr><td>".$data['name']."</td><td>".$data['userName']."</td><td>".$data['userEmail']."</td><td>".ucfirst($data['status'])."</td><td>".ucfirst($data['role'])."</td><td style='width: 30px;'></td></tr>";			
		}
	}

	?>
	</table>
	</div>
</div>
</div>