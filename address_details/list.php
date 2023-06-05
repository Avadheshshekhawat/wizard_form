<?php
		include_once "../db_connection.php";
		include_once "../global_constant.php";
		include_once "../global_function.php";
		
		if(!$connection){
			die( "Connection error : " . mysqli_connect_error() );
		}
		
		$base_url = (defined('BASE_URL')) ? BASE_URL : null;
		$active_status = (defined('ACTIVE')) ? ACTIVE : null;
		$deactive_status = (defined('DEACTIVE')) ? DEACTIVE : null;
		$not_deleted = (defined('NOT_DELETED')) ? NOT_DELETED : null;
		$deleted = (defined('DELETED')) ? DELETED : null;
		$updated = date("Y-m-d") ? date("Y-m-d") : null;
		$page_no = isset($_GET['page_num']) ? $_GET['page_num'] : null;
		$user_id = (isset($_GET['id'])) ? $_GET['id'] : null;
		$main_id = (isset($_GET['main_id'])) ? $_GET['main_id'] : null;
		$status = (isset($_GET['status'])) ? $_GET['status'] : null;
		$is_deleted = (isset($_GET['is_deleted'])) ? $_GET['is_deleted'] : null;
		$get_country = (function_exists('countries_get')) ? countries_get() : null;
		$get_state = (function_exists('states_get')) ? states_get() : null;
		$get_city = (function_exists('cities_get')) ? cities_get() : null;
		$user_status = (isset($_GET['user_status'])) ? $_GET['user_status'] : null;
		$user_is_deleted = (isset($_GET['user_is_deleted'])) ? $_GET['user_is_deleted'] : null;
		$time_stamp = date("y-m-d__H-i-s");
		$full_name = (isset($_GET['name'])) ? $_GET['name'] : null;
		
		
		//Status / is_deleted condition start
		($user_status == "Active") ? $disabled1 = '' : $disabled1 = 'disabled';
		($user_is_deleted == "Not_Deleted") ? $disabled2 = '' : $disabled2 = 'disabled';
		//Status / is_deleted condition end
		
		
		//Update status query start
		if(isset($user_id) && isset($status)){
			$update_status = "UPDATE employee_address_detail SET status = '$status', updated = '$updated' WHERE user_id = '$user_id' and id = '$main_id'";
			$status_update = mysqli_query($connection, $update_status);
		}
		//Update status query end
		
		
		//Update is deleted query start
		if(isset($user_id) && isset($is_deleted)){
			$update_is_deleted = "UPDATE employee_address_detail SET is_deleted = '$is_deleted', updated = '$updated' WHERE user_id = '$user_id' and id = '$main_id'";
			$is_deleted_update = mysqli_query($connection, $update_is_deleted);
		}
		//Update is deleted query end
		
	
		
		//Filter form query start
		$filter_country = isset($_REQUEST['filter_by_country']) ? test_input($_REQUEST['filter_by_country']) : null;
		$filter_state = isset($_REQUEST['filter_by_state']) ? test_input($_REQUEST['filter_by_state']) : null;
		$filter_status = isset($_REQUEST['filter_by_status']) ? $_REQUEST['filter_by_status'] : null;
		$where_condition = "";
		
		if(!empty($filter_country)){
			$where_condition .= "and country = '$filter_country'";
		}
		if(!empty($filter_state)){
			$where_condition .= "and state = '$filter_state'";
		}
		if($filter_status == "$active_status"){
			$where_condition .= "and status = '$active_status'";
		}
		if($filter_status == "$deactive_status"){
			$where_condition .= "and status = '$deactive_status'";
		}
		
		
			$page_record_limit = 10;
			$total_records = mysqli_query($connection, "SELECT COUNT(*) from employee_address_detail WHERE 1 $where_condition and user_id = $user_id");
			$count_records = mysqli_fetch_array($total_records);
			$total_no_of_pages = ceil($count_records[0] / $page_record_limit);
			$offset = ($page_no - 1) * $page_record_limit;
			$previous_page = $page_no - 1;
			$next_page = $page_no + 1;
		//Filter form query end
	
		$fetch_data = "SELECT * FROM employee_address_detail WHERE 1 $where_condition and user_id = $user_id order by user_id DESC limit $offset, $page_record_limit";
		$list = mysqli_query($connection, $fetch_data);
	
	
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			$data = strtolower($data);
			return $data;
		}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Address Details</title>

	<!-- Bootstrap css cdn link start -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- Bootstrap css cdn link end -->
	
	<!-- JQuery cdn link start -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<!-- JQuery cdn link end -->
