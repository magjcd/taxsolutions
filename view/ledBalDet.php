<?php
session_start();
include('../autoLoad.php');
$ContObj = new Controller();

if(isset($_POST['cusId']) && $_POST['cusId'] != null){
	$id = $_POST['cusId'];
	$DrCrLedTbal =$ContObj->DrCrLedTbal($id);
	if($DrCrLedTbal){
		foreach($DrCrLedTbal as $DrCrLedTbalDet){
			echo $DrCrLedTbalDet['ledBal'];
		}
	}
}elseif(isset($_POST['hdDet'])){
	
	$sHdArr = explode('|', $_POST['hdDet']);
	
	$sHdId = $sHdArr[0];
	$sHdNm = $sHdArr[1];
	$fd = $_POST['fd'];
	$td = $_POST['td'];

	$vSHdDet = $ContObj->vSHdDet($sHdId,$fd,$td);
	$vSHdDetOpBal = $ContObj->vSHdDetOpBal($sHdId,$fd,$td);
	$vSHdDetClBal = $ContObj->vSHdDetClBal($sHdId,$fd,$td);
	$vSHdDetDrBal = $ContObj->vSHdDetDrBal($sHdId,$fd,$td);
	$vSHdDetCrBal = $ContObj->vSHdDetCrBal($sHdId,$fd,$td);


	if($vSHdDet){
		?>
		<h3><?php 
				echo strtoupper($sHdNm); 
			?>
		</h3>
		<h5 style="text-align: center;">
			<?php 
				if($vSHdDetOpBal){
					foreach($vSHdDetOpBal as $vSHdDetOpBalData){
						if($vSHdDetOpBalData['sHdOpBal'] >= 0){
							echo 'Previous Balance: '.$vSHdDetOpBalData['sHdOpBal'].' ';
						}else{
							echo '<span style="color: red;">Previous Balance: '.number_format($vSHdDetOpBalData['sHdOpBal'],0).'</span> ';
						}
					}
				}

				if($vSHdDetDrBal){
					foreach($vSHdDetDrBal as $vSHdDetDrBalData){
						echo 'Debit Amount: '.number_format($vSHdDetDrBalData['sHdDrBal'],0).' ';
					}
				}

				if($vSHdDetCrBal){
					foreach($vSHdDetCrBal as $vSHdDetCrBalData){
						echo 'Credit Amount: '.number_format($vSHdDetCrBalData['sHdCrBal'],0).' ';
					}
				}
			
				if($vSHdDetClBal){
					foreach($vSHdDetClBal as $vSHdDetClBalData){
						if($vSHdDetClBalData['sHdClBal'] > 0){
							echo 'Closing Balance: '.number_format($vSHdDetClBalData['sHdClBal'],0);
						}else{
							echo '<span style="color: red;">Closing Balance: '.number_format($vSHdDetClBalData['sHdClBal'],0).'</span>';
						}
					}
				} 
					?>
				</h5>
				<?php 
				$vAccSHd = $ContObj->vAccSHd($sHdId);
				if($vAccSHd){
					foreach($vAccSHd as $vAccSHdData){

						echo '<h4 id="repFinActNm">'.strtoupper($vAccSHdData['clientNm']).'</h4>';
						$vAccSHdTrsctn = $ContObj->vAccSHdTrsctn($vAccSHdData['id'],$fd,$td);
					
							?>
							<div class="accTbl" style="width: 100%; overflow-x: auto;">
							<table id="full-width">
								<th style="width: 200px;">Date</th>
								<th style="width: 100px;">Doc Tp</th>
								<th style="text-align: center; width: 500px;">Description</th>
								<th style="width: 150px;">Business Name</th>
								<th>Type & Year</th>
								<th>Debit</th>
								<th>Credit</th>
								<th>Balance</th>
								<th style="text-align: right;">Representative</th>
								<?php 
									$vAccSHdOpBal = $ContObj->vAccSHdOpBal($sHdId,$vAccSHdData['id'],$fd,$td);
									if($vAccSHdOpBal){
										foreach($vAccSHdOpBal as $vAccSHdOpBalData){
											$accPrevBal = $vAccSHdOpBalData['accSHdOpBal'];
											echo '<tr><td colspan="9" style="text-align: center;"><h4>Previous Balance: '.number_format($vAccSHdOpBalData['accSHdOpBal'],2).'</h4></td>';
										}
									}	
									echo '</tr>';
									$tot = $accPrevBal;
								if($vAccSHdTrsctn){
									foreach($vAccSHdTrsctn as $vAccSHdTrsctnData){
										$tot = $tot+=($vAccSHdTrsctnData['drAmt']-$vAccSHdTrsctnData['crAmt']);
										echo '<tr>
										<td style="text-align: left;">'.$vAccSHdTrsctnData['gjDt'].' '.$vAccSHdTrsctnData['gjTm'].'</td>
										<td>'.$vAccSHdTrsctnData['retGj'].'</td>
										<td style="text-align: left;">'.$vAccSHdTrsctnData['description'].'</td>
										<td>'.$vAccSHdTrsctnData['busNm'].'</td>
										<td>'.$vAccSHdTrsctnData['feeTp'].' '.$vAccSHdTrsctnData['feeYr'].'</td>
										
										<td style="text-align: right;">'.number_format($vAccSHdTrsctnData['drAmt'],0).'</td>
										<td style="text-align: right;">'.number_format($vAccSHdTrsctnData['crAmt'],0).'</td>
										<td>'.number_format($tot,0).'</td>
										<td style="text-align: right;">'.$vAccSHdTrsctnData['repNm'].'</td>
										</tr>';
									}

								}


								echo '<tr><th colspan="5" style="text-align: center;"><h4>Total Balance:</h4></th>';

								$vAccSHdTotDr = $ContObj->vAccSHdTotDr($sHdId,$vAccSHdData['id'],$fd,$td);
									if($vAccSHdTotDr){
										foreach($vAccSHdTotDr as $vAccSHdTotDrData){
											$dr = $vAccSHdTotDrData['accSHdTotDr'];
											echo '<th style="text-align: right;">'.number_format($vAccSHdTotDrData['accSHdTotDr'],0).'</h4></th>';
										}
									}

								$vAccSHdTotCr = $ContObj->vAccSHdTotCr($sHdId,$vAccSHdData['id'],$fd,$td);
									if($vAccSHdTotCr){
										foreach($vAccSHdTotCr as $vAccSHdTotCrData){
											$cr = $vAccSHdTotCrData['accSHdTotCr'];
											echo '<th style="text-align: right;">'.number_format($vAccSHdTotCrData['accSHdTotCr'],0).'</h4></th>';
										}
									}	

									echo '<th style="text-align: right;">'.number_format($accPrevBal+$dr-$cr,0).'</th>
									<th></th>
									</tr>';
								?>

							</table>
							<br /><br /><br />
						</div>
							<?php
			}
		}
	}
}
?>













