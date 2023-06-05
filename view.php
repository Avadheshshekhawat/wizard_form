<?php
			include_once "db_connection.php";
			include_once "global_constant.php";
			include_once "global_function.php";
	
	
			if(!$connection){
				die( "Connection error : " . mysqli_connect_error() );
			}
			else{
				//echo "Database connected";
			}
			
			$base_url = (defined('BASE_URL')) ? BASE_URL : null;
			$gender = (defined('GENDER')) ? GENDER : null;
			$country_code = (defined('COUNTRY_CODE')) ? COUNTRY_CODE : null;
			$payment_type = (defined('PAYMENT_TYPE')) ? PAYMENT_TYPE : null;
			$get_country = (function_exists('countries_get')) ? countries_get() : null;
			$get_state = (function_exists('states_get')) ? states_get() : null;
			$get_city = (function_exists('cities_get')) ? cities_get() : null;
			$page_no = isset($_GET['page_num']) ? $_GET['page_num'] : null;
			$user_id = (isset($_GET['id'])) ? $_GET['id'] : null;
			$filter_full_name = (isset($_GET['filter_by_full_name'])) ? $_GET['filter_by_full_name'] : null;
			$filter_email = (isset($_GET['filter_by_email'])) ? $_GET['filter_by_email'] : null;
			$filter_country = (isset($_GET['filter_by_country'])) ? $_GET['filter_by_country'] : null;
			$filter_status = (isset($_GET['filter_by_status'])) ? $_GET['filter_by_status'] : null;
			
			
			
			//Fetch data query from employee_detail_table start
			$fetch_employee_detail_query = "SELECT * FROM employee_detail_table WHERE user_id = '$user_id'";
			$result1 = mysqli_query($connection, $fetch_employee_detail_query);
			$fetch_employee_detail = mysqli_fetch_assoc($result1);
			//Fetch data query from employee_detail_table end
			
			
			
			
			//Fetch data query from employee_bank_detail start
			$fetch_employee_bank_detail_query = "SELECT * FROM employee_bank_detail WHERE user_id = '$user_id' and status = 0 and is_deleted = 0";
			$total_records = mysqli_query($connection, "SELECT COUNT(*) from employee_bank_detail");
			$count_records = mysqli_fetch_array($total_records);
			$result2 = mysqli_query($connection, $fetch_employee_bank_detail_query);
			//Fetch data query from employee_bank_detail end
			
			
			
			
			//Fetch data query from employee_address_detail start
			$fetch_employee_address_detail_query = "SELECT * FROM employee_address_detail WHERE user_id = '$user_id' and status = 0 and is_deleted = 0";
			$total_records1 = mysqli_query($connection, "SELECT COUNT(*) from employee_address_detail");
			$count_records1 = mysqli_fetch_array($total_records1);
			$result3 = mysqli_query($connection, $fetch_employee_address_detail_query);
			//Fetch data query from employee_address_detail end
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Page</title>
	
		<!-- Bootstrap css cdn link start -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- Bootstrap css cdn link end -->

		<!-- JQuery cdn link start -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
		<!-- JQuery cdn link end -->
