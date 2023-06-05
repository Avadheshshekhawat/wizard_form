<?php
		include_once "../db_connection.php";
		include_once "../global_constant.php";
		
		if(!$connection){
			die( "Connection error : " . mysqli_connect_error() );
		}
		
		
		
		$base_url = (defined('BASE_URL')) ? BASE_URL : null;
		$payment_type = (defined('PAYMENT_TYPE')) ? PAYMENT_TYPE : null;
		$page_no = isset($_GET['page_num']) ? $_GET['page_num'] : null;
		$filter_bank_name = (isset($_GET['filter_by_bank_name'])) ? $_GET['filter_by_bank_name'] : null;
		$filter_card_num = (isset($_GET['filter_by_card_num'])) ? $_GET['filter_by_card_num'] : null;
		$filter_status = (isset($_GET['filter_by_status'])) ? $_GET['filter_by_status'] : null;
		$user_id = (isset($_GET['id'])) ? $_GET['id'] : null;
		$main_id = (isset($_GET['main_id'])) ? $_GET['main_id'] : null;
		$user_status = (isset($_GET['user_status'])) ? $_GET['user_status'] : null;
		$user_is_deleted = (isset($_GET['user_is_deleted'])) ? $_GET['user_is_deleted'] : null;
		$full_name = (isset($_GET['name'])) ? $_GET['name'] : null;
		
		
		
		$fetch_data_query = "SELECT * FROM employee_bank_detail WHERE user_id = '$user_id' and id = '$main_id'";
		$result = mysqli_query($connection, $fetch_data_query);
		$fetch_data = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Bank</title>

	<!-- Bootstrap css cdn link start -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- Bootstrap css cdn link end -->
	
	<!-- External css file link start -->
	<link rel="stylesheet" href="../style.css">
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
	
	
	<script>
		$(document).ready(function(){
		  $(function(){
			$( "#exp_date" ).datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true,
				minDate:'-1M'
			});
		  });
		});
	</script>
