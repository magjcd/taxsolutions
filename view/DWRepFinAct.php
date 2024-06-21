<?php
$repList = $ContObj->listAllRep();

?>
<div class="full-width">
	<h1 class="heading-big">Rep Fin Acts for Current Date</h1>
	<h4 style="text-align: center;"><?php echo date("D jS M Y"); ?></h4>
	<?php 
	foreach($repList as $repNm){
		echo "<div style='line-height: 40px; text-align: center; background: rgba(0, 0, 0, 0.9); color: #fff;'><b>".$repNm['name']."</b></div>";
		$repFinTransDaily = $ContObj->repDayFinTrans($repNm['id']);
		if($repFinTransDaily){
		// echo '<pre>';
		// print_r($repFinTransDaily);
		// echo '</pre>';
			$numRec = count(array_column($repFinTransDaily, 'repId'));

		?>

		<div style="overflow-x: auto;">
		<table style="width: 100%;">

			<!-- <tr><th colspan="8"><?php echo "<p style='font-weight: bold; text-align: center; background: #fff; color: #000;'>Number of Entries: ".$numRec."</p>"; ?></th></tr> -->
			
			<tr>
				<th>Sr. No.</th>
				<th>Client Name</th>
				<th>Business Name</th>
				<th>City</th>
				<th>Fees Type & Year</th>				
				<th style='text-align:right;'>Dr Amt</th>
				<th style='text-align:right;'>Cr Amt.</th>
				<th style='text-align:right;'>Doc. Type</th>
			</tr>

			<?php
			$cnt = 1;
			foreach($repFinTransDaily as $repTransDet){
				echo "<tr>
				<td>".$cnt."</td>
				<td>".$repTransDet['clientNm']."</td>
				<td>".$repTransDet['busNm']."</td>
				<td>".$repTransDet['cityNm']."</td>
				<td>".$repTransDet['feeTp']." of ".$repTransDet['feeYr']."</td>				
				<td style='text-align:right;'>".number_format($repTransDet['drAmt'],2)."</td>
				<td style='text-align:right;'>".number_format($repTransDet['crAmt'],2)."</td>
				<td style='text-align:right;'>".$repTransDet['retGj']."</td>
				</tr>";
				$cnt++;
				?>

			<?php 
		}
		?>
			</table>
		</div>
		<div class="rowGap">&nbsp;</div>
		<?php
	}else{
		echo "<div style='text-align: center; font-weight: bold;'>No Activity for current date has been done by this Representative</div>";
		echo '<div class="rowGap">&nbsp;</div>';
	}
	}
	?>
</div>
<div class="rowGap">&nbsp;</div>