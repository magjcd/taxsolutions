<?php
if(isset($_GET['citEid'])){
	$eid = $_GET['citEid'];
	$msf = $ContObj->modiCity($eid);
}
?>