<?php

// Crating Variables for Drop Down Boxes
$drpDnStat = $ContObj->clStatD(); // Client Status
$drpDnCity = $ContObj->clCityD(); // Client City
$hidAccNat = $ContObj->hidAccNat(); // Hidden Account Nature for New Client like Assets/Accounts Receivable


$busStatVar = (isset($_POST['busStatus']) ? $_POST['busStatus'] : '');
$busStatArr = explode('|', $busStatVar);
$busStatVarId = $busStatArr[0];
//$busStatus = (isset($_POST['busStatus']) ? $_POST['busStatus'] : "");

$cName = (isset($_POST['cName']) ? $_POST['cName'] : "");
$cnicNo = (isset($_POST['cnicNo']) ? $_POST['cnicNo'] : "");

/* To Keep City Value in DrpDn */
$ctVar = (isset($_POST['cCity']) ? $_POST['cCity'] : '');
$ctVarArr = explode('|', $ctVar);
$ctVarId = $ctVarArr[0];

//$cCity = (isset($_POST['cCity']) ? $_POST['cCity'] : "");

$bussName = (isset($_POST['bussName']) ? $_POST['bussName'] : "");

?>
