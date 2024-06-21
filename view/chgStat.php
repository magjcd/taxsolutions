<?php
if(isset($_GET['sid'])){
	$sid = $_GET['sid'];
	$stat = $_GET['stat'];

	$status = ($stat == 'active') ? 'inactive' : 'active';

	$ContObj->chgStat($sid,$status);
}
?>