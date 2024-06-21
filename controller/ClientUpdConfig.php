<?php

// Crating Variables for Drop Down Boxes
$drpDnStat = $ContObj->clStatD(); // Client Status
$drpDnCity = $ContObj->clCityD(); // Client City
$drpDnTou = $ContObj->clTouD(); // Tax Office Unit
$drpDnBrOff = $ContObj->clBrOffD(); // Branch Office
$drpDnRto = $ContObj->clRtoD(); // RTOs
$drpDnBusCat = $ContObj->clBusCatD(); // Business Category
$drpDnLnkAcc = $ContObj->clLnkAccD(); // Linked Account

$feeAppl = $ContObj->feeAppl(); // Fee Applied YES/No
$cls = $ContObj->cls(); // Classification A1/A/B/C
$whAgt = $ContObj->whAgt(); // With Holding YES/NO

//$userId = $cName = $cAddr = $cnic = $bussName = $ptclNo = $CellNo1 = $rtoCno2 = $bussAdd = $classification = $fbrId = $pass = $pinC = $Cemail = $remRes = $NTNno

$uID = (isset($_POST['uID']) ? $_POST['uID'] : "");
$cName = (isset($_POST['cName']) ? $_POST['cName'] : "");
$cAddr = (isset($_POST['cAddr']) ? $_POST['cAddr'] : "");
$cnicNo = (isset($_POST['cnicNo']) ? $_POST['cnicNo'] : "");

//$cCity = (isset($_POST['cCity']) ? $_POST['cCity'] : "");

// if(isset($_POST['cCity'])){
// 	$cCity = $_POST['cCity'];
// }elseif($clData['cityId'] == $data['id']) { 
// 	$cCity =  "selected = 'selected'";
// }else{
// 	$cCity = "";
// }


$bussName = (isset($_POST['bussName']) ? $_POST['bussName'] : "");
$ptclNo = (isset($_POST['ptclNo']) ? $_POST['ptclNo'] : "");
$CellNo1 = (isset($_POST['CellNo1']) ? $_POST['CellNo1'] : "");
$rtoCno2 = (isset($_POST['rtoCno2']) ? $_POST['rtoCno2'] : "");
$bussAdd = (isset($_POST['bussAdd']) ? $_POST['bussAdd'] : "");
// $classification = (isset($_POST['classification']) ? $_POST['classification'] : "");
// $fbrId = (isset($_POST['fbrId']) ? $_POST['fbrId'] : "");
// $pass = (isset($_POST['pass']) ? $_POST['pass'] : "");
// $pinC = (isset($_POST['pinC']) ? $_POST['pinC'] : "");
// $Cemail = (isset($_POST['Cemail']) ? $_POST['Cemail'] : "");
// $remRes = (isset($_POST['remRes']) ? $_POST['remRes'] : "");

// $NTNno = (isset($_POST['NTNno']) ? $_POST['NTNno'] : "");
// $NTNdor = (isset($_POST['NTNdor']) ? $_POST['NTNdor'] : "");

// $STRNno = (isset($_POST['STRNno']) ? $_POST['STRNno'] : "");
// $STRNdor = (isset($_POST['STRNdor']) ? $_POST['STRNdor'] : "");

// $whtAg = (isset($_POST['whtAg']) ? $_POST['whtAg'] : "");
// $WHTdor = (isset($_POST['WHTdor']) ? $_POST['WHTdor'] : "");

// $SRBno = (isset($_POST['SRBno']) ? $_POST['SRBno'] : "");
// $SRBdor = (isset($_POST['SRBdor']) ? $_POST['SRBdor'] : "");

// $BRBno = (isset($_POST['BRBno']) ? $_POST['BRBno'] : "");
// $BRBdor = (isset($_POST['BRBdor']) ? $_POST['BRBdor'] : "");

// $PRBno = (isset($_POST['PRBno']) ? $_POST['PRBno'] : "");
// $PRBdor = (isset($_POST['PRBdor']) ? $_POST['PRBdor'] : "");

?>
