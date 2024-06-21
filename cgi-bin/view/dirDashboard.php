<?php

include("../autoLoad.php");
$ContObj = new Controller();

?>
					<div class="col-sm-6 col-md-3 dir-panel-red">
						<h1><i class="fas fa-money-check-alt fa-lg fa-fw"></i><!-- <br />Financial Position --></h1>
						<?php
						$finRptRData = $ContObj->revRpt();
						?>
						<table id="dir-table">
							<tr>
								<?php
								if($finRptRData){
									foreach($finRptRData as $finRevData){
										$revAmt = $finRevData['revenue'];
										?>
										<td>Revenue</td><td style="text-align: right;">
											<?php echo number_format($finRevData['revenue'],2); ?></td>
										<?php
									}
								}
								?>
							</tr>

							<tr>
								<?php
								$finRptEData = $ContObj->expRpt();
								if($finRptEData){
									foreach($finRptEData as $finExpData){
										$expAmt = $finExpData['expences'];
										?>
											<td>Expences</td><td style="text-align: right;">
												<?php echo number_format($finExpData['expences'],2); ?></td>
										<?php 
									}
								} 
								?>
							</tr>

							<tr>
								<td>Net Profit</td><td style="text-align: right; border-top: 1px solid #fff; border-bottom: 3px double #fff;">
									<?php echo number_format(($revAmt-$expAmt),2); ?></td>
							</tr>
						</table>
					</div>
					<div class="col-sm-6 col-md-3 dir-panel-blue">
						<h1><i class="fas fa-user-tie fa-lg fa-fw"></i><!--  Client  --></h1>
						<table id="dir-table">
							<tr>
								<?php
								$retTrkDbData = $ContObj->retTrkRpt();
								if($retTrkDbData){
									foreach($retTrkDbData as $retTrkDrData){
										$retTrkDbAmt = $retTrkDrData['clRTAmt'];
										?>
										<td>Total Dues</td><td style="text-align: right;">
											<?php echo number_format($retTrkDrData['clRTAmt'],2); ?></td>
										<?php 
									}
								} 
								?>
							</tr>

							<tr>
								<?php 
								$retTrkCrData = $ContObj->clGjRpt();
								if($retTrkCrData){
									foreach($retTrkCrData as $retTrkColData){
										$retTrkColAmt = $retTrkColData['clCrAmt'];
										?>
										<td>Total Collection</td><td style="text-align: right;">
											<?php echo number_format($retTrkColData['clCrAmt'],2); ?></td>
										<?php 
									}
								} 
								?>
							</tr>

							<tr>
								<td>Arrears</td><td style="text-align: right; border-top: 1px solid #fff; border-bottom: 3px double #fff;">
									<?php echo number_format(($retTrkDbAmt-$retTrkColAmt),2); ?></td>
							</tr>
						</table>
					</div>
					<div class="col-sm-6 col-md-3 dir-panel-green">
						<h1><i class="fas fa-user fa-lg fa-fw"></i> <!-- Representative --></h1>
						<table id="dir-table">
							<tr>
								<?php 
								$retTrkCrData = $ContObj->clGjRpt();
								if($retTrkCrData){
									foreach($retTrkCrData as $retTrkColData){
										$retTrkColAmt2 = $retTrkColData['clCrAmt'];
										?>
										<td>Total Collection</td><td style="text-align: right;">
											<?php echo number_format($retTrkColData['clCrAmt'],2); ?></td>
										<?php 
									}
								} 
								?>
							</tr>

							<tr>
								<?php
								$repExpData = $ContObj->repExp();
								if($repExpData){
									foreach($repExpData as $repColExpData){
										$retTrkColExpAmt = $repColExpData['bal'];
										?>
										<td>Expences</td><td style="text-align: right;">
											<?php echo number_format($repColExpData['bal'],2); ?></td>
										<?php 
									}
								} 
								?>
							</tr>

							<tr>
								<?php
								$bnkInfData = $ContObj->bankInflow();
								if($bnkInfData){
									foreach($bnkInfData as $bnkInflowData){
										$bnkInfDt = $bnkInflowData['bnkInflow'];
										?>
										<td>Bank Deposits</td><td style="text-align: right;">
											<?php echo number_format($bnkInflowData['bnkInflow'],2); ?></td>
										<?php
									}
								}
								?>
							</tr>

							<tr>
								<td>Cash in Hand</td><td style="text-align: right; border-top: 1px solid #fff; border-bottom: 3px double #fff;">
									<?php echo number_format($retTrkColAmt2-$retTrkColExpAmt-$bnkInfDt,2); ?></td>
							</tr>
							

						</table>
					</div>

					<div class="col-sm-6 col-md-3 dir-panel-yellow">
						<h1><i class="fas fa-hand-holding-usd fa-lg fa-fw"></i><!-- Banks --></h1>
						<table id="dir-table">
							<tr>
								<?php
								$bnkInfData = $ContObj->bankInflow();
								if($bnkInfData){
									foreach($bnkInfData as $bnkInflowData){
										$bnkInfDt = $bnkInflowData['bnkInflow'];
										?>
										<td>Cash Inflow</td><td style="text-align: right;">
											<?php echo number_format($bnkInflowData['bnkInflow'],2); ?></td>
										<?php
									}
								}
								?>
							</tr>

							<tr>
								<?php
								$bnkOutData = $ContObj->bankOutflow();
								if($bnkOutData){
									foreach($bnkOutData as $bnkOutflowData){
										$bnkOutfDt = $bnkOutflowData['bnkOutflow'];
										?>
										<td>Cash Outflow</td><td style="text-align: right;">
											<?php echo number_format($bnkOutflowData['bnkOutflow'],2); ?></td>
										<?php
									}
								}
								?>
							</tr>

							<tr>
								<td>Balance</td><td style="text-align: right; border-top: 1px solid #000; border-bottom: 3px double #000;">
									<?php echo number_format($bnkInfDt-$bnkOutfDt,2); ?></td>
							</tr>
						</table>
					</div>