<?php ob_start(); ?>
<?php session_start();  ?>
<?php //require_once("../../includes/redirect.php"); ?>
<?php //require_once("../../includes/functions.php"); ?>
<?php require_once("../includes/classes/includes.php"); ?>
<?php //session_unset(); ?>
	<?php  
		//process order placement
	if(isset($_POST["placeOrder"])){
			isset($_SESSION['checkout_method']) ? $method_selected = $_SESSION['checkout_method']: $method_selected = null;
				if ($method_selected == "w") {
					//pay via wallet selected
					$payment_status = "Paid Via EarlyFood Wallet";
				}elseif($method_selected=="p"){
					//payment on delivery selected
					$payment_status = "To Be Paid On Delivery";
				}else{
					//session could not be set

				}
			$orderer_name = $_POST["ordererName"]; $safe_name = $database -> escape_string($orderer_name);
			$orderer_phone1 = $_POST["ordererPhone1"]; $safe_phone = $database -> escape_string($orderer_phone1);
			$orderer_phone2 = $_POST["ordererPhone2"];
			$street_address = $_POST["ordererAddress"]; $safe_address = $database -> escape_string($street_address);
			$marray = $_SESSION["menuid_array"];
			//$farray = $_SESSION["food_array"];
			//$parray = $_SESSION["price_array"];
			$qarray = $_SESSION["qty_array"];
			$ocost = $_SESSION["overAllCost"];
			$tarray = $_SESSION["total_cost"];
			$userId = isset($_SESSION["logged_user_id"]) ? $_SESSION["logged_user_id"] : 0;
			$restaurant_id = $_SESSION["sessionId"];
			$shipping_cost = $_SESSION["shipping_cost"];
			$number = count($marray);
			if (!empty($orderer_name) && !empty($street_address)){
				$number = count($marray);
				//loop through arrays and insert into orders table
				for ($i=0; $i <$number ; $i++) { 
					$orders -> place_order($userId, $safe_name, $marray[$i], $restaurant_id, $qarray[$i], $shipping_cost[$i], $tarray[$i], $safe_phone, $safe_address);
					//method to retieve the item name and cost for forwarding via text message
					// uncomment to allow sending message on order 
					//concatenate the orders
					//$food_list = ($i+1) . " Food Ordered: " . $marray[$i];
					//$food_list .= "\r\n";
					//$food_list .= "Price: " .$
					$totalCost = $shipping_cost[$i] + $tarray[$i];
					$date = $orders -> get_time();
					$orders -> message_body($marray[$i], $safe_phone, $safe_name, $qarray[$i], $safe_address, $shipping_cost[$i], $totalCost, $payment_status, $date);
						$_SESSION["internal_error"] = "Order Was Not Successful Please Try Again.";
						unset($_SESSION["user_error"]);
					}
			if (isset($_SESSION["logged_user_id"])) {
				//track payment method session variable
				isset($_SESSION['checkout_method']) ? $method_selected = $_SESSION['checkout_method']: $method_selected = null;
				if ($method_selected == "w") {
					//pay via wallet selected
					$order_amount =  $totalCost;
					$user_id = $_SESSION['logged_user_id'];
					$orders -> update_balance_with_order($order_amount, $user_id);
					$transaction_id = 0;
					$transaction_amount = $totalCost;
					$balance = $coupon -> get_existing_balance($user_id);
					$transaction_details = "Pyment For Food Ordered";
					$transaction_charges = 0;
					$orders -> create_transaction_record($user_id, $transaction_id, $balance, $transaction_amount, $transaction_details, $transaction_charges);
				}elseif($method_selected=="p"){
					//payment on delivery selected
					//no need to update wallet or create transaction record
				}else{
					//session could not be set

				}
				redirect_to("../memberspage/members.php");

			}else{
				$_SESSION["p_transfer"] = $safe_phone;
				$_SESSION["n_transfer"] = $safe_name;
				redirect_to("../registrationpage/registration.php");

			}
				
		}else{
			unset($_SESSION["internal_error"]);
			$_SESSION["user_error"] = "Order Was Not Successful. Please  Check That No Form Field Is Empty And Try Again!";
			redirect_to("../checkout/checkout.php");
		}
	}
?>
<?php ob_flush(); ?>
	