<!-- 	<div id="box">
		<div id="loader"></div>
		<h3 id="loaderNm">SAWREVA</h3>
		<h6 id="loadingNm">Loading...</h6>
	</div>
 -->	<!-- START MAIN CONTAINER -->
	<div class="container-fluid">		
		<!-- HEADING ROW -->
		<div class="row snm-tmenu mb-5">
			<div class="col-md-4 d-flex" style="display: inline-flex; justify-content: flex-start; align-items: flex-start;">
				<h1 style="font-weight: bold;" id="site-nm">MyTaxSol</h1>
				
			</div>

			<div class="col-md-8 d-flex" style="display: inline-flex; justify-content: flex-start; align-items: flex-start;">
				<h3 style="font-weight: bold; margin-top: 28px;" id="site-nm">MyTaxSol</h3>
				<ul class="top-menu mt-4">
					<li><a href="index"><i class="fa fa-home fa-lg fa-fw"></i>
					</a></li>

					<li><!-- <a href=""> --><i class="fa fa-bars fa-lg fa-fw"></i><!-- </a> -->
						<ul>
							
							
							<li><a href="index?page=nClient"><i class="fa fa-user-plus fa-lg fa-fw"></i>
							 Create New Client</a></li>
							<li><a href="index?page=viewClient"><i class="fa fa-users fa-lg fa-fw"></i> 
							Clients List</a></li>

							
							<li><a href="index?page=ngj"><i class="fas fa-book fa-lg fa-fw"></i> 
							General Journal</a></li>
							<li><a href="index?page=vgj"><i class="fas fa-open-book fa-lg fa-fw">&#xf518;</i> 
							View General Journal</a></li>
							<li><a href="index?page=vAcc"><i class="fas fa-open-book fa-lg fa-fw">&#xf518;</i> 
							View Account</a></li>
							
							<li><a href="index?page=nRetTrk"><i class="fas fa-money fa-lg fa-fw"></i> 
							Return Tracker</a></li>

							<li><a href="index?page=listClFilStat" accesskey=""><i class="fa fa-file fa-lg fa-fw"></i>
							Detailed RetTrk Filing Status</a></li>
							
							<li><a href="index?page=DWvRetTrk"><i class="fas fa-money fa-lg fa-fw"></i> 
							View Return Tracker</a></li>
						</ul>
					</li>

<!-- 					<li><i class="fas fa-book fa-lg fa-fw"></i>
						<ul>
							<li><a href="index.php?page=ngj"><i class="fas fa-book fa-lg fa-fw"></i>Header Account</a></li>
							<li><a href="index.php?page=vgj"><i class="fas fa-book fa-lg fa-fw"></i>Sub Account</a></li>
						</ul>
					</li>
 -->
				<?php
				if(isset($_SESSION['taxmagrep'])){
					?>
					<li><i class="fa fa-user-circle fa-lg fa-fw"></i><br />
						<ul class="user-menu">
							<?php
							$ses_expl = explode("_", $_SESSION['taxmagrep']);
						 	$uId = $ses_expl[0];
							$uNm = $ses_expl[1];							
							?>
							<li class="prof-nm" style="user-select: none; -webkit-user-select: none;"><?php echo $uNm; ?></li>
							
							<!-- <li><a href="index.php?page=profile">
							<i class="fa fa-user-circle fa-lg fa-fw"></i>Profile</a></li> -->

							<li><a href="index?page=changePwd" accesskey="c">
							<i class="fa fa-lock fa-lg fa-fw"></i>Change Password</a></li>
							<li><a href="logout">
							<i class="fas fa-sign-out-alt fa-lg fa-fw" accesskey="l"></i>Logout</a></li>
						</ul>
					</li>
				</ul>
					<?php
					//echo 'Well come Cookie : '.$_COOKIE['user']."	<br /><a href='logout.php'>Log Out</a>";
				}elseif(isset($_COOKIE['taxmagrep'])){
					echo 'Well come Session :  '.$_COOKIE['taxmagrep']."	<br /><a href='logout'>Log Out</a>";
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
						echo "<p>No Page</p>"; //.$page;
					}
				}else{
				?>
			<p class="normal-text">
				<?php 
				date_default_timezone_set("Asia/Karachi");
				//echo date_default_timezone_get(); 
				//echo date('d/m/Y h:i:s');

				// include("autoLoad.php");
				// $ContObj = new Controller();
				
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
				<?php
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
