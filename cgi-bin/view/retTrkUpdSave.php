<?php
session_start();
include('../autoLoad.php');
$ContObj = new Controller();
if(isset($_POST['retTDtUpd'])){
	$ContObj->retTrkUpd($_POST['idUpd'],$_POST['retTDtUpd'],$_POST['retTypeClUpd'],$_POST['taxYrUpd'],$_POST['clDtUpd'],$_POST['barCdUpd'],$_POST['subDtUpd'],$_POST['payfeeUpd'],$_POST['remUpd']);
}