<div class="row double-column">
<h1 class="heading-big">Trial Balance</h1>
<div style="width: 100%; text-align: center; font-weight: bold;"><?php echo date('l jS \of F Y') ?></div>
<div class="col-12">
<?php
$vSHeadAcc = $ContObj->vShdAcc();

if($vSHeadAcc){

	echo '<table style="width: 100%;">';
	echo '<tr><th>Sub Header</th><th style="text-align: right;">Debit</th><th style="text-align: right;">Credit</th></tr>';
	$drTot = 0;
	$crTot = 0;
	foreach($vSHeadAcc as $vSHeadAccDet){
		$trailBal = $ContObj->trialBalData($vSHeadAccDet['id']);
		foreach($trailBal as $trailBalDet){

			echo '<tr><td>'.$sHdNm = $vSHeadAccDet['subHeadNm'].'</td>';
			if($trailBalDet['trBal'] >= 0){
				$drTot += $trailBalDet['trBal'];
				echo '<td style="text-align: right;">'.number_format($trailBalDet['trBal'],2).'</td>';
				echo '<td style="text-align: right;"></td>';
			}else{
				$crTot += $trailBalDet['trBal'];
				echo '<td style="text-align: right;"></td>';
				echo '<td style="text-align: right;">'.number_format($trailBalDet['trBal'],2).'</td>';
			}
				echo '</tr>';
			}

	}
		echo '<tr><th>Total</th><th style="text-align: right;">'.number_format($drTot,2).'</th><th style="text-align: right;">'.number_format($crTot,2).'</th></tr>';
		echo '</table>';
}

?>
</div>
</div>
<br /><br />















