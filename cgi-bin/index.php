<!DOCTYPE html>
<?php
ob_start();
//header("Cache-Control: no-cache");
session_start();
include("autoLoad.php");
date_default_timezone_set('Asia/Karachi');
// define('DS',DIRECTORY_SEPARATOR);
// define('ROOT', dirname(__FILE__));
// $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')): [];

?>
<link rel="short icon" type="images/png" href="public/images/sts.ico">
<html>
<head>
	<title>
		SAWREVA Tax Solution
	</title>
	<link rel="icon" src="public/images/user.jpg">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- GOOGLE Fonts -->

<link href='https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap' rel='stylesheet'>
<!-- <link href='https://fonts.googleapis.com/css?family=Antic' rel='stylesheet'> -->
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine"> -->
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sans-Serif"> -->
  <!-- Bootstrap 3 and 4 liberary -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="public/css/style.css">

<!-- include jQuery library -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<!-- include Cycle plugin -->
<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js" integrity="sha512-yVcJYuVlmaPrv3FRfBYGbXaurHsB2cGmyHr4Rf1cxAS+IOe/tCqxWY/EoBKLoDknY4oI1BNJ1lSU2dxxGo9WDw==" crossorigin="anonymous"></script>

<!-- Font Awesome liberary -->
<script src="https://kit.fontawesome.com/affa3c5e5a.js" crossorigin="anonymous"></script>
<!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin="anonymous"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="public/js/jquery-3.5.1.js"></script>
<script type="text/javascript" src="public/js/myfunc.js"></script>

</head>
<body>
	<!-- <div id="content"> -->
<?php	
	// if(isset($_COOKIE['admin'])){
	// 	include("view/admin.php");
	// 	$obj = new Controller();
	// }elseif(isset($_SESSION['admin'])){
	// 	include("view/admin.php");
	// 	$obj = new Controller();
	// }else{
	// 	//header("Location: login.php");
	// }
	if(isset($_SESSION['admin'])){
		$ContObj = new Controller();
		include("view/admin.php");
	}elseif(isset($_SESSION['director'])){
		//$ContObj = new Controller();
		include("view/director.php");
	}elseif(isset($_SESSION['representative'])){
		$ContObj = new Controller();
		// $RepCntObj = new RepresCont();
		include("view/representative.php");
	}else{
		header("location: login");
	}
	ob_end_flush();
?>
<!-- </div> -->

</body>


</html>















