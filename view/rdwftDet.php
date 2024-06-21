<?php 
include('../autoLoad.php');
$ContObj = new Controller();

$ContObj->repDWFinTrans($_POST['fd'],$_POST['td']);

?>