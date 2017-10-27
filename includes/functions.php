<?php 

	function connect_to_db(){
		global $connection;
		define("DB_SERVER", "localhost");
		define("DB_USER", "root");
		define("DB_PASS", "");
		define("DB_NAME", "");
		
		$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		//check if connection was successful
		if (mysqli_connect_errno()) {
			die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
		}

	}
	function close_db(){
		global $connection;
		$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		return mysqli_close($connection);
	}
?>

<?php 
	
	function get_balance($user_id){
		global $connection;
		$query = "SELECT remaining_amount FROM wallet_balance WHERE user_id = $user_id";
		$result = mysqli_query($connection, $query);
		$balance = mysqli_fetch_assoc($result)['remaining_amount'];
		return $balance;
	}

?>
<?php 
	function create_admin($email, $password){
		global $connection;
		$safeEmail = mysql_prep($connection, $email);
		$safePassword = mysql_prep($connection, $password);
		$hashed_pass = encrypt($safePassword);
		$query  = "INSERT INTO  ";
			$query .= "admin (email, admin_password) ";
			$query .= "VALUES ('{$safeEmail}', '{$hashed_pass}') ";
			$result = mysqli_query($connection, $query);
			if ($result) {
				return true;
			}else{
				return false;
			}
	}
?>
<?php 
	function get_pending_admins(){
		global $connection;
		$query = "SELECT * FROM admin WHERE status = 'pending'";
		$result = mysqli_query($connection, $query);
		return $result;
	}
?>
<?php 
	function update_admin_status($admin_id, $value, $column){
		global $connection;
		//$query = "UPDATE admin SET status = '{$status}' WHERE id = {$id} LIMIT 1";
		$query = "UPDATE admin SET $column = '{$value}' WHERE id = $admin_id LIMIT 1 ";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			echo "Admin Update failde!";
		}else{
			echo "Admin Update successful.";
		}
	}	
?>
<?php 
	function login_admin($email, $password){
		global $connection;
		$_SESSION["admin_pend_error"] = "";
		$safeEmail = mysql_prep($connection, $email);
		$safePassword = mysql_prep($connection, $password);
		$query = "SELECT * From admin WHERE email = '$email' LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_array = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) == 0 ) {
			return false;
		}elseif ($result_array["status"]=="pending") {
			$_SESSION["admin_pend_error"] = "Your Account is not yet verified. Check Back in Six Hours Time";
			return false;
		}else{
			$hashed_pass = $result_array["admin_password"];
			if (decrypt($safePassword, $hashed_pass)) {
				//successful login
				return true;
			}else{
				return false;
			}
		}
	}
?>
<?php
	function getIpAddress(){
		$clientIp = $_SERVER['HTTP_CLIENT_IP'];
		$xForwardedFor = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$remoteAddress = $_SERVER['REMOTE_ADDR'];
		if (!empty($clientIp)) {
			$ipAddress = $clientIp;
			return $ipAddress;
		}elseif (!empty($xForwardedFor)) {
			$ipAddress = $xForwardedFor;
			return $ipAddress;
		}else{
			$ipAddress = $remoteAddress;
			return $ipAddress;
		}
	}
 ?>
<?php 
	function encrypt($password){
		
		return $hashed_password;
	}
	function generate_salt($length){
		
		return $salt;
	}
	function decrypt($password, $existing_hash){
		$hash = crypt($password, $existing_hash);
		if ($hash === $existing_hash) {
			return true;
		}else{
			return false;
		}
	}
?>
<?php 
	function mysql_prep($value1, $value2){
		global $string;
		$string = mysqli_real_escape_string($value1, $value2);
		return $string;
	}
?>
<?php 
	// form validation
	//Checking for presensce
	function has_no_presence($value){
		if (empty($value)) {
			//am aware of the zero inclusion in the empty fnction
			$message  = "Field cannot be empty.";
			return $message;
		}else{
			$message = null;
			return $message;
		}
	}

?>
<?php 
	// checking for min length
	$min = 3;
	function min_length($value){
		global $min;
		if (strlen($value)<=$min) {
			$message = "Characters must be 3 or more.";
			return $message;
		}else{
			$message = null;
			return $message;
		}
	}
?>	
<?php 
	//check for max length
	$max = 30;
	function max_length($value){
		global $max;
		if (strlen($value)>=$max) {
			$message = "Characters must be 30 or less.";
			return $message;
		}else{
			$message = null;
			return $message;
		}
	}
?>
<?php 
	function validate_email($email){
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}else{
			return false;
		}
	}
?>
<?php 
	function log_out(){
		session_destroy();
	}
?>
<?php 
	function selected($value){
		if (isset($value) && $value!=="Select") {
			return true;
		}else{
			return false;
		}
	}
