<?php require_once("includes.php"); ?>

<?php 

	class Orders{

		public function current_orders($user_id){
			//retieve the orders where delivery status is 0
			$database = new Database();
			$query = "SELECT orders.user_id, orders.menu_id, orders.qty_ordered, orders.total_cost, menu.food_item, menu.price, menu.id, menu.restaurant_id FROM menu, orders WHERE (menu.id = orders.menu_id AND orders.restaurant_id = menu.restaurant_id) AND orders.user_id = $user_id AND orders.delivered=0  ";
			return $result = $database -> find_by_query($query);
		}

		public function shipping_cost($user_id){
			$database = new Database();
			$query = "SELECT SUM(orders.shipping_cost) AS cost FROM orders WHERE delivered = 0 AND orders.user_id = $user_id";
			$result = $database -> find_by_query($query);
			if(mysqli_num_rows($result) == 0){
				$total_shipping_cost = "";
			}else{
				$total_shipping_cost = mysqli_fetch_assoc($result)['cost'];
				return $total_shipping_cost;
			}

		}

		public function total_cost($user_id){
			$database = new Database();
			$query = "SELECT SUM(orders.total_cost) AS cost FROM orders WHERE delivered = 0 AND orders.user_id = $user_id";
			$result = $database -> find_by_query($query);
			if (mysqli_num_rows($result)==0) {
				$total_cost = "";
			}else{
				$total_cost = mysqli_fetch_assoc($result)['cost'];
				return $total_cost;
			}
		}

		public function previous_orders($user_id){
			$database = new Database();
			$query = "SELECT orders.user_id, orders.menu_id, orders.qty_ordered, orders.total_cost, menu.food_item, menu.price, menu.id, menu.restaurant_id, restaurant.restaurant_name FROM menu, orders, restaurant WHERE (menu.id = orders.menu_id AND orders.restaurant_id = menu.restaurant_id) AND (orders.user_id = $user_id AND orders.delivered=1) AND menu.restaurant_id = restaurant.id ORDER BY id DESC LIMIT 3";
			$result = $database -> find_by_query($query);
			return $result;
		}

		private function send_message($number, $message_body){
			//the sms api goes here //format to remove first zero
			$haystack = $number; 
			$needle = "0"; $replace = "";	 
			$pos = strpos($haystack, $needle);
			if (($pos !== false) && ($pos == 0)) {
			    $f_number = substr_replace($haystack, $replace, $pos, strlen($needle));    
			}else{
				$f_number = $number;			
			}

			  $contacts = array(
				 $f_number => $message_body

				 );
				 
				 foreach($contacts as $numb => $mess){
					 $url = "http://api.mytxtbox.com/v3/messages/send?"
				    . "From=".urlencode("EarlyFood")
				    . "&To=%" ."2B233".urlencode($numb)
				    . "&Content=". urlencode($mess)
				    . "&ClientId= ...taken out"
				    . "&ClientSecret= ...taken out"
				    . "&RegisteredDelivery=true"; 
					 $curl = curl_init();

					 curl_setopt_array($curl, array(
					 CURLOPT_URL => $url,
					 CURLOPT_RETURNTRANSFER => true,
					 CURLOPT_CUSTOMREQUEST => "GET",
					 ));

					 $response = curl_exec($curl);
					 $err = curl_error($curl);

					 curl_close($curl);

					if ($err) {
						echo "cURL Error #:" . $err;
					 } else {
					 	echo $response;
					 }
				 }


		}

		public function message_body(
			$menu_id, $orderer_phone, $orderer_name, 
			$quantity, $address, 
			$shipping_cost, $total_cost, $payment_status, $date
		){
			$database = new Database();
			$database -> set_table('menu');
			$value =  $menu_id;
			$ref = "id";
			$result = $database -> find_by_sql($ref, $value);
			
			$result_array = mysqli_fetch_assoc($result);
			$restaurant_id = $result_array["restaurant_id"];
			$food_item = $result_array["food_item"];
			$price = $result_array["price"];
			$rest_name = $this -> restaurant_name($restaurant_id);
			$rest_phone = $this -> restaurant_phone($restaurant_id);

			$haystack = $orderer_phone; 
			$needle = "0"; $replace = "";	 
			$pos = strpos($haystack, $needle);
			if (($pos == true) && ($pos !== 0)) {
			    $orderer_phone = "0".$orderer_phone  ;  
			}else{
				$orderer_phone = $orderer_phone;			
			}

			$sub_message = $rest_name ."\r\n";
			$sub_message .= "Food Ordered: ". $food_item ."\r\n";
			$sub_message .= "Price: " . "GHS". $price."\r\n";
			$sub_message .= "Quantity: ". $quantity . " Plate(s)"."\r\n";
			$sub_message .= "Delivery Fee: "."GHS". $shipping_cost."\r\n";
			$sub_message .= "Total Cost: ". "GHS". $total_cost."\r\n";
			$sub_message .= "Name: ". $orderer_name."\r\n";
			$sub_message .= "Contact: " .$orderer_phone."\r\n";
			$sub_message .= "Street Address: " .$address."\r\n";
			$sub_message .= "Payment Status: " .$payment_status."\r\n";
			$sub_message .= "Date: " .$date."\r\n";
			$sub_message .= "Note: For Any Number Of Orders, Pay A Single Order Delivery Fee.";

			$this -> send_message($rest_phone, $sub_message);
			$this -> send_message($orderer_phone, $sub_message);
		}
		private function restaurant_name($id){
			$database = new Database();
			$database -> set_table("restaurant");
			$result = $database -> find_by_id($id);
			$rest_name = mysqli_fetch_assoc($result)["restaurant_name"];
			return $rest_name;

		}
		private function restaurant_phone($id){
			$database = new Database();
			$database -> set_table("restaurant");
			$result = $database -> find_by_id($id);
			$result_array = mysqli_fetch_assoc($result);
			$rest_phone = $result_array["order_receive_phone"];
			return $rest_phone;

		}

		public function place_order($user_id, $safe_name, $menu_id, $restaurant_id, $qty_ordered, $shipping_cost, $total_cost, $orderer_phone, $orderer_address){
			$database = new Database();
			$query = "INSERT INTO orders(user_id, orderer_name, menu_id, restaurant_id, qty_ordered, shipping_cost, total_cost, orderer_phone, orderer_address) VALUES({$user_id}, '{$safe_name}', {$menu_id}, {$restaurant_id}, {$qty_ordered}, {$shipping_cost}, {$total_cost}, {$orderer_phone}, '{$orderer_address}') ";
			$result = mysqli_query($database -> connection, $query);
			$database -> confirm_query($result);
		}
		public function update_balance_with_order($order_amount, $user_id){
			$coupon = new CouponBank();
			$database = new Database();
			$existing_balance = $coupon -> get_existing_balance($user_id);
			$new_balance = $existing_balance + $order_amount;
			$query = "UPDATE wallet_balance SET remaining_amount = $new_balance WHERE user_id = $user_id LIMIT 1";
			$result = mysqli_query($database -> connection, $query);
			return $database -> confirm_query($result);
		}
		public function create_transaction_record($user_id, $transaction_id, $balance, $transaction_amount, $transaction_details, $transaction_charges){
			$query = "INSERT INTO wallet_transactions(user_id, coupon_id, balance, transaction_amount, transaction_details, transaction_charges) VALUES($user_id, $transaction_id, $balance, $transaction_amount, '$transaction_details', $transaction_charges)";
			$database = new Database();
			$result = mysqli_query($database -> connection, $query);
			return $database -> confirm_query($result);
		}

		public function get_time(){
			$date =  date('D-d-M-Y');
			$date .= " At " . date('h:i:s');
			return $date;
		}
	}

	$orders = new Orders();

?>