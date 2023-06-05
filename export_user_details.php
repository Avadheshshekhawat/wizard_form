<?php
			include_once "db_connection.php";
			include_once "global_constant.php";
			include_once "global_function.php";
			
			if(!$connection){
				die( "Connection Error : " . mysqli_connect_error() );
			}
			
			
			
			$user_id = (isset($_GET['id'])) ? $_GET['id'] : null;
			$action = (isset($_GET['action'])) ? $_GET['action'] : null;
			$full_name = isset($_GET['name']) ? $_GET['name'] : null;
			$active_status = (defined('ACTIVE')) ? ACTIVE : null;
			$deactive_status = (defined('DEACTIVE')) ? DEACTIVE : null;
			$get_country = (function_exists('countries_get')) ? countries_get() : null;
			$get_state = (function_exists('states_get')) ? states_get() : null;
			$get_city = (function_exists('cities_get')) ? cities_get() : null;
			$time_stamp = date("y-m-d__H-i-s");
			$table_name = "";
			$file_name = "";
			$where_condition = "";
			$output = "";
			$column_names = array();
			$columns = array();
			
			
			switch($action){
				case USER_DETAILS:
					user_details();
					break;
					
				case USER_BANK_DETAILS:
					user_bank_details();
					break;
					
				case USER_ADDRESS_DETAILS:
					user_address_details();
					break;
					
				default:
					echo "This is default case";
					break;
			}
			
			
			
			
			
			
			/*
				* Name: user_details()
				* Description: Used to filter user details from 'employee_detail_table'
				* Param:
				* Return:
				* Created on: 29-April-2023
				* Created by: Avadhesh Shekhawat
			*/
			function user_details(){
				global $connection;
				global $table_name;
				global $file_name;
				global $where_condition;
				global $active_status;
				global $deactive_status;
				global $time_stamp;
				global $column_names;
				global $columns;
				
				$filter_full_name = isset($_REQUEST['filter_by_full_name']) ? $_REQUEST['filter_by_full_name'] : null;
				$filter_email = isset($_REQUEST['filter_by_email']) ? $_REQUEST['filter_by_email'] : null;
				$filter_country = isset($_REQUEST['filter_by_country']) ? $_REQUEST['filter_by_country'] : null;
				$filter_status = isset($_REQUEST['filter_by_status']) ? $_REQUEST['filter_by_status'] : null;
				
				if(!empty($filter_full_name)){
					$where_condition .= "and full_name LIKE '%$filter_full_name%'";
				}
				if(!empty($filter_email)){
					$where_condition .= "and email LIKE '%$filter_email%'";
				}
				if(!empty($filter_country)){
					$where_condition .= "and country = '$filter_country'";
				}
				if($filter_status == "$active_status"){
					$where_condition .= "and status = '$active_status'";
				}
				if($filter_status == "$deactive_status"){
					$where_condition .= "and status = '$deactive_status'";
				}
	
			
				
				$column_names = ["S.No.", "Name", "DOB", "Gender", "Username", "Email", "Country Code", "Phone Number", "Address", "Country", "Employee Id", "Designation", "Department", "Working Hour", "Status", "Is Deleted", "Created", "Updated"];
				$columns = "user_id, full_name, dob, gender, user_name, email, country_code, phone, address, country, employee_id, designation, department, working_hour, status, is_deleted, created, updated";
				$table_name = "employee_detail_table";
				$file_name = "user_details - $time_stamp.xls";
				
				export_function($table_name, $file_name, $where_condition, $column_names, $columns);
			}
			
			
			
			
			
			
			
			
			/*
				* Name: user_bank_details()
				* Description: Used to filter user bank details from 'employee_bank_detail' table
				* Param:
				* Return:
				* Created on: 29-April-2023
				* Created by: Avadhesh Shekhawat
			*/
			function user_bank_details(){
				global $connection;
				global $table_name;
				global $file_name;
				global $where_condition;
				global $active_status;
				global $deactive_status;
				global $time_stamp;
				global $column_names;
				global $columns;
				global $user_id;
				global $full_name;
				
				$filter_bank_name = isset($_REQUEST['filter_by_bank_name']) ? $_REQUEST['filter_by_bank_name'] : null;
				$filter_card_num = isset($_REQUEST['filter_by_card_num']) ? $_REQUEST['filter_by_card_num'] : null;
				$filter_status = isset($_REQUEST['filter_by_status']) ? $_REQUEST['filter_by_status'] : null;
				
				
				
				if(!empty($filter_bank_name)){
					$where_condition .= "and bank_name LIKE '%$filter_bank_name%' ";
				}
				if(!empty($filter_card_num)){
					$where_condition .= "and card_num LIKE '%$filter_card_num%' ";
				}
				if($filter_status == "$active_status"){
					$where_condition .= "and status = '$active_status' ";
				}
				if($filter_status == "$deactive_status"){
					$where_condition .= "and status = '$deactive_status' ";
				}
				
				$where_condition .= "and user_id = $user_id";
				$column_names = ["S.No.", "Bank Name", "Holder Name", "Expiry Date", "Payment Type", "Card Number", "CVC Number", "Status", "Is Deleted", "Created", "Updated"];
				$columns = "id, bank_name, holder_name, expiry_date, payment_type, card_num, cvc, status, is_deleted, created, updated";
				$table_name = "employee_bank_detail";
				$file_name = "$full_name"."_bank_details - $time_stamp.xls";
				
				
				export_function($table_name, $file_name, $where_condition, $column_names, $columns);
			}
			
			
			
			
			
			
			
			
			
			/*
				* Name: user_address_details()
				* Description: Used to filter user address details from 'employee_address_detail' table
				* Param:
				* Return:
				* Created on: 29-April-2023
				* Created by: Avadhesh Shekhawat
			*/
			function user_address_details(){
				global $connection;
				global $table_name;
				global $file_name;
				global $where_condition;
				global $active_status;
				global $deactive_status;
				global $time_stamp;
				global $column_names;
				global $columns;
				global $user_id;
				global $full_name;
				
				$filter_country = isset($_REQUEST['filter_by_country']) ? $_REQUEST['filter_by_country'] : null;
				$filter_state = isset($_REQUEST['filter_by_state']) ? $_REQUEST['filter_by_state'] : null;
				$filter_status = isset($_REQUEST['filter_by_status']) ? $_REQUEST['filter_by_status'] : null;
				
				
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
					
					
					$where_condition .= " and user_id = $user_id";
					$column_names = ["S.No.", "Name", "Country", "State", "City", "Pin Code", "Address", "Status", "Is Deleted", "Created", "Updated"];
					$columns = "id, user_id, country, state, city, pin, address, status, is_deleted, created, updated";
					$table_name = "employee_address_detail";
					$file_name = "$full_name"."_address_details - $time_stamp.xls";
					
					
					export_function($table_name, $file_name, $where_condition, $column_names, $columns);
			}
			
			
			
			
			/*
				* Name: export_function()
				* Description: Used to export user details into excel formet
				* Param:
				* Return:
				* Created on: 28-April-2023
				* Created by: Avadhesh Shekhawat
			*/
			function export_function($table_name, $file_name, $where_condition, $column_names, $columns){
				global $connection;
				global $table_name;
				global $file_name;
				global $where_condition;
				global $column_names;
				global $columns;
				global $active_status;
				global $get_country;
				global $get_state;
				global $get_city;
				global $full_name;
				
				
				
				$not_deleted = (defined('NOT_DELETED')) ? NOT_DELETED : null;
				$deleted = (defined('DELETED')) ? DELETED : null;
				$gender = (defined('GENDER')) ? GENDER : null;
				$country_code = (defined('COUNTRY_CODE')) ? COUNTRY_CODE : null;
				$payment_type = (defined('PAYMENT_TYPE')) ? PAYMENT_TYPE : null;
				
				
				
				$output = "<table border=1 cellpadding=5 style='text-align:center;'><tr>";
				for($i = 0; $i < count($column_names); $i++){
					$output .= "<th>$column_names[$i]</th>";
				}
				$output .= "</tr>";
				
				
				
				//Fetch table data query start
				$fetch_data = "SELECT $columns FROM $table_name WHERE 1 $where_condition ORDER BY user_id DESC";
				$list = mysqli_query($connection, $fetch_data);
				//Fetch table data query end
				
				
				if(mysqli_num_rows($list) > 0){
					$x = 1;
					
						while($row1 = mysqli_fetch_assoc($list)){
								($table_name == "employee_detail_table") ? $row1['user_id'] = $x : $row1['id'] = $x;
								$x++;
								($row1['status'] == $active_status) ? $row1['status'] = "Active" : $row1['status'] = "Deactive";
								($row1['is_deleted'] == $not_deleted) ? $row1['is_deleted'] = "Not Deleted" : $row1['is_deleted'] = "Deleted";
								(!empty($row1['updated'])) ? $row1['updated'] = $row1['updated'] : $row1['updated'] = "NA";
								
								
								if($table_name == "employee_detail_table" || $table_name == "employee_address_detail"){
									if(!empty($row1['country'])){
										foreach($get_country as $row){
											if($row1['country'] == $row['country_id']){
												$row1['country'] = strtolower($row['country_name']);
											}
										}
									}
									else{
										$row1['country'] = "NA";
									}
								}
								
								if($table_name == "employee_detail_table"){
									if(!empty($row1['gender'])){
										foreach($gender as $gender_key => $gender_values){
											if($row1['gender'] == $gender_key){
												$row1['gender'] = $gender_values;
											}
										}
									}
									else{
										$row1['gender'] = "NA";
									}
									
									if(!empty($row1['country_code'])){
										foreach($country_code as $country_code_key => $country_code_values){
											if($row1['country_code'] == $country_code_key){
												$row1['country_code'] = $country_code_values;
											}
										}
									}
									else{
										$row1['country_code'] = "NA";
									}
								}	
								
								if($table_name == "employee_bank_detail"){
									if(!empty($row1['payment_type'])){
										foreach($payment_type as $payment_type_key => $payment_type_values){
											if($row1['payment_type'] == $payment_type_key){
												$row1['payment_type'] = $payment_type_values;
											}
										}
									}
									else{
										$row1['payment_type'] = "NA";
									}
								}
								
								if($table_name == "employee_address_detail"){
									if(!empty($row1['state'])){
										foreach($get_state as $row){
											if($row1['state'] == $row['state_id']){
												$row1['state'] = strtolower($row['state_name']);
											}
										}
									}
									else{
										$row1['state'] = "NA";
									}
									
									if(!empty($row1['city'])){
										foreach($get_city as $row){
											if($row1['city'] == $row['city_id']){
												$row1['city'] = strtolower($row['city_name']);
											}
										}
									}
									else{
										$row1['city'] = "NA";
									}
									
									$row1['user_id'] = $full_name;
								}
								
								
								$output .= "<tr>";
								foreach($row1 as $data_value){
									
									$output .= "<td>". ucfirst($data_value) . "</td>";
								}
								$output .= "</tr>";
						}
				}
		
				
				$output .= "</table>";
				
				
				header("Content-Type: application/xls");
				header("Content-Disposition: attachment; filename =" . $file_name);
				
				echo $output;
			}
			
			
?>
