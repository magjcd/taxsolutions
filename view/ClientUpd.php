<?php

if(isset($_GET['eid'])){
	include 'controller/ClientUpdConfig.php';
	$datas = $ContObj->clientDet($_GET['eid']);
// Object for sending Form Data to Controller
//if(isset($_POST['busStatus'])){
	// $ContObj->nClient($_POST['busStatus'],$_POST['uID'],$_POST['cName'],$_POST['cAddr'],$_POST['cnicNo'],$_POST['cCity'],$_POST['tou'],$_POST['bussName'],$_POST['ptclNo'],$_POST['CellNo1'],$_POST['rtoCno2'],$_POST['bussAdd'],$_POST['branchOff'],$_POST['feeAppl'],$_POST['classification'],$_POST['rto'],$_POST['bussCat'],$_POST['fbrId'],$_POST['pass'],$_POST['pinC'],$_POST['linked'],$_POST['Cemail'],$_POST['remRes'],$_POST['NTNno'],$_POST['NTNdor'],$_POST['STRNno'],$_POST['STRNdor'],$_POST['whtAg'],$_POST['WHTdor'],$_POST['SRBno'],$_POST['SRBdor'],$_POST['BRBno'],$_POST['BRBdor'],$_POST['PRBno'],$_POST['PRBdor']);

//	$ContObj->nClient($_POST['busStatus'],$uID,$cName,$cAddr,$cnicNo,$_POST['cCity'],$_POST['tou'],$bussName,$ptclNo,$CellNo1,$rtoCno2,$bussAdd,$_POST['branchOff'],$_POST['feeAppl'],$classification,$_POST['rto'],$_POST['bussCat'],$fbrId,$pass,$pinC,$_POST['linked'],$Cemail,$remRes,$NTNno,$NTNdor,$STRNno,$STRNdor,$_POST['whtAg'],$WHTdor,$SRBno,$SRBdor,$BRBno,$BRBdor,$PRBno,$PRBdor);		
//}
	// echo '<pre>';
	// print_r($datas);
	// echo '</pre>';
if(isset($_POST['UpdClient'])){
	$ContObj->clientUpd($_GET['eid'],$_POST['busStatus'],$_POST['uID'],$_POST['cName'],$_POST['cAddr'],$_POST['cnicNo'],$_POST['cCity'],$_POST['tou'],$_POST['bussName'],$_POST['ptclNo'],$_POST['CellNo1'],$_POST['rtoCno2'],$_POST['bussAdd'],$_POST['branchOff'],$_POST['feeAppl'],$_POST['classification'],$_POST['rto'],$_POST['bussCat'],$_POST['fbrId'],$_POST['pass'],$_POST['pinC'],$_POST['linked'],$_POST['Cemail'],$_POST['NTNno'],$_POST['NTNfee'],$_POST['NTNdor'],$_POST['STRNno'],$_POST['STRNfee'],$_POST['STRNdor'],$_POST['whtAg'],$_POST['whtFee'],$_POST['WHTdor'],$_POST['SRBno'],$_POST['SRBfee'],$_POST['SRBdor'],$_POST['BRBno'],$_POST['BRBfee'],$_POST['BRBdor'],$_POST['PRBno'],$_POST['PRBfee'],$_POST['PRBdor']);
}
?>
		 
<form action="index.php?page=ClientUpd&eid=<?php echo $_GET['eid']; ?>" method="post" style="margin-left: auto; margin-right: auto;">
	<div class="row double-column">
		<h1 class="heading-big">Update Client Profile</h1>
		<div class="col-md-6">

			<?php
			foreach ($datas as $clData) {
			?>
			<!-- <span class="">*</span> -->
			<select name="busStatus" class="reqFlab" autofocus>
				<option value="">Select Business Status</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($drpDnStat){
					foreach ($drpDnStat as $data) {
						if($clData['busStatNm'] == $data['statNm']){ echo 'Found'; }
				?>
					<option <?php if($clData['busStatId'] == $data['id']){ ?> selected = 'selected' <?php } ?> 		  
					value="<?php echo $data['id']; ?> | <?php echo $data['statNm']; ?>">
						<?php echo $data['statNm']; ?></option>
				<?php
					}
				}
				?>

			</select><br />
			<input type="text" name="uID" placeholder="User ID" value="<?php 
			if(strlen($clData['userId']) > 0 ){ echo $clData['userId']; }else{ echo $uID; } 
			//echo $clData['userId']; ?>"><br />
			
			<input type="text" name="cName" placeholder="Client Name" value="<?php 
			if(strlen($clData['clientNm']) > 0 ){ echo $clData['clientNm']; }else{ echo $cName; }
			//echo $clData['clientNm']; ?>" class="reqFlab"><br />

			<textarea name="cAddr" cols="10" rows="3" placeholder="Client Address"><?php 
			if(strlen($clData['clientAddr']) > 0 ){ echo $clData['clientAddr']; }else{ echo $cAddr; }
			//echo $clData['clientAddr']; ?></textarea><br />
			
			<input type="number" name="cnicNo" placeholder="CNIC without Dashes" value="<?php 
			if(strlen($clData['cnicNo']) > 0 ){ echo $clData['cnicNo']; }else{ echo $cnicNo; }
			//echo $clData['cnicNo']; ?>" class="reqFlab" dir="ltr"><br />

			<select name="cCity" class="reqFlab">
				<option value="">Select City</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($drpDnCity){
					foreach ($drpDnCity as $data) {
				?>
				<option <?php if($clData['cityId'] == $data['id']){ ?> selected = 'selected' <?php } ?>
				value="<?php echo $data['id']; ?>|<?php echo $data['cityNm']; ?>"><?php echo $data['cityNm']; ?></option>					
				<?php
					}
				}
				?>
			</select><br />

			<select name="tou">
				<option value="">Select Tax Office Unit</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($drpDnTou){
					foreach ($drpDnTou as $data) {
				?>
					<option <?php if($clData['touId'] == $data['id']){ ?> selected = 'selected' <?php } ?>
					value="<?php echo $data['id']; ?> | <?php echo $data['taxOffName']; ?>">
						<?php echo $data['taxOffName']; ?></option>
				<?php
					}
				}
				?>
			</select><br />

			<input type="text" name="bussName" placeholder="Business Name" value="<?php 
			if(strlen($clData['busNm']) > 0 ){ echo $clData['busNm']; }else{ echo $bussName; }
			//echo $clData['busNm']; ?>" class="reqFlab"><br />
			
			<input type="text" name="ptclNo" placeholder="PTCL No." value="<?php 
			if(strlen($clData['ptclNo']) > 0 ){ echo $clData['ptclNo']; }else{ echo $ptclNo; }
			//echo $clData['ptclNo']; ?>"><br />

			<input type="tel" name="CellNo1" placeholder="Cell No. 1" 
			pattern="^[\+]{1}[0-9]{2}[0-9]{3}[0-9]{7}$" title="+923331234567" value="<?php 
			if(strlen($clData['cellNo1']) > 0 ){ echo $clData['cellNo1']; }else{ echo $CellNo1; }
			//echo $clData['cellNo1']; ?>"><br />

			<input type="text" name="rtoCno2" placeholder="Cell No. 2" 
			pattern="^[\+]{1}[0-9]{2}[0-9]{3}[0-9]{7}$" title="+923331234567" value="<?php 
			if(strlen($clData['cellNo2']) > 0 ){ echo $clData['cellNo2']; }else{ echo $rtoCno2; }
			//echo $clData['cellNo2']; ?>"><br />
			
			<textarea name="bussAdd" placeholder="Businness Address"><?php 
			if(strlen($clData['busAddr']) > 0 ){ echo $clData['busAddr']; }else{ echo $bussAdd; }
			//echo $clData['busAddr']; ?></textarea>
			
			<select name="branchOff">
				<option value="">Select a Branch Office</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($drpDnBrOff){
					foreach ($drpDnBrOff as $data) {
				?>
					<option <?php if($clData['boId'] == $data['id']){ ?> selected = 'selected' <?php } ?>
					value="<?php echo $data['id']; ?> | <?php echo $data['brOffNm']; ?>">
						<?php echo $data['brOffNm']; ?></option>
				<?php
					}
				}
				?>

			</select><br />
			<select name="feeAppl">
				<option value="">Select Fees Applied</option>
				<?php
				if($feeAppl){
					foreach($feeAppl as $data){
						?>
						<option <?php if($clData['feeAppl'] == $data['feeAplVal']){ ?> selected='selected' <?php } ?> value="<?php echo $data['feeAplVal']; ?>">
							<?php echo $data['feeAplVal']; ?>
						</option>
						<?php
					}
				}
				?>
			</select><br />

			<select name="classification">
				<option value="">Select Classification</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($cls){
					foreach($cls as $data){
						?>
						<option <?php if($clData['classification'] == $data['clsVal']){ ?> selected='selected' <?php } ?> value="<?php echo $data['clsVal']; ?>">
							<?php echo $data['clsVal']; ?>
						</option>
						<?php
					}
				}
				?>
			</select>

			<select name="rto">
				<option value="">Select RTO</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($drpDnRto){
					foreach ($drpDnRto as $data) {
				?>
					<option <?php if($clData['rtoId'] == $data['id']){ ?> selected = 'selected' <?php } ?>
					value="<?php echo $data['id']; ?> | <?php echo $data['rtoName']; ?>">
						<?php echo $data['rtoName']; ?></option>
				<?php
					}
				}
				?>
			</select><br />

			<select name="bussCat">
				<option value="">Select Business Category</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($drpDnBusCat){
					foreach ($drpDnBusCat as $data) {
				?>
					<option <?php if($clData['busCatId'] == $data['id']){ ?> selected = 'selected' <?php } ?>
					 value="<?php echo $data['id']; ?> | <?php echo $data['busCatNm']; ?>">
						<?php echo $data['busCatNm']; ?></option>
				<?php
					}
				}
				?>
			</select><br />


			<input type="number" name="fbrId" placeholder="FBR ID" value="<?php echo $clData['fbrId']; ?>"><br />
			<input type="text" name="pass" placeholder="Abc*123xyz" value="<?php echo $clData['password']; ?>"><br />
			<input type="number" name="pinC" placeholder="Pin Code" value="<?php echo $clData['pinCd']; ?>"><br />

		</div>

		<div class="col-md-6">


			<select name="linked">
				<option value="">Linked With Advocate</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($drpDnLnkAcc){
					foreach ($drpDnLnkAcc as $data) {
				?>
					<option <?php if($clData['linkId'] == $data['id']){ ?> selected = 'selected' <?php } ?>
					value="<?php echo $data['id']; ?> | <?php echo $data['linkNm']; ?>">
						<?php echo $data['linkNm']; ?></option>
				<?php
					}
				}
				?>
			</select><br />

			<input type="text" name="Cemail" placeholder="email@domain.com" value="<?php echo $clData['emId']; ?>"><br />
			<!-- <textarea name="remRes" placeholder="Remarks / Reason"><?php //echo $remRes; ?></textarea><br /> -->
			<input type="text" name="NTNno" placeholder="NTN Numbr" value="<?php echo $clData['ntnNo']; ?>"><br />
			<input type="number" name="NTNfee" placeholder="Income Tax Fees" value="<?php 
			if($clData['ntnFee'] !=0 ){
				echo $clData['ntnFee'];
				}
			//echo $clData['ntnFee'];
			 ?>"><br />
			<input type="date" name="NTNdor" value="<?php echo $clData['ntnDt']; ?>"><br />

			<input type="text" name="STRNno" placeholder="STRN Number" value="<?php echo $clData['strnNo']; ?>"><br />
			<input type="number" name="STRNfee" placeholder="STRN Fees" value="<?php 
			if($clData['strnFee'] !=0 ){
				echo $clData['strnFee'];
			}
			//echo $clData['strnFee']; ?>"><br />
			<input type="date" name="STRNdor" value="<?php echo $clData['strnDt']; ?>"><br />

			<select name="whtAg">
				<option value="">WHT AGENT ?</option>
				<option disabled="disabled">------------------------------------</option>
				<?php
				if($whAgt){
					foreach($whAgt as $data){
						?>
						<option <?php if($clData['whAgt'] == $data['whAgtVal']){ ?> 
							selected='selected' <?php } ?> value="<?php echo $data['whAgtVal']; ?>">
							<?php echo $data['whAgtVal']; ?>
						</option>
						<?php
					}
				}
				?>
			</select>
			<input type="number" name="whtFee" placeholder="WHT Fees" value="<?php echo $whtFee; ?>"><br />
			<input type="date" name="WHTdor" value="<?php echo $clData['whDt']; ?>"><br />

			<input type="text" name="SRBno" placeholder="SRB" value="<?php echo $clData['srbNo']; ?>"><br />
			<input type="number" name="SRBfee" placeholder="SRB Fees" value="<?php 
			if($clData['srbFee'] !=0 ){
				echo $clData['srbFee'];
				}
			//echo $clData['srbFee']; ?>"><br />
			<input type="date" name="SRBdor" value="<?php echo $clData['srbDt']; ?>"><br />

			<input type="text" name="BRBno" placeholder="BRB" value="<?php echo $clData['brbNo']; ?>"><br />
			<input type="number" name="BRBfee" placeholder="BRB Fees" value="<?php 
			if($clData['brbFee'] !=0 ){
				echo $clData['brbFee'];
				}
			//echo $clData['brbFee']; ?>"><br />
			<input type="date" name="BRBdor" value="<?php echo $clData['brbDt']; ?>"><br />

			<input type="text" name="PRBno" placeholder="PRB" value="<?php echo $clData['prbNo']; ?>"><br />	
			<input type="number" name="PRBfee" placeholder="PRB Fees" value="<?php 
			if($clData['prbFee'] !=0 ){
				echo $clData['prbFee'];
				}
			//echo $clData['prbFee']; ?>"><br />
			<input type="date" name="PRBdor" value="<?php echo $clData['prbDt']; ?>"><br />
			<?php
		}
			?>
		</div>
	<!-- </div>
	<div class="row double-column"> -->
		<div class="col-12" style="text-align: center;">
			<button type="submit" name="UpdClient" accesskey="u">Update</button>
			<!-- <input type="submit" name="UpdClient" value="Update"> -->
			<input type="reset" name="reset" value="Reset">
		</div>
	</div>
</form>
<p class="bott-height"></p>
<?php

}else{
	echo "No Rec";
}
?>