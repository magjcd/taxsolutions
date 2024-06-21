<?php
$ContObj->adminLogChk();
?>
	<!-- START MAIN CONTAINER -->
	<div class="container-fluid">		
		<!-- HEADING ROW -->
		<div class="row snm-tmenu mb-5">
			<div class="col-md-4 d-flex" style="display: inline-flex; justify-content: flex-start; align-items: flex-start;">
				<h1 style="font-weight: bold;">SawReva</h1>
				
			</div>

			<div class="col-md-8 d-flex" style="display: inline-flex; justify-content: flex-start; align-items: flex-start;">
				<h3 style="font-weight: bold; margin-top: 28px;">MyTaxSol</h3>
				<ul class="top-menu mt-4">
					<li><a href="index" accesskey="h"><i class="fa fa-tachometer fa-lg fa-fw"></i>
					</a></li>

					<li><!-- <a href=""> --><i class="fa fa-bars fa-lg fa-fw"></i><!-- </a> -->
						<ul>
							<li><a href="index?page=nUser"><i class="fa fa-user-plus fa-lg fa-fw"></i>
							Creat Representative</a></li>
							<li><a href="index?page=viewUser"><i class="fa fa-users fa-lg fa-fw"></i> 
							View Representative</a></li>
							<li><a href="index?page=viewClient"><i class="fa fa-users fa-lg fa-fw"></i> 
							View Clients</a></li>
							<li><a href="index?page=nCity"><i class="fa fa-road fa-lg fa-fw"></i> 
							City</a></li>
							<li><a href="index?page=feeType"><i class="fa fa-road fa-lg fa-fw"></i> 
							Fees Type</a></li>
							<li><a href="index?page=clStat"><i class="fa fa-users fa-lg fa-fw"></i>
							Client Status</a></li>
							<li><a href="index?page=ctou"><i class="fa fa-building fa-lg fa-fw"></i>
							Tax Office Unit</a></li>
							<li><a href="index?page=bo"><i class="fa fa-building fa-lg fa-fw"></i>
							Branch Office</a></li>
							<li><a href="index?page=rto"><i class="fa fa-city fa-lg fa-fw"></i>
							RTO</a></li>
							<li><a href="index?page=bussCat"><i class="fa fa-briefcase fa-lg fa-fw"></i>
							Business Category</a></li>
							<li><a href="index?page=lnkAcc"><i class="fa fa-link fa-lg fa-fw"></i>
							Linked With</a></li>
						</ul>
					</li>
					
					<li><i class="fa fa-book fa-lg fa-fw"></i>
						<ul>
