<?php
			include_once "db_connection.php";
			include_once "global_constant.php";
			
			$get_duplicate_entry = array();
				
			if(!$connection){
				$get_duplicate_entry['Connection_status'] = mysqli_connect_error();
			}
			else{
				$get_duplicate_entry['Connection_status'] = "Database connected";
			}
			
			
			
			
			
			$unique_entry_check = (isset($_REQUEST['unique_entry_check'])) ? $_REQUEST['unique_entry_check'] : null;
			$user_id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
			$main_id = (isset($_REQUEST['main_id'])) ? $_REQUEST['main_id'] : null;
			$where_condition = "";
			$varable_name = "";
			$table_name = "";
			
			switch($unique_entry_check){
				case UNIQUE_USERNAME:
					duplicate_user_name_check();
					break;
				
				case UNIQUE_EMAIL:
					duplicate_email_check();
					break;
					
				case UNIQUE_PHONE:
					duplicate_phone_check();
					break;
					
				case UNIQUE_EMPLOYEE_ID:
					duplicate_employee_id_check();
					break;
					
				case UNIQUE_CARD_NUMBER:
					duplicate_card_num_check();
					break;
					
				default:
					$get_duplicate_entry['default_case'] = "This is default case";
			}
			
			
			
			
			
			/*
			 * Name: duplicate_user_name_check()
			 * Description: Used to check duplicate user name entry
			 * Param:
			 * Return:
			 * Created on: 25-April-2023
			 * Created by: Avadhesh Shekhawat
			 */
			function duplicate_user_name_check(){
				global $connection;
				global $user_id;
				global $where_condition;
				global $varable_name;
				global $table_name;
				
				$user_name = (isset($_REQUEST['user_name'])) ? $_REQUEST['user_name'] : null;
						
				if( !empty($user_name) ){
					$where_condition .= "and user_name = '$user_name'";
					$varable_name = "username";
					$table_name = "employee_detail_table";
				}
				if( !empty($user_id) ){
					$where_condition .= "and user_id != '$user_id'";
					$varable_name = "username";
					$table_name = "employee_detail_table";
				}
				
				unique_entry_check_query($where_condition, $table_name, $varable_name);
			}
			
			
			
			
			
			
			
			
			
			
			
			
			/*
			 * Name: duplicate_email_check()
			 * Description: Used to check duplicate email entry
			 * Param:
			 * Return:
			 * Created on: 25-April-2023
			 * Created by: Avadhesh Shekhawat
			 */
			function duplicate_email_check(){
				global $connection;
				global $user_id;
				global $where_condition;
				global $varable_name;
				global $table_name;
				
				$email = (isset($_REQUEST['email'])) ? $_REQUEST['email'] : null;
						
				if( !empty($email) ){
					$where_condition .= "and email = '$email'";
					$varable_name = "email";
					$table_name = "employee_detail_table";
				}
				if( !empty($user_id) ){
					$where_condition .= "and user_id != '$user_id'";
					$varable_name = "email";
					$table_name = "employee_detail_table";
				}
				
				unique_entry_check_query($where_condition, $table_name, $varable_name);
			}
			
			
			
			
			
			
			
			
			
			/*
			 * Name: duplicate_phone_check()
			 * Description: Used to check duplicate phone number entry
			 * Param:
			 * Return:
			 * Created on: 26-April-2023
			 * Created by: Avadhesh Shekhawat
			 */
			function duplicate_phone_check(){
				global $connection;
				global $user_id;
				global $where_condition;
				global $varable_name;
				global $table_name;
				
				$country_code = (isset($_REQUEST['country_code'])) ? $_REQUEST['country_code'] : null;
				$phone = (isset($_REQUEST['phone'])) ? $_REQUEST['phone'] : null;
						
				if( !empty($phone) ){
					$where_condition .= "and full_phone_num = '$country_code$phone'";
					$varable_name = "phone";
					$table_name = "employee_detail_table";
				}
				if( !empty($user_id) ){
					$where_condition .= "and user_id != '$user_id'";
					$varable_name = "phone";
					$table_name = "employee_detail_table";
				}
				
				unique_entry_check_query($where_condition, $table_name, $varable_name);
			}
			
			
			
			
			
			
			
			
			
			
			/*
			 * Name: duplicate_employee_id_check()
			 * Description: Used to check duplicate employee id entry
			 * Param:
			 * Return:
			 * Created on: 26-April-2023
			 * Created by: Avadhesh Shekhawat
			 */
			function duplicate_employee_id_check(){
				global $connection;
				global $user_id;
				global $where_condition;
				global $varable_name;
				global $table_name;
				
				$employee_id = (isset($_REQUEST['employee_id'])) ? $_REQUEST['employee_id'] : null;
						
				if( !empty($employee_id) ){
					$where_condition .= "and employee_id = '$employee_id'";
					$varable_name = "employee id";
					$table_name = "employee_detail_table";
				}
				if( !empty($user_id) ){
					$where_condition .= "and user_id != '$user_id'";
					$varable_name = "employee id";
					$table_name = "employee_detail_table";
				}
				
				unique_entry_check_query($where_condition, $table_name, $varable_name);
			}
			
			
			
			
			
			
			
			/*
			 * Name: duplicate_card_num_check()
			 * Description: Used to check duplicate card number entry
			 * Param:
			 * Return:
			 * Created on: 26-April-2023
			 * Created by: Avadhesh Shekhawat
			 */
			function duplicate_card_num_check(){
				global $connection;
				global $user_id;
				global $main_id;
				global $where_condition;
				global $varable_name;
				global $table_name;
				
				$card_number = (isset($_REQUEST['card_number'])) ? $_REQUEST['card_number'] : null;
						
				if( !empty($card_number) ){
					$where_condition .= "and card_num = '$card_number'";
					$varable_name = "card number";
					$table_name = "employee_bank_detail";
				}
				if( !empty($user_id) ){
					$where_condition .= "and user_id != '$user_id'";
					$varable_name = "card number";
					$table_name = "employee_bank_detail";
				}
				if( !empty($main_id) ){
					$where_condition .= "and id != '$main_id'";
					$varable_name = "card number";
					$table_name = "employee_bank_detail";
				}
				
				unique_entry_check_query($where_condition, $table_name, $varable_name);
			}
			
			
			
			
			
			/*
			 * Name: unique_entry_check_query()
			 * Description: Used to run unique entry check query
			 * Param:
			 * Return:
			 * Created on: 25-April-2023
			 * Created by: Avadhesh Shekhawat
			 */
			function unique_entry_check_query($where_condition, $table_name, $varable_name){
				global $connection;
				global $get_duplicate_entry;
				global $where_condition;
				global $varable_name;
				global $table_name;
				
				
				$duplicate_entry_check_query = "SELECT * FROM $table_name WHERE 1 $where_condition";
				$result = mysqli_query($connection, $duplicate_entry_check_query);
				$count = mysqli_num_rows($result);
				
				if($count > 0){
					$get_duplicate_entry['status'] = "Error";
					$get_duplicate_entry['message'] = "This $varable_name is already exist please try another";
					$get_duplicate_entry['count'] = $count;
				}
				else{
					$get_duplicate_entry['status'] = "Success";
					$get_duplicate_entry['message'] = "This $varable_name is free to use";
					$get_duplicate_entry['count'] = $count;
				}
				
				return $get_duplicate_entry;
			}
			
			
			
			echo json_encode($get_duplicate_entry);
?>
