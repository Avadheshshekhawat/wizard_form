<?php
	include_once "db_connection.php";
	include_once "global_constant.php";
	
	if(!$connection){
		die( "Connection Error : " . mysqli_connect_error() );
	}
	
	$user_id = (isset($_GET['id'])) ? $_GET['id'] : null;
	$base_url = (defined('BASE_URL')) ? BASE_URL : null;
	$gender = (defined('GENDER')) ? GENDER : null;
	$official_info_edit_status = (isset($_GET['official_info_edit_status'])) ? $_GET['official_info_edit_status'] : null;
	$payment_info_edit_status = (isset($_GET['payment_info_edit_status'])) ? $_GET['payment_info_edit_status'] : null;
	$address_info_edit_status = (isset($_GET['address_info_edit_status'])) ? $_GET['address_info_edit_status'] : null;
	
	$fetch_data_query = "SELECT * FROM employee_detail_table WHERE user_id = '$user_id'";
	$result = mysqli_query($connection, $fetch_data_query);
	$fetch_data = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Form 1 - Personal information</title>
	
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
		
		<!-- Datepicker cdn link start -->
		<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
		<!-- Datepicker cdn link end -->
		
		
		<!-- Datepicker script start -->
		<script>
		$(document).ready(function() {
		  $( function() {
			$( "#dob" ).datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true,
				maxDate:'-18Y'
			});
		  });
		});
		</script>
		<!-- Datepicker script end -->
