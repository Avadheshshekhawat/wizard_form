<?php
	include_once "db_connection.php";
	
	if(!$connection){
		die( "Connection Error : " . mysqli_connect_error() );
	}
	
	
	$country_id = (isset($_GET['country_id'])) ? $_GET['country_id'] : null;
	$state_id = (isset($_GET['state_id'])) ? $_GET['state_id'] : null;
	
	
	/*
	 * Name: countries_get()
	 * Description: Used to get countries list from database
	 * Param:
	 * Return:
	 * Created on: 14-April-2023
	 * Created by: Avadhesh Shekhawat
	 */
	 function countries_get(){
		 global $connection;
		 $country_get = array();
		 
		 if($connection){
			 $countries = "SELECT country_id, country_name FROM country WHERE status = 0 and is_deleted = 0";
			 $result = mysqli_query($connection, $countries);
			 
			 if(mysqli_num_rows($result) > 0){
				 while($row = mysqli_fetch_assoc($result)){
					 $country_get[] = $row;
				 }
			 }
			 else{
				 $country_get[] = "Error";
			 }
		 }
		 else{
			 $country_get[] = "Error";
		 }
		 return $country_get;
	 }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 /*
	 * Name : states_get()
	 * Description : Used to get states list
	 * Param : 
	 * Return : 
	 * Created on : 17 April 2023
	 * Created by : Avadhesh Singh
	 */
	 function states_get(){
		 global $connection;
		 global $country_id;
		 $get_states = array();
		 
		 if($connection){
			 
			 if(empty($country_id)){
				 $states = "Select state_id, state_name from state where  status = 0 and is_deleted = 0";
				 $result = mysqli_query($connection, $states);
			 }
			 if(!empty($country_id)){
				 $get_states = '<option value=""> -- Select State -- </option>';
				 $states = "Select state_id, state_name from state where country_id = '$country_id'";
				 $result = mysqli_query($connection, $states);
			 }
			 
			 if( (mysqli_num_rows($result) > 0) && empty($country_id) ){
				 while($row = mysqli_fetch_assoc($result)){
					 $get_states[] = $row;
				 }
			 }
			 if( (mysqli_num_rows($result) > 0) && !empty($country_id) ){
				 while($row = mysqli_fetch_assoc($result)){
					$get_states .= '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
				 }
			 }
			 else{
				 $get_states[] = "Error";
			 }
		 }
		 else{
			 $get_states[] = "Error";
		 }
		 return $get_states;
	 }
	 
	 if(!empty($country_id)){
		 $get_states = states_get() ? states_get() : null;
		 echo $get_states;
	 }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 /*
	 * Name : cities_get()
	 * Description : Used to get cities list
	 * Param : 
	 * Return : 
	 * Created on : 17 April 2023
	 * Created by : Avadhesh Singh
	 */
	 function cities_get(){
		 global $connection;
		 global $state_id;
		 $get_cities = array();
		 
		 if($connection){
			 if(empty($state_id)){
				 $cities = "Select city_id, city_name from city where status = 0 and is_deleted = 0";
				 $result = mysqli_query($connection, $cities);
			 }
			 if(!empty($state_id)){
				 $get_cities = '<option value=""> -- Select City -- </option>';
				 $cities = "Select city_id, city_name from city where state_id = '$state_id'";
				 $result = mysqli_query($connection, $cities);
			 }
			 
			 if( (mysqli_num_rows($result) > 0) && empty($state_id) ){
				 while($row = mysqli_fetch_assoc($result)){
					 $get_cities[] = $row;
				 }
			 }
			 if( (mysqli_num_rows($result) > 0) && !empty($state_id) ){
				 while($row = mysqli_fetch_assoc($result)){
					$get_cities .= '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
				 }
			 }
			 else{
				 $get_cities[] = "Error";
			 }
		 }
		 else{
			 $get_cities[] = "Error";
		 }
		 return $get_cities;
	 }
	 
	 if(!empty($state_id)){
		 $get_cities = cities_get() ? cities_get() : null;
		 echo $get_cities;
	 }
?>
