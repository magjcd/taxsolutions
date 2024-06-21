<?php
$ContObj->adminLogChk();
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
					<li><a href="index" accesskey="h"><i class="fa fa-dashboard fa-lg fa-fw"></i>
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
							<li><a href="index?page=nAcc"><i class="fa fa-book fa-lg fa-fw"></i>Account</a></li>
						</ul>
					</li>

				<?php
				if(isset($_SESSION['admin'])){
					?>
					<li><i class="fa fa-user-circle fa-lg fa-fw"></i><br />
						<ul class="user-menu">
							<?php
							$ses_expl = explode("_", $_SESSION['admin']);
						 	$uId = $ses_expl[0];
							$uNm = $ses_expl[1];							
							?>
							<li class="prof-nm"><?php echo $uNm; ?></li>
					
							<!-- <li><a href="index?page=profile">
							<i class="fa fa-user-circle fa-lg fa-fw"></i>Profile</a></li> -->

							<!-- <li><a href="index?page=changePwd"> -->
								<li><a href="index?page=changePwd">
							<i class="fa fa-lock fa-lg fa-fw"></i>Change Password</a></li>
							<li><a href="logout.php">
							<i class="fa fa-sign-out fa-lg fa-fw" accesskey="l"></i>Logout</a></li>
						</ul>
					</li>
				</ul>
					<?php
					//echo 'Well come Cookie : '.$_COOKIE['user']."	<br /><a href='logout.php'>Log Out</a>";
				}elseif(isset($_COOKIE['admin'])){
					echo 'Well come Session :  '.$_COOKIE['admin']."	<br /><a href='logout.php'>Log Out</a>";
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
			<p class="bdTxtFrmNm">
<!-- 				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				<br />
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				<br />
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				<br />
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				<br />
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum 
				<span style="color: red;">et</span> Malorum for use in a type specimen book. -->
				<!-- SAWREVA Tax Solution -->
			</p>
			<?php
		}
			?>				
			</div>
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
