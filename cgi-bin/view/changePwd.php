<?php
if(isset($_POST['prePwd'])){
	$ContObj->ChagePwdC($_POST['prePwd'],$_POST['nPwd'],$_POST['cPwd']);
}
?>


<div class="row single-column">
	<h1 class="heading-big">Change Password</h1>
	<div class="col-12">
		<form action="index.php?page=changePwd" method="post" style="text-align: center;">
		<input type="password" name="prePwd" placeholder="Old Password"><br />
		<input type="password" name="nPwd" placeholder="New Password"><br />
		<input type="password" name="cPwd" placeholder="Confirm Password"><br />
		<input type="submit" name="" value="Change Password">
<!-- 				<button type="submit" name="submit" class="submit-btn" style="width: 300px; height: 45px; border: 1px solid blue; color: #fff; background: blue;">
					<i class="fa fa-refresh fa-lg fa-fw"></i></button>
 -->		</form>
	</div>
</div>

