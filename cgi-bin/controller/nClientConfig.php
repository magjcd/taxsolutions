<?php

// Crating Variables for Drop Down Boxes
$drpDnStat = $ContObj->clStatD(); // Client Status
$drpDnCity = $ContObj->clCityD(); // Client City
$hidAccNat = $ContObj->hidAccNat(); // Hidden Account Nature for New Client like Assets/Accounts Receivable

$cName = (isset($_POST['cName']) ? $_POST['cName'] : "");
$cnicNo = (isset($_POST['cnicNo']) ? $_POST['cnicNo'] : "");
$bussName = (isset($_POST['bussName']) ? $_POST['bussName'] : "");

?>
