<?php
if(isset($_GET['eid'])){
	$datas = $ContObj->repDet($_GET['eid']);
	// echo '<pre>';
	// print_r($datas);
	// echo '</pre>';
	$eid = $_GET['eid'];
	if(isset($_POST['updUser'])){
		$ContObj->updUser($eid,$_POST['updUN'],$_POST['updEm'],$_POST['updFn'],
			$_POST['updRole']);
	}
	?>
	<div class="row single-column" style="overflow-y: auto;">
		<h1 class="heading-big">Update Representative</h1>
		<div class="col-12">
			<?php
			if($datas){
			foreach($datas as $data){
				?>
				<form action="index?page=updUser&eid=<?php echo $_GET['eid']; ?>" method="post">
				<input type="text" placeholder="User Name" name="updUN" 
				value="<?php echo $data['userName']; ?>"><br />

				<input type="email" name="updEm" placeholder="email@domain.com" 
				value="<?php echo $data['userEmail']; ?>"><br />

				<input type="text" name="updFn" placeholder="Full Name"
				value="<?php echo $data['name']; ?>"><br />
				
					<select name="updRole">
						<option value="<?php echo 'taxmagrep'; ?>"><?php echo 'Representative'; ?>
						<option value="<?php echo 'taxmagdir'; ?>"><?php echo 'Director'; ?>
							
						</option>
					</select><br />
					<button type="submit" name="updUser">Update</button>
					<br />
					<input type="reset" name="reset" value="Reset">
					</form>
					<?php
				}
			}
				?>
		</div>
	</div>
	<?php
}
?>