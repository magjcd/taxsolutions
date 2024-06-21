<?php
if(isset($_GET['rid'])){
	$rid = $_GET['rid'];
	$ContObj->resetPwd($rid);
}
?>