</head>
<body>
		
		<div class="container">
			<div class="row">
				
				
				<!-- Form start -->
				<form class="row mt-3 mb-3 border p-3 bg-light rounded" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="personal_info_form" name="personal_info_form" method="post">
				
					<!-- Form heading start -->
					<div class="col-11 text-center">
						<span class="h2">SIGN UP OFFICE EMPLOYEE ACCOUNT</span>
					</div>
					<!-- Form heading end -->
					
					<!-- Go to list page button start -->
					<div class="col-1 text-center">
						<a class="btn p-3 btn-outline-success" href="<?php echo $base_url . '/list.php?page_num=1'; ?>">Back</a>
					</div>
					<!-- Go to list page button end -->
					
					<!-- User id hidden field start -->
					<input type="hidden" class="col-12 form-control form-control-lg" id="user_id" name="user_id" value="<?php echo (isset($user_id)) ? $user_id : null; ?>">
					<!-- User id hidden field end -->
					
					<!-- Official info edit status hidden field start -->
					<input type="hidden" class="col-12 form-control form-control-lg" id="official_info_edit_status" name="official_info_edit_status" value="<?php echo (isset($official_info_edit_status)) ? $official_info_edit_status : null; ?>">
					<!-- Official info edit status hidden field start -->
					
					<!-- Payment info edit status hidden field start -->
					<input type="hidden" class="col-12 form-control form-control-lg" id="payment_info_edit_status" name="payment_info_edit_status" value="<?php echo (isset($payment_info_edit_status)) ? $payment_info_edit_status : null; ?>">
					<!-- Payment info edit status hidden field start -->
					
					<!-- Address info edit status hidden field start -->
					<input type="hidden" class="col-12 form-control form-control-lg" id="address_info_edit_status" name="address_info_edit_status" value="<?php echo (isset($address_info_edit_status)) ? $address_info_edit_status : null; ?>">
					<!-- Address info edit status hidden field start -->
					
					<!-- Form icon start -->
					<div class="col-2 p-4">
						<div class="col-12 p-4 active_icon text-center text-light">
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
						<div class="col-12 p-4 deactive_icon text-center text-light">
							<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
							  <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
							  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z"/>
							</svg><br>
							<span class="fs-3 fw-bold">Preview</span>
						</div>
					</div>
					<!-- Form icon end -->
					
					
					<div class="col-6 fs-4 text-danger">
						<span class="ms-2">Personal information</span>
					</div>
					<div class="col-6 fs-4 text-end">
						<span class="me-3">Step 1/6</span>
					</div>
					
					<!-- First name field start -->
					<div class="col-md-6 mt-2">
						<label for="fname">First Name
							<span title="Alphanumeric characters allowed"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#787a7b" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
							<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
							</svg></span>
							<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" class="bi bi-star-fill star" fill="#c16e7c" viewBox="0 0 16 16">
								<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
							</svg> :
						</label>
						<input type="text" class="form-control form-control-lg mt-2" id="fname" name="fname" value="<?php echo (!empty($fetch_data['first_name'])) ? ucfirst($fetch_data['first_name']) : null; ?>">
						<span id="fname_error" class="text-danger p-1"></span>
					</div>
					<!-- First name field end -->
					
					
					<!-- Last name field start -->
					<div class="col-md-6 mt-2">
						<label for="lname">Last Name
							<span title="Alphanumeric characters allowed"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#787a7b" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
							<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
							</svg></span>
							<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" class="bi bi-star-fill star" fill="#c16e7c" viewBox="0 0 16 16">
								<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
							</svg> :
						</label>
						<input type="text" class="form-control form-control-lg mt-2" id="lname" name="lname" value="<?php echo (!empty($fetch_data['last_name'])) ? ucfirst($fetch_data['last_name']) : null; ?>">
						<span id="lname_error" class="text-danger p-1"></span>
					</div>
					<!-- Last name field end -->
					
					
					<!-- Date of birth field start -->
					<div class="col-md-6 mt-2">
						<label for="dob">Date of birth</label>
						<input type="text" class="form-control form-control-lg mt-2" id="dob" name="dob" value="<?php echo (!empty($fetch_data['dob'])) ? $fetch_data['dob'] : null; ?>">
						<span id="dob_error" class="text-danger p-1"></span>
					</div>
					<!-- Date of birth field end -->
					
					
					<!-- Gender field start -->
					<div class="col-md-6 mt-2">
						<label for="gender">Gender</label>
						<select class="form-select form-select-lg mt-2" id="gender" name="gender">
						  <option value=""> -- Select gender -- </option>
						  <?php
								$selected_gender = (!empty($fetch_data['gender'])) ? $fetch_data['gender'] : null;
								foreach($gender as $gender_key => $gender_value){
									($selected_gender == $gender_key) ? $selected = 'selected' : $selected = '';
									echo '<option value="'.$gender_key.'"'.$selected.'>'.$gender_value.'</option>';
								}
						  ?>
						</select>
						<span id="gender_error" class="text-danger p-1"></span>
					</div>
					<!-- Gender field end -->
					
					
					<!-- Username field start -->
					<div class="col-md-4 mt-2">
						<label for="user_name">Username
							<span title="Alphanumeric characters allowed"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#787a7b" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
							<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
							</svg></span>
							<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" class="bi bi-star-fill star" fill="#c16e7c" viewBox="0 0 16 16">
								<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
							</svg> :
						</label>
						<input type="text" class="form-control form-control-lg mt-2" id="user_name" name="user_name" value="<?php echo (!empty($fetch_data['user_name'])) ? ucfirst($fetch_data['user_name']) : null; ?>">
						<span id="user_name_error" class="text-danger p-1"></span>
					</div>
					<!-- Username field end -->
					
					
					<!-- Password field start -->
					<div class="col-md-4 mt-2">
						<label for="password">Password
							<span title="Password length should be 4 characters"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#787a7b" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
							<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
							</svg></span>
							<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" class="bi bi-star-fill star" fill="#c16e7c" viewBox="0 0 16 16">
								<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
							</svg> :
						</label>
						<input type="password" class="form-control form-control-lg mt-2" id="password" name="password" value="<?php echo (!empty($fetch_data['password'])) ? $fetch_data['password'] : null; ?>">
						<span id="password_error" class="text-danger p-1"></span>
					</div>
					<!-- Password field end -->
					
					
					<!-- Confirm password field start -->
					<div class="col-md-4 mt-2">
						<label for="confirm_password">Confirm Password
							<span title="Confirm password should be same as password"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#787a7b" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
							<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
							</svg></span>
							<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" class="bi bi-star-fill star" fill="#c16e7c" viewBox="0 0 16 16">
								<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
							</svg> :
						</label>
						<input type="password" class="form-control form-control-lg mt-2" id="confirm_password" name="confirm_password" value="<?php echo (!empty($fetch_data['confirm_password'])) ? $fetch_data['confirm_password'] : null; ?>">
						<span id="confirm_password_error" class="text-danger p-1"></span>
					</div>
					<!-- Confirm password field end -->
					
					
					<!-- Button field start -->
					<div class="col-md-10"></div>
					<div class="col-md-2">
						<input type="submit" class="btn p-3 next-btn text-light" id="submit" name="submit" value="Next">
					</div>
					<!-- Button field end -->
				
				</form>
				<!-- Form end -->
				
			</div>
		</div>
		
		
		
		



		<!-- Bootstrap js cdn link start -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<!-- Bootstrap js cdn link end -->
		
		
		<!-- External js file link start -->
		<script src="form_process.js"></script>
		<!-- External js file link end -->
</body>
</html>
