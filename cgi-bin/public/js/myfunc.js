$(document).ready(function(){
	
	// Sliding Login
	//$(".container-login").fadeIn();


	// Changin Submit button value
	$("button").click(function(){
		$(this).html("<i class='fas fa-spinner fa-spin'></i>");
	});

	// $("input[type=submit]").click(function(){
	// 	$("input[type=submit]").attr('value', "<i class='fa fa-spinner fa-spin'>");
	// });

	// Error and Success messages
	$(".success-msg").slideDown(1000).delay(4000).slideUp(1000);
	// $(".message").slideDown(1000).delay(4000).slideUp(1000);
	$(".message").slideDown(500).animate({fontSize:'18px'}).delay(4000).animate({fontSize:'12px'}).slideUp(500);

	// Loading Director Panel after 10 Seconds automatically		
	function relDirPan(){
		$('.dir-panel').load('view/dirDashboard.php');
	}
	relDirPan();
	
	// Hits after 1 Second to Update Director's Panel
	setInterval(function(){
		relDirPan();
	}, 1000);

	// Start Loading Client Data
	function loadClientTable(){
		$.ajax({
			url : 'view/viewClientDet.php',
			type : 'POST',
			beforeSend: function(){
				/*$("#loader").fadeIn(function(){
					$(this).fadeOut();
				});*/
				$("#box").fadeIn(function(){
					$(this).fadeOut();
				});
			},
			success : function(data){
				$("#vClients").html(data);
			}
		});
	}
	loadClientTable();

	$("#clSearch").keyup(function(){
		var clSearch = $("#clSearch").val();
		var searchBy = $("#searchBy").val();
		$.ajax({
			url : 'view/viewClientDetST.php',
			type : 'POST',
			data : {searchBy:searchBy,clSearch:clSearch},
			// data : {clSearch:clSearch},
			beforeSend: function(){
				/*$("#loader").fadeIn(function(){
				$(this).fadeOut();
				});*/
				$("#box").fadeIn(function(){
				$(this).fadeOut();
				});
			},
			success: function(data){
				//$("#box").fadeOut();
				//$("#loader").hide();
				$("#vClients").html(data);
				//loadClientTable();
				
			}
		});
	});
	// End Client Table

	// View General Journal by Dropdown
	$("#vgj").change(function(){
		var vgj = $("#vgj").val();
		// var gjDt = $("#gjDt").val();
		$.ajax({
			url : 'view/vgjDet.php',
			type : 'POST',
			data : {vgj:vgj},
			beforeSend: function(){
				/*$("#loader").fadeIn(function(){
				$(this).fadeOut();
				});*/
				$("#box").fadeIn(function(){
				$(this).fadeOut();
				});
			},
			success : function(data){
				$("#fb").html(data);

			}
		});
	});

	// View Return Tracker by Dropdown
	$("#retTrk").change(function(){
		var vRtTrk = $("#retTrk").val();
		$.ajax({
			url : 'view/vRetTrkDet.php',
			type : 'POST',
			data : {vRtTrk:vRtTrk},
			beforeSend: function(){
				$("#box").fadeIn(function(){
				$(this).fadeOut();
				});
			},
			success : function(data){
				$("#vRetTrk").html(data);

			}
		});
	});

	// View Datewise Accounts
		$("#vSAcc").change(function(){
		var fd = $("#fd").val();
		var td = $("#td").val();
		var vSAcc = $("#vSAcc").val();
		$.ajax({
			url : 'view/vAccDet.php',
			//url : 'index.php?page=vAccDet',
			type : 'POST',
			data : {fd:fd,td:td,vSAcc:vSAcc},
			beforeSend: function(){
				$("#box").show();
			},
			success : function(data){
				$("#box").hide();
				$(".sDwAcc").html(data);
			}
		});
	});

	// Start Return Tracker
	function loadRetTrk(){
		$.ajax({
			url : 'view/vRetTrk.php',
			type : 'POST',
			beforeSend: function(){
				$("#box").show();
			},
			success : function(data){
				$("#box").hide();
				$('#retTrkData').html(data);
			}
		});
	}
	loadRetTrk();

	$("#retType").change(function(){
		var retTp = $("#retType").val();
		$.ajax({
			url : 'view/retTpDet.php',
			type : 'POST',
			data : {retTp:retTp},
			success : function(data){
				$("#clientDet").html(data);
			}
		});
	});

	//$("#clientDet").change(function(){
	$("#clientDt").change(function(){
		var retTpCl = $("#retType").val();
		var clDt = $("#clientDt").val();
		//alert(clDt);
		$.ajax({
			url : 'view/retTpDet.php',
			type : 'POST',
			data : {clDt:clDt,retTpCl:retTpCl},
			success : function(data){
				$("#feetext").text(data);
				var val = $("#feetext").text();
				var valInt = parseInt(val);
				$("#payfee").val(valInt);
				//$("input[type=number]").attr('value',valInt);
				$("#payfee").attr('value',valInt);
				//$("input[type=submit]").attr('value', 'Please wait.....');
			}
		});
	});

	$("#pay").click(function(event){
		event.preventDefault();
		let retTDt = $("#retTDt").val();
		let retTypeCl = $("#retType").val();
		let taxYr = $("#taxYr").val();
		let clDt = $("#clientDt").val();
		let barCd = $("#barCd").val();
		let subDt = $("#subDt").val();
		let payfee = $("#payfee").val();
		let rem = $("#rem").val();

		var conf = confirm("Confirm save this record ?");
		if(conf == true){
			if(retTDt != "" && retTypeCl != "" && taxYr != "" && clDt != "" && barCd != "" && subDt != "" && payfee != "" && rem != ""){
				if(taxYr.length == 4){
					if(barCd.length == 15){
						$.ajax({
							url : 'view/retTrkSave.php',
							type : 'POST',
							data : {retTDt:retTDt,retTypeCl:retTypeCl,taxYr:taxYr,clDt:clDt,barCd:barCd,subDt:subDt,payfee:payfee,rem:rem},
							success : function(data){
								$("#clientDet").val('');
								$("#barCd").val('');
								$("#subDt").val('');
								$("#payfee").val('0');
								$("#rem").val('');
								$("button").html("Save");
								//$("input[type=submit]").attr('value', 'Save');
								$("table").html(data);
								$("#clientDet").focus();
								loadRetTrk();
							}
						});
					}else{
						alert("Bar Code must be in 15 digits.");
						$("button").html("Save");
					}
				}else{
					alert("Tax year must be in 4 Digit");
					$("button").html("Save");
					//$("input[type=submit]").attr('value', 'Save');
				}
			}else{
				alert("Fill all the Fields.");
				$("button").html("Save");

				//$("input[type=submit]").attr('value', 'Save');
			}		
		}	
	});
	// End Return Tracker

	// CNIC Masking
	//$("#cnicNo").mask('9999999999999');


	// Start Updating Return Tracker
	// Sending Return Type Data to Controller and grabbing data for a particular Return Type Categorty.
	$("#retTypeUpd").change(function(){
		let retTypeUpd = $("#retTypeUpd").val();
		
		$.ajax({
			url : 'view/rTrkDetUpd.php',
			type : 'POST',
			data : {retTypeUpd : retTypeUpd},
			success : function(data){
				$("#clientDetUpd").html(data);
			}
		});
	});

	// Grabbing Client Data with applicated fees
	$("#clientDetUpd").change(function(){
		let retTypeUpdC = $("#retTypeUpd").val();
		let retTypeUpdCl =  $("#clientDetUpd").val();

		$.ajax({
			url : 'view/rTrkDetUpd.php',
			type : 'POST',
			data : {retTpUpd : retTypeUpdC,retTpUpdCl : retTypeUpdCl},
			success : function(data){
				$("#feetext").text(data);
				let valUpd = $("#feetext").text();
				let valIntUpd = parseInt(valUpd);
				$("#payfeeUpd").val(valIntUpd);
				$("#payfeeUpd").attr('value',valIntUpd);
				//$("input[type=number]").attr('value',valIntUpd);
			}
		});
	});

	// Saving Updated Record of Return tracker
	$("#payUpd").click(function(event){
		event.preventDefault();
		let idUpd = $("#idUpd").val();
		let retTDtUpd = $("#retTDtUpd").val();
		let retTypeClUpd = $("#retTypeUpd").val();
		let taxYrUpd = $("#taxYrUpd").val();
		let clDtUpd = $("#clientDetUpd").val();
		let barCdUpd = $("#barCdUpd").val();
		let subDtUpd = $("#subDtUpd").val();
		let payfeeUpd = $("#payfeeUpd").val();
		let remUpd = $("#remUpd").val();

		var conf = confirm("Confirm Update this record ?");
		if(conf == true){
			if(retTDtUpd != "" && retTypeClUpd != "" && taxYrUpd != "" && clDtUpd != "" && barCdUpd != "" && subDtUpd != "" && payfeeUpd != "" && remUpd != ""){
				if(barCdUpd.length == 15){
					$.ajax({
						url : 'view/retTrkUpdSave.php',
						type : 'POST',
						data : {
							idUpd:idUpd,
							retTDtUpd:retTDtUpd,
							retTypeClUpd:retTypeClUpd,
							taxYrUpd:taxYrUpd,
							clDtUpd:clDtUpd,
							barCdUpd:barCdUpd,
							subDtUpd:subDtUpd,
							payfeeUpd:payfeeUpd,
							remUpd:remUpd
						},
						success : function(data){
							$("#fb").html(data);
							$("input[type=submit]").attr('value', 'Update');
							//alert('Record updated successfully.'); 
							window.location.replace('index?page=nRetTrk');
						}
					});
				}else{
					alert("Bar Code must be in 15 digits.");
					$("button").html("Update");
			}
			}else{
				alert("Fill all the Fields.");
				$("input[type=submit]").attr('value', 'Update');
			}		
		}	
	});

	// End Return Tracker Updation
});