</head>
<body>
	
				
		<div class="container">
			<div class="row mt-3 mb-3 border p-3 bg-light rounded">
				
					<div class="col-11 h1 text-center">Detail view of <span class="text-success"><?php echo (!empty($fetch_employee_detail['first_name'])) ? ucfirst($fetch_employee_detail['first_name']) : "NA"; ?> <?php echo (!empty($fetch_employee_detail['last_name'])) ? ucfirst($fetch_employee_detail['last_name']) : "NA"; ?></span></div>
					
					<!-- Back button start -->
					<div class="col-1">
						<a class="btn btn-outline-success" href="<?php echo $base_url . '/list.php?page_num='.$page_no.'&filter_by_full_name='.$filter_full_name.'&filter_by_email='.$filter_email.'&filter_by_country='.$filter_country.'&filter_by_status='.$filter_status.'&id='.$user_id; ?>">Back</a>
					</div>
					<!-- Back button end -->
					
					
					<!-- View page details start -->
					<table class="table mt-2">
						  <tbody>
								<tr>
								  <th>First Name</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['first_name'])) ? ucfirst($fetch_employee_detail['first_name']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Last Name</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['last_name'])) ? ucfirst($fetch_employee_detail['last_name']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Date Of Birth</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['dob'])) ? $fetch_employee_detail['dob'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Gender</th>
								  <td class="text-success fw-bold">
										<?php
											if(!empty($fetch_employee_detail['gender'])){
												foreach($gender as $gender_key => $gender_value){
													if($fetch_employee_detail['gender'] == $gender_key){
														$fetch_employee_detail['gender'] = $gender_value;
														echo ucfirst($fetch_employee_detail['gender']);
													}
												}
											}
											else{
												echo "NA";
											}
										?>
								  </td>
								</tr>
								<tr>
								  <th>User Name</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['user_name'])) ? ucfirst($fetch_employee_detail['user_name']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Password</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['password'])) ? $fetch_employee_detail['password'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Confirm Password</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['confirm_password'])) ? $fetch_employee_detail['confirm_password'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Email</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['email'])) ? $fetch_employee_detail['email'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Phone</th>
								  <td class="text-success fw-bold">
										<?php
											if(!empty($fetch_employee_detail['country_code'])){
												foreach($country_code as $country_code_key => $country_code_value){
													if($fetch_employee_detail['country_code'] == $country_code_key){
														$fetch_employee_detail['country_code'] = $country_code_value;
														echo ucfirst($fetch_employee_detail['country_code']);
													}
												}
											}
											else{
												echo "NA";
											}
											
											echo " - ";
											
											echo (!empty($fetch_employee_detail['phone'])) ? $fetch_employee_detail['phone'] : "NA";
										?>
								  </td>
								</tr>
								<tr>
								  <th>Address</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['address'])) ? ucfirst($fetch_employee_detail['address']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Country</th>
								  <td class="text-success fw-bold">
										<?php
											if(!empty($fetch_employee_detail['country'])){
												foreach($get_country as $row){
													if($fetch_employee_detail['country'] == $row['country_id']){
														$fetch_employee_detail['country'] = strtolower($row['country_name']);
														echo ucfirst($fetch_employee_detail['country']);
													}
												}
											}
											else{
												echo "NA";
											}
										?>
								  </td>
								</tr>
								<tr>
								  <th>Employee ID</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['employee_id'])) ? ucfirst($fetch_employee_detail['employee_id']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Designation</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['designation'])) ? ucfirst($fetch_employee_detail['designation']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Department</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['department'])) ? ucfirst($fetch_employee_detail['department']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Working Hours</th>
								  <td class="text-success fw-bold"><?php echo (!empty($fetch_employee_detail['working_hour'])) ? $fetch_employee_detail['working_hour'] : "NA"; ?></td>
								</tr>
								
								<tr>
								  <th>Bank Details</th>
								  <td>
									  <div class="row">
										  <?php
												if(mysqli_num_rows($result2) > 0){
													while($row1 = mysqli_fetch_assoc($result2)){
														
														for($i = 1; $i <= $count_records[0]; $i++){
															if($i == $row1['id']){
										?>	
																
																	<div class="col-4 border p-2">
																		Bank Name : <?php echo (!empty($row1['bank_name'])) ? "<span class='text-success fw-bold'>".ucfirst($row1['bank_name'])."</span>" : "NA"; ?><br>
																		Holder Name : <?php echo (!empty($row1['holder_name'])) ? "<span class='text-success fw-bold'>".ucfirst($row1['holder_name'])."</span>" : "NA"; ?><br>
																		Expiry Date : <?php echo (!empty($row1['expiry_date'])) ? "<span class='text-success fw-bold'>".ucfirst($row1['expiry_date'])."</span>" : "NA"; ?><br>
																		Payment Type : <?php
																			if(!empty($row1['payment_type'])){
																				foreach($payment_type as $payment_type_key => $payment_type_value){
																					if($row1['payment_type'] == $payment_type_key){
																						$row1['payment_type'] = $payment_type_value;
																						echo "<span class='text-success fw-bold'>".ucfirst($row1['payment_type'])."</span>";
																					}
																				}
																			}
																			else{
																				echo "NA";
																			}
																		?><br>
																		Card Number : <?php echo (!empty($row1['card_num'])) ? "<span class='text-success fw-bold'>".ucfirst($row1['card_num'])."</span>" : "NA"; ?><br>
																		CVC : <?php echo (!empty($row1['cvc'])) ? "<span class='text-success fw-bold'>".ucfirst($row1['cvc'])."</span>" : "NA"; ?>
																	</div>
										
										<?php
															}
														}
													}
												}
											?>
									  </div>
								  </td>
								</tr>
								
								
								<tr>
								  <th>Address Details</th>
								  <td>
									  <div class="row">
										  <?php
												if(mysqli_num_rows($result3) > 0){
													while($row2 = mysqli_fetch_assoc($result3)){
														for($i = 1; $i <= $count_records1[0]; $i++){
															if($i == $row2['id']){
											?>	
																
																	<div class="col-4 border p-2">
																		Country : <?php
																						if(!empty($row2['country'])){
																							foreach($get_country as $row){
																								if($row2['country'] == $row['country_id']){
																									$row2['country'] = strtolower($row['country_name']);
																									echo "<span class='text-success fw-bold'>".ucfirst($row2['country'])."</span>";
																								}
																							}
																						}
																						else{
																							echo "NA";
																						}
																					?><br>
																		State : <?php
																					if(!empty($row2['state'])){
																						foreach($get_state as $row){
																							if($row2['state'] == $row['state_id']){
																								$row2['state'] = strtolower($row['state_name']);
																								echo "<span class='text-success fw-bold'>".ucfirst($row2['state'])."</span>";
																							}
																						}
																					}
																					else{
																						echo "NA";
																					}
																				?><br>
																		City : <?php
																					if(!empty($row2['city'])){
																						foreach($get_city as $row){
																							if($row2['city'] == $row['city_id']){
																								$row2['city'] = strtolower($row['city_name']);
																								echo "<span class='text-success fw-bold'>".ucfirst($row2['city'])."</span>";
																							}
																						}
																					}
																					else{
																						echo "NA";
																					}
																				?><br>
																		Pin Code : <?php echo (!empty($row2['pin'])) ? "<span class='text-success fw-bold'>".ucfirst($row2['pin'])."</span>" : "NA"; ?><br>
																		Address : <?php echo (!empty($row2['address'])) ? "<span class='text-success fw-bold'>".ucfirst($row2['address'])."</span>" : "NA"; ?>
																	</div>
										
										<?php
															}
														}
													}
												}
											?>
									  </div>
								  </td>
								</tr>
							
						  </tbody>
					</table>
					<!-- View page details end -->
					
			</div>
		</div>
		
		


		<!-- Bootstrap js cdn link start -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<!-- Bootstrap js cdn link end -->
		
</body>
</html>
