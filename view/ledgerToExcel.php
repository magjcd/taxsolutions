<?php

$conn = mysqli_connect("184.168.102.151","sawrevajcd","Titoo#02Dhonta","sawreva");

// $conn = mysqli_connect("localhost","root","","sawreva");
if(!mysqli_connect_errno()){

$sql = "SELECT * FROM `ledger` ORDER BY `repNm`";
$sumq = "SELECT sum(drAmt) as drAmt, sum(crAmt) as crAmt FROM `ledger`";

// $sql = "SELECT * FROM `client`";

$result = mysqli_query($conn,$sql);
$sum = mysqli_query($conn,$sumq);
// if(mysqli_num_rows($result) > 0){
// 		$html = "<table>
// 			<tr><th>Bus. Stat. Name</th><th>Client Name</th><th style='width: 150px;'>CNIC No.</th><th>Business Name</th><th>City Name</th><th>Address</th><th>Br. off. Name</th><th>Fee Applied</th><th>Classification</th><th>RTO</th><th>Business Category</th><th>FBR ID</th><th>Pin Code</th><th>Link Acc</th><th>Email ID</th><th>NTN No.</th><th>NTN Fee</th><th>STRN No.</th><th>STRN Fee</th><th>With Holding</th><th>WTH Fee</th><th>SRB No.</th><th>SRB Fee</th><th>BRB No.</th><th>BRB Fee</th><th>PRB No.</th><th>PRB Fee</th><th>Status</th></tr>";
// 	while($row = mysqli_fetch_assoc($result)){
// 		$html .= "<tr><td>".$row['busStatNm']."</td><td>".$row['clientNm']."</td><td>".$row['cnicNo']."</td>
// 		<td>".$row['busNm']."</td><td>".$row['cityNm']."</td><td>".$row['clientAddr']."</td><td>".$row['boNm']."</td><td>".$row['feeAppl']."</td><td>".$row['classification']."</td><td>".$row['rtoNm']."</td><td>".$row['busCatNm']."</td><td>".$row['fbrId']."</td><td>".$row['pinCd']."</td><td>".$row['linkNm']."</td><td>".$row['emId']."</td><td>".$row['ntnNo']."</td><td>".$row['ntnFee']."</td><td>".$row['strnNo']."</td><td>".$row['strnFee']."</td><td>".$row['whAgt']."</td><td>".$row['whtFee']."</td><td>".$row['srbNo']."</td><td>".$row['srbFee']."</td><td>".$row['brbNo']."</td><td>".$row['brbFee']."</td><td>".$row['prbNo']."</td><td>".$row['prbFee']."</td><td>".$row['status']."</td></tr>";
// 	}
// 	$html .= "</table>";


if(mysqli_num_rows($result) > 0){
		$html = "<table>
			<tr>
			<th>ID</th>
			<th style='width: 100px;'>Date</th>
			<th>Fees Type</th>
			<th>Fees Year</th>
			<th>Client ID</th>
			<th>Client Name</th>
			<th>City Name</th>
			<th>Header Name</th>
			<th>Sub Header Name</th>
			<th>Business Name</th>			
			<th>Bar Code</th>
			<th>Submission Date</th>
			<th>Dr Amt</th>
			<th>Cr Amt</th>
			<th style='width: 100px;'>Transaction Date</th>
			<th>Description</th>
			<th>Ret / GJ</th>
			<th>Rep. ID & Name</th>
			</tr>";
	while($row = mysqli_fetch_assoc($result)){
		$html .= "<tr>
		<td>".$row['id']."</td>
		<td>".$row['gjDt']."</td>
		<td>".$row['feeTp']."</td>
		<td>".$row['feeYr']."</td>
		<td>".$row['clientId']."</td>
		<td>".$row['clientNm']."</td>
		<td>".$row['cityNm']."</td>
		<td>".$row['hdNm']."</td>
		<td>".$row['sHdNm']."</td>
		<td>".$row['busNm']."</td>
		<td>'".$row['barCd']."</td>
		<td>".$row['subDt']."</td>
		<td>".$row['drAmt']."</td>
		<td>".$row['crAmt']."</td>
		<td>".$row['transDt']."</td>
		<td>".$row['description']."</td>
		<td>".$row['retGj']."</td>
		<td>".$row['repId'].' - '.$row['repNm']."</td>
		</tr>";
	}

	while($sumRow = mysqli_fetch_assoc($sum)){
		$html .= "<tr>
		<td colspan='10'>Credit / Debit Amount: </td>
		<td>".$sumRow['drAmt']."</td>
		<td>".$sumRow['crAmt']."</td>
		</tr>";
	}
	
	$html .= "</table>";
}else{
	echo 'No';
}	
}else{
	'Error: '.mysqli_connect_error();
}
?>
<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=LedgerData".date('d-m-Y_h:i:s_A').".xls");
// header("Content-Type: application/vnd.ms-excel; charset=utf-8");
// header("Content-disposition: attachment; filename=ClientData".date('d-m-Y_h:i:s_A').".xls");
echo $html;
exit();
?>



