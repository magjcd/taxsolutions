<div class="row full-width">
	
	<div class="col-12">
	<!-- <div class="full-width"> -->
		<h1 class="heading-big">Registered Clients</h1>
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

	</div>

	<!-- <div id="loader">
		<i class="fa fa-refresh fa-spin" style="font-size:40px"></i>
	</div> -->

	<div style="overflow-x: auto;">
	
	<!-- Loader will load each time when data will be grabbed -->
	<div id="box">
		<div id="loader"></div>
		<h3 id="loaderNm">SAWREVA</h3>
		<h6 id="loadingNm">Loading...</h6>
	</div>

	<table id="vClients">
	</table>		
	</div>
<!-- </div> -->
</div>
</div>
<div class="bott-height"></div>
