$(document).ready(function(){
	
	// Sliding Login
	//$(".container-login").fadeIn();


	$(window).scroll(function(){
		if($(document).scrollTop() > 1000){
			$(".scrollTop").show();
		}else{
			$(".scrollTop").hide();
		}
	});

	// Focus on New Input after PRESSING ENTER key
	$('input,select').keypress(function(e){
		if(e.which == 13){
			var index = $('input,select').index(this);
			$('input,select').eq(index + 1).focus();
			e.preventDefault();
		}
	});

	// Changing Submit button value
	$("button").click(function(){
		$(this).html("<i class='fas fa-spinner fa-spin'></i>");
	});

	// $("input[type=submit]").click(function(){
	// 	$("input[type=submit]").attr('value', "<i class='fa fa-spinner fa-spin'>");
	// });

	// Error and Success messages
	$(".success-msg").slideDown(1000).delay(2000).slideUp(1000);
	$(".message").slideDown(1000).delay(2000).slideUp(1000);
	//$(".message").slideDown(500).animate({fontSize:'18px'}).delay(1000).animate({fontSize:'12px'}).slideUp(500);

	// Loading Director Panel after 10 Seconds automatically		
	// function relDirPan(){
	// 	$('.dir-panel').load('view/dirDashboard.php');
	// }
	// relDirPan();
	
	// Hits after 1 Second to Update Director's Panel
	// setInterval(function(){
	// 	relDirPan();
	// }, 1000);

	// Start Loading Client Data
	function loadClientTable(){
		$.ajax({
			url : 'view/viewClientDet.php',
			type : 'POST',
			//beforeSend: function(){
				/*$("#loader").fadeIn(function(){
					$(this).fadeOut();
				});*/
			// 	$("#box").fadeIn(function(){
			// 		$(this).fadeOut();
			// 	});
			// },
			success : function(data){
				$("#vClients").html(data);
			}
		});
	}
	loadClientTable();

	//$("#clSearch").keyup(function(){
		$('#clSearchBtn').click(function(){
		var clSearch = $("#clSearch").val();
		var searchBy = $("#searchBy").val();
		$.ajax({
			url : 'view/viewClientDetST.php',
			type : 'POST',
			data : {searchBy:searchBy,clSearch:clSearch},
			// data : {clSearch:clSearch},
			//beforeSend: function(){
				/*$("#loader").fadeIn(function(){
				$(this).fadeOut();
				});*/
			// 	$("#box").fadeIn(function(){
			// 	$(this).fadeOut();
			// 	});
			// },
			success: function(data){
				//$("#box").fadeOut();
				//$("#loader").hide();
				$("#vClients").html(data);
				//loadClientTable();
				$('#clSearchBtn').html('<i class="fas fa-search"></i>');
				
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

	$('#accNmDet').on('change',function(){
		let cusDet = $('#accNmDet').val();
		cusDetArr = cusDet.split('|');
		//alert(cusDet);
		cusId = cusDetArr[0];

		$.ajax({
			url : 'view/ledBalDet.php',
			type : 'POST',
			data : {
				cusId:cusId
			},
			success : function(data){
				console.log(data);
				$('#bal').html(`Balance: ${data}`).fadeIn(500).delay(1000).fadeOut(500);
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
		// $("#clientDt").val('');
		// $("#payfee").val('');

		$("#clientDt").val('');
		$("#barCd").val('');
		$("#subDt").val('');
		$("#payfee").val('0');
		$("#rem").val('');
		
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

		// Focus on next field after selecting an account		
		var index = $("input").index(this);
		$('input').eq(index + 1).focus();

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

		// Special / Hidden Data in order to Save in Revenue Earned - Services
		let revEraned = $("#earnedRev").val();

		// var conf = confirm("Confirm save this record ?");
		// if(conf == true){
			if(retTDt != "" && retTypeCl != "" && taxYr != "" && clDt != "" && barCd != "" && subDt != "" && payfee != "" && rem != ""){
				if(barCd.length == 15){
					if(payfee != 0 || payfee != ""){
						$.ajax({
							url : 'view/retTrkSave.php',
							type : 'POST',
							data : {retTDt:retTDt,
								retTypeCl:retTypeCl,
								taxYr:taxYr,
								clDt:clDt,
								barCd:barCd,
								subDt:subDt,
								payfee:payfee,
								rem:rem,
								revEraned:revEraned
							},
							success : function(data){
								console.log(data);
								$("#clientDt").val('');
								$("#barCd").val('');
								$("#subDt").val('');
								$("#payfee").val('0');
								$("#rem").val('');
								$("button").html("Save");
								$("#clientDt").focus();
								loadRetTrk();
								$('#fb').html(data);
							}
						});
					}else{
						alert("Fees can't be empty.");
						// $("#payfee").css("background","red");
						// $("#payfee").select();
						$("button").html("Save");
						//$("input[type=submit]").attr('value', 'Save');
					}
				}else{
						alert("Bar Code must be in 15 digits.");
						$("#barCd").css("background","red");
						$("#barCd").select();
						$("button").html("Save");
					}
			}else{
				alert("Fill all the Fields.");
				$("#clientDt").focus();
				$("button").html("Save");

				//$("input[type=submit]").attr('value', 'Save');
			}		
		//}	
	});
	// End Return Tracker

	// CNIC Masking
	//$("#barCd").mask('999999999999999');


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
	$("#clientDtUpd").change(function(){
		let retTypeUpdC = $("#retTypeUpd").val();
		let retTypeUpdCl =  $("#clientDtUpd").val();

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
		let clDtUpd = $("#clientDtUpd").val();
		let barCdUpd = $("#barCdUpd").val();
		let subDtUpd = $("#subDtUpd").val();
		let payfeeUpd = $("#payfeeUpd").val();
		let remUpd = $("#remUpd").val();

		// Special / Hidden Data in order to Save in Revenue Earned - Services
		let revEranedUpd = $("#earnedRevUpd").val();

		// var conf = confirm("Confirm Update this record ?");
		// if(conf == true){
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
							remUpd:remUpd,
							revEranedUpd:revEranedUpd
						},
						success : function(data){
							$("#fb").html(data);
							$("input[type=submit]").attr('value', 'Update');
							//alert('Record updated successfully.'); 
							//window.location.replace('index?page=nRetTrk');
							console.log(data);
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
		//}	
	});
	// End Return Tracker Updation

	// Start Date Wise Representative's Report
	$("#getRepData").click(function(e){
		e.preventDefault();
		let fd = $("#fd").val();
		let td = $("#td").val();
		// alert(fd + td);
		$.ajax({
			url : 'view/rdwftDet.php',
			type : 'POST',
			data : {
				fd:fd,
				td:td
			},
			success : function(data){
				$('#rdwftData').html(data);
			}
		});		
	});

	$('#hdDet').on('change',function(){
		let hdDet = $(this).val();
		
		$.ajax({
			url : 'view/ledBalDet.php',
			type : 'POST',
			data : $('#hdWDt').serialize(),

			success : function(data){
				//console.log(data);
				// $("#box").hide();
				console.log(data);
				$(".sDwAcc").html(data);
			}
		});
	});

	// Change fee Year in General Journal on Click
	$(document).on('blur','.feeYr', function(e){
		e.preventDefault();
		const feeYr = $(this).text();
		let id = $(this).closest('tr').children('td:eq(0)').text();

		if(confirm('Do you realy want to change the Year ?')){
			$.ajax({
				url: 'view/GenOps.php',
				type: 'POST',
				data: {
					id:id,
					feeyr:feeYr
				},

				success: function(data){
					localtion.href="http://localhost/sawrevataxsol28-05-2023/index?page=vgj"
					console.log(data);
					$('.GenJounMessage').html(data);
				}
			});
		}
	});

	$(document).on('change','.feetp', function(){
		let data = $(this).val();
		let dataArr = data.split('|');
		let id = dataArr[0];
		let feetpid = dataArr[1];
		let feetpname = dataArr[2];

		if(confirm('Do you realy want to change the Fees Type')){
			$.ajax({
				url: 'view/GenOps.php',
				type: 'POST',
				data: {
					id:id,
					feetpid:feetpid,
					feetpname:feetpname
				},

				success: function(data){
					// localtion.replace("http://localhost/sawrevataxsol28-05-2023/index?page=vgj");
					// console.log(data);
						$('.GenJounMessageSuccess').html(JSON.parse(data)).slideDown(1000).delay(2000).slideUp(1000);
				}
			});

			// alert(`id: ${id} feetpid: ${feetpid} & name: ${feetpname}`);
		}
	});

	// Change Debit Amount in General Journal on Click
	// $(document).on('blur','.drAmt', function(e){
	// 	e.preventDefault();
	// 	const drAmt = $(this).text();
	// 	let id = $(this).closest('tr').children('td:eq(0)').text();

	// 	if(confirm('Do you realy want to change the Debit Amount ?')){
	// 		$.ajax({
	// 			url: 'view/GenOps.php',
	// 			type: 'POST',
	// 			data: {
	// 				id:id,
	// 				drAmt:drAmt
	// 			},

	// 			success: function(data){
	// 				console.log(data);
	// 				$('.GenJounMessage').html(data);
	// 			}
	// 		});
	// 	}
	// });

	// Change Credit Amount in General Journal on Click
	// $(document).on('blur','.crAmt', function(e){
	// 	e.preventDefault();
	// 	const crAmt = $(this).text();
	// 	let id = $(this).closest('tr').children('td:eq(0)').text();
		
	// 	if(confirm('Do you realy want to change the Credit Amount ?')){
	// 		$.ajax({
	// 			url: 'view/GenOps.php',
	// 			type: 'POST',
	// 			data: {
	// 				id:id,
	// 				crAmt:crAmt
	// 			},

	// 			success: function(data){
	// 				console.log(data);
	// 				$('.GenJounMessage').html(data);
	// 			}
	// 		});
	// 	}
	// });


});




















