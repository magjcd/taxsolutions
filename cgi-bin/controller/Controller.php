<?php
include(realpath(__DIR__.'/..')."/model/model.php");
//include("model/model.php");
/**
 * 
 */
class Controller extends Model
{
	
	public $messages = array();
	protected $model;

	function __construct(){	
		$this->model = new Model();
	}

	public function protect($var){
		$var = trim(strip_tags(addslashes($this->model->conn->real_escape_string($var))));
		return $var;
	}

	// Regular Expression for CNIC
	public function cnic($safeCinc){
		$safeCinc = '/^[\d-]{6}[\d-]{8}[\d]{1}+$/';
		return $safeCinc;
	}

	// Checks whether and user Logged in or not
	public function logChk(){
		session_start();
		if(count($_SESSION) > 0){
			header("location: index");
		}
	}

	//Checks whether ADMIN logged in or anyother
	public function adminLogChk(){
		if(!isset($_SESSION['admin'])){
			header("location: index");
		}
	}

	//Checks whether REPRESENTATIVE logged in or anyother
	public function repLogChk(){
		if(!isset($_SESSION['representative'])){
			header("location: index");
		}
	}

	//Checks whether DIRECTOR logged in or anyother
	public function dirLogChk(){
		if(!isset($_SESSION['director'])){
			header("location: index");
		}
	}

	public function loginRoleC(){
		$data = $this->model->loginRole();
			while($row = $data->fetch_assoc()){
				$datas[] = $row;
			}
			return $datas;
	}

