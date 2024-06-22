	<?php
	$path = (realpath(__DIR__.'/..').'/public/js/jquery-3.5.1.js');
	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<!-- 	<script type="text/javascript" src="E:/xampp/htdocs/sawreva/public/js/jquery-3.5.1.js">
		$(document).ready(function(){
			alert('Hi');
		});
	</script> -->
</head>

<body>
<?php //echo(realpath(__DIR__)); ?>


<div class="row full-width">
	
	<div class="col-12">
	<!-- <div class="full-width"> -->
		<h1 class="heading-big">Registered Clients</h1>
		<div class="success-msg">Type Keywords to SEARCH and Use ALT+S</div>
	<div class="clientSearch">

		<!-- 
		<select id="searchBy" style="width: 200px;" autofocus>
			<option value="">Select Search Term</option>
			<option disabled="disabled">----------------------------------</option>
			<option value="clientNm">Client Name</option>
			<option value="cnicNo">Client CNIC</option>
		</select>
 -->

		<input type="text" id="clSearch" name="clSearch" placeholder="Search Term Here" autofocus="autofocus">
		<button id="clSearchBtn" style="width: 50px;" accesskey="s" style="outline: none;"><i class="fas fa-search"></i></button>
	</div>

	<!-- <div id="loader">
		<i class="fa fa-refresh fa-spin" style="font-size:40px"></i>
	</div> -->

	<div style="overflow-x: auto;">
	
	<!-- Loader will load each time when data will be grabbed -->
	<!--<div id="box">-->
	<!--	<div id="loader"></div>-->
	<!--	<h3 id="loaderNm">SAWREVA</h3>-->
	<!--	<h6 id="loadingNm">Loading...</h6>-->
	<!--</div>-->

	<table id="vClients">
	</table>		
	</div>
<!-- </div> -->
</div>
</div>
<a href="#" class="scrollTop"><i class="fas fa-arrow-up"></i></a>
<div class="bott-height"></div>
</body>
</html>
