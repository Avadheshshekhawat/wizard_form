<?php
	include_once "db_connection.php";
	include_once "global_constant.php";
	include_once "global_function.php";
	
	if(!$connection){
		die( "Connection Error : " . mysqli_connect_error() );
	}
	
	$base_url = (defined('BASE_URL')) ? BASE_URL : null;
	$user_id = (isset($_GET['id'])) ? $_GET['id'] : null;
	$gender = (defined('GENDER')) ? GENDER : null;
	$country_code = (defined('COUNTRY_CODE')) ? COUNTRY_CODE : null;
	$payment_type = (defined('PAYMENT_TYPE')) ? PAYMENT_TYPE : null;
	$get_country = (function_exists('countries_get')) ? countries_get() : null;
	$get_state = (function_exists('states_get')) ? states_get() : null;
	$get_city = (function_exists('cities_get')) ? cities_get() : null;
	
	
	//Fetch data query from employee_detail_table start
	$fetch_employee_detail_query = "SELECT * FROM employee_detail_table WHERE user_id = '$user_id'";
	$result1 = mysqli_query($connection, $fetch_employee_detail_query);
	$fetch_employee_detail = mysqli_fetch_assoc($result1);
	//Fetch data query from employee_detail_table end
	
	
	
	
	//Fetch data query from employee_bank_detail start
	$fetch_employee_bank_detail_query = "SELECT * FROM employee_bank_detail WHERE user_id = '$user_id'";
	$result2 = mysqli_query($connection, $fetch_employee_bank_detail_query);
	$fetch_employee_bank_detail = mysqli_fetch_assoc($result2);
	//Fetch data query from employee_bank_detail end
	
	
	
	
	//Fetch data query from employee_address_detail start
	$fetch_employee_address_detail_query = "SELECT * FROM employee_address_detail WHERE user_id = '$user_id'";
	$result3 = mysqli_query($connection, $fetch_employee_address_detail_query);
	$fetch_employee_address_detail = mysqli_fetch_assoc($result3);
	//Fetch data query from employee_address_detail end
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Form Preview</title>
	
		<!-- Bootstrap css cdn link start -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- Bootstrap css cdn link end -->
		
		<!-- External css file link start -->
		<link rel="stylesheet" href="style.css">
		<!-- External css file link end -->

		<!-- JQuery cdn link start -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
		<!-- JQuery cdn link end -->
		
		<!-- Sweet alert cdn link start -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="sweetalert2.all.min.js"></script>  
		<!-- Sweet alert cdn link end -->
