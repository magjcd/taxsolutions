<!-- <div class="row double-column"> -->
<?php 
$ContObj->dirLogChk();
$assetsHd = $ContObj->vShdAccHD('Assets');
$liabHd = $ContObj->vShdAccHD('Liabilities');
$oeHd = $ContObj->vShdAccHD('Owner Equity');

// echo '<pre>';
// print_r($assetsHd);


?>

<div class="row double-column" style="margin-left: auto; margin-right: auto;">
	<div class="col-100">
		<h1 class="heading-big">Balance Sheet</h1>
		<div style="width: 100%; text-align: center; font-weight: bold;"><?php echo date('l jS \of F Y') ?></div>
	</div>
</div>

<div class="row double-column" style="margin-left: auto; margin-right: auto;">
	<div class="col-50">
		<table style="width: 100%">
			<tr>
				<th colspan="2" style="text-align: center;">ASSETS</th>
			</tr>
			<?php 
			if($assetsHd){
				foreach($assetsHd as $assetsHdDet){
					$sHdId = $assetsHdDet['id'];
				?>
				<tr>
					<td>
						<details>
						<summary>
							<?php echo '<h4>'.strtoupper($assetsHdDet['subHeadNm']).'</h4>'; ?>
							
							</summary>
							<?php 
							$vAccSHd = $ContObj->vAccSHd($sHdId);

							echo '<table style="width: 100%; color: #006699;">';
							if($vAccSHd){
								foreach($vAccSHd as $vAccSHdDet){
									$accId = $vAccSHdDet['id'];
									echo '<tr><td>'.$vAccSHdDet['clientNm'].'</td>';
								

									$balShtAccSum = $ContObj->balShtAccSum($accId);
									if($balShtAccSum){
										foreach($balShtAccSum as $balShtAccSumDet){
											if($balShtAccSumDet['Tbal'] >= 0){
												echo '<td style="text-align: right;">'.number_format($balShtAccSumDet['Tbal']).'</td></tr>';
											}else{
												echo '<td style="text-align: right; color: red;">'.number_format($balShtAccSumDet['Tbal']).'</td></tr>';
											}
										}
									}
								}
							}
							echo '</table>';
							?>
						
						</details>
					</td>

					<td style="text-align: right;">
						<?php 
						$assetsHdSum = $ContObj->sumShdAccHD($sHdId);
						if($assetsHdSum){
							foreach($assetsHdSum as $assetsHdSumDet){
								echo number_format($assetsHdSumDet['Tbal']);
							}
						}
						?>
					</td>
				</tr>
				<?php			
				}
			}
			?>
		</table>
	</div>

	<div class="col-50">
		<table style="width: 100%">
			<tr>
				<th colspan="2" style="text-align: center;">LIABILITIES</th>
			</tr>
			<?php 
			if($assetsHd){
				foreach($liabHd as $liabHdDet){
				?>
				<tr>
					<td>
						<?php echo $liabHdDet['subHeadNm']; ?>
					</td>

					<td style="text-align: left;">0.00</td>
				</tr>
				<?php			
				}
			}
			?>
		</table>
	</div>

	<div class="col-50">
		<!-- <table style="width: 100%">
			<th colspan="2" style="text-align: center;">&nbsp;</th>
		</table> -->
	</div>

	<div class="col-50">
		<table style="width: 100%">
			<tr>
				<th colspan="2" style="text-align: center;">Owner's Equity</th>
			</tr>
			<?php 
			if($oeHd){
				foreach($oeHd as $oeHdDet){
				?>
				<tr>
					<td>
						<?php echo $oeHdDet['subHeadNm']; ?>
					</td>

					<td style="text-align: left;">0.00</td>
				</tr>
				<?php			
				}
			}
			?>
		</table>
	</div>

</div>
<!-- </div> -->
<br /><br />















