<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

<form action="index?page=listClFilStat" method="POST" style="text-align: center;">
	<input type="number" name="subYear" value="" dir="rtl" autofocus="autofocus">
	<br />
	<input type="submit" name="Sub" value="Get Data">
</form>

</body>
</html>
<?php 
if(isset($_POST['subYear']) && $_POST['subYear'] != ""){
	$subYr = $_POST['subYear'];
$viewCity = $ContObj->viewCity();
if($viewCity){
	?>
<!-- <a href="view/listClFilStatExcel.php?subYr=<?php echo $subYr; ?>" style='color: #fff; background: darkgreen; border-color: darkgreen; position: fixed; bottom: 40px; right: 0;' accesskey='x' id='excelPrn' class="excelFixBtn">
	<i class='fa fa-file-excel-o fa-lg fa-fw'></i></a><br /> -->
<?php
	$cnt = 1;
	foreach($viewCity as $viewCityData){
		$ctId = $viewCityData['id'];

		echo "<div id='repFinActNm'><b>".$cnt.' - '.$viewCityData['cityNm']."</b></div>";
		echo '<br />
		<table style="width: 100%;">';
		echo '<tr>
		<th>Client Name</th>
		<th>Business Name</th>
		<th>Bar Code</th>
		<th>Submission Date</th>
		<th>Fees Type & Year</th>
		<th>Description</th>
		<th>Amount</th>
		<th>Representative</th>
		</tr>';

		// Sending ID to Grab ledger Details of Clients
		$viewClnt = $ContObj->listNoClByCt($ctId);
		if($viewClnt){
			foreach($viewClnt as $viewClntData){
				
				$clId = $viewClntData['id']; 
				//echo $viewClntData['id'].$viewClntData['clientNm'].'<br />';
				$viewClFil = $ContObj->listFiledCl($clId,$subYr);
				if($viewClFil){
					foreach($viewClFil as $viewClFilData){
						if($viewClFilData['drAmt'] != 0){
							//echo $viewClFilData['drAmt'].'<br />';
							$clNm = $viewClFilData['clientNm'];
							$busNm = $viewClFilData['busNm'];
							$barCd = $viewClFilData['barCd'];
							$subDt = $viewClFilData['subDt'];
							$feeTp = $viewClFilData['feeTp'];
							$feeYr = $viewClFilData['feeYr'];
							$description = $viewClFilData['description'];
							$repNm = $viewClFilData['repNm'];
							$filAmt = number_format($viewClFilData['drAmt'],2);		

							echo '<tr><td>'.$clNm.'</td><td>'.$busNm.'</td><td>'.$barCd.'</td><td>'.$subDt.'</td><td>'.$feeTp.' '.$feeYr.'</td><td>'.$description.'</td><td>'.$filAmt.'</td><td>'.$repNm.'</td></tr>';
						}
					}
				}else{
					//echo '<tr><td colspan="8" style="text-align: center;"><h4>No Return Tracker has been made in this City yet</h4></td></tr>';
					echo '<tr>
					<td>'.$viewClntData['clientNm'].'</td>
					<td>'.$viewClntData['busNm'].'</td>
					<td colspan="6" style="text-align: center; color: red;">Yet to be Submitted</td></tr>';		
				}
			}	
		}else{
			echo '<tr><td colspan="8" style="text-align: center;"><h4>No Client has been added in this City yet</h4></td></tr>';
		}
		echo '</table>
		<br />';
		$cnt++;
	}
}

echo '<br /><br /><br />';
if(isset($_SESSION['taxmagadmin'])){
?>
	<a href="view/listClFilStatExcel.php?subYr=<?php echo $subYr; ?>" accesskey='x' class="excelFixBtn">
	<i class='fa fa-file-excel-o fa-lg fa-fw'></i></a><br />
<?php 
}
}
?>
<a href="#" class="scrollTop"><i class="fas fa-arrow-up"></i></a>