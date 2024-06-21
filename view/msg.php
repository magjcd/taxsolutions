<div class="row double-column">
	<?php 
	if(isset($_POST['msg']) && $_POST['msg'] != ''){
		$msgRes = $ContObj->dirMsg($_POST['msg']);
	}
	?>
	<h1 class="heading-big" style="">Notification</h1>
	<div class="col-12" style="text-align: center;">
		<form action="index.php?page=msg" method="post" style="text-align: center;">
		<textarea name="msg" rows="5" cols="50"></textarea><br />
		<input type="submit" name="" value="SEND">
		</form>
	</div>
</div>