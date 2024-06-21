<?php 
ob_start();
include('../autoLoad.php');
$ContObj = new Controller();

$subYr = $_GET['subYr'];
//$subYr = 2020;
$viewCity = $ContObj->viewCity();
if($viewCity){
	$cnt = 1;
	foreach($viewCity as $viewCityData){
		$ctId = $viewCityData['id'];

		$html = "<div id='repFinActNm'><b>".$cnt.' - '.$viewCityData['cityNm']."</b></div>";
		$html .= '<br />
		<table style="width: 100%;">';
		$html .= '<tr>
		<th>Client Name</th>
		<th>Business Name</th>
		<th>Bar Code</th>
		<th>Submission Date</th>
		<th>Fees Type & Year</th>
		<th>Description</th>
		<th>Amount</th>
		<th>Town</th>
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
							$cityNm = $viewClFilData['cityNm'];
							$repNm = $viewClFilData['repNm'];
							$filAmt = number_format($viewClFilData['drAmt'],2);		

							$html .= '<tr><td>'.$clNm.'</td><td>'.$busNm.'</td><td>"'.$barCd.'</td><td>'.$subDt.'</td><td>'.$feeTp.' '.$feeYr.'</td><td>'.$description.'</td><td>'.$filAmt.'</td><td>'.$cityNm.'</td><td>'.$repNm.'</td></tr>';
						}
					}
				}else{
					//echo '<tr><td colspan="8" style="text-align: center;"><h4>No Return Tracker has been made in this City yet</h4></td></tr>';
					$html .= '<tr>
					<td>'.$viewClntData['clientNm'].'</td>
					<td>'.$viewClntData['busNm'].'</td>
					<td colspan="5" style="text-align: center; color: red;">Yet to be Submitted</td>
					<td>'.$viewClntData['cityNm'].'</td>
					<td></td>
					</tr>';		
				}
			}	
		}else{
			$html .= '<tr><td colspan="8" style="text-align: center;"><h4>No Client has been added in this City yet</h4></td></tr>';
		}
		$html .= '</table>
		<br />';
		$cnt++;

header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=".date('d-m-Y_h:i:s_A').".xls");
echo $html;
//exit();
	}
}
// echo '<br /><br /><br />';
ob_end_flush();
?>