?>
<?php 
	function update($table, $column, $value, $id, $message){
		global $connection;
		$query = "UPDATE $table SET $column = '$value' WHERE id = $id";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			echo "{$message} update was not successful <br />" ;
		}else{
			echo "{$message} update was successful <br />" ;
		}
	} 
?>

<?php 
	function add_menu_item($restaurant_id, $food_item, $price){
		global $connection;
		$query = "INSERT INTO menu(restaurant_id, food_item, price) VALUES($restaurant_id, '{$food_item}', {$price})";
		$result = mysqli_query($connection, $query);
		if(!$result){
			echo "{$food_item} Addition was not successful. <br />";
		}else{
			echo "{$food_item} Addition was successful. <br />";
		}
	}
?>
<?php 
	function update_menu_item($menu_id, $food_item, $price){
		global $connection;
		$query = "UPDATE menu SET food_item = '$food_item', price=$price WHERE id=$menu_id ";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			echo "Menu Update failde!";
		}else{
			echo "Menu Update successful.";
		}
	}
?>
<?php 
	/*function to insert order details  --- moved to orders class
	function place_order($user_id, $menu_id, $restaurant_id, $qty_ordered, $shipping_cost, $total_cost, $orderer_phone, $orderer_address){
		global $connection;
		$query = "INSERT INTO orders(user_id, menu_id, restaurant_id, qty_ordered, shipping_cost, total_cost, orderer_phone, orderer_address) VALUES({$user_id}, {$menu_id}, {$restaurant_id}, {$qty_ordered}, {$shipping_cost}, {$total_cost}, {$orderer_phone}, '{$orderer_address}') ";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Database connection failed: " . mysqli_error($connection) . mysqli_errno($connection));
		}else{
			echo "Success";
		}
	} */
	
?>

<?php 
	//update the delivery status
	function delivered($user_id, $restaurant_id, $orderer_phone, $order_time){
		global $connection;
		//$phone = substr('{$orderer_phone}', 1);
		$query = "UPDATE orders SET delivered = 1 WHERE ((orders.user_id = $user_id AND orders.restaurant_id = $restaurant_id) AND (orders.order_time = '$order_time' AND orders.orderer_phone = $orderer_phone)) LIMIT 1";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			echo "Could not update delivery status" . mysqli_error($connection);
		}else{
			echo "Delivery Status Updated Succesfully";
		}

	}
?>
<?php 
	//function to update user info
function update_user($column, $value, $id){
	global $connection;
	//$column = mysql_prep($connection, $column);
	//$value = mysql_prep($connection, $value);
	//$id = mysql_prep($connection, $id);
	$query = "UPDATE members SET $column = '{$value}' WHERE id = $id LIMIT 1 ";
	$result = mysqli_query($connection, $query);
	if(!$result){
		die("Database connection failed. " . mysqli_error($connection));
		return false;
	}else{
		return true;
	}
}
?>

<?php 

function email_exist($email){
	global $connection;
	$query = "SELECT * FROM memebers WHERE email_address = '{$email}'";
	$result = mysqli_query($connection, $query);
	if(!$result){
		die("Database connection failed. " . mysqli_error($connection));
	}else{
		echo "Hello";
		return mysqli_num_rows($result) > 0 ? true : false;
	}

}

?>
<?php 
	//function to update urestaurant logo
