<?php
session_start();
include("../autoLoad.php");
$ContObj = new Controller();
if(isset($_POST['vRtTrk'])){
	$vgjDet = $ContObj->vRetTrkDetSR($_POST['vRtTrk']);
	// echo "<pre>";
	// print_r($vgjDet);
	// echo "</pre>";
	if($vgjDet){
		$retTrkDt =  $_POST['vRtTrk'];
		?>
		<div style="width: 100%; overflow-x: auto;">
			<table style="width: 100%;">
				<tr>
					<th>Account Name</th>
					<th>Bus. Name</th>
					<th>City</th>
					<th>Fees Type</th>
					<th>Fees Year</th>
					<th>Description</th>
					<th>Amount</th>
					<!-- <th>Credit</th> -->
					<th>Representative <a href="index?page=prnPdf&rTrkPrnDt=<?php echo $retTrkDt; ?>" style='color: #fff;' accesskey='p' id='pdfPrn'><i class='fa fa-file-pdf fa-lg fa-fw'></i></a></th>
					<!-- <th>Action</th> -->
									<!-- <a href='index?page=prnPdf&rTrkPrnId=".$retTrkData['id']."' id='edit'>
					</a> -->
				</tr>
				<?php
				foreach ($vgjDet as $data) {
					?>
					<tr>
						<td><?php echo $data['clientNm']; ?></td>
						<td><?php echo $data['busNm']; ?></td>
						<td><?php echo $data['cityNm']; ?></td>
						<td><?php echo $data['feeTp']; ?></td>
						<td><?php echo $data['feeYr']; ?></td>
						<td><?php echo $data['description']; ?></td>
						<td style="text-align: right;"><?php echo $data['drAmt']; ?></td>
						<!-- <td style="text-align: right;"><?php echo $data['crAmt']; ?></td> -->
						<td style="text-align: center;"><?php echo $data['repNm'].' '.$data['gjTm']; ?></td>
<!-- 						<td>
							<?php echo "
							<a href='index.php?page=gjEntUpd&gjEid=".$data['id']."' id='edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a>";
					?>
					</td> -->
					</tr>
					<?php
				}

				
				$totDrCr = $ContObj->totDrCrRTDt($_POST['vRtTrk']);
				foreach ($totDrCr as $DrCr) {
				$gjCurBl = ($DrCr['drAmt']-$DrCr['crAmt']);	
				?>
				<tr><th colspan="6" style="text-align: center;">Total Amount</th>
					<th style="text-align: right;"><?php echo number_format($DrCr['drAmt'],0); ?></th>
					<th style="text-align: right;"></th><th></th></tr>
				<?php } ?>
				
			</table>

	</div>
	<br /><br /><br />
		<?php
	}
}
?>