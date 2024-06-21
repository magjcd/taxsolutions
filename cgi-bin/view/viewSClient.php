<?php

$datas = $ContObj->vSClient($_GET['vid']);

?>

<div class="row double-column" style="overflow-y: auto;">
	<h1 class="heading-big">View Client Profile</h1>
		<?php
		foreach ($datas as $data) {
		?>
	<div class="col-md-6">
	<table style="width: 100%;" id="vSClient">
		<tr><td><span>Buss. Name: </span><?php echo $data['busStatNm']; ?></td></tr>
		<tr><td><span>User Id: </span><?php echo $data['userId']; ?></td></tr>
		<tr><td><span>Client Name: </span><?php echo $data['clientNm']; ?></td></tr>
		<tr><td><span>Client Address: </span><?php echo $data['clientAddr']; ?></td></tr>
		<tr><td><span>CNIC No: </span><?php echo $data['cnicNo']; ?></td></tr>
		<tr><td><span>City: </span><?php echo $data['cityNm']; ?></td></tr>
		<tr><td><span>Tax Off. Unit: </span><?php echo $data['touNm']; ?></td></tr>
		<tr><td><span>Buss. Name: </span><?php echo $data['busNm']; ?></td></tr>
		<tr><td><span>PTCL No: </span><?php echo $data['ptclNo']; ?></td></tr>
		<tr><td><span>Cell No.1: </span><?php echo $data['cellNo1']; ?></td></tr>
		<tr><td><span>Cell No.2: </span><?php echo $data['cellNo2']; ?></td></tr>
		<tr><td><span>Buss. Addr: </span><?php echo $data['busAddr']; ?></td></tr>
		<tr><td><span>Branch Off. Name: </span><?php echo $data['boNm']; ?></td></tr>
		<tr><td><span>Fees Applied: </span><?php echo $data['feeAppl']; ?></td></tr>
		<tr><td><span>CLassification: </span><?php echo $data['classification']; ?></td></tr>
		<tr><td><span>R.T.O Name: </span><?php echo $data['rtoNm']; ?></td></tr>
		<tr><td><span>Buss. Category: </span><?php echo $data['busCatNm']; ?></td></tr>
	</table>
	</div>
	<div class="col-md-6">
	<table style="width: 100%;" id="vSClient">
		<tr><td><span>FBR ID: </span><?php echo $data['fbrId']; ?></td></tr>
		<tr><td><span>Password: </span><?php echo $data['password']; ?></td></tr>
		<tr><td><span>Pin Code: </span><?php echo $data['pinCd']; ?></td></tr>
		<!-- <tr><td><span>link Id: </span><?php echo $data['linkId']; ?></td></tr> -->
		<tr><td><span>Link Name: </span><?php echo $data['linkNm']; ?></td></tr>
		<tr><td><span>emial ID: </span><?php echo $data['emId']; ?></td></tr>
		<tr><td><span>Remarks: </span><?php echo $data['remarks']; ?></td></tr>
		<tr><td><span>NTN No.: </span><?php echo $data['ntnNo']; ?></td></tr>
		<tr><td><span>NTN Date: </span><?php echo $data['ntnDt']; ?></td></tr>
		<tr><td><span>STRN No.: </span><?php echo $data['strnNo']; ?></td></tr>
		<tr><td><span>STRN Date: </span><?php echo $data['strnDt']; ?></td></tr>
		<tr><td><span>WHT Agent: </span><?php echo $data['whAgt']; ?></td></tr>
		<tr><td><span>WHT Date: </span><?php echo $data['whDt']; ?></td></tr>
		<tr><td><span>BRB No.: </span><?php echo $data['brbNo']; ?></td></tr>
		<tr><td><span>BRB Date: </span><?php echo $data['brbDt']; ?></td></tr>
		<tr><td><span>PRB No.: </span><?php echo $data['prbNo']; ?></td></tr>
		<tr><td><span>PRB Date: </span><?php echo $data['prbDt']; ?></td></tr>
		<tr><td><span>Status: </span><?php echo ucfirst($data['status']); ?></td></tr>
	</table>
	<?php
	}
	?>
	</div>
</div>
<br /><br /><br />