<?php

include("autoLoad.php");
$ContObj = new Controller();
?>
	<!-- START MAIN CONTAINER -->
	<div class="container-fluid">		
		<!-- HEADING ROW -->
		<div class="row snm-tmenu mb-5">
			<div class="col-md-4 d-flex" style="display: inline-flex; justify-content: flex-start; align-items: flex-start;">
				<h1 style="font-weight: bold;">SAWREVA</h1>
				
			</div>

			<div class="col-md-8 d-flex" style="display: inline-flex; justify-content: flex-start; align-items: flex-start;">
				<h3 style="font-weight: bold; margin-top: 28px;">SAWREVA</h3>
				<ul class="top-menu mt-4">
					<li><a href="index"><i class="fa fa-dashboard fa-lg fa-fw"></i>
					</a></li>

					<li><!-- <a href=""> --><i class="fa fa-bars fa-lg fa-fw"></i><!-- </a> -->
<!-- 						<ul>
							<li><a href="index?page="><i class="fa fa-user-plus fa-lg fa-fw"></i>
							Client</a></li>
							<li><a href="index?page="><i class="fa fa-road fa-lg fa-fw"></i> 
							City</a></li>
							<li><a href="index?page="><i class="fas fa-users fa-lg fa-fw"></i>
							Status</a></li>
							<li><a href="index?page="><i class="fas fa-building fa-lg fa-fw"></i>
							Tax Office Unit</a></li>
							<li><a href="index?page="><i class="far fa-building fa-lg fa-fw"></i>
							Branch Office</a></li>
							<li><a href="index?page="><i class="fas fa-city fa-lg fa-fw"></i>
							RTO</a></li>
							<li><a href="index?page="><i class="fas fa-briefcase fa-lg fa-fw"></i>
							Business Category</a></li>
							<li><a href="index?page="><i class="fas fa-link fa-lg fa-fw"></i>
							Linked With</a></li>
						</ul> -->
					</li>

				<?php
				if(isset($_SESSION['director'])){
					?>
					<li><i class="fa fa-user-circle fa-lg fa-fw"></i><br />
						<ul class="user-menu">
							<?php
							$ses_expl = explode("_", $_SESSION['director']);
						 	$uId = $ses_expl[0];
							$uNm = $ses_expl[1];							
							?>
							<li class="prof-nm"><?php echo $uNm; ?></li>

							<!-- <li><a href="index?page=profile">
							<i class="fa fa-user-circle fa-lg fa-fw"></i>Profile</a></li> -->

							<li><a href="index?page=changePwd">
							<i class="fa fa-lock fa-lg fa-fw"></i>Change Password</a></li>
							<li><a href="logout.php">
							<i class="fa fa-sign-out fa-lg fa-fw" accesskey="l"></i>Logout</a></li>
						</ul>
					</li>
				</ul>
					<?php
					//echo 'Well come Cookie : '.$_COOKIE['user']."	<br /><a href='logout.php'>Log Out</a>";
				}elseif(isset($_COOKIE['director'])){
					echo 'Well come Session :  '.$_COOKIE['director']."	<br /><a href='logout.php'>Log Out</a>";
				}else{
					header("Location: login.php");
				}

				?>
			</div>
			<p id="busNSml">Tax Solution</p>
		</div>
		<!-- END HEADING ROW -->

				<?php
				if(isset($_GET['page'])){
					$page = $_GET['page'];
					$path = ('view/'.$page.'.php');
					if(file_exists($path)){
						?>
						<div class="row">
						<div class="col-12">
						<?php
						include($path);
					}else{
						echo "<p>No Page</p>".$page;
					}
					?>
					</div>
				</div>
					<?php
				}else{
					?>
					<div class="row dir-panel">
						<?php
						// include('dirDashboard.php');
						?>
					</div>

					<!-- Another Row -->
					<!-- <div class="row" style="background: #330099; color: #fff; margin-top: 2px;">
						Another Row
					</div> -->
					<?php
				}
				?>
			</div>

		<!-- FOOTER -->
		<div class="row footer">
			<div class="col-12">
				<p>Copy Right &copy; <?php echo date('Y'); ?>-2021 - Design & Developed by <a href="mailto:magjcd@gmail.com" style="color: #000;">magtech</a> | 0333-2445283</p>
			</div>
		</div>
		<!-- END FOOTER -->

	</div>
	<!-- END MAIN CONTAINER -->