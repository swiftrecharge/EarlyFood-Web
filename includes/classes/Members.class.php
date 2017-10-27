<?php require_once("includes.php"); ?>

<?php 

	class Members{

		public function first_name($id){
			$database = new Database();
			$database -> set_table("members");
			$database -> get_table();
			$result = $database -> find_by_id($id);
			if (mysqli_num_rows($result) != 0) {
				$result_array = mysqli_fetch_assoc($result);
				$first_name = $result_array["first_name"];
				return $first_name;
			}
		}

		public function sign_up_bonus($id){
			//get the number of orders
			$database = new Database();
			$database -> set_table("orders");
			$database -> get_table();
			$result = $database -> find_by_id($id);
			$num_rows = mysqli_affected_rows($database -> connection);
			if ($num_rows === 0 ) {
				$message = "Congratulations!";
				$message .="<br />";
				$message .="You have won Ghc50.00 Worth of EarlyFood voucher";
				$message .="<br />";
				$message .= "Make Your First Three Orders To Activate Voucher!";
			}elseif ($num_rows === 1) {
				$message = "Make Your Remaining Two Orders To Activate Your Ghc50.00 EarlyFood Voucher.";
			}elseif ($num_rows === 2) {
				$message = "Make Your Last Order To Activate Your Ghc50.00 EarlyFood Voucher";
			}elseif($num_rows ==3){
				$message = "Your Ghc50.00 EarlyFood Voucher Have Been Credited To Your Account";
			}else{
				$message = "";
			}
			return $message;
		}

		public function current_orders($user_id){
			//retieve the orders where delivery status is 0
			$database = new Database();
			$query = "SELECT orders.user_id, orders.menu_id, orders.qty_ordered, orders.total_cost, menu.food_item, menu.price, menu.id, menu.restaurant_id FROM menu, orders WHERE (menu.id = orders.menu_id AND orders.restaurant_id = menu.restaurant_id) AND orders.user_id = $id AND orders.delivered=0  ";
			$result = $database -> find_by_query($query);
		}

		public function reset_password($txtEmail){
			//mail a reset link to the individual
			//check to insure the mail exist
				$database = new Database();
			    $ref = "email_address";
				$value = $txtEmail;
				$database -> set_table("members");
				$database -> get_table();
				$database -> find_by_sql($ref, $value);
				$database -> set_result();
				$result = $database -> get_result();
				$result_array = mysqli_fetch_assoc($result);
				if (mysqli_num_rows($result)==0) {
					return false;
				}else{
						$str = $this -> random_str();
						$id = $result_array["id"];

						$mail_body = "<html>";
						$mail_body .="<body>";
						$mail_body .= "You requested a password reset of your account with earlyFood.com"."<br /><br />";

						/* 
							implementation taken out
						*/
						$mail_body .= "If clicking on the link does not work, copy and paste the URL in your address bar."."<br /><br />";
											
						$mail_body .= "If you have not requested a password reset, please ignore this mail! Thank You."."<br /><br />";
						$mail_body .= "Sincerely, earlyFood Customer care center.";
						$mail_body .="</body>";
						$mail_body .="</html>";
		

					// this will be in the form of an html file
					$subject = "earlyFood Password Reset";
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= "From: <earlyFood@delivery.com>\r\n ";
					$to = $txtEmail;
					$mail_result  = mail($to, $subject, $mail_body, $headers);
					
					if ($mail_result) {
						#mail sent successfully proceed to create database record
						$user_id = $result_array["id"];
						$database = new Database();
						$user_id = $database -> escape_string($user_id);
						$safestr = $database -> escape_string($str);
						//will work on it later
						//$hashed_string = $database -> encrypt($safestr);

						$result_created = $database -> create_or_update($user_id, $safestr);

						if (!$result_created) {
							return true;
							#you can hardly track both progresses
						}else{

							return true;
						}

					}
				}

			
		}

		public function random_str()
			{
				require '../includes/vendor/autoload.php';
				$length = 30; 
				$keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			    $str = '';
			    $max = mb_strlen($keyspace, '8bit') - 1;
			    for ($i = 0; $i < $length; ++$i) {
			        $str .= $keyspace[random_int(0, $max)];
			    }
			    return $str;
			}

	}
	$member = new Members();

?>