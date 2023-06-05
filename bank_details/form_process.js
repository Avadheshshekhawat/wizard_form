	$(document).ready(function(){
		const BASE_URL = "http://learning.dev2.gipl.inet/avadhesh_pal/wizard_form_module";
		const UNIQUE_CARD_NUMBER = "card_num";
		const ADD_BANK = "add_bank";
		
		//Ajax request for unique card number start
				$("#card_number").on("blur", function(){
						var error_flag = [];
						var card_number = $(this).val().trim();
						var valid_card_number = /^\d{10}$/;
						var user_id = $("#user_id").val();
						var main_id = $("#main_id").val();
						console.log(main_id);
						
						if(card_number == ""){
							$("#card_number_error").text("Card number is required");
							error_flag.push(1);
						}
						else{
							if(!valid_card_number.test(card_number)){
								$("#card_number_error").text("Invalid card number");
								error_flag.push(1);
							}
							else{
								$("#card_number_error").text("");
							}
						}
						
								if(error_flag.length < 1){
									
										$.ajax({
												url: BASE_URL + "/duplicate_entry_check.php",
												type: "POST",
												data: {unique_entry_check: UNIQUE_CARD_NUMBER, main_id: main_id, card_number: card_number},
												contentType: "application/x-www-form-urlencoded",
												dataType: "json",
												beforeSend: function(){
													$("#loder_bg1").fadeIn(300);
												},
												success: function(response){
													
													if(response.status == "Error"){
														$("#card_number_error").text(response.message);
														$("#submit").attr("disabled", true);
													}
													else{
														$("#card_number_error").text("");
														$("#submit").attr("disabled", false);
													}
												},
												error: function(xhr){
													Swal.fire({
														title: 'Error!',
														text: "Error: " + xhr.status + " " + xhr.statusText,
														icon: 'error',
														confirmButtonText: 'Ok'
													})
												},
												complete: function(){
													$("#loder_bg1").fadeOut(300);
												}
										});
									
								}
				});
				//Ajax request for unique card number end
		
		
			
		//Ajax request for insert bank details start
			$("#submit").click(function(e){
				e.preventDefault();
				var add_bank = $("#add_bank_form").serialize();
				var user_id = $("#user_id").val();
				var main_id = $("#main_id").val();
				var user_status = $("#user_status").val();
				var user_is_deleted = $("#user_is_deleted").val();
				
				//Form validation start
					var error_flag = [];
					var bank_name = $("#bank_name").val().trim();
					var valid_bank_name = /^[a-zA-Z ]*$/;
					var holder_name = $("#holder_name").val().trim();
					var valid_name = /^[A-Za-z0-9 _.-]+$/;
					var card_number = $("#card_number").val().replace(/ /g,'');
					var valid_card_number = /^\d{10}$/;
					var cvc = $("#cvc").val().replace(/ /g,'');
					var valid_cvc_number = /^\d{3}$/;
					
					if(bank_name == ''){
						$("#bank_name_error").text("Bank name is required");
						error_flag.push(1);
					}
					else{
						if(!valid_bank_name.test(bank_name)){
							$("#bank_name_error").text("Invalid bank name");
							error_flag.push(1);
						}
						else{
							$("#bank_name_error").text("");
						}
					}
						
					if(holder_name == ""){
						$("#holder_name_error").text("Holder name is required");
						error_flag.push(1);
					}
					else{
						if(!valid_name.test(holder_name)){
							$("#holder_name_error").text("Invalid holder name");
							error_flag.push(1);
						}
						else{
							if(/^[0-9]*$/.test(holder_name)){
								$("#holder_name_error").text("Invalid holder name");
							}
							else{
								$("#holder_name_error").text("");
							}
						}
					}
						
					if(card_number == ""){
						$("#card_number_error").text("Card number is required");
						error_flag.push(1);
					}
					else{
						if(!valid_card_number.test(card_number)){
							$("#card_number_error").text("Invalid card number");
							error_flag.push(1);
						}
						else{
							$("#card_number_error").text("");
						}
					}
						
					if(cvc == ""){
						$("#cvc_error").text("CVC number is required");
						error_flag.push(1);
					}
					else{
						if(!valid_cvc_number.test(cvc)){
							$("#cvc_error").text("Invalid CVC number");
							error_flag.push(1);
						}
						else{
							$("#cvc_error").text("");
						}
					}
						
					if(error_flag.length < 1){
							
							
								$.ajax({
										url: BASE_URL + "/duplicate_entry_check.php",
										type: "POST",
										data: {unique_entry_check: UNIQUE_CARD_NUMBER, main_id: main_id, card_number: card_number},
										contentType: "application/x-www-form-urlencoded",
										dataType: "json",
										beforeSend: function(){
											$("#loder_bg").fadeIn(300);
										},
										success: function(response){
													
											if(response.status == "Error"){
												$("#card_number_error").text(response.message);
											}
											else{
												$("#card_number_error").text("");
							
							
							
															$.ajax({
																	url: BASE_URL + "/form_request.php",
																	data: {form_data: add_bank, form_step: ADD_BANK},
																	type: "POST",
																	contentType: "application/x-www-form-urlencoded",
																	dataType: "json",
																	beforeSend: function(){
																		$("#loder_bg").fadeIn(300);
																	},
																	success: function(add_bank){
																		
																		if(add_bank.status == "Error"){
																			console.log(add_bank);
																			if(add_bank.error.hasOwnProperty("bank_name_error")){
																				$("#bank_name_error").text(add_bank.error.bank_name_error);
																			}
																			else{
																				$("#bank_name_error").text("");
																			}
																			
																			if(add_bank.error.hasOwnProperty("holder_name_error")){
																				$("#holder_name_error").text(add_bank.error.holder_name_error);
																			}
																			else{
																				$("#holder_name_error").text("");
																			}
																			
																			if(add_bank.error.hasOwnProperty("card_number_error")){
																				$("#card_number_error").text(add_bank.error.card_number_error);
																			}
																			else{
																				$("#card_number_error").text("");
																			}
																			
																			if(add_bank.error.hasOwnProperty("cvc_number_error")){
																				$("#cvc_error").text(add_bank.error.cvc_number_error);
																			}
																			else{
																				$("#cvc_error").text("");
																			}
																		}
																		else{
																			Swal.fire({
																					 position: 'top-end',
																					 icon: 'success',
																					 title: add_bank.message,
																					 showConfirmButton: false,
																					 timer: 1500
																			}).then(function(){
																				window.location.href = "list.php?page_num=1&id=" + user_id + "&user_status="+ user_status + "&user_is_deleted="+ user_is_deleted;
																			});
																		}
																	},
																	error: function(xhr){
																		Swal.fire({
																			title: 'Error!',
																			text: "Error: " + xhr.status + " " + xhr.statusText,
																			icon: 'error',
																			confirmButtonText: 'Ok'
																		})
																	},
																	complete: function(){
																		$("#loder_bg").fadeOut(300);
																	}
															});
												
											}
										}
									});			
											
						}
				//Form validation end
			});
		//Ajax request for insert bank details end
			
	});
