<?php
include("autoLoad.php");
$ContObj = new Controller();
$noEntLed = $ContObj->noEntLed();
?>

	<!-- START MAIN CONTAINER -->

	<div class="container-fluid">		

		<!-- HEADING ROW -->

		<div class="row snm-tmenu mb-5">

			<div class="col-md-4 d-flex" style="display: inline-flex; justify-content: flex-start; align-items: flex-start;">

				<h1 style="font-weight: bold;">SawReva</h1>
			</div>



			<div class="col-md-8 d-flex" style="display: inline-flex; justify-content: flex-start; align-items: flex-start;">

				<h3 style="font-weight: bold; margin-top: 28px;">SawReva</h3>

				<ul class="top-menu mt-4">

					<li><a href="index"><i class="fa fa-tachometer fa-lg fa-fw"></i>

					</a></li>



					<li><!-- <a href=""> --><i class="fa fa-bars fa-lg fa-fw"></i><!-- </a> -->

						<ul>

							<li><a href="index?page=nAcc" accesskey="r"><i class="fa fa-file fa-lg fa-fw"></i>
							New Account</a></li>

							<li><a href="index?page=vAcc" accesskey="r"><i class="fa fa-file fa-lg fa-fw"></i>
							View Account</a></li>

							<li><a href="index?page=rdwft"><i class="fa fa-book fa-lg fa-fw"></i>
							Reps. Fin. Acts.</a></li>

							<li><a href="index?page=clFiled" accesskey="r"><i class="fa fa-file fa-lg fa-fw"></i>
							RetTrk Filing Status</a></li>

							<li><a href="index?page=listClFilStat" accesskey=""><i class="fa fa-file fa-lg fa-fw"></i>
							Detailed RetTrk Filing Status</a></li>

							<li><a href="index?page=trialBalance" accesskey="t"><i class="fa fa-file fa-lg fa-fw"></i>
							Trial Balance</a></li>

							<li><a href="index?page=balSht" accesskey="t"><i class="fa fa-file fa-lg fa-fw"></i>
							Balance Sheet</a></li>

							<li><a href="index?page=vHdWDt" accesskey="t"><i class="fa fa-file fa-lg fa-fw"></i>
							Header Wise Report</a></li>

							<li><a href="index?page=gjCSV" accesskey="v"><i class="fa fa-file fa-lg fa-fw"></i>
							Upload GJ CSV</a></li>

						</ul>

					</li>



				<?php

				if(isset($_SESSION['taxmagdir'])){

					?>

					<li><i class="fa fa-user-circle fa-lg fa-fw"></i><br />

						<ul class="user-menu">

							<?php

							$ses_expl = explode("_", $_SESSION['taxmagdir']);

						 	$uId = $ses_expl[0];

							$uNm = $ses_expl[1];							

							?>

							<li class="prof-nm"><?php echo $uNm; ?></li>
							
							<li><a href="index?page=changePwd">

							<i class="fa fa-lock fa-lg fa-fw"></i>Change Password</a></li>

							<li><a href="logout">

							<i class="fa fa-sign-out-alt fa-lg fa-fw" accesskey="l"></i>Logout</a></li>

						</ul>

					</li>

					<li><i class="fa fa-bell" style="font-size: 18px;"></i>
						<ul>
							<li><a href="index?page=msg">
								<i class="fa fa-paper-plane"></i>
								 Message</a></li>
						</ul>
					</li>
					<span style="position: relative; width: 5px; margin-left: -21px; top: 2px; color: #fff;">
						<?php 
						if($noEntLed){
							echo count($noEntLed);
						}else{
							echo '0';
						}
						?>
					</span>


				</ul>

					<?php

					//echo 'Well come Cookie : '.$_COOKIE['user']."	<br /><a href='logout.php'>Log Out</a>";

				}elseif(isset($_COOKIE['taxmagdir'])){

					echo 'Well come Session :  '.$_COOKIE['taxmagdir']."	<br /><a href='logout.php'>Log Out</a>";

				}else{

					header("Location: login");

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

						include('dirDashboard.php');
						include('curDtRepFinAct.php');
						?>

					</div>

					<?php

				}

				?>

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
