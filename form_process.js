	$(document).ready(function(){
		
		//Global constant declaration start
		const BASE_URL = "http://learning.dev2.gipl.inet/avadhesh_pal/wizard_form_module";
		const UNIQUE_USERNAME = "user_name";
		const UNIQUE_EMAIL = "email";
		const UNIQUE_PHONE = "phone";
		const UNIQUE_EMPLOYEE_ID = "employee_id";
		const UNIQUE_CARD_NUMBER = "card_num";
		const FORM_STEP_PERSONAL_INFO = "personal_info";
		const FORM_STEP_CONTACT_INFO = "contact_info";
		const FORM_STEP_OFFICIAL_INFO = "official_info";
		const FORM_STEP_PAYMENT_INFO = "payment_info";
		const FORM_STEP_ADDRESS_INFO = "address_info";
		const FORM_STEP_FORM_PREVIEW = "form_preview";
		const CANCLE_STATUS = "true";
		//Global constant declaration end
		
		
		
		
		
		//=====================================================================================
		//Employee personal info script start
			
				//Ajax request for unique username start
				$("#user_name").on("blur", function(){
						var error_flag = [];
						var user_name = $(this).val().trim();
						var valid_name = /^[A-Za-z0-9 _.-]+$/;
						var user_id = $("#user_id").val();
						
						if(user_name == ""){
							$("#user_name_error").text("Username is required");
							error_flag.push(1);
						}
						else{
							if(!valid_name.test(user_name)){
								$("#user_name_error").text("Invalid username");
								error_flag.push(1);
							}
							else{
								if(/^[0-9]*$/.test(user_name)){
									$("#user_name_error").text("Invalid username");
									error_flag.push(1);
								}
								else{
									$("#user_name_error").text("");
								}
							}
						}
						
								if(error_flag.length < 1){
									
										$.ajax({
												url: BASE_URL + "/duplicate_entry_check.php",
												type: "POST",
												data: {unique_entry_check: UNIQUE_USERNAME, id: user_id, user_name: user_name},
												contentType: "application/x-www-form-urlencoded",
												dataType: "json",
												beforeSend: function(){
													$("#loder_bg").fadeIn(300);
												},
												success: function(response){
													if(response.status == "Error"){
														$("#user_name_error").text(response.message);
													}
													else{
														$("#user_name_error").text("");
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
				});
				//Ajax request for unique username end
				
				
				
				
				
				
				//Ajax request for insert / update employee personal info data start
				$("#submit").click(function(e){
						e.preventDefault();
						var personal_info = $("#personal_info_form").serialize();
						var user_id = $("#user_id").val();
						var official_info_edit_status = $("#official_info_edit_status").val();
						var payment_info_edit_status = $("#payment_info_edit_status").val();
						var address_info_edit_status = $("#address_info_edit_status").val();
						
						//Form validation start
						var error_flag = [];
						var fname = $("#fname").val().trim();
						var valid_name = /^[A-Za-z0-9 _.-]+$/;
						var lname = $("#lname").val().trim();
						var dob = $("#dob").val().trim();
						var gender = $("#gender").val();
						var user_name = $("#user_name").val().trim();
						var password = $("#password").val().replace(/ /g,'');
						var confirm_password = $("#confirm_password").val().replace(/ /g,'');
						
						if(fname == ""){
							$("#fname_error").text("First name is required");
							error_flag.push(1);
						}
						else{
							if(!valid_name.test(fname)){
								$("#fname_error").text("Invalid first name");
								error_flag.push(1);
							}
							else{
								if(/^[0-9]*$/.test(fname)){
									$("#fname_error").text("Invalid first name");
									error_flag.push(1);
								}
								else{
									$("#fname_error").text("");
								}
							}
						}
						
						
						if(lname == ""){
							$("#lname_error").text("Last name is required");
							error_flag.push(1);
						}
						else{
							if(!valid_name.test(lname)){
								$("#lname_error").text("Invalid last name");
								error_flag.push(1);
							}
							else{
								if(/^[0-9]*$/.test(lname)){
									$("#lname_error").text("Invalid last name");
									error_flag.push(1);
								}
								else{
									$("#lname_error").text("");
								}
							}
						}
						
						
						if(user_name == ""){
							$("#user_name_error").text("Username is required");
							error_flag.push(1);
						}
						else{
							if(!valid_name.test(user_name)){
								$("#user_name_error").text("Invalid username");
								error_flag.push(1);
							}
							else{
								if(/^[0-9]*$/.test(user_name)){
									$("#user_name_error").text("Invalid username");
									error_flag.push(1);
								}
								else{
									$("#user_name_error").text("");
								}
							}
						}
						
						
						if(password == ""){
							$("#password_error").text("Password is required");
							error_flag.push(1);
						}
						else{
							if(password != "" && password.length != 4){
								$("#password_error").text("Invalid password");
								error_flag.push(1);
							}
							else{
								$("#password_error").text("");
							}
						}
						
						if(confirm_password == ""){
							$("#confirm_password_error").text("Confirm password is required");
							error_flag.push(1);
						}
						else{
							if(confirm_password != password){
								$("#confirm_password_error").text("Confirm password should be same as password");
								error_flag.push(1);
							}
							else{
								if(confirm_password.length != 4){
									$("#confirm_password_error").text("Invalid confirm password");
									error_flag.push(1);
								}
								else{
									$("#confirm_password_error").text("");
								}
							}
						}
						
						if(error_flag.length < 1){
							
								$.ajax({
										url: BASE_URL + "/duplicate_entry_check.php",
										type: "POST",
										data: {unique_entry_check: UNIQUE_USERNAME, id: user_id, user_name: user_name},
										contentType: "application/x-www-form-urlencoded",
										dataType: "json",
										beforeSend: function(){
											$("#loder_bg").fadeIn(300);
										},
										success: function(response){
													
											if(response.status == "Error"){
												$("#user_name_error").text(response.message);
											}
											else{
												$("#user_name_error").text("");
							
							
														$.ajax({
															url: BASE_URL + "/form_request.php",
															type: "POST",
															data: {form_data: personal_info, form_step: FORM_STEP_PERSONAL_INFO},
															contentType: "application/x-www-form-urlencoded",
															dataType: "json",
															beforeSend: function(){
																$("#loder_bg").fadeIn(300);
															},
															success: function(personal_info){
																if(personal_info.status == "Error"){
																	
																	if(personal_info.error.hasOwnProperty("fname_error")){
																		$("#fname_error").text(personal_info.msg.fname_error);
																	}
																	else{
																		$("#fname_error").text("");
																	}
																	
																	if(personal_info.error.hasOwnProperty("lname_error")){
																		$("#lname_error").text(personal_info.msg.lname_error);
																	}
																	else{
																		$("#lname_error").text("");
																	}
																	
																	if(personal_info.error.hasOwnProperty("password_error")){
																		$("#password_error").text(personal_info.msg.password_error);
																	}
																	else{
																		$("#password_error").text("");
																	}
																	
																	if(personal_info.error.hasOwnProperty("user_name_error")){
																		$("#user_name_error").text(personal_info.msg.user_name_error);
																	}
																	else{
																		$("#user_name_error").text("");
																	}
																}
																else{
																	window.location.href = "contact_info.php?id=" + personal_info.user_id + "&official_info_edit_status=" + official_info_edit_status + "&payment_info_edit_status=" + payment_info_edit_status + "&address_info_edit_status=" + address_info_edit_status;
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
				//Ajax request for insert / update employee personal info data end
			
		//Employee personal info script end
		//=====================================================================================
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//=====================================================================================
		//Employee contact info script start
		
				//Ajax request for unique email start
				$("#email").on("blur", function(){
						var error_flag = [];
						var email = $(this).val().trim();
						var valid_email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
						var user_id = $("#user_id").val();
						
						if(email == ""){
							$("#email_error").text("Email is required");
							error_flag.push(1);
						}
						else{
							if(!valid_email.test(email)){
								$("#email_error").text("Invalid email");
								error_flag.push(1);
							}
							else{
								$("#email_error").text("");
							}
						}
						
								if(error_flag.length < 1){
									
										$.ajax({
												url: BASE_URL + "/duplicate_entry_check.php",
												type: "POST",
												data: {unique_entry_check: UNIQUE_EMAIL, id: user_id, email: email},
												contentType: "application/x-www-form-urlencoded",
												dataType: "json",
												beforeSend: function(){
													$("#loder_bg").fadeIn(300);
												},
												success: function(response){
													
													if(response.status == "Error"){
														$("#email_error").text(response.message);
													}
													else{
														$("#email_error").text("");
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
				});
				//Ajax request for unique email end
		
		
		
		
		
				
				
				//Ajax request for unique phone number start
				$("#phone").on("blur", function(){
						var error_flag = [];
						var phone = $(this).val().trim();
						var country_code = $("#country_code").val();
						var valid_phone_number = /^\d{10}$/;
						var user_id = $("#user_id").val();
						
						if(phone == ""){
							$("#phone_error").text("Phone number is required");
							error_flag.push(1);
						}
						else{
							if(!valid_phone_number.test(phone)){
								$("#phone_error").text("Invalid phone number");
								error_flag.push(1);
							}
							else{
								$("#phone_error").text("");
							}
						}
						
								if(error_flag.length < 1){
									
										$.ajax({
												url: BASE_URL + "/duplicate_entry_check.php",
												type: "POST",
												data: {unique_entry_check: UNIQUE_PHONE, id: user_id, country_code: country_code, phone: phone},
												contentType: "application/x-www-form-urlencoded",
												dataType: "json",
												beforeSend: function(){
													$("#loder_bg").fadeIn(300);
												},
												success: function(response){
													
													if(response.status == "Error"){
														$("#phone_error").text(response.message);
													}
													else{
														$("#phone_error").text("");
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
				});
				//Ajax request for unique phone number end
		
		
		
		
		
				
				//Ajax request for update employee contact info data start
				$("#submit1").click(function(e){
						e.preventDefault();
						var contact_info = $("#contact_info_form").serialize();
						var user_id = $("#user_id").val();
						var official_info_edit_status = $("#official_info_edit_status").val();
						var payment_info_edit_status = $("#payment_info_edit_status").val();
						var address_info_edit_status = $("#address_info_edit_status").val();
						
						//Form validation start
						var error_flag = [];
						var email = $("#email").val().replace(/ /g,'');
						var valid_email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
						var country_code = $("#country_code").val();
						var phone = $("#phone").val().replace(/ /g,'');
						var valid_phone_number = /^\d{10}$/;
						var address = $("#address").val().trim();
						var country = $("#country").val().trim();
						
						if(email == ""){
							$("#email_error").text("Email is required");
							error_flag.push(1);
						}
						else{
							if(!valid_email.test(email)){
								$("#email_error").text("Invalid email");
								error_flag.push(1);
							}
							else{
								$("#email_error").text("");
							}
						}
						
						if(country_code == ""){
							$("#country_code_error").text("Please select country code");
							error_flag.push(1);
						}
						else{
							$("#country_code_error").text("");
						}
						
						if(phone == ""){
							$("#phone_error").text("Phone number is required");
							error_flag.push(1);
						}
						else{
							if(!valid_phone_number.test(phone)){
								$("#phone_error").text("Invalid phone number");
								error_flag.push(1);
							}
							else{
								$("#phone_error").text("");
							}
						}
						
						if(address == ""){
							$("#address_error").text("Address is required");
							error_flag.push(1);
						}
						else{
							if(/^[0-9]*$/.test(address)){
								$("#address_error").text("Invalid address");
								error_flag.push(1);
							}
							else{
								if(/[`!@#$%^&*()_+\=\[\]{};':"\\|<>\/?~]/.test(address)){
									$("#address_error").text("Invalid address");
									error_flag.push(1);
								}
								else{
									$("#address_error").text("");
								}
							}
						}
						
						if(country == ""){
							$("#country_error").text("Country is required");
							error_flag.push(1);
						}
						else{
							$("#country_error").text("");
						}
						
						
						if(error_flag.length < 1){
							
								
								$.ajax({
									url: BASE_URL + "/duplicate_entry_check.php",
									type: "POST",
									data: {unique_entry_check: UNIQUE_EMAIL, id: user_id, email: email},
									contentType: "application/x-www-form-urlencoded",
									dataType: "json",
									beforeSend: function(){
										$("#loder_bg").fadeIn(300);
									},
									success: function(response){
													
										if(response.status == "Error"){
											$("#email_error").text(response.message);
										}
										else{
											$("#email_error").text("");
											
											
											
											$.ajax({
												url: BASE_URL + "/duplicate_entry_check.php",
												type: "POST",
												data: {unique_entry_check: UNIQUE_PHONE, id: user_id, country_code: country_code, phone: phone},
												contentType: "application/x-www-form-urlencoded",
												dataType: "json",
												beforeSend: function(){
													$("#loder_bg").fadeIn(300);
												},
												success: function(response){
													
													if(response.status == "Error"){
														$("#phone_error").text(response.message);
													}
													else{
														$("#phone_error").text("");
								
								
							
																	$.ajax({
																			url: BASE_URL + "/form_request.php",
																			type: "POST",
																			data: {form_data: contact_info, form_step: FORM_STEP_CONTACT_INFO},
																			contentType: "application/x-www-form-urlencoded",
																			dataType: "json",
																			beforeSend: function(){
																				$("#loder_bg").fadeIn(300);
																			},
																			success: function(contact_info){
																				
																				if(contact_info.status == "Error"){
																					
																					if(contact_info.error.hasOwnProperty("email_error")){
																						$("#email_error").text(contact_info.error.email_error);
																					}
																					else{
																						$("#email_error").text("");
																					}
																					
																					if(contact_info.error.hasOwnProperty("country_code_error")){
																						$("#country_code_error").text(contact_info.error.country_code_error);
																					}
																					else{
																						$("#country_code_error").text("");
																					}
																					
																					if(contact_info.error.hasOwnProperty("phone_error")){
																						$("#phone_error").text(contact_info.error.phone_error);
																					}
																					else{
																						$("#phone_error").text("");
																					}
																					
																					if(contact_info.error.hasOwnProperty("address_error")){
																						$("#address_error").text(contact_info.error.address_error);
																					}
																					else{
																						$("#address_error").text("");
																					}
																					
																					if(contact_info.error.hasOwnProperty("country_error")){
																						$("#country_error").text(contact_info.error.country_error);
																					}
																					else{
																						$("#country_error").text("");
																					}
																					
																				}
																				else{
																					window.location.href = "official_info.php?id=" + contact_info.user_id + "&official_info_edit_status=" + official_info_edit_status + "&payment_info_edit_status=" + payment_info_edit_status + "&address_info_edit_status=" + address_info_edit_status;
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
								}
							});
																
						}
						//Form validation end
				});
				//Ajax request for update employee contact info data end
				
		//Employee contact info script end
		//=====================================================================================
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//=====================================================================================
		//Employee official info script start
		
				//Ajax request for unique employee id start
				$("#employee_id").on("blur", function(){
						var error_flag = [];
						var employee_id = $(this).val().replace(/ /g,'');
						var valid_value = /^[A-Za-z0-9 _.-]+$/;
						var user_id = $("#user_id").val();
						
						if(employee_id == ""){
							$("#employee_id_error").text("Employee id is required");
							error_flag.push(1);
						}
						else{
							if(!valid_value.test(employee_id)){
								$("#employee_id_error").text("Invalid employee id");
								error_flag.push(1);
							}
							else{
								if(employee_id.length != 10){
									$("#employee_id_error").text("Employee id length should be 10 characters");
									error_flag.push(1);
								}
								else{
									$("#employee_id_error").text("");
								}
							}
						}
						
								if(error_flag.length < 1){
									
										$.ajax({
												url: BASE_URL + "/duplicate_entry_check.php",
												type: "POST",
												data: {unique_entry_check: UNIQUE_EMPLOYEE_ID, id: user_id, employee_id: employee_id},
												contentType: "application/x-www-form-urlencoded",
												dataType: "json",
												beforeSend: function(){
													$("#loder_bg").fadeIn(300);
												},
												success: function(response){
													
													if(response.status == "Error"){
														$("#employee_id_error").text(response.message);
													}
													else{
														$("#employee_id_error").text("");
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
				});
				//Ajax request for unique employee id end
				
				
				
				
				
				
				
				
				
				//Ajax request for update employee official info data start
				$("#submit2").click(function(e){
						e.preventDefault();
						var official_info = $("#official_info_form").serialize();
						var user_id = $("#user_id").val();
						var official_info_edit_status = $("#official_info_edit_status").val();
						var payment_info_edit_status = $("#payment_info_edit_status").val();
						var address_info_edit_status = $("#address_info_edit_status").val();
						
						//Form validation start
						var error_flag = [];
						var employee_id = $("#employee_id").val().replace(/ /g,'');
						var valid_value = /^[A-Za-z0-9 _.-]+$/;
						var designation = $("#designation").val().trim();
						var department = $("#department").val().trim();
						var working_hours = $("#working_hours").val().replace(/ /g,'');
						
						
						if(employee_id == ""){
							$("#employee_id_error").text("Employee id is required");
							error_flag.push(1);
						}
						else{
							if(!valid_value.test(employee_id)){
								$("#employee_id_error").text("Invalid employee id");
								error_flag.push(1);
							}
							else{
								if(employee_id.length != 10){
									$("#employee_id_error").text("Employee id length should be 10 characters");
									error_flag.push(1);
								}
								else{
									$("#employee_id_error").text("");
								}
							}
						}
						
						
						if(designation == ""){
							$("#designation_error").text("Designation is required");
							error_flag.push(1);
						}
						else{
							if(!valid_value.test(designation)){
								$("#designation_error").text("Invalid designation");
								error_flag.push(1);
							}
							else{
								if(/^[0-9]*$/.test(designation)){
									$("#designation_error").text("Invalid designation");
									error_flag.push(1);
								}
								else{
									$("#designation_error").text("");
								}
							}
						}
						
						
						if(department == ""){
							$("#department_error").text("Department is required");
							error_flag.push(1);
						}
						else{
							if(!valid_value.test(department)){
								$("#department_error").text("Invalid department");
								error_flag.push(1);
							}
							else{
								if(/^[0-9]*$/.test(department)){
									$("#department_error").text("Invalid department");
									error_flag.push(1);
								}
								else{
									$("#department_error").text("");
								}
							}
						}
						
						
						if(working_hours == ''){
							$("#working_hours_error").text("Working hours is required");
						}
						else{
							if(!/^[0-9]*$/.test(working_hours)){
								$("#working_hours_error").text("Only numeric characters allowed");
							}
							else{
								if(working_hours.length > 2){
									$("#working_hours_error").text("Maximum length should be 2 characters");
								}
								else{
									$("#working_hours_error").text("");
								}
							}
						}
						
						
						if(error_flag.length < 1){
							
								
								$.ajax({
									url: BASE_URL + "/duplicate_entry_check.php",
									type: "POST",
									data: {unique_entry_check: UNIQUE_EMPLOYEE_ID, id: user_id, employee_id: employee_id},
									contentType: "application/x-www-form-urlencoded",
									dataType: "json",
									beforeSend: function(){
										$("#loder_bg").fadeIn(300);
									},
									success: function(response){
													
										if(response.status == "Error"){
											$("#employee_id_error").text(response.message);
										}
										else{
											$("#employee_id_error").text("");
							
									
														$.ajax({
																url: BASE_URL + "/form_request.php",
																type: "POST",
																data: {form_data: official_info, form_step: FORM_STEP_OFFICIAL_INFO},
																contentType: "application/x-www-form-urlencoded",
																dataType: "json",
																beforeSend: function(){
																	$("#loder_bg").fadeIn(300);
																},
																success: function(official_info){
																	
																	if(official_info.status == "Error"){
																		
																		if(official_info.error.hasOwnProperty("employee_id_error")){
																			$("#employee_id_error").text(official_info.error.employee_id_error);
																		}
																		else{
																			$("#employee_id_error").text("");
																		}
																		
																		if(official_info.error.hasOwnProperty("designation_error")){
																			$("#designation_error").text(official_info.error.designation_error);
																		}
																		else{
																			$("#designation_error").text("");
																		}
																		
																		if(official_info.error.hasOwnProperty("department_error")){
																			$("#department_error").text(official_info.error.department_error);
																		}
																		else{
																			$("#department_error").text("");
																		}
																		
																		if(official_info.error.hasOwnProperty("working_hours_error")){
																			$("#working_hours_error").text(official_info.error.working_hours_error);
																		}
																		else{
																			$("#working_hours_error").text("");
																		}
																		
																	}
																	else{
																		window.location.href = "payment_info.php?id=" + official_info.user_id + "&payment_info_edit_status=" + payment_info_edit_status + "&address_info_edit_status=" + address_info_edit_status;
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
				//Ajax request for update employee official info data end
				
		//Employee official info script end
		//=====================================================================================
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//=====================================================================================
		//Employee Payment info script start
		
				//Ajax request for unique card number start
				$("#card_number").on("blur", function(){
						var error_flag = [];
						var card_number = $(this).val().trim();
						var valid_card_number = /^\d{10}$/;
						var user_id = $("#user_id").val();
						
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
												data: {unique_entry_check: UNIQUE_CARD_NUMBER, id: user_id, card_number: card_number},
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
				});
				//Ajax request for unique card number end
		
		
		
		
		
		
		
		
		
				//Ajax request for update employee payment info data start
				$("#submit3").click(function(e){
						e.preventDefault();
						var payment_info = $("#payment_info_form").serialize();
						var user_id = $("#user_id").val();
						var payment_info_edit_status = $("#payment_info_edit_status").val();
						var address_info_edit_status = $("#address_info_edit_status").val();
						
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
										data: {unique_entry_check: UNIQUE_CARD_NUMBER, id: user_id, card_number: card_number},
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
																	type: "POST",
																	data: {form_data: payment_info, form_step: FORM_STEP_PAYMENT_INFO},
																	contentType: "application/x-www-form-urlencoded",
																	dataType: "json",
																	beforeSend: function(){
																		$("#loder_bg").fadeIn(300);
																	},
																	success: function(payment_info){
																		
																		if(payment_info.status == "Error"){
																			if(payment_info.error.hasOwnProperty("bank_name_error")){
																				$("#bank_name_error").text(payment_info.error.bank_name_error);
																			}
																			else{
																				$("#bank_name_error").text("");
																			}
																			
																			if(payment_info.error.hasOwnProperty("holder_name_error")){
																				$("#holder_name_error").text(payment_info.error.holder_name_error);
																			}
																			else{
																				$("#holder_name_error").text("");
																			}
																			
																			if(payment_info.error.hasOwnProperty("card_number_error")){
																				$("#card_number_error").text(payment_info.error.card_number_error);
																			}
																			else{
																				$("#card_number_error").text("");
																			}
																			
																			if(payment_info.error.hasOwnProperty("cvc_number_error")){
																				$("#cvc_error").text(payment_info.error.cvc_number_error);
																			}
																			else{
																				$("#cvc_error").text("");
																			}
																		}
																		else{
																			window.location.href = "address_info.php?id=" + payment_info.user_id + "&address_info_edit_status=" + address_info_edit_status;
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
				//Ajax request for update employee payment info data end
		
		//Employee payment info script end
		//=====================================================================================
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//=====================================================================================
		//Employee address info script start
				
				//Ajax request to get state start
				$("#country_add").on("change", function(){
					var country_id = $(this).val();
					$("#city").html('<option value=""> -- Select City -- </option>');
					$("#state").html('<option value=""> -- Select State -- </option>');
					if(country_id == ''){
							Swal.fire({
								title: 'Error!',
								text: "Something went wrong!",
								icon: 'error',
								confirmButtonText: 'Ok'
							})
					}
					else{
						$.ajax({
							url: BASE_URL + "/global_function.php",
							type: "GET",
							data: {country_id: country_id},
							contentType: "application/x-www-form-urlencoded",
							dataType: "html",
							beforeSend: function(){
								$("#loder_bg").fadeIn(300);
							},
							success: function(state){
								if(state == ''){
									$("#state").html('<option value=""> -- Select State -- </option>');
								}
								else{
									$("#state").html(state);
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
				});
				//Ajax request to get state end
				
				
				
				
				
				
				//Ajax request to get city start
				$("#state").on("change", function(){
					var state_id = $(this).val();
					if(state_id == ''){
						$("#city").html('<option value=""> -- Select City -- </option>');
							Swal.fire({
								title: 'Error!',
								text: "Something went wrong!",
								icon: 'error',
								confirmButtonText: 'Ok'
							})
					}
					else{
						$.ajax({
							url: BASE_URL + "/global_function.php",
							type: "GET",
							data: {state_id: state_id},
							contentType: "application/x-www-form-urlencoded",
							dataType: "html",
							beforeSend: function(){
								$("#loder_bg").fadeIn(300);
							},
							success: function(city){
								if(city == ''){
									$("#city").html('<option value=""> -- Select City -- </option>');
								}
								else{
									$("#city").html(city);
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
				});
				//Ajax request to get city end
				
				
				
				
				
				
				//Ajax request for update employee address info data start
				$("#submit4").click(function(e){
						e.preventDefault();
						var address_info = $("#address_info_form").serialize();
						var user_id = $("#user_id").val();
						var address_info_edit_status = $("#address_info_edit_status").val();
						
						//Form validation start
						var error_flag = [];
						var country = $("#country_add").val();
						var state = $("#state").val();
						var city = $("#city").val();
						var pin_code = $("#pin_code").val().replace(/ /g,'');
						var valid_pin_code = /^\d{6}$/;
						var address = $("#address").val().trim();
						
						if(country == ""){
							$("#country_add_error").text("Country is required");
							error_flag.push(1);
						}
						else{
							$("#country_add_error").text("");
						}
						
						if(state == ""){
							$("#state_error").text("State is required");
							error_flag.push(1);
						}
						else{
							$("#state_error").text("");
						}
						
						if(city == ""){
							$("#city_error").text("City is required");
							error_flag.push(1);
						}
						else{
							$("#city_error").text("");
						}
						
						if(pin_code == ""){
							$("#pin_code_error").text("Pin code is required");
							error_flag.push(1);
						}
						else{
							if(!valid_pin_code.test(pin_code)){
								$("#pin_code_error").text("Invalid pin code");
								error_flag.push(1);
							}
							else{
								$("#pin_code_error").text("");
							}
						}
						
						
						if(address == ""){
							$("#address_error").text("Address is required");
							error_flag.push(1);
						}
						else{
							if(/^[0-9]*$/.test(address)){
								$("#address_error").text("Invalid address");
								error_flag.push(1);
							}
							else{
								if(/[`!@#$%^&*()_+\=\[\]{};':"\\|<>\/?~]/.test(address)){
									$("#address_error").text("Invalid address");
									error_flag.push(1);
								}
								else{
									$("#address_error").text("");
								}
							}
						}
						
						
						
						
						if(error_flag.length < 1){
							
								$.ajax({
										url: BASE_URL + "/form_request.php",
										type: "POST",
										data: {form_data: address_info, form_step: FORM_STEP_ADDRESS_INFO},
										contentType: "application/x-www-form-urlencoded",
										dataType: "json",
										beforeSend: function(){
											$("#loder_bg").fadeIn(300);
										},
										success: function(address_info){
											if(address_info.status == "Error"){
												
												if(address_info.error.hasOwnProperty("country_add_error")){
													$("#country_add_error").text(address_info.error.country_add_error);
												}
												else{
													$("#country_add_error").text("");
												}
												
												if(address_info.error.hasOwnProperty("state_error")){
													$("#state_error").text(address_info.error.state_error);
												}
												else{
													$("#state_error").text("");
												}
												
												if(address_info.error.hasOwnProperty("city_error")){
													$("#city_error").text(address_info.error.city_error);
												}
												else{
													$("#city_error").text("");
												}
												
												if(address_info.error.hasOwnProperty("pin_code_error")){
													$("#pin_code_error").text(address_info.error.pin_code_error);
												}
												else{
													$("#pin_code_error").text("");
												}
												
											}
											else{
												window.location.href = "form_preview.php?id=" + address_info.user_id;
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
						//Form validation end
				});
				//Ajax request for update employee address info data end
				
				
				
				
		//Employee address info script end
		//=====================================================================================
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//=====================================================================================
		//Form preview script start
		
				//Ajax request for confirm details start
				$("#submit5").click(function(e){
						e.preventDefault();
						var form_preview_data = $("#preview_form").serialize();
						
						if(user_id == ""){
							Swal.fire({
								title: 'Error!',
								text: "Something went wrong",
								icon: 'error',
								confirmButtonText: 'Ok'
							})
						}
						else{
							$.ajax({
									url: BASE_URL + "/form_request.php",
										contentType: "application/x-www-form-urlencoded",
										data: {form_data: form_preview_data, form_step: FORM_STEP_FORM_PREVIEW},
										dataType: "json",
										beforeSend: function(){
											$("#loder_bg").fadeIn(300);
										},
										success: function(response){
											if(response.status == "Success"){
												
													Swal.fire({
															 position: 'top-end',
															 icon: 'success',
															 title: response.message,
															 showConfirmButton: false,
															 timer: 1500
													}).then(function(){
														window.location.href = "list.php?page_num=1";
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
				});
				//Ajax request for confirm details end
				
				
				
				
				
				
				//Ajax request for cancle process start
				$("#cancle").click(function(e){
						e.preventDefault();
						var form_preview_data = $("#preview_form").serialize();
						
						if(user_id == ""){
							Swal.fire({
								title: 'Error!',
								text: "Something went wrong",
								icon: 'error',
								confirmButtonText: 'Ok'
							})
						}
						else{
							$.ajax({
									url: BASE_URL + "/form_request.php",
										contentType: "application/x-www-form-urlencoded",
										data: {form_data: form_preview_data, form_step: FORM_STEP_FORM_PREVIEW, cancle_status: CANCLE_STATUS},
										dataType: "json",
										beforeSend: function(){
											$("#loder_bg").fadeIn(300);
										},
										success: function(response){
											
											if(response.status == "Success"){
													Swal.fire({
															 position: 'top-end',
															 icon: 'success',
															 title: response.message,
															 showConfirmButton: false,
															 timer: 1500
													}).then(function(){
														window.location.href = "personal_info.php";
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
				});
				//Ajax request for cancle process end
				
				
		//Form preview script end
		//=====================================================================================
		
	});
