<?php
$ContObj->adminLogChk();

$uNm = $fNm = $uPwd = $cPwd = $eAddr = "";

if(isset($_POST['userNm'])){
	if(empty($_POST['userNm'])){
	}else{
		$uNm = $_POST['userNm'];
	}

	if(empty($_POST['fNm'])){
	}else{
		$fNm = $_POST['fNm'];
	}

	if(empty($_POST['uPwd'])){
	}else{
		$uPwd = $_POST['uPwd'];
	}

	if(empty($_POST['cPwd'])){
	}else{
		$cPwd = $_POST['cPwd'];
	}

	if(empty($_POST['eAddr'])){
	}else{
		$eAddr = $_POST['eAddr'];
	}
}


?>
<?php
if(isset($_POST['userNm'])){
	$ContObj->nUserC($_POST['userNm'],$_POST['fNm'],$_POST['uPwd'],$_POST['cPwd'],$_POST['eAddr'],$_POST['status'],$_POST['role']);
}
?>

<div class="row single-column" style="text-align: center;">
	<h1 class="heading-big">Creat Representative</h1>
	<div class="col-12">
		<form action="index?page=nUser" method="post">
			<input type="text" name="userNm" value = "<?php echo $uNm; ?>" placeholder="User Name">

			<input type="text" name="fNm" value="<?php echo $fNm; ?>" placeholder="Full Name">

			<input type="password" name="uPwd" value="<?php echo $uPwd; ?>" placeholder="********"><br />
			<input type="password" name="cPwd" value="<?php echo $cPwd; ?>" placeholder="********"><br />
			<input type="text" name="eAddr" value="<?php echo $eAddr; ?>" placeholder="email@domain.com"><br />

			<select name="status">
				<option value="">Select Status</option>
				<option value="active">Active</option>
				<option value="inactive">Inactive</option>
			</select>

			<select name="role">
				<option value="">Select a Role</option>
				<option value="representative">Representative</option>
				<option value="director">Director</option>
			</select>

			<input type="submit" id="cUser" value="Creat">
			<input type="reset" name="reset" value="Reset">
		</form>
	</div>
</div>