	public function loginC($un,$upwd,$role){
		$un = $this->protect($un);
		$upwd = $this->protect($upwd);

		$upwd = hash('sha256', $upwd);
		if(!empty($un) && !empty($upwd) && !empty($role)){
			$login = $this->model->login($un,$upwd,$role);
			if($login->num_rows > 0){
				while($row=$login->fetch_assoc()){
					$id = $row['id'];
					$DbRole = $row['role'];
					$DbName = $row['name'];
					$DbStatus = $row['status'];
				}

				if($DbStatus == 'active'){
					// if($rem != ""){
					// 	setcookie($role, $un, time() + 60 * 60 * 7,"/");
					// 	header("Location: index");
					// 	//header("location: ../index");
					// }else{
					session_start();
					// Sending User ID alogn with Full Name for further use Like updating Password etc
					$_SESSION[$DbRole]=$id."_".$DbName;						
					header("location: index");
					//}
				}else{
					$this->messages[] = "<div class='message'>Your status is <strong>INACTIVE</strong>, contact the Administrator.</div>";
				}
			}else{
				$this->messages[] = "<div class='message'>Your credentials don't match with Database.</div>";
			}
		}else{
			$this->messages[]  = "<div class='message'>Fill all the Fields.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// For Changing Password of User
	public function ChagePwdC($pPwd,$nPwd,$cPwd){
		$pPwd = $this->protect($pPwd);
		$nPwd = $this->protect($nPwd);
		$cPwd = $this->protect($cPwd);
		$pPwd = hash('sha256', $pPwd);
		if(!empty($pPwd) && !empty($nPwd) && !empty($cPwd)){

			if(strlen($pPwd) >= 8){
				if(strlen($nPwd) >= 8){
					if(preg_match("/^[a-zA-Z0-9#_]*$/", $nPwd)){
						if($nPwd === $cPwd){
							
							// Extracting User ID FROM SESSION Var for WHERE Clause
							if(isset($_SESSION['admin'])){
								$sessNm = 'admin';
							}elseif(isset($_SESSION['representative'])){
								$sessNm = 'representative';
							}else{
								$sessNm = 'director';
							}
							$ses_expl = explode("_", $_SESSION[$sessNm]);
						 	$uId = $ses_expl[0];
							$uNm = $ses_expl[1];							

							// Extracting Data from DB for matching User Pwd with DB Pwd
							$datas = $this->model->fetchSingle('user',' id='.$uId);
							if($datas->num_rows > 0){
								while($row=$datas->fetch_assoc()){
									$DbPass=$row['userPass'];
								}
								if($DbPass === $pPwd){
								// Creating Array Variable for updation for Model
									// Calculating hashes of Password
									$cPwd = hash('sha256', $cPwd);
									$varArr = array(
									'userPass' => $cPwd
									);
									$chgPwd = $this->model->update('user',$varArr,' id='.$uId);
									if($chgPwd == 1){
										$this->messages[] = "<div class='success-msg'>Password is Changed successfully.</div>";
									}else{
										$this->messages[] = "<div class='message'>Password could'nt be changed.</div>";										
									}
								}else{
									$this->messages[] = "<div class='message'>Old Password is not exist in Database.</div>";
								}
							}else{
								$this->messages[] = "<div class='message'>No Record found.</div>";
							}
						}else{
							$this->messages[] = "<div class='message'><strong>NEW</strong> Password does'nt match with <strong>CONFIRM</strong> Password</div>";
						}
					}else{
						$this->messages[] = "<div class='message'>Password should cntain Alpha Numeric and _#</div>";
					}
				}else{
					$this->messages[] = "<div class='message'>New Password must be at least <strong> 8 </strong> characters long</div>";
				}
			}else{
				$this->messages[] = "<div class='message'>Password at least <strong> 8 </strong> characters long</div>";
			}

		}else{
			$this->messages[] = "<div class='message'>Fill all the Fields</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Creating New User By Admin
	public function nUserC($uNm,$fNm,$uPwd,$cPwd,$eAddr,$status,$role){

		$uNm = trim(strip_tags(addslashes($uNm)));
		$fNm = trim(strip_tags(addslashes($fNm)));
		$uPwd = trim(strip_tags(addslashes($uPwd)));
		$cPwd = trim(strip_tags(addslashes($cPwd)));
		$eAddr = trim(strip_tags(addslashes($eAddr)));
		$status = trim(strip_tags(addslashes($status)));
		$role = trim(strip_tags(addslashes($role)));
		$userNmChk = 0;
		$userEmChk = 0;

		if(!empty($uNm) && !empty($fNm) && !empty($uPwd) && !empty($cPwd) && !empty($eAddr)){
			if(preg_match("/^[a-zA-Z0-9]*$/",$uNm)){
				if(preg_match("/^[a-zA-Z ]*$/",$fNm)){
					if(strlen($uPwd) >= 8){
						if($uPwd === $cPwd){
							if(filter_var($eAddr,FILTER_VALIDATE_EMAIL)){
								if($status != ""){
									if($role != ""){
										$data = $this->model->fetchAll('user');
										while ($row=$data->fetch_assoc()) {
											$userNm = $row['userName'];
											$userEmail = $row['userEmail'];

											// Check if Username is already in DB
											if($userNm == $uNm){
												$userNmChk = 1;
											}

											// Check if Email Addess is already in DB
											if($userEmail == $eAddr){
												$userEmChk = 1;
											}
										}

										if($userNmChk != 1){
											if($userEmChk != 1){
												$uPwd = hash('sha256', $uPwd);
												$varArr = array(
													'userName' => $uNm,
													'userPass' => $uPwd,
													'userEmail' => $eAddr,
													'name' => $fNm,
													'status' => $status,
													'role' => $role
												);

												// Send FORM Data to Database
												$nUser = $this->model->insert('user',$varArr);
												if($nUser == 1){
													$this->messages[] = "<div class='success-msg'>Record is Inserted Successfully.</div>";
													//header("refresh:5; url=index?page=viewUser");
													header("refresh:7; url=index?page=nUser");
												}else{
													$this->messages[] = "<div class='message'>Record Can't Entered.</div>";
												}

											}else{
												$this->messages[] = "<div class='message'>Email <strong>".$eAddr."</strong> is already taken.</div>";
											}
										}else{
											$this->messages[] = "<div class='message'>Username <strong>".$uNm."</strong> is already taken.</div>";
										}

									}else{
										$this->messages[] = "<div class='message'>Select a valid User role</div>";
									}
								}else{
									$this->messages[] = "<div class='message'>Select a valid Status of User</div>"; 
								}								
							}else{
								$this->messages[] = "<div class='message'>Invalid e-mail Address.</div>";
							}
						}else{
							$this->messages[] = "<div class='message'>Password does'nt match with Confirm Password.</div>";
						}
					}else{
						$this->messages[] = "<div class='message'>Password at least 8 character.</div>";
					}
				}else{
					$this->messages[] = "<div class='message'>Full Name must be Alphabetical.</div>";
				}
			}else{
				$this->messages[] = "<div class='message'>User Name should contain Alpha Numeric Characters.</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>All Fields are required.</div>";
		}

		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Viewing Total records by Admin
	public function viewUsersC(){
		$viewUsers = $this->model->fetchall('user',' ORDER BY userName ASC');
		if($viewUsers->num_rows > 0){
			while($row=$viewUsers->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}else{
			$this->messages[] = "<div class='message'>No Records are available.</div>";
		}

		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Changing status( Active / Inactive) of User by Admin
	public function chgStat($sid,$status){
		$stat = array(
			'status' => $status
		);
		$chgStat = $this->model->update('user',$stat,' id='.$sid);
		if($chgStat == 1){
			//echo "<div class='success-msg'>Status is changed successfully.<br />Wait.....</div>";
			//header("refresh:5; url=index?page=viewUser");
			header("location: index?page=viewUser");
		}else{
			$this->messages[] = "<div class='message'>Status could'nt be changed.<br />Wait.....</div>";
		}

		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Grabbing Details of User / Representative
	public function repDet($id){
		$repDet = $this->model->fetchSingle('user',' id='.$id);
		if($repDet->num_rows > 0){
			while($row = $repDet->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Update User / Representative
	public function updUser($id,$updUn,$updEm,$updFn,$updRole){
		$updUn = $this->protect($updUn);
		$updEm = $this->protect($updEm);
		$updFn = $this->protect($updFn);
		$updRole = $this->protect($updRole);

		if($updUn != ""){
			if($updEm != ""){
				if($updFn != ""){
					$varArr = array(
						'userName' => $updUn,
						'userEmail' => $updEm,
						'name' => $updFn,
						'role' => $updRole
					);
					$updUser = $this->model->update('user',$varArr,' id='.$id);
					if($updUser == 1){
						$this->messages[] = "<div class='success-msg'>Representative is updated successfully.</div>";
						header("refresh:7;url=index?page=viewUser");
					}else{
						$this->messages[] = "<div class='message'>Representative can't be updated.</div>";		
					}
				}else{
					$this->messages[] = "<div class='message'>Email can't be empty.</div>";		
				}
			}else{
				$this->messages[] = "<div class='message'>Email can't be empty.</div>";			
			}
		}else{
			$this->messages[] = "<div class='message'>User name can't be empty.</div>";
		}

		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}

	}

	// Inserting New RTO
	public function rto($rtoNm){
		$rtoNm = trim(strip_tags(addslashes($rtoNm)));
		if(!empty($rtoNm)){
			$datas = $this->model->fetchSingle('rto',' rtoName='."'".$rtoNm."'");
			if($datas->num_rows <= 0){
				$varArr = array(
					'rtoName' => $rtoNm
				);
				$insRto = $this->model->insert('rto',$varArr);
				if($insRto == 1){
					echo "<div class='success-msg'>RTO <b>$rtoNm</b> is inserted successfully.</div>";
				}else{
					$this->messages[] = "<div class='message'>RTO <b>$rtoNm</b> could'nt be inserted.</div>";
				}
			}else{
				$this->messages[] = "<div class='message'>RTO <b>$rtoNm</b> is already exist.</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Fill RTO name.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// View Total RTOs
	public function viewRtos(){
		$vRtos = $this->model->fetchAll('rto',' ORDER BY rtoName ASC');
		if($vRtos->num_rows > 0){
			while($row=$vRtos->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Updating RTOs
	public function updRtos($id,$rtoNm){
		$rtoNm = $this->protect($rtoNm);
		if($rtoNm != ""){
			$varArr = array(
				'rtoName' => $rtoNm
			);
			$updCtNm = $this->model->update('rto',$varArr,' id='.$id);
			if($updCtNm == 1){
				$this->messages[] = "<div class='success-msg'>RTO Name updated Successfully.</div>";
				header('refresh:7;url=index?page=rto');
			}else{
				$this->messages[] = "<div class='message'>RTO Name can't be updated Successfully.</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>RTO Name can't be empty.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Inserting Tax Office Unit
	public function ctou($touNm){
		$touNm = trim(strip_tags(addslashes($touNm)));
		if(!empty($touNm)){
			if(strlen($touNm) > 3){
				$datas = $this->model->fetchSingle('taxoffice',' taxOffName = '."'".$touNm."'");
				if($datas->num_rows <= 0){

					$varArr = array(
						'taxOffName' => $touNm
					);
					$ctouIns = $this->model->insert('taxoffice',$varArr);

					if($ctouIns == 1){
						echo "<div class='success-msg'>Tax Off. Unit <b>$touNm</b> is inserted successfully.</div>";
					}else{
						$this->messages[] = "<div class='message'>Tax Office Unit $touNm could'nt be inserted.</div>";
					}
	
				}else{
					$this->messages[] = "<div class='message'>Tax Office Unit $touNm is already exist.</div>";
				}


			}else{
				$this->messages[] = "<div class='message'>Tax Unit Office Name is too short</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Fill Tax Unit Office Name.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// View Total Tax Office Units
	public function viewCtous(){
		$vRtos = $this->model->fetchAll('taxoffice',' ORDER By taxOffName ASC');
		if($vRtos->num_rows > 0){
			while($row=$vRtos->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}		
	}

	// Updating Tax Office Unit
	public function updCtous($id,$touNm){
		$touNm = $this->protect($touNm);
		if($touNm != ""){
			$varArr = array(
				'taxOffName' => $touNm
			);
			$updCtNm = $this->model->update('taxoffice',$varArr,' id='.$id);
			if($updCtNm == 1){
				$this->messages[] = "<div class='success-msg'>Tax Office Name updated Successfully.</div>";
				header('refresh:7;url=index?page=ctou');
			}else{
				$this->messages[] = "<div class='message'>Tax Office Name can't be updated Successfully.</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Tax Office name can't be empty.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Inserting Branch office
	public function bo($boNm){
		$boNm = trim(strip_tags(addslashes($boNm)));
		if(!empty($boNm)){
			if(strlen($boNm) > 3){
				$datas = $this->model->fetchSingle('broff',' brOffNm = '."'".$boNm."'");
				if($datas->num_rows <= 0){

					$varArr = array(
						'brOffNm' => $boNm
					);

					$brOffIns = $this->model->insert('broff',$varArr);
					if($brOffIns == 1){
						echo "<div class='success-msg'>Tax Off. Unit <b>$boNm</b> is inserted successfully.</div>";
					}else{
						$this->messages[] = "<div class='message'>Branch Office <b>$boNm</b> could'nt be inserted.</div>";
					}

				}else{
					$this->messages[] = "<div class='message'>Branch Office <b>$boNm</b> is already exist.</div>";
				}
			}else{
				$this->messages[] = " <div class='message'>Branch Office Name is too short</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Fill Branch Office Name.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// View Total Branch Offices
	public function viewBrOff(){
		$vBrOff = $this->model->fetchAll('broff',' ORDER BY brOffNm ASC');
		if($vBrOff->num_rows > 0){
			while($row=$vBrOff->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}		
	}

	// Updating Branch office
	public function updBrOff($id,$boNm){
		$boNm = $this->protect($boNm);
		if($boNm != ""){
			$varArr = array(
				'brOffNm' => $boNm
			);
			$updCtNm = $this->model->update('broff',$varArr,' id='.$id);
			if($updCtNm == 1){
				$this->messages[] = "<div class='success-msg'>Branch Office Name updated Successfully.</div>";
				header('refresh:7;url=index?page=bo');
			}else{
				$this->messages[] = "<div class='message'>Branch Office Name can't be updated Successfully.</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Branch Office name can't be empty.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Inserting City
	public function nCity($ctNm){
		$ctNm = trim(strip_tags(addslashes($ctNm)));
		if(!empty($ctNm)){
			if(strlen($ctNm) > 3){
				$datas = $this->model->fetchSingle('city',' cityNm = '."'".$ctNm."'");
				if($datas->num_rows <= 0){

					$varArr = array(
						'cityNm' => $ctNm
					);

					$cityIns = $this->model->insert('city',$varArr);
					if($cityIns == 1){
						echo "<div class='success-msg'>City Name <b>$ctNm</b> is inserted successfully.</div>";
					}else{
						$this->messages[] = "<div class='message'>City Name <b>$ctNm</b> could'nt be inserted.</div>";
					}

				}else{
					$this->messages[] = "<div class='message'>City Name <b>$ctNm</b> is already exist.</div>";
				}
			}else{
				$this->messages[] = "<div class='message'>City Name is too short</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Fill City Name.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// View Total Cities
	public function viewCity(){
		$vCity = $this->model->fetchAll('city',' ORDER BY cityNm ASC');
		if($vCity->num_rows > 0){
			while($row=$vCity->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}		
	}

	// Updating City
	public function updCity($id,$ctNm){
		$ctNm = $this->protect($ctNm);
		if($ctNm != ""){
			$varArr = array(
				'cityNm' => $ctNm
			);
			$updCtNm = $this->model->update('city',$varArr,' id='.$id);
			if($updCtNm == 1){
				$this->messages[] = "<div class='success-msg'>City Name updated Successfully.</div>";
				header('refresh:7;url=index?page=nCity');
			}else{
				$this->messages[] = "<div class='message'>City Name can't be updated Successfully.</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>City name can't be empty.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Inserting New Fees Type
	public function feeTp($feeTp){
		$feeTp = $this->protect($feeTp);
		if(!empty($feeTp)){
			if(strlen($feeTp) > 3){
				$datas = $this->model->fetchSingle('feetp',' feeTp = '."'".$feeTp."'");
				if($datas->num_rows <= 0){

					$varArr = array(
						'feetp' => $feeTp
					);

					$feeTpIns = $this->model->insert('feetp',$varArr);
					if($feeTpIns == 1){
						echo "<div class='success-msg'>Fees Type <b>$feeTp</b> is inserted successfully.</div>";
					}else{
						$this->messages[] = "<div class='message'>Fees Type <b>$feeTp</b> could'nt be inserted.</div>";
					}

				}else{
					$this->messages[] = "<div class='message'>Fees Type <b>$feeTp</b> is already exist.</div>";
				}
			}else{
				$this->messages[] = "<div class='message'>Fees Type is too short</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Fill Fees Type.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}		
	}

	// View Total Fees Type
	public function viewFeeTp(){
		$vFeeTp = $this->model->fetchAll('feetp',' ORDER BY feetp ASC');
		if($vFeeTp->num_rows > 0){
			while($row=$vFeeTp->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}		
	}

	// Updating Fees Type
	public function updFeeTp($id,$fTpNm){
		$fTpNm = $this->protect($fTpNm);
		if($fTpNm != ""){
			$varArr = array(
				'feeTp' => $fTpNm
			);
			$updCtNm = $this->model->update('feeTp',$varArr,' id='.$id);
			if($updCtNm == 1){
				$this->messages[] = "<div class='success-msg'>Fees Type updated Successfully.</div>";
				header('refresh:7;url=index?page=feeType');
			}else{
				$this->messages[] = "<div class='message'>Fees Type can't be updated Successfully.</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Fees Type can't be empty.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Inserting Client Status
	public function cStatus($cStatus){
		$cStatus = trim(strip_tags(addslashes($cStatus)));
		if(!empty($cStatus)){
			if(strlen($cStatus) > 1){
				$datas = $this->model->fetchSingle('status',' statNm = '."'".$cStatus."'");
				if($datas->num_rows <= 0){

					$varArr = array(
						'statNm' => $cStatus
					);

					$cStatIns = $this->model->insert('status',$varArr);
					if($cStatIns == 1){
						echo "<div class='success-msg'>Status <b>$cStatus</b> is inserted successfully.</div>";
					}else{
						$this->messages[] = "<div class='message'>Status <b>$cStatus</b> could'nt be inserted.</div>";
					}

				}else{
					$this->messages[] = "<div class='message'>Status <b>$cStatus</b> is already exist.</div>";
				}
			}else{
				$this->messages[] = "<div class='message'>Status Name is too short</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Fill Status Name.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	//View Client Status
	public function viewStatus(){
		$vStatus = $this->model->fetchAll('status',' ORDER BY statNm ASC');
		if($vStatus->num_rows > 0){
			while($row=$vStatus->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}		
	}

	// Updating Status
	public function updStatus($id,$statNm){
		$statNm = $this->protect($statNm);
		if($statNm != ""){
			$varArr = array(
				'statNm' => $statNm
			);
			$updCtNm = $this->model->update('status',$varArr,' id='.$id);
			if($updCtNm == 1){
				$this->messages[] = "<div class='success-msg'>Status updated Successfully.</div>";
				header('refresh:7;url=index?page=clStat');
			}else{
				$this->messages[] = "<div class='message'>Status can't be updated Successfully.</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Status can't be empty.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Inserting Business Category
	public function busCat($busCat){
		$busCat = trim(strip_tags(addslashes($busCat)));
		if(!empty($busCat)){
			if(strlen($busCat) > 3){
				$datas = $this->model->fetchSingle('buscat',' busCatNm = '."'".$busCat."'");
				if($datas->num_rows <= 0){

					$varArr = array(
						'busCatNm' => $busCat
					);

					$busCatIns = $this->model->insert('buscat',$varArr);
					if($busCatIns == 1){
						echo "<div class='success-msg'>Business Category <b>$busCat</b> is inserted successfully.</div>";
					}else{
						$this->messages[] = "<div class='message'>Business Category <b>$busCat</b> could'nt be inserted.</div>";
					}

				}else{
					$this->messages[] = "<div class='message'>Business Category <b>$busCat</b> is already exist.</div>";
				}
			}else{
				$this->messages[] = "<div class='message'>Business Category Name is too short</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Fill Business Category Name.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	//View Business Category
	public function viewBussCat(){
		$vBusCat = $this->model->fetchAll('buscat',' ORDER BY busCatNm ASC');
		if($vBusCat->num_rows > 0){
			while($row=$vBusCat->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}		
	}

	// Updating Bussiness Cateory
	public function updBussCat($id,$busCtNm){
		$busCtNm = $this->protect($busCtNm);
		if($busCtNm != ""){
			$varArr = array(
				'busCatNm' => $busCtNm
			);
			$updCtNm = $this->model->update('buscat',$varArr,' id='.$id);
			if($updCtNm == 1){
				$this->messages[] = "<div class='success-msg'>Business Category Name updated Successfully.</div>";
				header('refresh:7;url=index?page=bussCat');
			}else{
				$this->messages[] = "<div class='message'>Business Category Name can't be updated Successfully.</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Business Category name can't be empty.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Inserting Link Account
	public function lnkAcc($lnkNm){
		$lnkNm = trim(strip_tags(addslashes($lnkNm)));
		if(!empty($lnkNm)){
			if(strlen($lnkNm) > 3){
				$datas = $this->model->fetchSingle('linkacc',' linkNm = '."'".$lnkNm."'");
				if($datas->num_rows <= 0){

					$varArr = array(
						'linkNm' => $lnkNm
					);

					$lnkAccIns = $this->model->insert('linkacc',$varArr);
					if($lnkAccIns == 1){
						echo "<div class='success-msg'>Link Account <b>$lnkNm</b> is inserted successfully.</div>";
					}else{
						$this->messages[] = "<div class='message'>Link Account <b>$lnkNm</b> could'nt be inserted.</div>";
					}

				}else{
					$this->messages[] = "<div class='message'>Link Account <b>$lnkNm</b> is already exist.</div>";
				}
			}else{
				$this->messages[] = "<div class='message'>Link Account Name is too short</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Fill Link Account Name.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// View Linked Accounts
	public function viewLnkAcc(){
		$vLnkAcc = $this->model->fetchAll('linkacc',' ORDER BY linkNm ASC');
		if($vLnkAcc->num_rows > 0){
			while($row=$vLnkAcc->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}		
	}

	// Updating Link Account
	public function updLnkAcc($id,$lnkNm){
		$lnkNm = $this->protect($lnkNm);
		if($lnkNm != ""){
			$varArr = array(
				'linkNm' => $lnkNm
			);
			$updCtNm = $this->model->update('linkacc',$varArr,' id='.$id);
			if($updCtNm == 1){
				$this->messages[] = "<div class='success-msg'>Link Account updated Successfully.</div>";
				header('refresh:7;url=index?page=lnkAcc');
			}else{
				$this->messages[] = "<div class='message'>Link Account can't be updated Successfully.</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Link Account can't be empty.</div>";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}


/*
	Client Form Data for Drop Downs
*/

	// Grabing Data for Clint's Status Drop Down
	public function clStatD(){
		$datas = $this->model->fetchAll('status',' ORDER BY statNm ASC');
		if($datas->num_rows > 0){
			while ($row=$datas->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Grabing Data for Clint's City Drop Down
	public function clCityD(){
		$datas = $this->model->fetchAll('city',' ORDER BY cityNm ASC');
		if($datas->num_rows > 0){
			while ($row=$datas->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Grabing Data for Clint's Account's Nature Hidden Drop Down
	public function hidAccNat(){
		$hidAccNatDt = $this->model->fetchSingle('subhead',' subHeadNm = "Accounts Receivable"');
		if($hidAccNatDt->num_rows > 0){
			while($row=$hidAccNatDt->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Grabing Data for Clint's Tax Office Unit Drop Down
	public function clTouD(){
		$datas = $this->model->fetchAll('taxoffice',' ORDER BY taxOffName ASC');
		if($datas->num_rows > 0){
			while ($row=$datas->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Grabing Data for Clint's Branch Office Drop Down
	public function clBrOffD(){
		$datas = $this->model->fetchAll('broff',' ORDER BY brOffNm ASC');
		if($datas->num_rows > 0){
			while ($row=$datas->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Grabing Data for Clint's RTO Drop Down
	public function clRtoD(){
		$datas = $this->model->fetchAll('rto',' ORDER BY rtoName ASC');
		if($datas->num_rows > 0){
			while ($row=$datas->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Grabing Data for Clint's Business Category Drop Down
	public function clBusCatD(){
		$datas = $this->model->fetchAll('buscat',' ORDER BY busCatNm ASC');
		if($datas->num_rows > 0){
			while ($row=$datas->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Grabing Data for Clint's Linked Account Drop Down
	public function clLnkAccD(){
		$datas = $this->model->fetchAll('linkacc',' ORDER BY linkNm ASC');
		if($datas->num_rows > 0){
			while ($row=$datas->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Insert New Client
	// NOTE : trim,strip_tags,addslashes and real_escape_string functions are not used on Drop Downs Data and Dates
	public function nClient($busStatus,$cName,$cnicNo,$cCity,$bussName,$accNatDet){		
			if($busStatus != ""){
				// Extracting Business Status Array
				$CbusStatArr = explode("|", $busStatus);
				$CbusCatId = $CbusStatArr[0];
				$CbusCatNm = $CbusStatArr[1];

				// Extracting SESSION variable for DB
				$repDet = explode("_",$_SESSION['representative']);
				$repId = $repDet[0];
				$repNm = $repDet[1];

				if($cName != ""){
					if(preg_match("/^[a-zA-Z ]*$/", $cName)){
						$cName = $this->protect($cName);
						//if(preg_match("/^[0-9]*$/", $cnicNo)){
						if(is_numeric($cnicNo) && strlen($cnicNo) == 13){
							if($cCity != ""){

								// Extracting City Array
								$cCityArr = explode("|", $cCity);
								$cCityId = $cCityArr[0];
								$cCityNm = $cCityArr[1];

								if($bussName != ""){
									$bussName = $this->protect($bussName);

									// Extracting Hidden Account Nature Details
									$accNatDetArr = explode('|', $accNatDet);

									$headId = $accNatDetArr[0];
									$headNm = $accNatDetArr[1];
									$sHdId = $accNatDetArr[2];
									$sHdNm = $accNatDetArr[3];
									// Creating array for variables for sending in Database
									$varArr = array(
									'busStatId' => $CbusCatId,
									'busStatNm' => $CbusCatNm,
									'clientNm' => $cName,
									'hdId' => $headId,
									'headNm' => $headNm,
									'sHdId' => $sHdId,
									'sHdNm' => $sHdNm,
									'cnicNo' => $cnicNo,
									'cityId' => $cCityId,
									'cityNm' => $cCityNm,
									'busNm' => $bussName,
									'registerarId' => $repId,
									'registerarNm' => $repNm,
									'status' => 'active'

									); 
									$nClientIns = $this->model->insert('client',$varArr);
									if($nClientIns == 1){
										echo "<div class='success-msg'>Record is inserted Successfully.</div>";
										header("refresh:3; url=index?page=nClient");	
									}else{
										$this->messages[] = "Record couldn't be inserted.";
									}
								}else{
									$this->messages[] = "Please fill Business Name.";
								}
							}else{
								$this->messages[] = "Please select a valid City Name";
							}
						}else{
							$this->messages[] = "Use Numeric 0-9 without dashes for CNIC and must be 13 digits.";
						}
					}else{
						$this->messages[] = "Please use Alphabet for Client Name";
					}
				}else{
					$this->messages[] = "Please Fill Client Name.";
				}
			}else{
				$this->messages[] = "Please select a valid Business category.";
			}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}

	// Grabing Existing Client Details for Updation
	public function clientDet($id){
		if($id != ''){
			if(is_numeric($id)){
				$id = $this->protect($id);
				$data = $this->model->fetchSingle('client',' id='.$id);
				if($data->num_rows > 0){
					while($row=$data->fetch_assoc()){
						$datas[] = $row;
					}
					return $datas;
				}else{
					$this->messages[] = "No records found for this ID ".$id;
				}
			}else{
				$this->messages[] = "ID must be numberic ".$id;
			}
		}else{
			$this->messages[] = "ID can't be empty.";
		}

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}

	// View Clients
	public function viewClints(){
		$vClint = $this->model->fetchAll('client',' ORDER BY clientNm ASC');
		if($vClint->num_rows > 0){
			while($row=$vClint->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}				
	}

	// View Clients for Search term
	// Search By Term like Client Name or CNIC
	// public function viewClientsST($searchBy,$clSearch){
	public function viewClientsST($clSearch){
		//if($searchBy != ""){
			$clSearch = $this->protect($clSearch);	
			//$vClint = $this->model->fetchSingle('client',' '.$searchBy.' LIKE "%'.$clSearch.'%" ORDER BY clientNm');
			$vClint = $this->model->fetchSingle('client',' clientNm LIKE "%'.$clSearch.'%" OR cnicNo LIKE "%'.$clSearch.'%" OR cityNm LIKE "%'.$clSearch.'%" ORDER BY clientNm');
		// public function viewClientsST($clSearch){
		// 	$vClint = $this->model->fetchSingle('client',' clientNm LIKE "%'.$clSearch.'%" ORDER BY id ASC');
			if($vClint->num_rows > 0){
				while($row=$vClint->fetch_assoc()){
					$data[] = $row;
				}
				return $data;
			}
		// }else{
		// 	$this->messages[] = "Select Search Term.";
		// }				

		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}

	// Updating Client Record
	public function clientUpd($eid,$busStatus,$CuID,$cName,$cAddr,$cnicNo,$cCity,$tou,$bussName,$ptclNo,$CellNo1,$rtoCno2,$bussAddr,$branchOff,$feeAppl,$classification,$rto,$bussCat,$fbrId,$pass,$pinC,$linked,$Cemail,$NTNno,$NTNfee,$NTNdor,$STRNno,$STRNfee,$STRNdor,$whtAg,$whtfee,$WHTdor,$SRBno,$SRBfee,$SRBdor,$BRBno,$BRBfee,$BRBdor,$PRBno,$PRBfee,$PRBdor){		
			if($busStatus != ""){
				// Extracting Business Status Array
				$CbusStatArr = explode("|", $busStatus);
				$CbusCatId = $CbusStatArr[0];
				$CbusCatNm = $CbusStatArr[1];

				// Extracting SESSION variable for DB
				$repDet = explode("_",$_SESSION['representative']);
				$repId = $repDet[0];
				$repNm = $repDet[1];

				//$CuID = trim(strip_tags(addslashes($this->model->conn->real_escape_string($CuID))));
				$CuID = $this->protect($CuID);
				if($cName != ""){
					if(preg_match("/^[a-zA-Z ]*$/", $cName)){
						$cAddr = $this->protect($cAddr);
						if(preg_match("/^['0-9']*$/", $cnicNo)){
							if($cCity != ""){
								// if(is_numeric($NTNfee) && is_numeric($STRNfee) && is_numeric($whtfee) && is_numeric($SRBfee) && is_numeric($BRBfee) && is_numeric($PRBfee)){
									// Extracting City Array
									$cCityArr = explode("|", $cCity);
									$cCityId = $cCityArr[0];
									$cCityNm = $cCityArr[1];
									if($bussName != ""){

										if(filter_var($Cemail,FILTER_VALIDATE_EMAIL) || empty($Cemail)){

											// Extracting Tax Office Unit Array
											if($tou != ""){
												$touArr = explode("|", $tou);
												$touId = $touArr[0];
												$touNm = $touArr[1];
											}else{
												$touId = 0;
												$touNm = '';
											}

											// Extracting Branch Office Array
											if($branchOff != ""){
												$brOffArr = explode("|", $branchOff);
												$brOffId = $brOffArr[0];
												$brOffNm = $brOffArr[1];
											}else{
												$brOffId = 0;
												$brOffNm = '';
											}

											// Extracting Fees Applied
											if($feeAppl != ""){
												$feeAppl = $feeAppl;
											}

											// Extracting ROT Array
											if($rto != ""){
												$rtoArr = explode("|", $rto);
												$rtoId = $rtoArr[0];
												$rtoNm = $rtoArr[1];
											}else{
												$rtoId = 0;
												$rtoNm = '';
											}

											// Extracting Business Category Array
											if($bussCat != ""){
												$busCatArr = explode("|", $bussCat);
												$busCatId = $busCatArr[0];
												$busCatNm = $busCatArr[1];
											}else{
												$busCatId = 0;
												$busCatNm = '';
											}

											// Extracting Linked Account Array
											if($linked != ""){
												$linkedArr = explode("|", $linked);
												$linkedId = $linkedArr[0];
												$linkedNm = $linkedArr[1];
											}else{
												$linkedId = 0;
												$linkedNm = '';
											}

											// Extracting With Holding Tax Agent
											if($whtAg != ""){
												$whtAg = $whtAg;
											}

											$bussName = $this->protect($bussName);
											$ptclNo = $this->protect($ptclNo);
											$CellNo1 = $this->protect($CellNo1);
											$rtoCno2 = $this->protect($rtoCno2);
											$bussAddr = $this->protect($bussAddr);
											$classification = $this->protect($classification);
											$fbrId = $this->protect($fbrId);
											$pass = $this->protect($pass);
											$pinC = $this->protect($pinC);
											$linked = $this->protect($linked);
											$Cemail = $this->protect($Cemail);
											// $remRes = trim(strip_tags(addslashes($this->model->conn->real_escape_string($remRes))));
											$NTNno = $this->protect($NTNno);
											$NTNfee = $this->protect($NTNfee);

											$STRNno = $this->protect($STRNno);
											$STRNfee = $this->protect($STRNfee);

											$whtAg = $this->protect($whtAg);
											$whtfee = $this->protect($whtfee);

											$SRBno = $this->protect($SRBno);
											$SRBfee = $this->protect($SRBfee);

											$BRBno = $this->protect($BRBno);
											$BRBfee = $this->protect($BRBfee);

											$PRBno = $this->protect($PRBno);
											$PRBfee = $this->protect($PRBfee);

											// Creating array for variables for sending in Database
											$varArr = array(
											'busStatId' => $CbusCatId,
											'busStatNm' => $CbusCatNm,
											'userId' => $CuID,
											'clientNm' => $cName,
											'clientAddr' => $cAddr,
											'cnicNo' => $cnicNo,
											'cityId' => $cCityId,
											'cityNm' => $cCityNm,
											'touId' => $touId,
											'touNm' => $touNm,
											'busNm' => $bussName,
											'ptclNo' => $ptclNo,
											'cellNo1' => $CellNo1,
											'cellNo2' => $rtoCno2,
											'busAddr' => $bussAddr,
											'boId' => $brOffId,
											'boNm' => $brOffNm,
											'feeAppl' => $feeAppl,
											'classification' => $classification,
											'rtoId' => $rtoId,
											'rtoNm' => $rtoNm,
											'busCatId' => $busCatId,
											'busCatNm' => $busCatNm,
											'fbrId' => $fbrId,
											'password' => $pass,
											'pinCd' => $pinC,
											'linkId' => $linkedId,
											'linkNm' => $linkedNm,
											'emId' => $Cemail,
											// 'remarks' => $remRes,
											'ntnNo' => $NTNno,
											'ntnFee' => $NTNfee,
											'ntnDt' => $NTNdor,
											'strnNo' => $STRNno,
											'strnFee' => $STRNfee,
											'strnDt' => $STRNdor,
											'whAgt' => $whtAg,
											'whtFee' => $whtfee,
											'whDt' => $WHTdor,
											'srbNo' => $SRBno,
											'SRBfee' => $SRBfee,
											'srbDt' => $SRBdor,
											'brbNo' => $BRBno,
											'brbFee' => $BRBfee,
											'brbDt' => $BRBdor,
											'prbNo' => $PRBno,
											'prbFee' => $PRBfee,
											'prbDt' => $PRBdor,
											'registerarId' => $repId,
											'registerarNm' => $repNm
											);
											$clientUpd = $this->model->update('client',$varArr,' id='.$eid);
											if($clientUpd == 1){
												echo "<div class='success-msg'>Record is updated Successfully.</div>";
												header("refresh:7;url=index?page=viewClient");
											}else{
												$this->messages[] = "Record couldn't be updated.";
											}
										}else{
											$this->messages[] = "Invalid e-mail <b>$Cemail</b>, please enter valid email address.";
										}
									}else{
										$this->messages[] = "Please fill Business Name.";
									}
								// }else{
								// 	$this->messages[] = "All Fees Must be in Numeric form.";
								// }

							}else{
								$this->messages[] = "Please select a valid City Name";
							}
						}else{
							$this->messages[] = "Use Numeric 0-9 without dashes for CNIC";
						}
					}else{
						$this->messages[] = "Please use Alphabet for Client Name";
					}
				}else{
					$this->messages[] = "Please Fill Client Name.";
				}
			}else{
				$this->messages[] = "Please select a valid Business category.";
			}

			//Checks if any Error exist.
			if(count($this->messages) > 0){
				foreach ($this->messages as $msg) {
					echo "<div class='message'>".$msg."</div>";
				}
			}
	}

	// Changing status( Active / Inactive) of Client by Admin
	public function chgClStat($sid,$status){
		$stat = array(
			'status' => $status
		);
		$chgStat = $this->model->update('client',$stat,' id='.$sid);
		if($chgStat == 1){
			//echo "<div class='success-msg'>Status is changed successfully.<br />Wait.....</div>";
			//header("refresh:5; url=index?page=viewUser");
			header("location: index?page=viewClient");
		}else{
			$this->messages[] = "Status could'nt be changed.<br />Wait.....";
		}

		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}

	// View CSingle Client Profile
	public function vSClient($id){
		$id = $this->protect($id);
		if(is_numeric($id)){
			$data = $this->model->fetchSingle('client',' id='.$id.' ORDER BY clientNm ASC');
			if($data->num_rows > 0){
				while($row=$data->fetch_assoc()){
					$datas[] = $row;
				}
				return $datas;
			}else{
				$this->messages[] = "No record found for this ID. ".$id;
			}
		}else{
			$this->messages[] = "ID isn't in numerical form.";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}


/*

ACCOUNTS RELATED AREA

*/
	// Viewing Header
	public function vHdAcc(){
		$vhAcc = $this->model->fetchall('headacc',' ORDER BY headNm ASC');
		if($vhAcc->num_rows > 0){
			while ($row=$vhAcc->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}else{
		$this->messages[] = "No Header Account is available.";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}

	// Inserting Sub Header
	public function nSubHead($hdArr,$subHead){
		if($hdArr != ""){
			$hdArr = explode("|", $hdArr);
			$hdId = $hdArr[0];
			$hdNm = $this->protect($hdArr[1]);
			$subHead = $this->protect($subHead);
			if($subHead != ""){
				$varArr = array(
					'subHeadNm' => $subHead,
					'hdId' => $hdId,
					'headNm' => $hdNm,
				);
				$insSubAcc = $this->model->insert('subhead',$varArr);
				if($insSubAcc == 1){
					echo "<div class='success-msg'>Sub Account inserted Successfully.</div>";
				}else{
					$this->messages[] = "Record can't be inserted.";
				}
			}else{
				$this->messages[] = "Sub Account can't be empty.";
			}
		}else{
			$this->messages[] = "Please select a valid Header Account.";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}


	// Viewing Sub Header
	public function vShdAcc(){
		$vShdAcc = $this->model->fetchall('subhead',' ORDER BY subHeadNm ASC');
		if($vShdAcc->num_rows > 0){
			while ($row=$vShdAcc->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}else{
		$this->messages[] = "No Sub Header Account is available.";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}

	// INSERT New Account by Admin
	public function nAccount($accNm,$subHd,$cityNm){
		if($subHd != ""){
			$subHdArr = explode("|",$subHd);
			$sHdId = $subHdArr[0];
			$sHdNm = $subHdArr[1];
			$hdId = $subHdArr[2];
			$hdNm = $subHdArr[3];
			$this->accNm = $this->protect($accNm);
			if($this->accNm != ""){
				if(preg_match("/^[a-zA-Z0-9 -]*$/", $this->accNm)){
					if($cityNm != ""){
						$cityArr = explode("|",$cityNm);
						$ctId = $cityArr[0];
						$ctNm = $cityArr[1];

						$varArr = array(
							'clientNm' => $accNm,
							'hdId' => $hdId,
							'headNm' => $hdNm,
							'sHdId' => $sHdId,
							'sHdNm' => $sHdNm,
							'cityId' => $ctId,
							'cityNm' => $ctNm
						);
						$insNAcc = $this->model->insert('client',$varArr);
						if($insNAcc == 1){
							echo "<div class='success-msg'>Account is inserted Successfully.</div>";
						}else{
							$this->messages[] = "Record could'nt be inserted.";
						}
					}else{
						$this->messages[] = "Please select a city.";
					}
				}else{
					$this->messages[] = "Only Alphabet is alowed.";
				}
			}else{
				$this->messages[] = "Account name can't be empty.";
			}
		}else{
			$this->messages[] = "Select a valid Sub Header.";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}


	// View Clients for GJ
	public function viewGjClients(){
		$vClint = $this->model->fetchAll('client',' WHERE status != "inactive" ORDER BY clientNm ASC');
		if($vClint->num_rows > 0){
			while($row=$vClint->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}				
	}

	// Previous / Current Balance of Representative
	public function prevBalRep(){
		$repDet = explode("_",$_SESSION['representative']);
		$repId = $repDet[0];
		$repNm = $repDet[1];

		$prevBalRep = $this->model->prevBal('ledger',' gjDt<"'.date('Y-m-d').'" AND retGj = "GJ" AND repId='.$repId);
		if($prevBalRep->num_rows > 0){
			while($row=$prevBalRep->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Adding General Journal entries in Database
	public function nGj($jdt,$clDet,$ft,$fYr,$desc,$dr,$cr,$repId,$repNm){
		$this->jdt = $this->protect($jdt);
		$this->fYr = $this->protect($fYr);
		$this->desc = $this->protect($desc);
		$this->dr = $this->protect($dr);
		$this->cr = $this->protect($cr);

		if($jdt != ""){
			if($clDet !=""){
				$clArr  = explode("|",$clDet);
				$clId = $clArr[0];
				$clNm = $clArr[1];
				$ctId = $clArr[2];
				$ctNm = $clArr[3];

				$hdId = $clArr[4];
				$hdNm = $clArr[5];
				$sHdId = $clArr[6];
				$sHdNm = $clArr[7];
				$busNm = $clArr[8];
				if($clId !='' && $clNm != '' && $ctId != '' && $ctNm != '' && $hdId != '' && $hdNm != '' && $sHdId != '' && $sHdNm != ''){
					if($ft != ""){
						$ftArr = explode('|', $ft);
						$ftId = $ftArr[0];
						$ftNm = $ftArr[1];

						if($fYr != ""){
							if($desc != ""){
								if($dr != "" || $cr != ""){
									$varArr = array(
										'gjDt' => $jdt,
										'clientId' => $clId,
										'clientNm' => $clNm,
										'cityId' => $ctId,
										'cityNm' => $ctNm,
										'hdId' => $hdId,
										'hdNm' => $hdNm,
										'sHdId' => $sHdId,
										'sHdNm' => $sHdNm,
										'busNm' => $busNm,
										'feeTpId' => $ftId,
										'feeTp' => $ftNm,
										'feeYr' => $fYr,
										'description' => $desc,
										'drAmt' => $dr,
										'crAmt' => $cr,
										'retGj' => 'GJ',
										'repId' => $repId,
										'repNm' => $repNm,
									);
									$insGj = $this->model->insert('ledger',$varArr);
									if($insGj == 1){
										echo "<div class='success-msg'>Record is inserted Successfully.</div>";
										header("refresh:7;url=index?page=ngj");							
									}else{
										$this->messages[] = "<div class='message'>Record could'nt be entered</div>";
									}
								}else{
									$this->messages[] = "<div class='message'>Please add Amount in Debit or Credit</div>";
								}
							}else{
								$this->messages[] = "<div class='message'>Please fill Description.</div>";
							}
						}else{
							$this->messages[] = "<div class='message'>Please add a year for Fees</div>";
						}
					}else{
						$this->messages[] = "<div class='message'>Please select a Fees Type</div>";
					}
				}else{
						$this->messages[] = "<div class='message'>Something went wrong while selecting Account.</div>";

				}
			}else{
				$this->messages[] = "<div class='message'>Please select an Account</div>";
			}
		}else{
			$this->messages[] = "<div class='message'>Please select a valid Date.</div>";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// View General Journal Entries
	public function vGjEnt(){
		$repDet = explode("_",$_SESSION['representative']);
		$repId = $repDet[0];
		$repNm = $repDet[1];

		$vGjData = $this->model->fetchSingle('ledger',' gjDt = "'.date('Y-m-d').'" AND retGj = "GJ" AND repId='.$repId." ORDER BY id DESC");

		if($vGjData->num_rows > 0){
			while($row=$vGjData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}

		// else{
		// 	$this->messages[] = "No Record found for Current Date and Representative";
		// }

		// Checks if any Error exist.
		// if(count($this->messages) > 0){
		// 	foreach ($this->messages as $msg) {
		// 		echo "<div class='message'>".$msg."</div>";
		// 	}
		// }
	}

	// Calculating Total for New General Journal Dr & Cr Entries
	public function totDrCrgj(){
		$repDet = explode("_",$_SESSION['representative']);
		$repId = $repDet[0];
		$repNm = $repDet[1];

		$vGjData = $this->model->totDrCr('ledger',' gjDt = "'.date('Y-m-d').'" AND retGj = "GJ" AND  repId='.$repId);
		if($vGjData->num_rows > 0){
			while($row=$vGjData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}else{
			$this->messages[] = "No Record found.";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}

	// Grabbing Data for Updating GJ Entries
	public function modiGjEnt($gjEid){
		$gjEid = $this->protect($gjEid);
		$gjEidData = $this->model->fetchSingle('ledger',' id='.$gjEid);
		if($gjEidData->num_rows > 0){
			while($row=$gjEidData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	//
	public function gjEntUpd($gjEid,$gjdt,$accDet,$ft,$fy,$desc,$dr,$cr){
		$gjdt = $this->protect($gjdt);
		$fy = $this->protect($fy);
		$desc = $this->protect($desc);
		$dr = $this->protect($dr);
		$cr = $this->protect($cr);
		if($gjdt != ""){
			if($accDet != ""){
				$accDerArr = explode("|",$accDet);
				$id = $accDerArr[0];
				$clNm = $accDerArr[1];
				$ctId = $accDerArr[2];
				$ctNm = $accDerArr[3];
				if($ft != ""){
					$ftArr = explode('|', $ft);
					$ftId = $ftArr[0];
					$ftNm = $ftArr[1];
					if($fy != ""){
						if($desc != ""){
							if($dr != 0 || $cr != 0){
								if(is_numeric($dr) || is_numeric($cr)){
									$varArr = array(
										'gjDt' => $gjdt,
										'clientId' => $id,
										'clientNm' => $clNm,
										'cityId' => $ctId,
										'cityNm' => $ctNm,
										'feeTpId' => $ftId,
										'feeTp' => $ftNm,
										'feeYr' => $fy,
										'description' => $desc,
										'drAmt' => $dr,
										'crAmt' => $cr
									);
									$updGjEnt = $this->model->update('ledger',$varArr,' id='.$gjEid);
									if($updGjEnt == 1){
										header("refresh:0;url=index?page=ngj");
									}else{
										$this->messages[] = "Record Can't be updated.";
										header("refresh:3;url=index?page=ngj");
									}
								}else{
									$this->messages[] = "Debit or Credit Amount must be Numeric.";
								}
							}else{
								$this->messages[] = "Please fill Debit or Credit Amount.";
							}
						}else{
							$this->messages[] = "Please fill Description.";
						}
					}else{
						$this->messages[] = "Please Fill Fees Year.";
					}
				}else{
					$this->messages[] = "Please select a Fees Type.";
				}
			}else{
				$this->messages[] = "Please an Account.";
			}
		}else{
			$this->messages[] = "Date Can't be epmty.";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}

	// View Date wise General Journal
	public function vGjEntDt(){
		$vGjEntDt = $this->model->distinct('gjDt','ledger');
		if($vGjEntDt->num_rows > 0){
			while($row=$vGjEntDt->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Calculating Total for New General Journal Dr & Cr Entries
	public function totDrCrgjDt($dt){
		$repDet = explode("_",$_SESSION['representative']);
		$repId = $repDet[0];
		$repNm = $repDet[1];

		$vGjData = $this->model->totDrCr('ledger',' gjDt = "'.$dt.'" AND retGj = "GJ"');
		if($vGjData->num_rows > 0){
			while($row=$vGjData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Calculating Total for New Return Tracker Dr Entries
	public function totDrCrRTDt($dt){
		$repDet = explode("_",$_SESSION['representative']);
		$repId = $repDet[0];
		$repNm = $repDet[1];

		$vGjData = $this->model->totDrCr('ledger',' gjDt = "'.$dt.'" AND retGj = "retTrk"');
		if($vGjData->num_rows > 0){
			while($row=$vGjData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Data For Dropdown Box for viewing Single Account Detail vgj.php
	public function vSAcc(){
		$repDet = explode("_",$_SESSION['representative']);
		$repId = $repDet[0];
		$repNm = $repDet[1];
		$vSAccData = $this->model->fetchAll('client','ORDER BY clientNm ASC');
		if($vSAccData->num_rows > 0){
			while($row=$vSAccData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
		// else{
		// 	$this->messages[] = "No Record found for Current Date and Representative";
		// }

		// // Checks if any Error exist.
		// if(count($this->messages) > 0){
		// 	foreach ($this->messages as $msg) {
		// 		echo "<div class='message'>".$msg."</div>";
		// 	}
		// }
	}

	// View Date Wise General Journal 
	public function vgjDet($dt){
		$vgjData = $this->model->fetchSingle('ledger',' gjDt="'.$dt.'" AND retGj = "GJ"');
		if($vgjData->num_rows > 0){
			while($row=$vgjData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// View Date Wise Return Tracker 
	public function vRetTrkDet($dt){
		$vgjData = $this->model->fetchSingle('ledger',' gjDt="'.$dt.'" AND retGj = "RetTrk"');
		if($vgjData->num_rows > 0){
			while($row=$vgjData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Fetching Client / Account details
	public function sAccData($id,$fd,$td){
		$repDet = explode("_",$_SESSION['representative']);
		$repId = $repDet[0];
		$repNm = $repDet[1];

		if($fd != "" && $td != ""){
			$accSData = $this->model->fetchSingle('ledger',' clientId='.$id.' AND gjDt>="'.$fd.'" AND gjDt<="'.$td.'"');
			//$accSData = $this->model->fetchSingle('gj',' clientId='.$id.' AND gjDt>="'.$fd.'" AND gjDt<="'.$td.'" AND repId='.$repId);

				//$data = $this->model->fetchSingle('client',' id='.$id);
			if($accSData->num_rows > 0){
				while($row=$accSData->fetch_assoc()){
					$data[] = $row;
				}
				return $data;
			}
			// else{
			// 	//$this->messages[] = "No record found for this Account.";
			// }
		}else{
			$this->messages[] = "Please select From Date To Date.";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}

	// Calculating Previous Balance
	public function accPrevBal($id,$fd){
		$accPrvBal = $this->model->prevBal('ledger',' clientId='.$id.' AND gjDt<"'.$fd.'"');
		if($accPrvBal->num_rows > 0){
			while($row=$accPrvBal->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Calculating Total Dr, Total Cr and Final Balance
	public function DrCrTbal($id,$fd,$td){
		$DrCrBalData = $this->model->totDrCr('ledger',' clientId='.$id.' AND gjDt>="'.$fd.'" AND gjDt<="'.$td.'"');
		if($DrCrBalData->num_rows > 0){
			while($row=$DrCrBalData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Grabbing Return Type for Return Tracker Drop Down
	public function retTpData(){
		$retTpData = $this->model->fetchall('feetp');
		if($retTpData->num_rows > 0){
			while($row=$retTpData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Grabbing Return Type for Return Tracker Drop Down in nRetTrk.php & retTpDet.php
	public function clDetData($retTpId){
		//$retTpDet = $this->model->fetchAll('client');
		if($retTpId == 'IncomeTax'){
			$retTpDet = $this->model->fetchSingle('client',' ntnFee !=0 AND status !="inactive"');
		}
		elseif($retTpId == 'SalesTax'){
			$retTpDet = $this->model->fetchSingle('client',' strnFee !=0 AND status !="inactive"');
		}
		elseif($retTpId == 'WHTax'){
			$retTpDet = $this->model->fetchSingle('client',' whtFee !=0 AND status !="inactive"');
		}
		elseif($retTpId == 'SRB'){
			$retTpDet = $this->model->fetchSingle('client',' srbFee !=0 AND status !="inactive"');
		}
		elseif($retTpId == 'BRB'){
			$retTpDet = $this->model->fetchSingle('client',' brbFee !=0 AND status !="inactive"');
		}
		elseif($retTpId == 'PRB'){
			$retTpDet = $this->model->fetchSingle('client',' prbFee !=0 AND status !="inactive"');
		}
		if($retTpDet->num_rows > 0){
			while($row=$retTpDet->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Insert Return Tracker
	public function nRetTrk($retTDt,$retTp,$txYr,$clDet,$barCd,$subDt,$payFee,$rem){
		
		$repDet = explode("_",$_SESSION['representative']);
		$repId = $repDet[0];
		$repNm = $repDet[1];

		$retTDt = $this->protect($retTDt);
		$txYr = $this->protect($txYr);
		$barCd = $this->protect($barCd);
		$subDt = $this->protect($subDt);
		$payFee = $this->protect($payFee);
		$rem = $this->protect($rem);

		// Extracting ID and Return Type from $retTp
		$retTpArr = explode('|', $retTp);
		$retTpId = $retTpArr[0];
		$retTpNm = $retTpArr[1];

		// Extracting Client Detail from $clDet
		$clDetArr = explode('|', $clDet);
		$clId = $clDetArr[0];
		$clNm = $clDetArr[1];
		$ctId = $clDetArr[2];
		$ctNm = $clDetArr[3];
		$busNm = $clDetArr[4];
		$hdId = $clDetArr[5];
		$hdNm = $clDetArr[6];
		$sHdId = $clDetArr[7];
		$sHdNm = $clDetArr[8];

		$varArr = array(
			'gjDt' => $retTDt,
			'clientId' => $clId,
			'clientNm' => $clNm,
			'cityId' => $ctId,
			'cityNm' => $ctNm,
			'hdId' => $hdId,
			'hdNm' => $hdNm,
			'sHdId' => $sHdId,
			'sHdNm' => $sHdNm,
			'busNm' => $busNm,
			'barCd' => $barCd,
			'subDt' => $subDt,
			'feeTpId' => $retTpId,
			'feeTp' => $retTpNm,
			'feeYr' => $txYr,
			'description' => $rem,
			'drAmt' => $payFee,
			'retGj' => 'RetTrk',
			'repId' => $repId,
			'repNm' => $repNm
		);
		$retTrkIns = $this->model->insert('ledger',$varArr);
		if($retTrkIns == 1){
			$this->messages[] = "<div class='success-msg'>Record is inserted Successfully.</div>";
			//header("refresh:0;url=index?page=nRetTrk");
		}else{
			$this->messages[] = "<div class='message'>Record can't be entered.</div>";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}
	}

	// Grabbing Data for Updating Retrun Tracker Entries
	public function modirTrkEnt($rTrkEid){
		$rTrkEid = $this->protect($rTrkEid);
		$rTrkEidData = $this->model->fetchSingle('ledger',' id='.$rTrkEid);
		if($rTrkEidData->num_rows > 0){
			while($row=$rTrkEidData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function viewRetTrk(){
		$vRetTrk = $this->model->fetchSingle('ledger',' retGj = "retTrk"');
		if($vRetTrk->num_rows > 0){
			while($row=$vRetTrk->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}


	// Grabbing Return Tracker's Data for Updating Return Tracker Record
	public function retTpPrvData($id){
		$retTpData = $this->model->fetchSingle('ledger',' id='.$id);
		if($retTpData->num_rows > 0){
			while($row=$retTpData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Updating Return Tracker
	public function retTrkUpd($id,$retTDtUp,$retTpClUp,$txYUp,$clDtUp,$barCdUp,$subDtUp,$payFUp,$remUp){

		$repDet = explode("_",$_SESSION['representative']);
		$repId = $repDet[0];
		$repNm = $repDet[1];

		$retTDtUp = $this->protect($retTDtUp);
		$barCdUp = $this->protect($barCdUp);
		$subDtUp = $this->protect($subDtUp);
		$payFUp = $this->protect($payFUp);
		$remUp = $this->protect($remUp);

		// Extracting Data from Return Type
		$retTpArr = explode("|", $retTpClUp);
		$retTpId = $retTpArr[0];
		$retTpNm = $retTpArr[1];

		// Extracting Client Data
		$clDtUpArr = explode("|", $clDtUp);
		$clIdUp = $clDtUpArr[0];
		$clNmUp = $clDtUpArr[1];
		$ctIdUp = $clDtUpArr[2];
		$ctNmUp = $clDtUpArr[3];
		$busNmUp = $clDtUpArr[4];
		$hdIdUp = $clDtUpArr[5];
		$hdNmUp = $clDtUpArr[6];
		$sHdIdUp = $clDtUpArr[7];
		$sHdNmUp = $clDtUpArr[8];

		$varArr = array(
			'gjdt' => $retTDtUp,
			'clientId' => $clIdUp,
			'clientNm' => $clNmUp,
			'cityId' => $ctIdUp,
			'cityNm' => $ctNmUp,
			'hdId' => $hdIdUp,
			'hdNm' => $hdNmUp,
			'sHdId' => $sHdIdUp,
			'sHdNm' => $sHdNmUp,
			'busNm' => $busNmUp,
			'barCd' => $barCdUp,
			'subDt' => $subDtUp,
			'feeTpId' => $retTpId,
			'feeTp' => $retTpNm,
			'feeYr' => $txYUp,
			'description' => $remUp,
			'drAmt' => $payFUp,
			'repId' => $repId,
			'repNm' => $repNm
		);

		$retTrkUpQ = $this->model->update('ledger',$varArr,' id='.$id);
		if($retTrkUpQ == 1){
			$this->messages[] = "<div class='success-msg'>Record Updated Successfully<br />
			You'll be redirected, if you don't redirect <a href='index?page=nRetTrk'>CLICK ME</a>.</div>";
			//header("refresh:3;url=index?page=nRetTrk");
		}else{
			$this->messages[] = "<div class='message'>Record couldn't be Updated.</div>";
		}

		// Checks if any Error exist.
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo $msg;
			}
		}

	}	

	// For Director's Reports Total REVENUE
	public function revRpt(){
		$finRevData = $this->model->finRev('sum(crAmt)','revenue','ledger','sHdNm = "Accounts Receivable"');
		if($finRevData->num_rows > 0){
			while($row=$finRevData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// For Director's Reports Total EXPENCES
	public function expRpt(){
		$finRptData = $this->model->finRev('sum(drAmt)','expences','ledger','hdNm = "Expences"');
		if($finRptData->num_rows > 0){
			while($row=$finRptData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// For Director's Reports Total Amount of RETURN TRACKER
	public function retTrkRpt(){
		$retTrkRptData = $this->model->finRev('sum(drAmt)','clRTAmt','ledger','retGj = "retTrk"');
		if($retTrkRptData->num_rows > 0){
			while($row=$retTrkRptData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// For Director's Reports Total Amount of Clients from General Journal and It also collecting Data for Return Tracker collection for Representative in Dashboard
	public function clGjRpt(){
		$clGjRptData = $this->model->finRev('sum(crAmt)','clCrAmt','ledger','sHdNm = "Accounts Receivable" AND retGj = "GJ"');
		if($clGjRptData->num_rows > 0){
			while($row=$clGjRptData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// For Director's Reports Total Expences / Amount spent by Representative during Collection
	public function repExp(){
		$repExpData = $this->model->prevBal('ledger',' hdNm="Expences"');
		if($repExpData->num_rows > 0){
			while($row=$repExpData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// For Director's Reports Total Bank Inflow of Cash by Representative during Collection
	public function bankInflow(){
		$bnkInfData = $this->model->finRev('sum(drAmt)','bnkInflow','ledger','shdNm = "Banks" AND retGj = "GJ"');
		if($bnkInfData->num_rows > 0){
			while($row=$bnkInfData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// For Director's Reports Total Bank Inflow of Cash by Representative during Collection
	public function bankOutflow(){
		$bnkOutData = $this->model->finRev('sum(crAmt)','bnkOutflow','ledger','shdNm = "Banks" AND retGj = "GJ"');
		if($bnkOutData->num_rows > 0){
			while($row=$bnkOutData->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	// Destuctor for closing DB Connection
	public function __destruct(){
		if($this->model->connOk){
			if($this->model->conn->close()){
				$this->connOk = false;
				return true;
			}
			
		}else{
			return false;
		}
	}

	// Closing Class Controller
}
?>




























