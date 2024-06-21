
	<!-- START MAIN CONTAINER -->
	<div class="container-fluid">		
		<!-- HEADING ROW -->
		<div class="row snm-tmenu mb-5">
			<div class="col-md-4">
				<h1 style="font-weight: bold;">DURRANI</h1><p style="margin-top: -10px; font-size: 16px;">Taxation & <br />Law Associates</p>
			</div>
			<div class="col-md-6 d-flex d-flex-reverse">
				<ul class="top-menu mt-4">
					<li><a href="index.php"><i class="fa fa-home fa-lg fa-fw"></i>
					</a></li>

					<li><!-- <a href=""> --><i class="fa fa-bars fa-lg fa-fw"></i><!-- </a> -->
						<ul>
							<li><a href="index.php?page=nClient"><i class="fa fa-user-plus fa-lg fa-fw"></i>
							 Client</a></li>
							<li><a href="index.php?page=nCity"><i class="fa fa-road fa-lg fa-fw"></i> City</a></li>
							<li><a href="index.php?page=clStat">Status</a></li>
							<li><a href="index.php?page=ctou">Concern Tax Office Unit</a></li>
							<li><a href="index.php?page=bo">Branch Office</a></li>
							<li><a href="index.php?page=rto">RTO</a></li>
							<li><a href="index.php?page=bussCat">Business Category</a></li>
							<li><a href="index.php?page=lnkAcc">Linked With</a></li>
						</ul>
					</li>

<!-- 					<li><a href="">Menu</a>
						<ul>
							<li><a href="index.php?page=sub">Sub Menu</a></li>
							<li><a href="index.php?page=sub">Sub Menu</a></li>
							<li><a href="index.php?page=sub">Sub Menu</a></li>
							<li><a href="index.php?page=sub">Sub Menu</a></li>
						</ul>
					</li>
 -->
				</ul>
			</div>
			<div class="col-md-2 p-3 mt-4 user-panel">
				<?php
				if(isset($_SESSION['representative'])){
					?>
				<ul class="top-menu">
					<li class="prof-nm"><img src="public/images/user.jpg" class="user-pic"><br />
						<!-- <a href=""> --><?php echo $_SESSION['representative']; ?><!-- </a> -->
						<ul class="user-menu">
							<li><a href="index.php?page=profile">
							<i class="fa fa-user-circle fa-lg fa-fw"></i>Profile</a></li>

							<li><a href="index.php?page=changePwd">
							<i class="fa fa-lock fa-lg fa-fw"></i>Change Password</a></li>
							<li><a href="logout.php">
							<i class="fa fa-sign-out fa-lg fa-fw"></i>Logout</a></li>
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
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
				Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
			</p>
			<?php
		}
			?>				
			</div>
		</div>

		<!-- FOOTER -->
		<div class="row footer">
			<div class="col-12 mt-3">
				<p>Copy Right &copy; 2021 magtech </p>
			</div>
		</div>
		<!-- END FOOTER -->

	</div>
	<!-- END MAIN CONTAINER -->
