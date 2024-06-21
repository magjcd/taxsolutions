<?php

$conn = mysqli_connect("184.168.102.151","sawrevajcd","Titoo#02Dhonta","sawreva");

if(!mysqli_connect_errno()){

$sql = "SELECT * FROM `ledger` WHERE drAmt > 0 AND retGj = 'retTrk' ORDER BY `repNm`";
$sumq = "SELECT sum(drAmt) as drAmt FROM `ledger` WHERE drAmt > 0 AND retGj = 'retTrk'";

$result = mysqli_query($conn,$sql);
$sum = mysqli_query($conn,$sumq);
// if(mysqli_num_rows($result) > 0){
// 		$html = "<table>
// 			<tr><th>Bus. Stat. Name</th><th>Client Name</th><th style='width: 150px;'>CNIC No.</th><th>Business Name</th><th>City Name</th><th>Address</th><th>Br. off. Name</th><th>Fee Applied</th><th>RTO</th><th>Business Category</th><th>NTN No.</th><th>STRN No.</th><th>With Holding</th><th>SRB No.</th><th>BRB No.</th><th>PRB No.</th><th>Registered By</th><th>Status</th></tr>";
// 	while($row = mysqli_fetch_assoc($result)){
// 		$html .= "<tr><td>".$row['busStatNm']."</td><td>".$row['clientNm']."</td><td>'".$row['cnicNo']."</td>
// 		<td>".$row['busNm']."</td><td>".$row['cityNm']."</td><td>".$row['clientAddr']."</td><td>".$row['boNm']."</td><td>".$row['feeAppl']."</td><td>".$row['rtoNm']."</td><td>".$row['busCatNm']."</td><td>".$row['ntnNo']."</td><td>".$row['strnNo']."</td><td>".$row['whAgt']."</td><td>".$row['srbNo']."</td><td>".$row['brbNo']."</td><td>".$row['prbNo']."</td><td>".$row['registerarNm']."</td><td>".$row['status']."</td></tr>";
// 	}
// 	$html .= "</table>";


if(mysqli_num_rows($result) > 0){
		$html = "<table>
			<tr><th style='width: 100px;'>Date</th><th>Fees Type</th><th>Fees Year</th><th>Client Name</th><th>Bar Code</th><th>Submission Date</th><th>Amount</th><th>Description</th><th>Rep. Name</th></tr>";
	while($row = mysqli_fetch_assoc($result)){
		$html .= "<tr><td>".$row['gjDt']."</td><td>".$row['feeTp']."</td><td>".$row['feeYr']."</td><td>'".$row['clientNm']."</td><td>".$row['barCd']."</td><td>".$row['subDt']."</td><td>".$row['drAmt']."</td><td>".$row['description']."</td><td>".$row['repNm']."</td></tr>";
	}

	echo "<tr>";
	while($sumRow = mysqli_fetch_assoc($sum)){
		echo "<td colspan='6'>Total Amount: ".$sumRow['drAmt']."</td>";
	}
	echo "</tr>";
	
	$html .= "</table>";
}else{
	echo 'No';
}	
}else{
	'Error: '.mysqli_connect_error();
}

?>
<?php
// header("Content-Type: application/vnd.ms-excel");
// header("Content-disposition: attachment; filename=ClientData".date('d-m-Y_h:i:s_A').".xls");
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-disposition: attachment; filename=ClientData".date('d-m-Y_h:i:s_A').".xls");
echo $html;
exit();
?>














