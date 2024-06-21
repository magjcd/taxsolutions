<?php
//include(ROOT. DS . 'autoLoad.php');
session_start();
include("../autoLoad.php");
$ContObj = new Controller();

if(isset($_POST['retTypeUpd'])){

	// Extracting Return Type Array
	$retTypeUpdArr = explode('|', $_POST['retTypeUpd']);
	$retTypeUpdId = $retTypeUpdArr[0];
	$retTypeUpdNm = $retTypeUpdArr[1];

	$clDetData = $ContObj->clDetData($retTypeUpdNm);
	if($clDetData){
		?>
		<option value="">Select a Client</option>
		<option disabled="disabled">----------------------------------</option>
		<?php
			foreach ($clDetData as $clDetDt) {
				?>
				<option value="<?php echo $clDetDt['id']; ?>|<?php echo $clDetDt['clientNm']; ?>|<?php echo $clDetDt['cityId']; ?>|<?php echo $clDetDt['cityNm']; ?>|<?php echo $clDetDt['busNm']; ?>|<?php echo $clDetDt['hdId']; ?>|<?php echo $clDetDt['headNm']; ?>|<?php echo $clDetDt['sHdId']; ?>|<?php echo $clDetDt['sHdNm']; ?>">
					<?php echo $clDetDt['clientNm']; ?> - <?php echo $clDetDt['busNm']; ?> - <?php echo $clDetDt['cnicNo']; ?> - <?php echo $clDetDt['cityNm']; ?>
					</option>
					<?php
			}
	}
}elseif(isset($_POST['retTpUpdCl']) && $_POST['retTpUpdCl'] != ""){

	// Extracting ID from retTpUpdCl Array
	$clDtArr = explode("|", $_POST['retTpUpdCl']);
	$clDtId = $clDtArr[0];	

	// Extracting Return Type Name from retTpUpd 
	$retTpClArr = explode("|",$_POST['retTpUpd']);
	$retTpClId = $retTpClArr[0];
	$retTpClNm = $retTpClArr[1];

	$clRetData = $ContObj->vSClient($clDtId);
	if($retTpClNm == 'IncomeTax'){
		if($clRetData){
			foreach($clRetData as $clRedDt){
				echo $clRedDt['ntnFee'];
			}
		}
	}elseif($retTpClNm == 'SalesTax'){
		if($clRetData){
			foreach($clRetData as $clRedDt){
				echo $clRedDt['strnFee'];
			}
		}
	}elseif($retTpClNm == 'WHTax'){
		if($clRetData){
			foreach($clRetData as $clRedDt){
				echo $clRedDt['whtFee'];
			}
		}
	}elseif($retTpClNm == 'SRB'){
		if($clRetData){
			foreach($clRetData as $clRedDt){
				echo $clRedDt['srbFee'];
			}
		}
	}elseif($retTpClNm == 'BRB'){
		if($clRetData){
			foreach($clRetData as $clRedDt){
				echo $clRedDt['brbFee'];
			}
		}
	}elseif($retTpClNm == 'PRB'){
		if($clRetData){
			foreach($clRetData as $clRedDt){
				echo $clRedDt['prbFee'];
			}
		}
	}
}