</head>
<body style="background-color:#fff;">
		
		<div class="container">
			<div class="row">
			
					<div class="col-8 mt-3 mb-3 ms-auto me-auto border p-3 rounded">
						
							<!-- Form start -->
							<form class="row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="add_bank_form" name="add_bank_form" method="post">
									
									<!-- Form heading start -->
									<div class="col-10 text-center h1"><?php echo (empty($main_id)) ? "Add" : "Update"; ?> Bank Details</div>
									<div class="col-2">
										<a href=<?php echo "$base_url/bank_details/list.php?page_num=$page_no&id=$user_id&user_status=$user_status&user_is_deleted=$user_is_deleted&name=$full_name"; ?> class="btn btn-outline-primary w-100">Back</a>
									</div>
									<!-- Form heading end -->
									
									<!-- User id hidden field start -->
									<input type="hidden" class="col-12 form-control form-control-lg" id="user_id" name="user_id" value="<?php echo (isset($user_id)) ? $user_id : null; ?>">
									<!-- User id hidden field end -->
									
									<!-- Main id hidden field start -->
									<input type="hidden" class="col-12 form-control form-control-lg" id="main_id" name="main_id" value="<?php echo (isset($main_id)) ? $main_id : null; ?>">
									<!-- Main id hidden field end -->
									
									<!-- User status hidden field start -->
									<input type="hidden" class="col-12 form-control form-control-lg" id="user_status" name="user_status" value="<?php echo (isset($user_status)) ? $user_status : null; ?>">
									<!-- User status hidden field end -->
									
									<!-- User is deleted hidden field start -->
									<input type="hidden" class="col-12 form-control form-control-lg" id="user_is_deleted" name="user_is_deleted" value="<?php echo (isset($user_is_deleted)) ? $user_is_deleted : null; ?>">
									<!-- User is deleted hidden field end -->
									
									<!-- Bank name field start -->
									<div class="col-md-6 mt-2">
										<label for="bank_name">Bank Name
											<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" class="bi bi-star-fill star" fill="#c16e7c" viewBox="0 0 16 16">
												<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
											</svg> :
										</label>
										<input type="text" class="form-control form-control-lg mt-2" id="bank_name" name="bank_name" value="<?php echo (!empty($fetch_data['bank_name'])) ? ucfirst($fetch_data['bank_name']) : null; ?>">
										<span id="bank_name_error" class="text-danger p-1"></span>
									</div>
									<!-- Bank name field end -->
									
									
									<!-- Holder name field start -->
									<div class="col-md-6 mt-2">
										<label for="holder_name">Holder Name
											<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" class="bi bi-star-fill star" fill="#c16e7c" viewBox="0 0 16 16">
												<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
											</svg> :
										</label>
										<input type="text" class="form-control form-control-lg mt-2" id="holder_name" name="holder_name" value="<?php echo (!empty($fetch_data['holder_name'])) ? ucfirst($fetch_data['holder_name']) : null; ?>">
										<span id="holder_name_error" class="text-danger p-1"></span>
									</div>
									<!-- Holder name field end -->
									
									
									<!-- Expiry date field start -->
									<div class="col-md-6 mt-2">
										<label for="exp_date">Expiry Date</label>
										<input type="text" class="form-control form-control-lg mt-2" id="exp_date" name="exp_date" value="<?php echo (!empty($fetch_data['expiry_date'])) ? ucfirst($fetch_data['expiry_date']) : null; ?>">
										<span id="exp_date_error" class="text-danger p-1"></span>
									</div>
									<!-- Expiry date field end -->
									
									
									<!-- Payment type field start -->
									<div class="col-md-6 mt-2">
										<label for="payment_type">Payment Type</label>
										<select class="form-select form-select-lg mt-2" id="payment_type" name="payment_type">
										  <option value=""> -- Select Payment Type -- </option>
										  <?php
												$selected_payment_type = (!empty($fetch_data['payment_type'])) ? $fetch_data['payment_type'] : null;
												foreach($payment_type as $payment_type_key => $payment_type_value){
													($selected_payment_type == $payment_type_key) ? $selected = 'selected' : $selected = '';
													echo '<option value="'.$payment_type_key.'"'.$selected.'>'.$payment_type_value.'</option>';
												}
										  ?>
										</select>
										<span id="payment_type_error" class="text-danger p-1"></span>
									</div>
									<!-- Payment type field end -->
									
									
									<!-- Card number field start -->
									<div class="col-md-6 mt-2">
										<label for="card_number">Card Number
											<span title="Card number should be 10 digits"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#787a7b" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
												<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
											</svg></span>
											<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" class="bi bi-star-fill star" fill="#c16e7c" viewBox="0 0 16 16">
												<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
											</svg> :
										</label>
										<input type="text" class="form-control form-control-lg mt-2" id="card_number" name="card_number" value="<?php echo (!empty($fetch_data['card_num'])) ? ucfirst($fetch_data['card_num']) : null; ?>">
										<span id="card_number_error" class="text-danger p-1"></span>
									</div>
									<!-- Card number field end -->
									
									
									<!-- CVC field start -->
									<div class="col-md-6 mt-2">
										<label for="cvc">CVC
											<span title="CVC number should be 3 digits"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#787a7b" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
												<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
											</svg></span>
											<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" class="bi bi-star-fill star" fill="#c16e7c" viewBox="0 0 16 16">
												<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
											</svg> :
										</label>
										<input type="text" class="form-control form-control-lg mt-2" id="cvc" name="cvc" value="<?php echo (!empty($fetch_data['cvc'])) ? ucfirst($fetch_data['cvc']) : null; ?>">
										<span id="cvc_error" class="text-danger p-1"></span>
									</div>
									<!-- CVC field end -->
									
									
									<!-- Button field start -->
									<div class="col-md-9"></div>
									<div class="col-md-3">
										<input type="submit" class="btn btn-outline-success w-100" id="submit" name="submit" value="Submit">
									</div>
									<!-- Button field end -->
									
							</form>
							<!-- Form end -->
						
					</div>
			
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
