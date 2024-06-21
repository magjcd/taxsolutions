<?php
//session_start();
//include(ROOT. DS . 'autoLoad.php');
include("../autoLoad.php");
$ContObj = new Controller();

//if(isset($_POST['payfee'])){
	$ContObj->nRetTrk($_POST['retTDt'],$_POST['retTypeCl'],$_POST['taxYr'],$_POST['clDt'],$_POST['barCd'],$_POST['subDt'],$_POST['payfee'],$_POST['rem'],$_POST['revEraned']);

	//$ContObj->nRetTrk($_POST['retTDt'],$_POST['retType'],$_POST['taxYr'],$_POST['clientDet'],$_POST['barCd'],$_POST['subDt'],$_POST['payfee'],$_POST['rem']);	
//}
?>