</head>
<body>
	
		<div class="container-fluid">
			<div class="row p-2">
				
				<div class="row d-flex">
						<div class="col-11">
							<!-- Filter form start -->
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page_num=1&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&main_id=$main_id&user_status=$user_status&user_is_deleted=$user_is_deleted&name=$full_name");?>" id="filter_form" name="filter_form" class="mt-2 mb-1 p-2 row">
								
								<!-- Add address button start -->
								<div class="col-md-1">
									<a href=<?php echo "$base_url/address_details/add_address.php?page_num=$page_no&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&user_status=$user_status&user_is_deleted=$user_is_deleted&name=$full_name"; ?> class="btn btn-outline-primary <?php echo $disabled1 . " " . $disabled2; ?>">Add Address</a>
								</div>
								<!-- Add address button end -->
								
								
								
								<!-- Filter by country options start -->
								<div class="col-md-3">
									<select id="filter_by_country" name="filter_by_country" class="form-select">
										<option value=""> -- Filter by country -- </option>
										<?php
												$selected_country = (isset($_REQUEST['filter_by_country'])) ? $_REQUEST['filter_by_country'] : null;
												foreach($get_country as $row){
													($selected_country == $row['country_id']) ? $selected = 'selected' : $selected = '';
													echo '<option value="'. $row['country_id'] . '" '.$selected.'>'.$row['country_name'].'</option>';
												}
										?>
									</select>
								</div>
								<!-- Filter by country options end -->
								
								<!-- Filter by state options start -->
								<div class="col-md-3">
									<select id="filter_by_state" name="filter_by_state" class="form-select">
										<option value=""> -- Filter by state -- </option>
										<?php
												$selected_state = (isset($_REQUEST['filter_by_state'])) ? $_REQUEST['filter_by_state'] : null;
												foreach($get_state as $row){
													($selected_state == $row['state_id']) ? $selected = 'selected' : $selected = '';
													echo '<option value="'. $row['state_id'] . '" '.$selected.'>'.$row['state_name'].'</option>';
												}
										?>
									</select>
								</div>
								<!-- Filter by state options end -->
								
								
								<!-- Filter by status options start -->
								<div class="col-md-3">
									<select class="form-select" id="filter_by_status" name="filter_by_status">
										<option value=""> -- Filter by status -- </option>
										<option value="0" <?php echo ($filter_status == "0") ? 'selected' : ''; ?>>Active</option>
										<option value="1" <?php echo ($filter_status == "1") ? 'selected' : ''; ?>>Deactive</option>
									</select>
								</div>
								<!-- Filter by status options end -->
								
								<!-- Filter button start -->
								<div class="col-md-2">
									<input type="submit" class="btn btn-outline-success" id="filter_btn" name="filter_btn" value="Filter">
									<a href=<?php echo "$base_url/address_details/list.php?page_num=1&id=$user_id&main_id=$main_id&user_status=$user_status&user_is_deleted=$user_is_deleted&name=$full_name"; ?> class="btn btn-outline-danger" id="reset_btn">Reset</a>
									<a href=<?php echo "$base_url/list.php?page_num=$page_no&id=$user_id"; ?> class="btn btn-outline-primary">Back</a>
								</div>
								<!-- Filter button end -->
								
							</form>
							<!-- Filter form end -->
						</div>
				
						<!-- Export address details form start -->
						<div class="col-1">
							<form method="post" action='<?php echo "$base_url/export_user_details.php?page_num=$page_no&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&main_id=$main_id&user_status=$user_status&user_is_deleted=$user_is_deleted&name=$full_name&action=".USER_ADDRESS_DETAILS;?>' class="row mt-3">
								<div class="col-md-11"></div>
								<div class="col-md-1">
									<input type="submit" id="export_add" name="export_add" class="btn btn-info ms-2" value="Export Address">
								</div>
							</form>
						</div>
						<!-- Export address details form end -->
				</div>
				
				
				
				
				<!-- List view start -->
				<table class="table text-center table-bordered">
					  <thead>
						<tr>
						  <th scope="col">S.N.</th>
						  <th scope="col">Country</th>
						  <th scope="col">State</th>
						  <th scope="col">City</th>
						  <th scope="col">Pin Code</th>
						  <th scope="col">Address</th>
						  <th scope="col">Status</th>
						  <th scope="col">Is Deleted</th>
						  <th scope="col">Created</th>
						  <th scope="col">Updated</th>
						  <th scope="col">Action</th>
						</tr>
					  </thead>
					  <tbody>
						  <?php
							if(mysqli_num_rows($list) > 0){
								if($page_no > 1){
								$x = 1 + ($offset);
								}
								else{
									$x = 1;
								}
								while($row1 = mysqli_fetch_assoc($list)){
									$user_id = $row1['user_id'];
									$main_id = $row1['id'];
									$serial_num = $x;
									$x++;
							?>
							<tr>
								<td><?php echo (!empty($row1['user_id'])) ? $serial_num : "NA"; ?></td>
								<td>
									<?php
											if(!empty($row1['country'])){
												foreach($get_country as $row){
													if($row1['country'] == $row['country_id']){
														$row1['country'] = strtolower($row['country_name']);
														echo ucfirst($row1['country']);
													}
												}
											}
											else{
												echo "NA";
											}
									?>
								</td>	
								<td>
									<?php
											if(!empty($row1['state'])){
												foreach($get_state as $row){
													if($row1['state'] == $row['state_id']){
														$row1['state'] = strtolower($row['state_name']);
														echo ucfirst($row1['state']);
													}
												}
											}
											else{
												echo "NA";
											}
									?>
								</td>
								<td>
									<?php
											if(!empty($row1['city'])){
												foreach($get_city as $row){
													if($row1['city'] == $row['city_id']){
														$row1['city'] = strtolower($row['city_name']);
														echo ucfirst($row1['city']);
													}
												}
											}
											else{
												echo "NA";
											}
									?>
								</td>
								<td><?php echo (!empty($row1['pin'])) ? strtolower($row1['pin']) : "NA"; ?></td>
								<td><?php echo (!empty($row1['address'])) ? strtolower($row1['address']) : "NA"; ?></td>
								<td><?php echo ($row1['status'] == $active_status) ? "<span class='text-success'>Active</span>" : "<span class='text-danger'>Deactive</span>"; ?></td>
								<td><?php echo ($row1['is_deleted'] == $not_deleted) ? "<span class='text-success'>Not Deleted</span>" : "<span class='text-danger'>Deleted</span>"; ?></td>	
								<td><?php echo (!empty($row1['created'])) ? $row1['created'] : "NA"; ?></td>	
								<td><?php echo (!empty($row1['updated'])) ? $row1['updated'] : "NA"; ?></td>
								<td>
									<?php
										if($row1['status'] == $active_status){
											$status_url = "$base_url/address_details/list.php?page_num=$page_no&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&status=$deactive_status&main_id=$main_id&user_status=$user_status&user_is_deleted=$user_is_deleted&name=$full_name";
											$status_button_name = "Mark Deactive";
											$status_button_style = "width:150px;";
											$status_button_class = "btn-outline-danger ms-2";
											$status_message = "Are you sure to mark as deactive <span class='text-danger'>$full_name's " .$row1['country']. "'s</span> address ?";
											$disabled3 = '';
										}
										else{
											$status_url = "$base_url/address_details/list.php?page_num=$page_no&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&status=$active_status&main_id=$main_id&user_status=$user_status&user_is_deleted=$user_is_deleted&name=$full_name";
											$status_button_name = "Mark Active";
											$status_button_style = "width:150px;";
											$status_button_class = "btn-outline-success ms-2";
											$status_message = "Do you want to mark as active  <span class='text-success'>$full_name's " .$row1['country']. "'s</span> address ?";
											$disabled3 = 'disabled';
										}
										
										
										if($row1['is_deleted'] == $not_deleted){
											$url = "$base_url/address_details/list.php?page_num=$page_no&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&is_deleted=$deleted&main_id=$main_id&user_status=$user_status&user_is_deleted=$user_is_deleted&name=$full_name";
											$button_name = "Mark Deleted";
											$button_style = "width:170px;";
											$button_class = "btn-outline-danger ms-2";
											$message = "Are you sure to mark as deleted <span class='text-danger'>$full_name's " .$row1['country']. "'s</span> address ?";
											$disabled4 = '';
										}
										else{
											$url = "$base_url/address_details/list.php?page_num=$page_no&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&is_deleted=$not_deleted&main_id=$main_id&user_status=$user_status&user_is_deleted=$user_is_deleted&name=$full_name";
											$button_name = "Mark Not Deleted";
											$button_style = "width:170px;";
											$button_class = "btn-outline-success ms-2";
											$message = "Do you want to mark as not deleted <span class='text-success'> $full_name's " .$row1['country']. "'s</span> address ?";
											$disabled4 = 'disabled';
										}
									
										echo "<a href='$base_url/address_details/add_address.php?page_num=$page_no&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&main_id=$main_id&user_status=$user_status&user_is_deleted=$user_is_deleted&name=$full_name' class='btn btn-warning ms-2 $disabled1 $disabled2 $disabled3 $disabled4'>Edit</a>";
										
										echo "<input type='button' class='btn $status_button_class' style='$status_button_style' value='$status_button_name' data-bs-toggle='modal' data-bs-target='#confirmation_status$main_id'>";	
										echo "<div class='modal fade' id='confirmation_status$main_id' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-hidden='true'>
											  <div class='modal-dialog modal-dialog-centered modal-lg'>
												<div class='modal-content'>
												  <div class='modal-body h3'>"
													. $status_message .
												  "</div>
												  <div class='modal-footer'>
													<button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>No</button>
													<a href='$status_url' class='btn $status_button_class'>Yes</a>
												  </div>
												</div>
											  </div>
											</div>";
											
										echo "<input type='button' class='btn $button_class' style='$button_style' value='$button_name' data-bs-toggle='modal' data-bs-target='#confirmation_delete$main_id'>";
										echo "<div class='modal fade' id='confirmation_delete$main_id' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-hidden='true'>
											  <div class='modal-dialog modal-dialog-centered modal-lg'>
												<div class='modal-content'>
												  <div class='modal-body h3'>"
													. $message .
												  "</div>
												  <div class='modal-footer'>
													<button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>No</button>
													<a href='$url' class='btn $button_class'>Yes</a>
												  </div>
												</div>
											  </div>
											</div>";
									?>
								</td>	
							</tr>
							
						<?php
								}
							}
							else{
						?> 
								<tr><td colspan=11>No Record Found</td></tr>
						<?php
							}
						  ?>
					  </tbody>
				</table>
				<!-- List view end -->
				
			</div>
		</div>
				
		<?php echo "Showing ". ($offset + 1) . " to " .  ($offset + mysqli_num_rows($list))  . " of $count_records[0] entries"; ?>
		
		<!-- Pagination start -->
        <?php
			echo "<nav>";
			  echo "<ul class='pagination justify-content-center'>";
				$disabled = ($page_no <= 1) ? $disabled = 'disabled' : $disabled = '';
				echo "<li class='page-item $disabled'><a class='page-link' href='$base_url/address_details/list.php?page_num=$previous_page&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&main_id=$main_id&name=$full_name&user_status=$user_status&user_is_deleted=$user_is_deleted'>Previous</a></li>";
					for($i = 1; $i <= $total_no_of_pages; $i++){
						$active = ($page_no == $i) ? $active = 'active' : $active = '';
						echo "<li class='page-item $active'><a class='page-link' name='page_link' href='$base_url/address_details/list.php?page_num=$i&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&main_id=$main_id&name=$full_name&user_status=$user_status&user_is_deleted=$user_is_deleted'>$i</a></li>";
					}
				  $disabled = ($page_no >= $total_no_of_pages) ? $disabled = 'disabled' : $disabled = '';
				echo "<li class='page-item $disabled'><a class='page-link' href='$base_url/address_details/list.php?page_num=$next_page&filter_by_country=$filter_country&filter_by_state=$filter_state&filter_by_status=$filter_status&id=$user_id&main_id=$main_id&name=$full_name&user_status=$user_status&user_is_deleted=$user_is_deleted'>Next</a></li>";
			  echo "</ul>";
			echo "</nav>";
		?>
        <!-- Pagination end -->



	<!-- Bootstrap js cdn link start -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- Bootstrap js cdn link end -->
</body>
</html>
