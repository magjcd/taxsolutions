<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap' rel='stylesheet'>
	<meta charset="utf-8">
	<!-- <meta http-equiv="refresh" content="5"> -->
	<title></title>
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Josefin Sans', sans-Serif;
		}

		div {
			width: auto;
			height: auto;
			margin:auto;
			position: relative;
			margin-top: 0px;
			/*animation: mymove 10s;*/
			/*opacity: 0;*/
			padding: 250px 600px;
/*			transform: translateX(-700px);*/
		}

		#logo {

		}

		#loading {
			width: 90%;
			height: 100%;
			margin-left: 20px;
		}

/*		@keyframes mymove {
			0% {opacity: 0.3;}
			50% {opacity: 0.6;}
			70% {opacity: 1;}
			100% {opacity: 1;}

		}*/

		span {
			text-align: center;
			margin-left: 50px;

		}

		@media only screen and (max-width: 767px) {
			div {				
				/*padding: 200px 350px;*/
				/*margin-top: 100px;*/
			}		

		#loading {
			width: 90%;
			height: 100%;
			margin-left: 20px;
		}
	}
</style>
</head>
<body>
<div>
	<img src="public/images/taxSol.png" id="logo">
	<img src="public/images/loading.gif" id="loading">
<!-- 	<span>loading.....</span> -->

</div>
<?php 
header("refresh:5;url=login");
?>
</body>
</html>












