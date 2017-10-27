<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>

<?php 

	if (isset($_POST["g_password"])) {
		# code...
			$name = $_POST["txtname"];
			$query = "SELECT restaurant.restaurant_name, restaurant.id FROM restaurant WHERE restaurant.restaurant_name = '$name' LIMIT 1";
			$result = mysqli_query($connection, $query);
			$result_array = mysqli_fetch_assoc($result);
			$id = $result_array["id"];
			$name = $result_array["restaurant_name"];

			$rand = substr(md5(rand()), 0, 5);
			$pass = $rand.$id;
			//random string
			//id
			//combine to get pass
			//echo $pass . "<br />";
			//echo substr($pass, 5);

			$query2 = "SELECT deliveries_account.restaurant_id FROM deliveries_account";
			$result = mysqli_query($connection, $query);

			$update = false;

			while ($value = mysqli_fetch_assoc($result)) {
				if ($value["restaurant_id"]==$id) {
					$update = true;
					break;
				}
			}

			if ($update) {
				# code already exist update to new one
			}else{
				//create a new code
				$query = "INSERT INTO deliveries_account(random_string, restaurant_id, unique_code) VALUES('$rand', $id, '$pass')";
				$result = mysqli_query($connection, $query);

				if ($result) {
					# success redirect
					redirect_to("index.php?deliveries=Create+Deliveries+Account");
				}else{
					mysql_error($connection);
				}

			}
	}

?>

<?php close_db(); ?>