<!-- 							<li><a href="index?page=nHeadAcc"><i class="fa fa-book fa-lg fa-fw"></i>Header Account</a></li> -->
							<li><a href="index?page=subHead"><i class="fa fa-book fa-lg fa-fw"></i>Sub Header</a></li>
							<li><a href="index?page=nAcc"><i class="fa fa-book fa-lg fa-fw"></i>New Account</a></li>

							<li><a href="index?page=vAcc" accesskey="r"><i class="fa fa-file fa-lg fa-fw"></i>
							View Account</a></li>

							<li><a href="index?page=rdwft" accesskey="r"><i class="fa fa-file fa-lg fa-fw"></i>
							Reps. Fin. Acts.</a></li>

							<li><a href="view/clientExcelList.php" accesskey=""><i class="fa fa-file fa-lg fa-fw"></i>
							Client Excel List</a></li>

							<li><a href="view/ledgerToExcel.php" accesskey=""><i class="fa fa-file fa-lg fa-fw"></i>
							Ledger's Excel File</a></li>

							<li><a href="index?page=clFiled" accesskey=""><i class="fa fa-file fa-lg fa-fw"></i>
							RetTrk Filing Status</a></li>

							<li><a href="index?page=listClFilStat" accesskey=""><i class="fa fa-file fa-lg fa-fw"></i>
							Detailed RetTrk Filing Status</a></li>

							<li><a href="index?page=trialBalance" accesskey="t"><i class="fa fa-file fa-lg fa-fw"></i>
							Trial Balance</a></li>

						</ul>
					</li>

				<?php
				if(isset($_SESSION['taxmagadmin'])){
					?>
					<li><i class="fas fa-user-circle fa-lg fa-fw"></i><br />
						<?php 
						// if(strpos($_SERVER['HTTP_USER_AGENT'],'Android')){
						?>
							<!-- <i class="fa fa-mobile"></i> -->
						<?php
						// }else{
							?>
						<!-- <i class="fa fa-laptop" style="font-size: 20px;"></i> -->
					 	<?php
						// }
						?>
						<ul class="user-menu">
							<?php
							$ses_expl = explode("_", $_SESSION['taxmagadmin']);
						 	$uId = $ses_expl[0];
							$uNm = $ses_expl[1];							
							?>
							<li class="prof-nm" style="user-select: none; -webkit-user-select: none;"><?php echo $uNm; ?></li>
					
							<!-- <li><a href="index?page=profile">
							<i class="fa fa-user-circle fa-lg fa-fw"></i>Profile</a></li> -->

							<!-- <li><a href="index?page=changePwd"> -->
								<li><a href="index?page=changePwd">
							<i class="fa fa-lock fa-lg fa-fw"></i>Change Password</a></li>
							<li><a href="logout">
							<i class="fa fa-sign-out-alt fa-lg fa-fw" accesskey="l"></i>Logout</a></li>
						</ul>
					</li>

					<!-- <li><i class="fa fa-bell" style="font-size: 18px;"></i></li>
					<span style="position: relative; width: 5px; margin-left: -25px; top: -2px; color: #fff;">2550</span> -->
					</ul>
					<?php
					//echo 'Well come Cookie : '.$_COOKIE['user']."	<br /><a href='logout.php'>Log Out</a>";
				}elseif(isset($_COOKIE['taxmagadmin'])){
					echo 'Well come Session :  '.$_COOKIE['taxmagadmin']."	<br /><a href='logout'>Log Out</a>";
				}else{
					header("Location: login");
				}

				?>
			</div>
			<p id="busNSml">Tax Solution</p>			
		</div>
		<!-- END HEADING ROW -->

		<div class="row">
			<div class="col-12">
				<?php
				if(isset($_GET['page'])){
					$page = $_GET['page'];
					$path = ('view/'.$page.'.php');
					if(file_exists($path)){
						include($path);
					}else{
						echo "<p>No Page</p>".$page;
					}
				}else{
					$getDirMsg = $ContObj->getDirMsg();
				?>
				<div class="row double-column">
					<h1 class="heading-big" style="">Notification</h1>
					<?php 
					echo '<table>';
					if($getDirMsg){
						
						foreach($getDirMsg as $getDirMsgDet){
							echo '<tr><td>'.$getDirMsgDet['addDt'].' '.$getDirMsgDet['addTm'].'</td></tr>';
							echo '<tr><td>'.$getDirMsgDet['msg'].'</td></tr>';
						}

					}else{
						echo '<tr><td style="text-align: center;">No New <span style="color: red">NOTIFICATION</span> has been received from <span style="color: red">DIRECTOR</span></td></tr>';
					}
					echo '</table>';
					?>
				</div>
				<br />
				<?php
					include('emptyEnt.php');
					include('curDtRepFinAct.php');
				}
			?>				
			</div>
		</div>

		<!-- FOOTER -->
		<div class="row footer">
			<div class="col-12">
				<p>Copy Right &copy; <?php echo date('Y'); ?>-2021 - Design & Developed by <a href="mailto:magjcd@gmail.com" style="color: #000;">magTech</a> | +92 333 244 5283</p>
			</div>
		</div>
		<!-- END FOOTER -->

	</div>
	<!-- END MAIN CONTAINER -->