function update_logo($column, $value, $id){
	global $connection;
	$query = "UPDATE restaurant SET $column = '{$value}' WHERE id = $id LIMIT 1 ";
	$result = mysqli_query($connection, $query);
	if(!$result){
		die("Database connection failed. " . mysqli_error($connection));
		return false;
	}else{
		return true;
	}
}
?>
<?php 
//Restaurant operation time methods
	function opening_time($restaurant_id, $opening_m, $opening_t, $opening_w, $opening_th, $opening_f, $opening_sa, $opening_s){
		global $connection;
		$query = "INSERT INTO restaurant_opentime(restaurant_id, monday, tuesday, wednesday, thursday, friday, saturday, sunday) VALUES($restaurant_id, '$opening_m', '$opening_t', '$opening_w', '$opening_th', '$opening_f', '$opening_sa', '$opening_s')";
		$result = mysqli_query($connection, $query);
		if ($result) {
			echo "Restaurant Opening Time Aaddition Was Successful";
			echo "<br /><br />";
		}else{
			die("Could not add opening time! Plesae Try Again");
		}
	}
	function closing_time($restaurant_id, $closing_m, $closing_t, $clsoing_w, $closing_th, $closing_f, $closing_sa, $closing_s){
		global $connection;
		$query = "INSERT INTO restaurant_closetime(restaurant_id, monday, tuesday, wednesday, thursday, friday, saturday, sunday) VALUES($restaurant_id, '$closing_m', '$closing_t', '$clsoing_w', '$closing_th', '$closing_f', '$closing_sa', '$closing_s')";
		$result = mysqli_query($connection, $query);
		if ($result) {
			echo "Restaurant Closing Time Addition Was Successful";
		}else{
			die("Could not add closing time! Plesae Try Again");
		}
	}
	function operation_time_switch($restaurant_id){
		global $connection;
		$query = "SELECT * FROM restaurant_opentime WHERE restaurant_id = $restaurant_id";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)==0) {
			//create time
			return true;
		}else{
			//update return false;
			return false;
		}
	}
	function update_operation_openingtime($restaurant_id, $column, $value){
		global $connection;
		$query = "UPDATE restaurant_opentime SET $column = '{$value}' WHERE id = $restaurant_id LIMIT 1 ";
		$result = mysqli_query($connection, $query);
		if(!$result){
			die("Database connection failed. " . mysqli_error($connection));
			return false;
		}else{
			echo "Restaurant Opening " . ucfirst($column) ." Time Update Was Successful";
			echo "<br /><br />";
		}
	}

	function update_operation_closingtime($restaurant_id, $column, $value){
		global $connection;
		$query = "UPDATE restaurant_closetime SET $column = '{$value}' WHERE id = $restaurant_id LIMIT 1 ";
		$result = mysqli_query($connection, $query);
		if(!$result){
			die("Database connection failed. " . mysqli_error($connection));
			return false;
		}else{
			echo "Restaurant Closing " . ucfirst($column) . " Time Update Was Successful";
		}
	}

?>
<?php
//Restaurant delivery fee methods
	function fee_switch($restaurant_id){
			global $connection;
			$query = "SELECT * FROM delivery_fee WHERE restaurant_id = $restaurant_id";
			$result = mysqli_query($connection, $query);
			if (mysqli_num_rows($result)==0) {
				//create time
				return true;
			}else{
				//update return false;
				return false;
			}
		}

	function create_fee($restaurant_id, $fee){
		global $connection;
		$query = "INSERT INTO delivery_fee(restaurant_id, delivery_fee) VALUES($restaurant_id, '$fee')";
		$result = mysqli_query($connection, $query);
		if ($result) {
			echo "Restaurant Delivery Fee Was Added Successfully";
			echo "<br /><br />";
		}else{
			die("Could not add delivery fee! Plesae Try Again");
		}
	}

	function update_fee($restaurant_id, $column, $fee){
		global $connection;
		$query = "UPDATE delivery_fee SET $column = '{$fee}' WHERE id = $restaurant_id LIMIT 1 ";
		$result = mysqli_query($connection, $query);
		if(!$result){
			die("Database connection failed. " . mysqli_error($connection));
			return false;
		}else{
			echo "Restaurant Delivery Fee Update Was Successful";
			echo "<br /><br />";
		}
	}
?>
<?php 
	//method to retrieve restaurant shipping cost
	function delivery_fee($restaurant_id){
		global $connection;
		$query = "SELECT * FROM delivery_fee WHERE restaurant_id = $restaurant_id LIMIT 1";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Could Nnot Get Delivery Fee for this order!");
		}else{
			$result_array = mysqli_fetch_assoc($result);
			$cost = $result_array["delivery_fee"];
			return $cost;
		}
	}
?>
<?php 
	//add and update restaurant statement
function add_statement($restaurant_id, $general, $kitchen, $suggestion){
	global $connection;
		$query = "INSERT INTO restaurant_statement(restaurant_id, general_statement, kitchen_statement, suggestions) VALUES($restaurant_id, '$general', '$kitchen', '$suggestion')";
		$result = mysqli_query($connection, $query);
		if ($result) {
			//echo "Restaurant Delivery Fee Was Added Successfully";
			//echo "<br /><br />";
		}else{
			die("Could not add delivery fee! Plesae Try Again");
		}
}

function update_statement($restaurant_id, $column, $value){
	global $connection;
		$query = "UPDATE restaurant_statement SET $column = '{$value}' WHERE id = $restaurant_id LIMIT 1 ";
		$result = mysqli_query($connection, $query);
		if(!$result){
			die("Database connection failed. " . mysqli_error($connection));
			return false;
		}else{
			echo "Restaurant Statement Update Was Successful";
			echo "<br /><br />";
		}
}

function checkstatus($restaurant_id){
	global $connection;
		$query = "SELECT * FROM restaurant_statement WHERE restaurant_id = $restaurant_id LIMIT 1";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die(mysqli_error($connection));
		}else{
			$num = mysqli_affected_rows($connection);
			if ($num==1){
				return true;
			}else{
				return false;
			}
		}
}
?>