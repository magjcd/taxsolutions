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
				<h1 style="font-weight: bold;" id="site-nm">SAWREVA</h1>
				
			</div>

			<div class="col-md-8 d-flex" style="display: inline-flex; justify-content: flex-start; align-items: flex-start;">
				<h3 style="font-weight: bold; margin-top: 28px;" id="site-nm">SAWREVA</h3>
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
				if(isset($_SESSION['representative'])){
					?>
					<li><i class="fa fa-user-circle fa-lg fa-fw"></i><br />
						<ul class="user-menu">
							<?php
							$ses_expl = explode("_", $_SESSION['representative']);
						 	$uId = $ses_expl[0];
							$uNm = $ses_expl[1];							
							?>
							<li class="prof-nm"><?php echo $uNm; ?></li>
							
							<!-- <li><a href="index.php?page=profile">
							<i class="fa fa-user-circle fa-lg fa-fw"></i>Profile</a></li> -->

							<li><a href="index?page=changePwd" accesskey="c">
							<i class="fa fa-lock fa-lg fa-fw"></i>Change Password</a></li>
							<li><a href="logout.php">
							<i class="fa fa-sign-out fa-lg fa-fw" accesskey="l"></i>Logout</a></li>
						</ul>
					</li>
				</ul>
					<?php
					//echo 'Well come Cookie : '.$_COOKIE['user']."	<br /><a href='logout.php'>Log Out</a>";
				}elseif(isset($_COOKIE['representative'])){
					echo 'Well come Session :  '.$_COOKIE['representative']."	<br /><a href='logout.php'>Log Out</a>";
				}else{
					header("Location: login.php");
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
				?>
			<p class="normal-text">
				<?php 
				date_default_timezone_set("Asia/Karachi");
				//echo date_default_timezone_get(); 
				//echo date('d/m/Y h:i:s');
				?>

<!-- 				<br />
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				<br />
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				<br />
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				<br />
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				<br />
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum 
				<span style="color: red;">et</span> Malorum for use in a type specimen book.
			</p> -->
			<?php
		}
			?>				
<!-- 			<br /><br /><br />
			<br /><br /><br />
 -->			</div>
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
