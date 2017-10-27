<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<?php 
	// process restaurant addition
		$restaurant_name = $_POST["restaurant_name"]; $safe_restaurant_name = mysql_prep($connection, $restaurant_name);
		$slogan = $_POST["slogan"]; $safe_slogan = mysql_prep($connection, $slogan); 
		$address = $_POST["address"]; $safe_address = mysql_prep($connection, $address);
		$email_address = $_POST["restaurant_email"]; $safe_email_address = mysql_prep($connection, $email_address);
		$order_phone = $_POST["order_phone"]; $safe_order_phone = mysql_prep($connection, $order_phone);
		$work_contact = $_POST["work_contact"]; $safe_work_contact = mysql_prep($connection, $work_contact);
		//$working_days = $_POST["working_days"]; $safe_working_days = mysql_prep($connection,$working_days);
		$region = $_POST["region"];
		$district = $_POST["district"];
		//$working_hours = $_POST["working_hours"]; $safe_working_hours = mysql_prep($connection ,$working_hours);
		$visible = $_POST["visible"];
		$empty_restaurant_log = array(has_no_presence($restaurant_name), has_no_presence($address), has_no_presence($order_phone));
		$empty_select = array();
		
		
		if($empty_restaurant_log[0]===null && $empty_restaurant_log[1]===null){
			$_SESSION["name"] = $restaurant_name;
			$_SESSION["add"] = $address;
			$_SESSION["slogan"] = $slogan;
			$_SESSION["mail"] = $email_address;
			$_SESSION["o_phone"] = $order_phone;
			$_SESSION["w_contact"] = $work_contact;
			if(selected($district) && selected($region) && selected($visible)){
				//everything is good proceed to create restaurant
				$_SESSION["name"] = null;
				$_SESSION["add"] = null;
				//query database
				$query = "INSERT INTO restaurant(restaurant_name, loc_region, loc_district, street_address, working_days, working_hours, visible, slogan, order_receive_phone, work_contact, email_address) VALUES('$safe_restaurant_name', '$region', '$district', '$safe_address', '$safe_working_days', '$safe_working_hours', '$visible', '$safe_slogan', $safe_order_phone, $safe_work_contact, '$safe_email_address')";
				$result = mysqli_query($connection, $query);
				if(!$result){
					die("Database connection failed." . mysqli_error($connection) );
				}else{
					echo "<span style=\"font-size: 30px;\">Restaurant  Addition was successful.</span><br /> <br />";
					echo "<span style=\"font-size: 30px\"><a href=\"add_restaurant_next.php\">Proceed To Next Step</a></span><br />";	
				}
			}else{
				echo "<span style=\"font-size: 30px;\">Restaurant  Addition was not successful. Try Aagain!</span><br /> <br />";
				echo "<span style=\"font-size: 30px; color: red;\">Check to Ensure You've Selected all Labels</span><br /> <br />";
			}
		}else{
			$_SESSION["name"] = null;
			$_SESSION["add"] = null;
			echo "<span style=\"font-size: 30px;\">Restaurant  Addition was not successful. Try Aagain!</span><br /> <br />";
			echo "<span style=\"font-size: 30px; color: red;\">Restaurant Name, Order Receive Phone Number and Address are Required</span> <br />";
		}
?>
<html>
	<head>
		<style type="text/css">
			body{
				background-color: #333 ;
				color: #ccc;
			}
			#link{
				height: 30px;
				background-color: red;
				padding-top: 1em;
				width: 150px;
				text-align: center;
				border: 2px solid white;
				margin-top: 100px;
				font-family: Tahoma;
			}
			#link a{
				color: #ccc;
				text-decoration: none;
			}
			#link a:visited{
				color: #ccc;
			}
			#link a:hover{
				text-decoration: none;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div id="link">
			<a href="index.php">Next Step</a>
		</div>
	</body>
</html>