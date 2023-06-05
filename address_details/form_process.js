		$(document).ready(function(){
				const BASE_URL = "http://learning.dev2.gipl.inet/avadhesh_pal/wizard_form_module";
				const ADD_ADDRESS = "add_address";
				
				//Ajax request to fetch states start
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
				//Ajax request to fetch states end
				
				
				
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
				
				
				
				
				//Ajac request for add / update address details start
				$("#submit").click(function(e){
					e.preventDefault();
					var add_address = $("#add_address_form").serialize();
					console.log(add_address);
					var user_id = $("#user_id").val();
					var main_id = $("#main_id").val();
					var user_status = $("#user_status").val();
					var user_is_deleted = $("#user_is_deleted").val();
					console.log(user_status + " " + user_is_deleted);
					
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
										data: {form_data: add_address, form_step: ADD_ADDRESS},
										contentType: "application/x-www-form-urlencoded",
										dataType: "json",
										beforeSend: function(){
											$("#loder_bg").fadeIn(300);
										},
										success: function(add_address){
											if(add_address.status == "Error"){
												
												if(add_address.error.hasOwnProperty("country_add_error")){
													$("#country_add_error").text(add_address.error.country_add_error);
												}
												else{
													$("#country_add_error").text("");
												}
												
												if(add_address.error.hasOwnProperty("state_error")){
													$("#state_error").text(add_address.error.state_error);
												}
												else{
													$("#state_error").text("");
												}
												
												if(add_address.error.hasOwnProperty("city_error")){
													$("#city_error").text(add_address.error.city_error);
												}
												else{
													$("#city_error").text("");
												}
												
												if(add_address.error.hasOwnProperty("pin_code_error")){
													$("#pin_code_error").text(add_address.error.pin_code_error);
												}
												else{
													$("#pin_code_error").text("");
												}
												
											}
											else{
												Swal.fire({
														position: 'top-end',
														icon: 'success',
														title: add_address.message,
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
					//Form validation end
				});
				//Ajac request for add / update address details end
				
		});
