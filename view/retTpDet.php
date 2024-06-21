<?php
//include(ROOT. DS . 'autoLoad.php');
session_start();
include("../autoLoad.php");
$ContObj = new Controller();

if(isset($_POST['retTp']) && $_POST['retTp'] != ''){
	$retTpArr = explode("|", $_POST['retTp']);
	$retTpId = $retTpArr[0];
	$retTpNm = $retTpArr[1];

	$clDetData = $ContObj->clDetData($retTpNm);
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
}elseif(isset($_POST['clDt']) && $_POST['clDt'] != ""){

	// Extracting ID from clDt Array
	$clDtArr = explode("|", $_POST['clDt']);
	$clDtId = $clDtArr[0];	

	// Extracting Return Type Name from retTpCl 
	$retTpClArr = explode("|",$_POST['retTpCl']);
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
// elseif(isset($_POST['payfee'])){
// 	$ContObj->nRetTrk($_POST['retTypeCl'],$_POST['taxYr'],$_POST['clDt'],$_POST['barCd'],$_POST['subDt'],$_POST['payfee'],$_POST['rem']);
// 	echo 'Ok';
// }
?>