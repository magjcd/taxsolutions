<?php
session_start();
include("../autoLoad.php");
$ContObj = new Controller();
if(isset($_POST['vgj'])){
	$vgjDet = $ContObj->vgjDet($_POST['vgj']);
	$vFeeTp = $ContObj->viewFeeTp();

	$vGjDt = $_POST['vgj'];
	if($vgjDet){
		?>
		<div class="GenJounMessageSuccess text-center bg-default" style="line-height: 35px; display:none; "></div>
		<!-- <div class="GenJounMessageError text-center bg-danger" style="line-height: 35px;"></div> -->
		<div style="width: 100%; overflow-x: auto; overflow-y: auto;">
			<table style="width: 100%;">
				<tr>
					<th>Trans. Date & Time</th>
					<th>Account Name</th>
					<th>Bus. Name</th>
					<th>City</th>
					<th>Fees Type</th>
					<th>Fees Year</th>
					<th>Description</th>
					<th>Debit</th>
					<th>Credit</th>
					<th>Representative <a href="index?page=prnPdf&gjPrnDt=<?php echo $vGjDt; ?>" style='color: #fff;' accesskey='p' id='pdfPrn'><i class='fa fa-file-pdf fa-lg fa-fw'></i></a></th>
					<!-- <th>Action</th> -->
				</tr>
				<?php
				foreach ($vgjDet as $data) {
					?>
					<tr>
						<td hidden><?php echo $data['id']; ?></td>
						<td><?php echo $data['gjDt'].' '.$data['gjTm']; ?></td>
						<td><?php echo $data['clientNm']; ?></td>
						<td><?php echo $data['busNm']; ?></td>
						<td><?php echo $data['cityNm']; ?></td>
						<!-- <td><?php // echo $data['feeTp']; ?></td> -->

						<td>
							<select name="feetp" id="feetp" class="feetp">
								
								<?php 
								foreach($vFeeTp as $feetp){
									?>
									<option <?php if($data['feeTpId'] == $feetp['id']){ echo "selected='selected'"; } ?> value="<?php echo $data['id']; ?>|<?php echo $feetp['id']; ?>|<?php echo $feetp['feeTp']; ?>">
										<?php echo $feetp['feeTp']; ?>
									</option>
									<?php 
								} 
								?>

							</select>
							<?php //echo $data['feeTp']; ?>
						
						</td>
						<td contenteditable data-id="<?php echo $data['feeYr']; ?>" class="feeYr" ><?php echo $data['feeYr']; ?></td>
						<td><?php echo $data['description']; ?></td>
						<td style="text-align: right;"><?php echo number_format($data['drAmt'],2); ?></td>
						<td style="text-align: right;"><?php echo number_format($data['crAmt'],2); ?></td>
						<td style="text-align: center;"><?php echo $data['repNm']; ?></td>
<!-- 						<td>
							<?php echo "
							<a href='index.php?page=gjEntUpd&gjEid=".$data['id']."' id='edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a>";
					?>
					</td> -->
					</tr>
					<?php
				}
				$totDrCr = $ContObj->totDrCrgjDtSR($_POST['vgj']);
				foreach ($totDrCr as $DrCr) {
				$gjCurBl = ($DrCr['drAmt']-$DrCr['crAmt']);	
				?>
				<tr><th colspan="7" style="text-align: center;">Total Amount</th>
					<th style="text-align: right;"><?php echo number_format($DrCr['drAmt'],2); ?></th>
					<th style="text-align: right;"><?php echo number_format($DrCr['crAmt'],2); ?></th><th></th></tr>
				<?php } ?>
			</table>

	</div>
	<br /><br /><br />
		<?php
	}
}
?>