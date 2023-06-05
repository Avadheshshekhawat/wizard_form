<?php
							include_once "db_connection.php";
							include_once "global_constant.php";
							
							$data = array();
							
							if(!$connection){
								$data['connection_status'] = mysqli_connect_error();
							}
							else{
								$data['connection_status'] = "Database connected";
							}
							
						
						
							//Get data from ajax request start
							$get_form_step = (isset($_REQUEST['form_step'])) ? $_REQUEST['form_step'] : null;
							$get_form_data = (isset($_REQUEST['form_data'])) ? $_REQUEST['form_data'] : null;
							$form_data = array();
							parse_str($get_form_data, $form_data);
							//Get data from ajax request end
							
				
							
							$error_flag = array();
							$active_status = (defined('ACTIVE')) ? ACTIVE : null;
							$deactive_status = (defined('DEACTIVE')) ? DEACTIVE : null;
							$not_deleted = (defined('NOT_DELETED')) ? NOT_DELETED : null;
							$deleted = (defined('DELETED')) ? DELETED : null;
							$created = date("Y-m-d") ? date("Y-m-d") : null;
							$updated = date("Y-m-d") ? date("Y-m-d") : null;
							$user_id = (isset($form_data['user_id'])) ? $form_data['user_id'] : null;
							$main_id = (isset($form_data['main_id'])) ? $form_data['main_id'] : null;
							$column_values = "";
							$column_names = "";
							$table_name = "";
							$column_name_values = "";
							$message = "";
							$where_condition = "";
						
						
							
						
							//Switch case start
							switch($get_form_step){
								case FORM_STEP_PERSONAL_INFO:
									personal_info();
									break;
								
								case FORM_STEP_CONTACT_INFO:
									contact_info();
									break;
									
								case FORM_STEP_OFFICIAL_INFO:
									official_info();
									break;
									
								case FORM_STEP_PAYMENT_INFO:
									payment_info();
									break;
									
								case FORM_STEP_ADDRESS_INFO:
									address_info();
									break;
									
								case FORM_STEP_FORM_PREVIEW:
									form_preview();
									break;
									
								case ADD_BANK:
									add_update_bank();
									break;
									
								case ADD_ADDRESS:
									add_update_address();
									break;
									
								default:
									$data['default_case'] = "Something went wrong";
									break;
							}
							//Switch case end
						
							
						
						
						
						
						
						
						
						
						/*
						 * Name: personal_info()
						 * Description: Used to validate personal info form details
						 * Param:
						 * Return:
						 * Created on: 27-April-2023
						 * Created by: Avadhesh Shekhawat
						 */
						function personal_info(){
							global $connection;
							global $data;
							global $error_flag;
							global $user_id;
							global $column_values;
							global $column_names;
							global $column_name_values;
							global $table_name;
							global $form_data;
							global $deactive_status;
							global $deleted;
							global $created;
							global $where_condition;
							
							
							$fname = (isset($form_data['fname'])) ? $form_data['fname'] : null;
							$lname = (isset($form_data['lname'])) ? $form_data['lname'] : null;
							$dob = (isset($form_data['dob'])) ? $form_data['dob'] : null;
							$gender = (isset($form_data['gender'])) ? $form_data['gender'] : null;
							$user_name = (isset($form_data['user_name'])) ? $form_data['user_name'] : null;
							$password = (isset($form_data['password'])) ? $form_data['password'] : null;
							$confirm_password = (isset($form_data['confirm_password'])) ? $form_data['confirm_password'] : null;
							
							
							
							
							
								if(empty($fname)){
									$error_flag['fname_error'] = ERROR_MSG['fname1'];
								}
								else{
									if(!preg_match("/^[A-Za-z0-9 _.-]+$/", $fname)){
										$error_flag['fname_error'] = ERROR_MSG['fname2'];
									}
									else{
										if(preg_match("/^[0-9]*$/", $fname)){
											$error_flag['fname_error'] = ERROR_MSG['fname2'];
										}
										else{
											$first_name = strtolower($fname);
										}
									}
								}
								
								if(empty($lname)){
									$error_flag['lname_error'] = ERROR_MSG['lname1'];
								}
								else{
									if(!preg_match("/^[A-Za-z0-9 _.-]+$/", $lname)){
										$error_flag['lname_error'] = ERROR_MSG['lname2'];
									}
									else{
										if(preg_match("/^[0-9]*$/", $lname)){
											$error_flag['lname_error'] = ERROR_MSG['lname2'];
										}
										else{
											$last_name = strtolower($lname);
										}
									}
								}
								
								if(empty($user_name)){
									$error_flag['user_name_error'] = ERROR_MSG['user_name1'];
								}
								else{
									if(!preg_match("/^[A-Za-z0-9 _.-]+$/", $user_name)){
										$error_flag['user_name_error'] = ERROR_MSG['user_name2'];
									}
									else{
										if(preg_match("/^[0-9]*$/", $user_name)){
											$error_flag['user_name_error'] = ERROR_MSG['user_name2'];
										}
										else{
											$uname = strtolower($user_name);
										}
									}
								}
								
								if(empty($password)){
									$error_flag['password_error'] = ERROR_MSG['password1'];
								}
								else{
									if(strlen($password) != 4){
										$error_flag['password_error'] = ERROR_MSG['password2'];
									}
									else{
										$pswd = $password;
									}
								}
								
								if(empty($confirm_password)){
									$error_flag['confirm_password_error'] = ERROR_MSG['confirm_password1'];
								}
								else{
									if(strlen($confirm_password) != 4){
										$error_flag['confirm_password_error'] = ERROR_MSG['confirm_password2'];
									}
									else{
										if($confirm_password != $password){
											$error_flag['confirm_password_error'] = ERROR_MSG['confirm_password3'];
										}
										else{
											$confirm_pswd = $confirm_password;
										}
									}
								}
								
								
								if(empty($error_flag)){
										$data['status'] = "Success";
										$data['error'] = $error_flag;
										
										if(empty($user_id)){
											$column_names = "first_name, last_name, full_name, dob, gender, user_name, password, confirm_password, status, is_deleted, created";
											$column_values = "'$first_name', '$last_name', '$first_name $last_name', '$dob', '$gender', '$uname', '$pswd', '$confirm_pswd', '$deactive_status', '$deleted', '$created'";
											$table_name = "employee_detail_table";
											insert_query_function($column_names, $column_values, $table_name, $user_id, $message);
										}
										else{
											$column_name_values = "first_name = '$first_name', last_name = '$last_name', full_name = '$first_name $last_name', dob = '$dob', gender = '$gender', user_name = '$uname', password = '$pswd', confirm_password = '$confirm_pswd'";
											$table_name = "employee_detail_table";
											$where_condition = "user_id = '$user_id'";
											update_query_function($column_name_values, $table_name, $where_condition, $message);
										}
								}
								else{
									$data['status'] = "Error";
									$data['error'] = $error_flag;
								}
						}
			
			
			
			
			
			
						/*
						 * Name: contact_info()
						 * Description: Used to validate contact info form details
						 * Param:
						 * Return:
						 * Created on: 27-April-2023
						 * Created by: Avadhesh Shekhawat
						 */
						function contact_info(){
							global $connection;
							global $data;
							global $error_flag;
							global $user_id;
							global $column_name_values;
							global $table_name;
							global $form_data;
							global $where_condition;
							
							
							$email = (isset($form_data['email'])) ? $form_data['email'] : null;
							$country_code = (isset($form_data['country_code'])) ? $form_data['country_code'] : null;
							$phone = (isset($form_data['phone'])) ? $form_data['phone'] : null;
							$address = (isset($form_data['address'])) ? $form_data['address'] : null;
							$country = (isset($form_data['country'])) ? $form_data['country'] : null;
							
							
							
									if(empty($email)){
										$error_flag['email_error'] = ERROR_MSG['email1'];
									}
									else{
										if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
											$error_flag['email_error'] = ERROR_MSG['email2'];
										}
										else{
											$emal = strtolower($email);
										}
									}
									
									if(empty($country_code)){
										$error_flag['country_code_error'] = ERROR_MSG['country_code'];
									}
									else{
										$contry_code = $country_code;
									}
									
									if(empty($phone)){
										$error_flag['phone_error'] = ERROR_MSG['phone1'];
									}
									else{
										if(!preg_match('/^[0-9]{10}+$/', $phone)){
											$error_flag['phone_error'] = ERROR_MSG['phone2'];
										}
										else{
											$phone_num = $phone;
										}
									}
									
									if(empty($address)){
										$error_flag['address_error'] = ERROR_MSG['address1'];
									}
									else{
										if(preg_match('/^[0-9]*$/', $address)){
											$error_flag['address_error'] = ERROR_MSG['address2'];
										}
										else{
											$addr = strtolower($address);
										}
									}
									
									if(empty($country)){
										$error_flag['country_error'] = ERROR_MSG['country'];
									}
									else{
										$contry = strtolower($country);
									}
									
									
									
									if(empty($error_flag)){
										$data['status'] = "Success";
										$data['error'] = $error_flag;
										
											if(!empty($user_id)){
												$column_name_values = "email = '$emal', country_code = '$contry_code', phone = '$phone_num', full_phone_num = '$contry_code$phone_num', address = '$addr', country = '$contry'";
												$table_name = "employee_detail_table";
												$where_condition = "user_id = '$user_id'";
												update_query_function($column_name_values, $table_name, $where_condition, $message);
											}
											else{
												$data['status'] = "Error";
												$data['message'] = "User id not found";
											}
									}
									else{
										$data['status'] = "Error";
										$data['error'] = $error_flag;
									}
						}
						
						
						
						
						
						
						
						
						/*
						 * Name: official_info()
						 * Description: Used to validate official info form details
						 * Param:
						 * Return:
						 * Created on: 27-April-2023
						 * Created by: Avadhesh Shekhawat
						 */
						function official_info(){
							global $connection;
							global $data;
							global $error_flag;
							global $user_id;
							global $column_values;
							global $column_names;
							global $column_name_values;
							global $table_name;
							global $active_status;
							global $not_deleted;
							global $created;
							global $updated;
							global $form_data;
							global $where_condition;
							
							
							$employee_id = (isset($form_data['employee_id'])) ? $form_data['employee_id'] : null;
							$designation = (isset($form_data['designation'])) ? $form_data['designation'] : null;
							$department = (isset($form_data['department'])) ? $form_data['department'] : null;
							$working_hours = (isset($form_data['working_hours'])) ? $form_data['working_hours'] : null;
							$official_info_edit_status = (isset($form_data['official_info_edit_status'])) ? $form_data['official_info_edit_status'] : null;
					
							
									if(empty($employee_id)){
										$error_flag['employee_id_error'] = ERROR_MSG['employee_id1'];
									}
									else{
										if(!preg_match("/^[A-Za-z0-9 _.-]+$/", $employee_id)){
											$error_flag['employee_id_error'] = ERROR_MSG['employee_id2'];
										}
										else{
											$emp_id = strtolower($employee_id);
										}
									}
									
									if(empty($designation)){
										$error_flag['designation_error'] = ERROR_MSG['designation1'];
									}
									else{
										if(!preg_match("/^[A-Za-z0-9 _.-]+$/", $designation)){
											$error_flag['designation_error'] = ERROR_MSG['designation2'];
										}
										else{
											if(preg_match("/^[0-9]*$/", $designation)){
												$error_flag['designation_error'] = ERROR_MSG['designation2'];
											}
											else{
												$designaton = strtolower($designation);
											}
										}
									}
									
									if(empty($department)){
										$error_flag['department_error'] = ERROR_MSG['department1'];
									}
									else{
										if(!preg_match("/^[A-Za-z0-9 _.-]+$/", $department)){
											$error_flag['department_error'] = ERROR_MSG['department2'];
										}
										else{
											if(preg_match("/^[0-9]*$/", $department)){
												$error_flag['department_error'] = ERROR_MSG['department2'];
											}
											else{
												$departmnt = strtolower($department);
											}
										}
									}
									
									if(empty($working_hours)){
										$error_flag['working_hours_error'] = ERROR_MSG['working_hours1'];
									}
									else{
										if(!preg_match("/^[0-9]*$/", $working_hours)){
											$error_flag['working_hours_error'] = ERROR_MSG['working_hours2'];
										}
										else{
											if(strlen($working_hours) > 2){
												$error_flag['working_hours_error'] = ERROR_MSG['working_hours3'];
											}
											else{
												$work_hours = $working_hours;
											}
										}
									}	
									
									
									
									if(empty($error_flag)){
										$data['status'] = "Success";
										$data['error'] = $error_flag;
										
										if(!empty($user_id)){
											$column_name_values = "employee_id = '$emp_id', designation = '$designaton', department = '$departmnt', working_hour = '$work_hours'";
											$table_name = "employee_detail_table";
											$where_condition = "user_id = '$user_id'";
											update_query_function($column_name_values, $table_name, $where_condition, $message);
											
											if(empty($official_info_edit_status)){
												$column_names = "user_id, designation, department, working_hour, status, is_deleted, created";
												$column_values = "'$user_id', '$designaton', '$departmnt', '$work_hours', '$active_status', '$not_deleted', '$created'";
												$table_name = "employee_detail_history_table";
												insert_query_function($column_names, $column_values, $table_name, $user_id, $message);
											}
											else{
												$column_name_values = "designation = '$designaton', department = '$departmnt', working_hour = '$work_hours', updated = '$updated'";
												$table_name = "employee_detail_history_table";
												$where_condition = "user_id = '$user_id'";
												update_query_function($column_name_values, $table_name, $where_condition, $message);
											}
										}
										else{
											$data['status'] = "Error";
											$data['message'] = "User id not found";
										}
									}
									else{
										$data['status'] = "Error";
										$data['error'] = $error_flag;
									}
						}
						
						
						
						
						
						
						
						
						
						/*
						 * Name: payment_info()
						 * Description: Used to validate payment info form details
						 * Param:
						 * Return:
						 * Created on: 27-April-2023
						 * Created by: Avadhesh Shekhawat
						 */
						function payment_info(){
							global $connection;
							global $data;
							global $error_flag;
							global $user_id;
							global $column_values;
							global $column_names;
							global $column_name_values;
							global $table_name;
							global $active_status;
							global $not_deleted;
							global $created;
							global $updated;
							global $form_data;
							global $where_condition;
							
							$bank_name = (isset($form_data['bank_name'])) ? $form_data['bank_name'] : null;
							$holder_name = (isset($form_data['holder_name'])) ? $form_data['holder_name'] : null;
							$exp_date = (isset($form_data['exp_date'])) ? $form_data['exp_date'] : null;
							$payment_type = (isset($form_data['payment_type'])) ? $form_data['payment_type'] : null;
							$card_number = (isset($form_data['card_number'])) ? trim($form_data['card_number']) : null;
							$cvc = (isset($form_data['cvc'])) ? trim($form_data['cvc']) : null;
							$payment_info_edit_status = (isset($form_data['payment_info_edit_status'])) ? $form_data['payment_info_edit_status'] : null;
							
										if(empty($bank_name)){
											$error_flag['bank_name_error'] = ERROR_MSG['bank_name1'];
										}
										else{
											if(!preg_match("/^[a-zA-Z ]*$/", $bank_name)){
												$error_flag['bank_name_error'] = ERROR_MSG['bank_name2'];
											}
											else{
												$bank_nam = strtolower($bank_name);
											}
										}
										
										if(empty($holder_name)){
											$error_flag['holder_name_error'] = ERROR_MSG['holder_name1'];
										}
										else{
											if(!preg_match("/^[A-Za-z0-9 _.-]+$/", $holder_name)){
												$error_flag['holder_name_error'] = ERROR_MSG['holder_name2'];
											}
											else{
												if(preg_match("/^[0-9]*$/", $holder_name)){
													$error_flag['holder_name_error'] = ERROR_MSG['holder_name2'];
												}
												else{
													$holder_nam = strtolower($holder_name);
												}
											}
										}
										
										if(empty($card_number)){
											$error_flag['card_number_error'] = ERROR_MSG['card_number1'];
										}
										else{
											if(!preg_match('/^[0-9]{10}+$/', $card_number)){
												$error_flag['card_number_error'] = ERROR_MSG['card_number2'];
											}
											else{
												$card_num = $card_number;
											}
										}
										
										if(empty($cvc)){
											$error_flag['cvc_number_error'] = ERROR_MSG['cvc_number1'];
										}
										else{
											if(!preg_match('/^[0-9]{3}+$/', $cvc)){
												$error_flag['cvc_number_error'] = ERROR_MSG['cvc_number2'];
											}
											else{
												$cvc_num = $cvc;
											}
										}
										
										
										
										if(empty($error_flag)){
											$data['status'] = "Success";
											$data['error'] = $error_flag;
											
											if(!empty($user_id)){
												if(empty($payment_info_edit_status)){
													$column_names = "user_id, bank_name, holder_name, expiry_date, payment_type, card_num, cvc, status, is_deleted, created";
													$column_values = "'$user_id', '$bank_nam', '$holder_nam', '$exp_date', '$payment_type', '$card_num', '$cvc_num', '$active_status', '$not_deleted', '$created'";
													$table_name = "employee_bank_detail";
													insert_query_function($column_names, $column_values, $table_name, $user_id, $message);
												}
												else{
													$column_name_values = "bank_name = '$bank_nam', holder_name = '$holder_nam', expiry_date = '$exp_date', payment_type = '$payment_type', card_num = '$card_num', cvc = '$cvc_num', updated = '$updated'";
													$table_name = "employee_bank_detail";
													$where_condition = "user_id = '$user_id'";
													update_query_function($column_name_values, $table_name, $where_condition, $message);
												}
											}
											else{
												$data['status'] = "Error";
												$data['message'] = "User id not found";
											}
										}
										else{
											$data['status'] = "Error";
											$data['error'] = $error_flag;
										}
						}
						
						
						
						
						
						
						
						
						/*
						 * Name: address_info()
						 * Description: Used to validate address info form details
						 * Param:
						 * Return:
						 * Created on: 27-April-2023
						 * Created by: Avadhesh Shekhawat
						 */
						function address_info(){
							global $connection;
							global $data;
							global $error_flag;
							global $user_id;
							global $column_values;
							global $column_names;
							global $column_name_values;
							global $table_name;
							global $active_status;
							global $not_deleted;
							global $created;
							global $updated;
							global $form_data;
							global $where_condition;		
										
										
							$country_add = (isset($form_data['country_add'])) ? $form_data['country_add'] : null;
							$state = (isset($form_data['state'])) ? $form_data['state'] : null;
							$city = (isset($form_data['city'])) ? $form_data['city'] : null;
							$pin_code = (isset($form_data['pin_code'])) ? $form_data['pin_code'] : null;
							$address = (isset($form_data['address'])) ? $form_data['address'] : null;
							$address_info_edit_status = (isset($form_data['address_info_edit_status'])) ? $form_data['address_info_edit_status'] : null;
										
										
				
										if(empty($country_add)){
											$error_flag['country_add_error'] = ERROR_MSG['country'];
										}
										else{
											$contry_add = $country_add;
										}
										
										if(empty($state)){
											$error_flag['state_error'] = ERROR_MSG['state'];
										}
										else{
											$stat = strtolower($state);
										}
										
										if(empty($city)){
											$error_flag['city_error'] = ERROR_MSG['city'];
										}
										else{
											$cty = strtolower($city);
										}
										
										if(empty($pin_code)){
											$error_flag['pin_code_error'] = ERROR_MSG['pin_code1'];
										}
										else{
											if(!preg_match('/^[0-9]{6}+$/', $pin_code)){
												$error_flag['pin_code_error'] = ERROR_MSG['pin_code2'];
											}
											else{
												$pin_cod = $pin_code;
											}
										}
										
										if(empty($address)){
											$error_flag['address_error'] = ERROR_MSG['address1'];
										}
										else{
											if(preg_match('/^[0-9]*$/', $address)){
												$error_flag['address_error'] = ERROR_MSG['address2'];
											}
											else{
												$addr = strtolower($address);
											}
										}
										
										
										
										if(empty($error_flag)){
											$data['status'] = "Success";
											$data['error'] = $error_flag;
											
											
											if(!empty($user_id)){
												if(empty($address_info_edit_status)){
													$column_names = "user_id, country, state, city, pin, address, status, is_deleted, created";
													$column_values = "'$user_id', '$contry_add', '$stat', '$cty', '$pin_cod', '$addr', '$active_status', '$not_deleted', '$created'";
													$table_name = "employee_address_detail";
													insert_query_function($column_names, $column_values, $table_name, $user_id, $message);
												}
												else{
													$column_name_values = "country = '$contry_add', state = '$stat', city = '$cty', pin = '$pin_cod', address = '$addr', updated = '$updated'";
													$table_name = "employee_address_detail";
													$where_condition = "user_id = '$user_id'";
													update_query_function($column_name_values, $table_name, $where_condition, $message);
												}
											}
											else{
												$data['status'] = "Error";
												$data['message'] = "User id not found";
											}
										}
										else{
											$data['status'] = "Error";
											$data['error'] = $error_flag;
										}
						}
						
						
						
						
						
						
						
						
						/*
						 * Name: form_preview()
						 * Description: Used to confirm / cancle form details
						 * Param:
						 * Return:
						 * Created on: 27-April-2023
						 * Created by: Avadhesh Shekhawat
						 */
						function form_preview(){
							global $connection;
							global $data;
							global $user_id;
							global $column_name_values;
							global $table_name;
							global $active_status;
							global $deactive_status;
							global $not_deleted;
							global $deleted;
							global $created;
							global $updated;
							global $message;
							global $where_condition;
							
							$get_form_cancle_status = (isset($_REQUEST['cancle_status'])) ? $_REQUEST['cancle_status'] : null;
								
										
										if(!empty($user_id)){
											$data['status'] = "Success";
											
											if(empty($get_form_cancle_status)){
												$column_name_values = "status = '$active_status', is_deleted = '$not_deleted', created = '$created'";
												$table_name = "employee_detail_table";
												$message = "You have successfully registered";
												$where_condition = "user_id = '$user_id'";
												update_query_function($column_name_values, $table_name, $where_condition, $message);
											}
											else{
												$column_name_values = "status = '$deactive_status', is_deleted = '$deleted', created = '$created'";
												$table_name = "employee_detail_table";
												$message = "Your registration is cancled";
												$where_condition = "user_id = '$user_id'";
												update_query_function($column_name_values, $table_name, $where_condition, $message);
											}
										}
										else{
											$data['status'] = "Error";
											$data['message'] = "User id not found";
										}
						}
						
						
						
						
						
						
						
						
						
						
						/*
						 * Name: add_update_bank()
						 * Description: Used to add / update user's bank details
						 * Param:
						 * Return:
						 * Created on: 28-April-2023
						 * Created by: Avadhesh Shekhawat
						 */
						function add_update_bank(){
							global $connection;
							global $data;
							global $error_flag;
							global $user_id;
							global $main_id;
							global $form_data;
							global $active_status;	   
							global $not_deleted;
							global $created;
							global $updated;
							global $column_names;
							global $column_values;
							global $column_name_values;
							global $table_name;
							global $where_condition;
							global $message;
							
							$bank_name = (isset($form_data['bank_name'])) ? $form_data['bank_name'] : null;
							$holder_name = (isset($form_data['holder_name'])) ? $form_data['holder_name'] : null;
							$exp_date = (isset($form_data['exp_date'])) ? $form_data['exp_date'] : null;
							$payment_type = (isset($form_data['payment_type'])) ? $form_data['payment_type'] : null;
							$card_number = (isset($form_data['card_number'])) ? trim($form_data['card_number']) : null;
							$cvc = (isset($form_data['cvc'])) ? trim($form_data['cvc']) : null;
							
							
											if(empty($bank_name)){
												$error_flag['bank_name_error'] = ERROR_MSG['bank_name1'];
											}
											else{
												if(!preg_match("/^[a-zA-Z ]*$/", $bank_name)){
													$error_flag['bank_name_error'] = ERROR_MSG['bank_name2'];
												}
												else{
													$bank_nam = strtolower($bank_name);
												}
											}
											
											if(empty($holder_name)){
												$error_flag['holder_name_error'] = ERROR_MSG['holder_name1'];
											}
											else{
												if(!preg_match("/^[A-Za-z0-9 _.-]+$/", $holder_name)){
													$error_flag['holder_name_error'] = ERROR_MSG['holder_name2'];
												}
												else{
													if(preg_match("/^[0-9]*$/", $holder_name)){
														$error_flag['holder_name_error'] = ERROR_MSG['holder_name2'];
													}
													else{
														$holder_nam = strtolower($holder_name);
													}
												}
											}
											
											if(empty($card_number)){
												$error_flag['card_number_error'] = ERROR_MSG['card_number1'];
											}
											else{
												if(!preg_match('/^[0-9]{10}+$/', $card_number)){
													$error_flag['card_number_error'] = ERROR_MSG['card_number2'];
												}
												else{
													$card_num = $card_number;
												}
											}
											
											if(empty($cvc)){
												$error_flag['cvc_number_error'] = ERROR_MSG['cvc_number1'];
											}
											else{
												if(!preg_match('/^[0-9]{3}+$/', $cvc)){
													$error_flag['cvc_number_error'] = ERROR_MSG['cvc_number2'];
												}
												else{
													$cvc_num = $cvc;
												}
											}
											
											
											
											
											
											if(empty($error_flag)){
													$data['status'] = "Success";
													$data['error'] = $error_flag;
													
													if(empty($main_id)){
														$column_names = "user_id, bank_name, holder_name, expiry_date, payment_type, card_num, cvc, status, is_deleted, created"; 
														$column_values = "'$user_id', '$bank_nam', '$holder_nam', '$exp_date', '$payment_type', '$card_num', '$cvc_num', '$active_status', '$not_deleted', '$created'";
														$table_name = "employee_bank_detail";
														$message = "Bank added successfully";
														insert_query_function($column_names, $column_values, $table_name, $user_id, $message);
													}
													else{
														$column_name_values = "bank_name = '$bank_nam', holder_name = '$holder_nam', expiry_date = '$exp_date', payment_type = '$payment_type', card_num = '$card_num', cvc = '$cvc_num', updated = '$updated'";
														$table_name = "employee_bank_detail";
														$where_condition = "user_id = '$user_id' and id = '$main_id'";
														$message = "Bank updated successfully";
														update_query_function($column_name_values, $table_name, $where_condition, $message);
													}
											}
											else{
												$data['status'] = "Error";
												$data['error'] = $error_flag;
											}
						}
						
						
						
						
						
						
						
						/*
						 * Name: add_update_address()
						 * Description: Used to add / update user's address details
						 * Param:
						 * Return:
						 * Created on: 28-April-2023
						 * Created by: Avadhesh Shekhawat
						 */
						function add_update_address(){
							global $connection;
							global $data;
							global $error_flag;
							global $user_id;
							global $main_id;
							global $form_data;
							global $active_status;	   
							global $not_deleted;
							global $created;
							global $updated;
							global $column_names;
							global $column_values;
							global $column_name_values;
							global $table_name;
							global $where_condition;
							global $message;
							
							$country_add = (isset($form_data['country_add'])) ? $form_data['country_add'] : null;
							$state = (isset($form_data['state'])) ? $form_data['state'] : null;
							$city = (isset($form_data['city'])) ? $form_data['city'] : null;
							$pin_code = (isset($form_data['pin_code'])) ? $form_data['pin_code'] : null;
							$address = (isset($form_data['address'])) ? $form_data['address'] : null;
							
										if(empty($country_add)){
											$error_flag['country_add_error'] = ERROR_MSG['country'];
										}
										else{
											$contry_add = $country_add;
										}
										
										if(empty($state)){
											$error_flag['state_error'] = ERROR_MSG['state'];
										}
										else{
											$stat = strtolower($state);
										}
										
										if(empty($city)){
											$error_flag['city_error'] = ERROR_MSG['city'];
										}
										else{
											$cty = strtolower($city);
										}
										
										if(empty($pin_code)){
											$error_flag['pin_code_error'] = ERROR_MSG['pin_code1'];
										}
										else{
											if(!preg_match('/^[0-9]{6}+$/', $pin_code)){
												$error_flag['pin_code_error'] = ERROR_MSG['pin_code2'];
											}
											else{
												$pin_cod = $pin_code;
											}
										}
										
										if(empty($address)){
											$error_flag['address_error'] = ERROR_MSG['address1'];
										}
										else{
											if(preg_match('/^[0-9]*$/', $address)){
												$error_flag['address_error'] = ERROR_MSG['address2'];
											}
											else{
												$addr = strtolower($address);
											}
										}
				
										
										
										if(empty($error_flag)){
												$data['status'] = "Success";
												$data['error'] = $error_flag;
													
												if(empty($main_id)){
													$column_names = "user_id, country, state, city, pin, address, status, is_deleted, created"; 
													$column_values = "'$user_id', '$contry_add', '$stat', '$cty', '$pin_cod', '$addr', '$active_status', '$not_deleted', '$created'";
													$table_name = "employee_address_detail";
													$message = "Address added successfully";
													insert_query_function($column_names, $column_values, $table_name, $user_id, $message);
												}
												else{
													$column_name_values = "country = '$contry_add', state = '$stat', city = '$cty', pin = '$pin_cod', address = '$addr', updated = '$updated'";
													$table_name = "employee_address_detail";
													$where_condition = "user_id = '$user_id' and id = '$main_id'";
													$message = "Address updated successfully";
													update_query_function($column_name_values, $table_name, $where_condition, $message);
												}
										}
										else{
											$data['status'] = "Error";
											$data['error'] = $error_flag;
										}
						}
						
						
						
			
			
			
			
						/*
						 * Name: insert_query_function()
						 * Description: Used to insert data into database
						 * Param:
						 * Return:
						 * Created on: 27-April-2023
						 * Created by: Avadhesh Shekhawat
						 */
						function insert_query_function($column_names, $column_values, $table_name, $user_id, $message){
							global $connection;
							global $data;
							global $column_names;
							global $column_values;
							global $table_name;
							global $user_id;
							global $message;
							
							
											
									$insert_data = "INSERT INTO $table_name ($column_names) VALUES ($column_values)";
									if(mysqli_query($connection, $insert_data)){
										$data['status'] = "Success";
										$data['message'] = $message;
										if($table_name == "employee_detail_table"){
											$last_id = $connection->insert_id;
											$data['user_id'] = $last_id;
										}
										else{
											$data['user_id'] = $user_id;
										}
									}
									else{
										$data['status'] = "Error";
										$data['message'] = "Error: " . $insert_data . "<br>" . mysqli_error($connection);
									}
								
									return $data;
						}
						
						
						
						
						
						
						
						
						
						
						
						/*
						 * Name: update_query_function()
						 * Description: Used to update data into database
						 * Param:
						 * Return:
						 * Created on: 27-April-2023
						 * Created by: Avadhesh Shekhawat
						 */
						function update_query_function($column_name_values, $table_name, $where_condition, $message){
							global $connection;
							global $data;
							global $column_name_values;
							global $table_name;
							global $user_id;
							global $main_id;
							global $message;
							global $where_condition;
								
									$update_data = "UPDATE $table_name SET $column_name_values WHERE $where_condition";
									if(mysqli_query($connection, $update_data)){
										$data['status'] = "Success";
										$data['message'] = $message;
										$data['user_id'] = $user_id;
									}
									else{
										$data['status'] = "Error";
										$data['message'] = "Error: " . $update_data . "<br>" . mysqli_error($connection);
									}
								
									return $data;
						}
						
					
					
					
						echo json_encode($data);
?>
