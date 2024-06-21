<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../public/css/style.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="../public/js/jquery-3.5.1.js"></script>

</head>
<body>
<h1>Hi</h1>
</body>
	<div id="box">
		<div id="loader"></div>
		<h3 id="loaderNm">SAWREVA</h3>
		<h6 id="loadingNm">Loading...</h6>
	</div>
</html>
<script type="text/javascript">
	$(window).on("load",function(){
		$("#box").fadeIn(function(){
			$(this).fadeOut(6000);
		});
	});
// $(document).ready(function(){
// 	//alert('Hi');
// 	//$(window).on("load",function(){
// 		$("#box").show(3000,function(){
// 			$(this).fadeOut(8000);
// 		});
// 	//});
// 	});
	</script>