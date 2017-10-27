<?php 
	class CouponBank extends Database
	{
		private $couponCode;
		private $couponSerial;
		private $counponExpiryDate;
		public $couponsGenerationSuccess;
		public $couponLoadStatus = "";

		public function generateCoupon($couponValue, $couponCount){
			if ($couponCount >= 1) {
				for ($i = 1; $i <= $couponCount; $i++){
					$this -> couponCode = "";
					$couponLength = 0;
					while ($couponLength < 16){
						/* implementation taken out

						*/
					}
					if (($this -> couponDoesNotExist($this -> couponCode))) {
						$this -> couponSerial = $this -> generate_serial_number();
						$this -> counponExpiryDate = $this -> get_expiry_date();
						$couponStatus = 0;
						$this -> create_coupons_record($this -> couponSerial, $this -> couponCode, $couponValue, $couponStatus, $this -> counponExpiryDate) ? $this -> couponsGenerationSuccess = "Coupons Were Generated Succesfully" : $this -> couponsGenerationSuccess = "Coud not generate coupons. Try again!";
						//echo "Success";
						//echo $this -> couponCode;
					}else{
						echo "Coupon already exist";
					}

				}
			}
		}

		public function get_expiry_date(){
			$date = date("Y-m-d");
			$date = strtotime(date("Y-m-d", strtotime($date)) . " +12 month");
			$date = date("Y-m-d",$date);
			return $date;
		}

		public function generate_serial_number(){
			$serial_number = strtoupper(substr(sha1(microtime()), rand(0, 5), 25));
			return $serial_number;	
		}
		private function couponDoesNotExist($couponCode){
			//get the existing values from the database
			$query = "SELECT * FROM  coupon_bank WHERE coupon_code = $couponCode";
			$result = $this -> find_by_query($query);
			$count = $result -> num_rows;
			if ($count ==0) {
				# good code
				return true;
			}else{
				return false;
			}
		}
		private function create_coupons_record($couponSerial, $couponCode, $couponValue, $couponStatus, $couponExpiry){
			$this -> set_table("coupon_bank");
			$table = $this -> get_table();
			$query = "INSERT INTO $table(serial_number, coupon_code, coupon_value, coupon_status, expiry_date) VALUES('$couponSerial', $couponCode, $couponValue, $couponStatus, '{$couponExpiry}')";
			$result = mysqli_query($this -> connection, $query);
			return $this -> confirm_query($result);
		}
		public function get_all_coupons(){
			$this -> set_table("coupon_bank");
			$table = $this -> get_table();
			$query = "SELECT * FROM $table";
			$result = mysqli_query($this -> connection, $query);
			$this -> confirm_query($result);
			return $result;
		}

		public function get_active_coupons(){
			$this -> set_table("coupon_bank");
			$table = $this -> get_table();
			$query = "SELECT * FROM $table WHERE coupon_status = 0";
			$result = mysqli_query($this -> connection, $query);
			$this -> confirm_query($result);
			$count = $result -> num_rows;
			return $count;
		}

		public function get_used_coupons(){
			$this -> set_table("coupon_bank");
			$table = $this -> get_table();
			$query = "SELECT * FROM $table WHERE coupon_status = 1";
			$result = mysqli_query($this -> connection, $query);
			$this -> confirm_query($result);
			$count = $result -> num_rows;
			return $count;
		}

		public function get_monetary_value_of_active_coupons(){
			$this -> set_table("coupon_bank");
			$table = $this -> get_table();
			$query = "SELECT SUM(coupon_value) FROM $table WHERE coupon_status = 0";
			$result = mysqli_query($this -> connection, $query);
			$this -> confirm_query($result);
			$result = mysqli_fetch_assoc($result);
			return $result['coupon_value'];
		}

		public function load_coupon($coupon_code){
			$query = "SELECT * FROM  coupon_bank WHERE coupon_code = $coupon_code";
			$result = $this -> find_by_query($query);
			$count = $result -> num_rows;
			$value = mysqli_fetch_assoc($result);
			if ($count !=1) {
				//coupon not found
				$this -> couponLoadStatus = "Wrong Coupon Code.";
				return false;
			}elseif ($value['coupon_status'] == 1) {
				$this -> couponLoadStatus = "Coupon Already Used!";
				return false;
			}elseif (date('Y-m-d') > $value['expiry_date']) {
				$this -> couponLoadStatus = "Coupon Has Expired.";
				return false;
			}else{
				//good code, proceeed to add monetary value to available balance
				$coupon_id = $value['id'];
				$user_id = $_SESSION['logged_user_id'];
				$coupon_value = $this -> coupon_value($coupon_code);
				$existing_balance = $this -> get_existing_balance($user_id);
				$balance = $existing_balance + $coupon_value;
				$transaction_charges = 0;
				$transaction_details = "Loaded coupon to your EarlyFood wallet.";
				$good_outcome = $this ->  create_transaction_record($user_id, $coupon_id, $balance, $coupon_value, $transaction_details, $transaction_charges);
				if ($good_outcome) {
					#record created successfully, update balance
					$up = $this -> update_balance_with_coupon($coupon_value, $user_id);
					if ($up) {
						# bal update success
						$this -> update_coupon_status($coupon_id);
						$this -> couponLoadStatus = "Coupon Loaded Succesfully!";
						return true;
					}else{
						$this -> couponLoadStatus = "Internal Error in Loading Coupon. Try Again Shortly!";
						return false;
					}
				}else{
					$this -> couponLoadStatus = "Internal Error in Loading Coupon. Try Again Shortly!";
					return false;
				}
			}
		}

		public function update_coupon_status($id){
			//$id = $this -> get_id($coupon_code);
			$query = "UPDATE coupon_bank SET coupon_status = 1 WHERE id = '$id'";
			//die($query);
			$result = mysqli_query($this -> connection, $query);
			$this -> confirm_query($result);
			$num_rows = mysqli_affected_rows($this -> connection);
			if ($num_rows == 1) {
				return true;
			}else{
				
				return false;
			}
		}
		public function get_id($coupon_code){
			$query = "SELECT id FROM coupon_bank WHERE coupon_code = '$coupon_code' LIMIT 1";
			$result = $this -> find_by_query($query);
			$this -> confirm_query($result);
			$num = $result -> num_rows;
			//die($num . " ". $query);
			$id = mysqli_fetch_assoc($result)['id'];
			//die($id);
			return $id;
		}
		public function coupon_value($couponCode){
			$query = "SELECT coupon_value FROM  coupon_bank WHERE coupon_code = $couponCode";
			$result = $this -> find_by_query($query);
			$value = mysqli_fetch_assoc($result)['coupon_value'];
			return $value;
		}

		public function create_transaction_record($user_id, $coupon_id, $balance, $transaction_amount, $transaction_details, $transaction_charges){
			$query = "INSERT INTO wallet_transactions(user_id, coupon_id, balance, transaction_amount, transaction_details, transaction_charges) VALUES($user_id, $coupon_id, $balance, $transaction_amount, '$transaction_details', $transaction_charges)";
			$result = mysqli_query($this -> connection, $query);
			return $this -> confirm_query($result);
		}

		public function get_transactions($user_id){
			$query = "SELECT * FROM wallet_transactions WHERE user_id = $user_id ORDER BY id DESC";
			$result = $this -> find_by_query($query);
			return $result;
		}
		public function update_balance_with_coupon($coupon_value, $user_id){
			$existing_balance = $this -> get_existing_balance($user_id);
			$new_balance = $coupon_value + $existing_balance;
			$query = "UPDATE wallet_balance SET remaining_amount = $new_balance WHERE user_id = $user_id LIMIT 1";
			$result = mysqli_query($this -> connection, $query);
			return $this -> confirm_query($result);
		}

		public function get_existing_balance($user_id){
			$query = "SELECT remaining_amount FROM wallet_balance WHERE user_id = $user_id";
			$result = $this -> find_by_query($query);
			$balance = mysqli_fetch_assoc($result)['remaining_amount'];
			return $balance;
		}

		public function initialise_wallet($user_id){
			//this is called when a person signs up for the first time
			$remaining_amount = 0;
			$query = "INSERT INTO wallet_balance(user_id, remaining_amount) VALUES($user_id, $remaining_amount)";
			$result = mysqli_query($this -> connection, $query);
			return $this -> confirm_query($result);
		}
	}

	

	$coupon = new CouponBank();
?>