</head>
<body>
		
		<div class="container">
			<div class="row mt-3 mb-3 border p-3 bg-light rounded">
				
					<!-- Heading start -->
					<div class="col-12 text-center">
						<span class="h2">Preview of your details</span>
					</div>
					<!-- Heading end -->
					
					<!-- Icons start -->
					<div class="col-2 p-4">
						<div class="col-12 p-4 deactive_icon text-center text-light">
							<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
							  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
							</svg><br>
							<span class="fs-3 fw-bold">Personal</span>
						</div>
					</div>
					
					<div class="col-2 p-4">
						<div class="col-12 p-4 deactive_icon text-center text-light">
							<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
							  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
							</svg><br>
							<span class="fs-3 fw-bold">Contact</span>
						</div>
					</div>
					
					<div class="col-2 p-4">
						<div class="col-12 p-4 deactive_icon text-center text-light">
							<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
							  <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
							</svg><br>
							<span class="fs-3 fw-bold">Official</span>
						</div>
					</div>
					
					<div class="col-2 p-4">
						<div class="col-12 p-4 deactive_icon text-center text-light">
							<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16">
							  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0V4zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1H0z"/>
							</svg><br>
							<span class="fs-3 fw-bold">Payment</span>
						</div>
					</div>
					
					<div class="col-2 p-4">
						<div class="col-12 p-4 deactive_icon text-center text-light">
							<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
							  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
							</svg><br>
							<span class="fs-3 fw-bold">Address</span>
						</div>
					</div>
					
					<div class="col-2 p-4">
						<div class="col-12 p-4 active_icon text-center text-light">
							<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
							  <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
							  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z"/>
							</svg><br>
							<span class="fs-3 fw-bold">Preview</span>
						</div>
					</div>
					<!-- Icons end -->
					
					
					<div class="col-6 fs-4 text-danger">
						<span class="ms-2">Detail Preview</span>
					</div>
					<div class="col-6 fs-4 text-end">
						<span class="me-3">Step 6/6</span>
					</div>
					
					
					<!-- Preview start -->
					<table class="table mt-4">
						  <tbody>
								<tr>
								  <th>First Name</th>
								  <td><?php echo (!empty($fetch_employee_detail['first_name'])) ? ucfirst($fetch_employee_detail['first_name']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Last Name</th>
								  <td><?php echo (!empty($fetch_employee_detail['last_name'])) ? ucfirst($fetch_employee_detail['last_name']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Date Of Birth</th>
								  <td><?php echo (!empty($fetch_employee_detail['dob'])) ? $fetch_employee_detail['dob'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Gender</th>
								  <td>
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
								  <td><?php echo (!empty($fetch_employee_detail['user_name'])) ? ucfirst($fetch_employee_detail['user_name']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Password</th>
								  <td><?php echo (!empty($fetch_employee_detail['password'])) ? $fetch_employee_detail['password'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Confirm Password</th>
								  <td><?php echo (!empty($fetch_employee_detail['confirm_password'])) ? $fetch_employee_detail['confirm_password'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Email</th>
								  <td><?php echo (!empty($fetch_employee_detail['email'])) ? $fetch_employee_detail['email'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Phone</th>
								  <td>
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
								  <td><?php echo (!empty($fetch_employee_detail['address'])) ? ucfirst($fetch_employee_detail['address']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Country</th>
								  <td>
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
								  <td><?php echo (!empty($fetch_employee_detail['employee_id'])) ? ucfirst($fetch_employee_detail['employee_id']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Designation</th>
								  <td><?php echo (!empty($fetch_employee_detail['designation'])) ? ucfirst($fetch_employee_detail['designation']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Department</th>
								  <td><?php echo (!empty($fetch_employee_detail['department'])) ? ucfirst($fetch_employee_detail['department']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Working Hours</th>
								  <td><?php echo (!empty($fetch_employee_detail['working_hour'])) ? $fetch_employee_detail['working_hour'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Bank Name</th>
								  <td><?php echo (!empty($fetch_employee_bank_detail['bank_name'])) ? ucfirst($fetch_employee_bank_detail['bank_name']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Holder Name</th>
								  <td><?php echo (!empty($fetch_employee_bank_detail['holder_name'])) ? ucfirst($fetch_employee_bank_detail['holder_name']) : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Expiry Date</th>
								  <td><?php echo (!empty($fetch_employee_bank_detail['expiry_date'])) ? $fetch_employee_bank_detail['expiry_date'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Payment Type</th>
								  <td>
										<?php
											if(!empty($fetch_employee_bank_detail['payment_type'])){
												foreach($payment_type as $payment_type_key => $payment_type_value){
													if($fetch_employee_bank_detail['payment_type'] == $payment_type_key){
														$fetch_employee_bank_detail['payment_type'] = $payment_type_value;
														echo ucfirst($fetch_employee_bank_detail['payment_type']);
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
								  <th>Card Number</th>
								  <td><?php echo (!empty($fetch_employee_bank_detail['card_num'])) ? $fetch_employee_bank_detail['card_num'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>CVC</th>
								  <td><?php echo (!empty($fetch_employee_bank_detail['cvc'])) ? $fetch_employee_bank_detail['cvc'] : "NA"; ?></td>
								</tr>
								<tr>
								  <th>Country</th>
								  <td>
										<?php
											if(!empty($fetch_employee_address_detail['country'])){
												foreach($get_country as $row){
													if($fetch_employee_address_detail['country'] == $row['country_id']){
														$fetch_employee_address_detail['country'] = strtolower($row['country_name']);
														echo ucfirst($fetch_employee_address_detail['country']);
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
								  <th>State</th>
								  <td>
										<?php
											if(!empty($fetch_employee_address_detail['state'])){
												foreach($get_state as $row){
													if($fetch_employee_address_detail['state'] == $row['state_id']){
														$fetch_employee_address_detail['state'] = strtolower($row['state_name']);
														echo ucfirst($fetch_employee_address_detail['state']);
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
								  <th>City</th>
								  <td>
										<?php
											if(!empty($fetch_employee_address_detail['city'])){
												foreach($get_city as $row){
													if($fetch_employee_address_detail['city'] == $row['city_id']){
														$fetch_employee_address_detail['city'] = strtolower($row['city_name']);
														echo ucfirst($fetch_employee_address_detail['city']);
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
								  <th>Pin Code</th>
								  <td><?php echo (!empty($fetch_employee_address_detail['pin'])) ? $fetch_employee_address_detail['pin'] : "NA"; ?></td>
								</tr>
						  </tbody>
					</table>
					<!-- Preview end -->
					
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="preview_form" name="preview_form" method="post">
							<!-- User id hidden field start -->
							<input type="hidden" class="col-12 form-control form-control-lg" id="user_id" name="user_id" value="<?php echo (isset($user_id)) ? $user_id : null; ?>">
							<!-- User id hidden field end -->
					
							<input type="submit" class="btn p-3 cancle-btn text-light" id="cancle" name="cancle" value="Cancle">
							<a class="btn p-3 previous-btn text-light" href="<?php echo $base_url . '/address_info.php?id='.$user_id.'&official_info_edit_status='.'&payment_info_edit_status='.'&address_info_edit_status=true'; ?>">Previous</a>
							<input type="submit" class="btn p-3 next-btn text-light" id="submit5" name="submit5" value="Confirm">
					</form>
					
			</div>
		</div>
		
		
			<!-- Loader start -->
			<div id="loder_bg">
			  <div class="cv-spinner">
				<span class="spinner"></span>
			  </div>
			</div>
			<!-- Loader end -->


		<!-- Bootstrap js cdn link start -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<!-- Bootstrap js cdn link end -->
		
		<!-- External js file link start -->
		<script src="form_process.js"></script>
		<!-- External js file link end -->
</body>
</html>

