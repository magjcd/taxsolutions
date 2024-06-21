<!DOCTYPE html>
<?php
include("autoLoad.php");
//include("controller/controller.php");
$controller = new Controller();
$controller->logChk();
?>
<link rel=" short icon" type="images/png" href="public/images/sts.png">
<html>
<head>
	<title>
		SAWREVA Tax Solution
	</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="public/css/style.css">
 Font Awesome liberary 
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 include jQuery library 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  include Cycle plugin 
<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
 <script type="text/javascript" src="public/js/jquery-3.5.1.js"></script> 
<script type="text/javascript" src="./public/js/myfunc.js"></script>
 <script type="text/javascript" src="./public/js/myfunc1.js"></script> 

<script type="text/javascript">

	// function showPassword(){
	// let shPwd = document.getElementById("shPwd");
	// if(shPwd.type === "password"){
	// 	shPwd.type = "text";
	// }else{
	// 	shPwd.type = "password";
	// }
	// }

</script>
</head>
<body>
	
	<div class="container-login">&nbsp;
<?php
// if(isset($_POST['user_name'])){
// 	$rem = (isset($_POST['remmember']) ? $_POST['remmember'] : "");
// 	$controller->loginC($_POST['user_name'],$_POST['user_pwd'],$_POST['user_role'],$rem);
// }


if(isset($_POST['user_name'])){
	$controller->loginC($_POST['user_name'],$_POST['user_pwd'],$_POST['user_role']);
}
?>
		<div class="login_form">
			<div class="log-nm"><h1>Login Form</h1></div>
			<?php
			//require 'genLogFile.php';
			$user_name="";$user_pwd="";$user_role="";

			$user_name = (isset($_POST['user_name']) ? $_POST['user_name'] : "");
			$user_pwd = (isset($_POST['user_pwd']) ? $_POST['user_pwd'] : "");
			//$user_role = (isset($_POST['user_role']) ? $_POST['user_role'] : "");
			?>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<form action="controller/login-chk.php" method="post">
				<input type="text" name="user_name" value="<?php echo $user_name; ?>" placeholder="User Name" autofocus>
				<br />
				<input type="password" name="user_pwd" id="shPwd" value="<?php echo $user_pwd; ?>" placeholder="********">
				 <input type="checkbox" onclick="showPassword();" style="width: 20px; outline: none;
				position: absolute; left: 800px;"> -->
				<br />
				<select name="user_role">
					<option value="">Select a Role</option>
					<option value="taxmagrep">Representative</option>
					 <option value="accountant">Accountant</option> 
					<option value="taxmagdir">Director</option>
					<option value="taxmagadmin">Admin</option>
				</select><br />
				
				<input type="checkbox" name="remmember" value="remmember">Remmember Me
				<input type="checkbox" name="mat" value="Matriculation" />Matriculation<br />
				 <input type="submit" name="submit" class="submit-btn" value="Login"> 
				<button id="lginBtn" type="submit" name="submit">
					<i class="fa fa-sign-in fa-lg fa-fw"></i></button>
			</form>

		</div>
 			<h5 class="login-footer">magtech</h5> 
&nbsp;
	</div>
	
</body>
</html>
