<?php
if(isset($_POST['AddClient'])){
	$ContObj->ClientUpd($_POST['uID'],$_POST['cAddr']);
}

?>