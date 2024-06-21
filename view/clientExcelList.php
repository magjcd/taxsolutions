<?php

$conn = mysqli_connect("184.168.102.151","sawrevajcd","Titoo#02Dhonta","sawreva");

// $conn = mysqli_connect("localhost","root","","taxsol");
if(!mysqli_connect_errno()){

//$sql = "SELECT * FROM `ledger` WHERE drAmt > 0 AND retGj = 'retTrk' ORDER BY `repNm`";
//$sumq = "SELECT sum(drAmt) as drAmt FROM `ledger` WHERE drAmt > 0 AND retGj = 'retTrk'";

$sql = "SELECT * FROM `client`";

$result = mysqli_query($conn,$sql);
//$sum = mysqli_query($conn,$sumq);
if(mysqli_num_rows($result) > 0){
		$html = "<table>
			<tr><th>Bus. Stat. Name</th><th>Client ID</th><th>Client Name</th><th style='width: 150px;'>CNIC No.</th><th>Business Name</th><th>City Name</th><th>Address</th><th>Br. off. Name</th><th>Fee Applied</th><th>Classification</th><th>RTO</th><th>Business Category</th><th>FBR ID</th><th>Pin Code</th><th>Password</th><th>Link Acc</th><th>Email ID</th><th>NTN No.</th><th>NTN Fee</th><th>NTN Date</th><th>STRN No.</th><th>STRN Fee</th><th>STRN Date</th><th>With Holding</th><th>WTH Fee</th><th>WTH Date</th><th>SRB No.</th><th>SRB Fee</th><th>SRB Date</th><th>BRB No.</th><th>BRB Fee</th><th>BRB Date</th><th>PRB No.</th><th>PRB Fee</th><th>PRB Date</th><th>Status</th><th>Representative</th></tr>";
	while($row = mysqli_fetch_assoc($result)){
		$html .= "<tr><td>".$row['busStatNm']."</td><td>".$row['id']."</td><td>".$row['clientNm']."</td><td>'".$row['cnicNo']."</td>
		<td>".$row['busNm']."</td><td>".$row['cityNm']."</td><td>".$row['clientAddr']."</td><td>".$row['boNm']."</td><td>".$row['feeAppl']."</td><td>".$row['classification']."</td><td>".$row['rtoNm']."</td><td>".$row['busCatNm']."</td><td>'".$row['fbrId']."</td><td>".$row['pinCd']."</td><td>".$row['password']."</td><td>".$row['linkNm']."</td><td>".$row['emId']."</td><td>".$row['ntnNo']."</td><td>".$row['ntnDt']."</td><td>".$row['ntnFee']."</td><td>'".$row['strnNo']."</td><td>".$row['strnFee']."</td><td>".$row['strnDt']."</td><td>".$row['whAgt']."</td><td>".$row['whtFee']."</td><td>".$row['whDt']."</td><td>".$row['srbNo']."</td><td>".$row['srbFee']."</td><td>".$row['srbDt']."</td><td>".$row['brbNo']."</td><td>".$row['brbFee']."</td><td>".$row['brbDt']."</td><td>".$row['prbNo']."</td><td>".$row['prbFee']."</td><td>".$row['prbDt']."</td><td>".$row['status']."</td><td>".$row['registerarNm']."</td></tr>";
	}
	$html .= "</table>";
	
}else{
	'Error: '.mysqli_connect_error();
}
}
?>
<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=ClientData".date('d-m-Y_h:i:s_A').".xls");
// header("Content-Type: application/vnd.ms-excel; charset=utf-8");
// header("Content-disposition: attachment; filename=ClientData".date('d-m-Y_h:i:s_A').".xls");
echo $html;
exit();
?>



