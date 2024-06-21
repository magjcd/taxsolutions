
<div class="full-width">
<h1 class="heading-big">Date Wise Representative's Finanacial Activities</h1>
<form id="rdwft" action="index?page=rdwft"  method="POST" style="text-align: center;">
	<input type="date" name="fd" id="fd" value="<?php echo date('Y-m-01'); ?>">
	<input type="date" name="td" id="td" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" value="GET DATA">
	<!-- <button id="getRepData">GET</button> -->
</form>
<div id="rdwftData"></div>

<?php 
if(isset($_POST['td'])){
$repList = $ContObj->listAllRep();
?>
<!-- <div class="full-width"> -->
<!-- 	<h1 class="heading-big">Rep Fin Acts for Current Date</h1> -->
	<h4 style="text-align: center;"><?php echo date("D jS M Y"); ?></h4>
	<?php 
	foreach($repList as $repNm){
		echo "<div  id='repFinActNm'>
		<b>".$repNm['name']."</b>
		</div>";
		$repFinTransDaily = $ContObj->repDWFinTrans($repNm['id'],$_POST['fd'],$_POST['td']);
		if($repFinTransDaily){
		// echo '<pre>';
		// print_r($repFinTransDaily);
		// echo '</pre>';
			$numRec = count(array_column($repFinTransDaily, 'repId'));

		?>

		<div style="overflow-x: auto;">
		<table style="width: 100%;">

			<tr><th colspan="11"><?php echo "<p style='font-weight: bold; text-align: center; background: #fff; color: #000;'>".$_POST['fd']." To ".$_POST['td']."</p>"; ?></th></tr>
			
			<tr>
				<th>Sr. No.</th>
				<th>Trans Date</th>
				<th>Client Name</th>
				<th>Business Name</th>
				<th>City</th>
				<th>Description</th>
				<th>Fees Type & Year</th>				
				<th style='text-align:right;'>Dr Amt</th>
				<th style='text-align:right;'>Cr Amt.</th>
				<th style='text-align:right;'>Doc. Type</th>
				<th style='text-align:right;'>Action</th>
			</tr>

			<?php
			$cnt = 1;
			foreach($repFinTransDaily as $repTransDet){
				if($repTransDet['retGj'] == 'GJ'){
					echo "<tr>
					<td>".$cnt."</td>
					<td>".$repTransDet['gjDt']."</td>
					<td>".$repTransDet['clientNm']."</td>
					<td>".$repTransDet['busNm']."</td>
					<td>".$repTransDet['cityNm']."</td>
					<td>".$repTransDet['description']."</td>					
					<td>".$repTransDet['feeTp']." of ".$repTransDet['feeYr']."</td>				
					<td style='text-align:right;'>".number_format($repTransDet['drAmt'],2)."</td>
					<td style='text-align:right;'>".number_format($repTransDet['crAmt'],2)."</td>
					<td style='text-align:right;'>".$repTransDet['retGj']."</td>
					<td style='text-align:right;'>
					<a href='#' id='edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i>
					</a>
					</td>
					</tr>";
					$cnt++;
				}else{
					echo "<tr>
					<td>".$cnt."</td>
					<td>".$repTransDet['gjDt']."</td>
					<td>".$repTransDet['clientNm']."</td>
					<td>".$repTransDet['busNm']."</td>
					<td>".$repTransDet['cityNm']."</td>
					<td>".$repTransDet['description']."</td>					
					<td>".$repTransDet['feeTp']." of ".$repTransDet['feeYr']."</td>				
					<td style='text-align:right;'>".number_format($repTransDet['drAmt'],2)."</td>
					<td style='text-align:right;'>".number_format($repTransDet['crAmt'],2)."</td>
					<td style='text-align:right;'>".$repTransDet['retGj']."</td>
					<td style='text-align:right;'>
					<a href='#' id='edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a>
					</td>
					</tr>";
					$cnt++;
				}
				?>

			<?php 
		}
		?>
		<!-- 	<a href='index.php?page=gjEntUpd&gjEid=".$repTransDet['id']."' id='edit'>
				<i class='fa fa-edit fa-lg fa-fw'></i></a> -->		
		<!-- <a href='index?page=retTrkUpd&rTrkEid=".$repTransDet['id']."' id='edit'>
					<i class='fa fa-edit fa-lg fa-fw'></i></a> -->
			</table>
		</div>
		<div class="rowGap">&nbsp;</div>
		<?php
	}else{
		echo "<div style='text-align: center; font-weight: bold;'>No Activity for given period has been done by this Representative</div>";
		echo '<div class="rowGap">&nbsp;</div>';
	}
	}
	?>
<!-- </div> -->
<div class="rowGap">&nbsp;</div>





<?php
}

?>
</div>