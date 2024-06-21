<?php 
$emtEntDet = $ContObj->emptyEnt();
$cntEntLedRep = $ContObj->countRepLedEnt();
if($emtEntDet){
	?>
	<details>
	<?php
	echo '<summary style="text-align: center; outline: none;">'.count($emtEntDet).' records entered with No Representative'.'</summary>';
	echo '<table>';
	echo '<tr><th>Date & Time</th><th>Client Name</th><th>Business Name</th><th>City</th><th>Debit</th><th>Credit</th><th>Doc Type</th></tr>';
	foreach($emtEntDet as $emtEntDetData){
		echo '<tr><td>'.$emtEntDetData['gjDt'].' - '.$emtEntDetData['gjTm'].'</td><td>'.$emtEntDetData['clientNm'].'</td><td>'.$emtEntDetData['busNm'].'</td><td>'.$emtEntDetData['cityNm'].'</td><td>'.$emtEntDetData['drAmt'].'</td><td>'.$emtEntDetData['crAmt'].'</td><td>'.$emtEntDetData['retGj'].'</td></tr>';
	}
	echo '</table>';
	?>
	</details>
	<?php
}else{
	?>
	<details>
		<?php 
		echo '<summary style="text-align: center; outline: none;">'.count($cntEntLedRep).' Records, All Records are associated with respective Representatives</summary>';
		echo '<table>';
		echo '<tr><th>Representatives</th><th style="text-align: center;">No Of Retrun Trackers</th></tr>';
		foreach($cntEntLedRep as $cntEntLedRepData){
			echo '<tr>
			<td>'.$cntEntLedRepData['name'].'</td>
			<td style="text-align: center;">'.$cntEntLedRepData['noLedRec'].'</td>
			</tr>';
		}
		echo '</table>';	
		?>
	</details>
	<?php
	// echo '<div style="text-align: center;">All Records are associated with respective Representatives</div>';
}
?>