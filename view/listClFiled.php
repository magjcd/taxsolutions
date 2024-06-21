<?php 
$viewCity = $ContObj->viewCity();
if($viewCity){
	foreach($viewCity as $viewCityData){
		$ctId = $viewCityData['id'];

		echo '<h2>'.$viewCityData['cityNm'].'</h2><br />';
		// Sending ID to Grab ledger Details of Clients
		$viewClnt = $ContObj->listNoClByCt($ctId);
		if($viewClnt){
			foreach($viewClnt as $viewClntData){
				$clId = $viewClntData['id']; 
				//echo $viewClntData['id'].$viewClntData['clientNm'].'<br />';
				$clNm = $viewClntData['clientNm'];
				$viewClFil = $ContObj->listFiledCl($clId);
				if($viewClFil){
					$cnt = 1;
					foreach($viewClFil as $viewClFilData){
						if($viewClFilData['drAmt'] != 0){
							//echo $viewClFilData['drAmt'].'<br />';
							$filAmt = number_format($viewClFilData['drAmt'],2);		
						}
						echo $clNm.' - '.$filAmt.'<br />';
					}
				}
			}	
		}else{
			echo 'No Client added yet.';
		}
	}
}
?>
<br /><br /><br />