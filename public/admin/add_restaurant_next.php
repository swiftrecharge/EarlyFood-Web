<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
<div id="order_title">
	<img class="main" src="images/logo.png" alt="" /><br /><span><em>Registered Restaurants</em></span>
</div>
<?php 
	
	if (isset($_POST["add_restaurant_next"])) {
		$restaurant_name = $_POST["restaurant_name"];
		$restaurant_id = $_POST["restaurant_id"];
		if ($restaurant_name == "Select Restaurant") {
			echo "<span style=\"font: 2em Tahoma; color: white;\">Please Select Restaurant Name</span>";
			echo "<br />";
		}elseif ($restaurant_id == "Select ID") {
			echo "<span style=\"font: 2em Tahoma; color: white\">Please Select Restaurant ID</span>";
			echo "<br />";
		}else{
			$query = "SELECT * FROM restaurant WHERE id = $restaurant_id";
			$result = mysqli_query($connection, $query);
			if ($restaurant_name != mysqli_fetch_assoc($result)['restaurant_name']) {
				echo "<span style=\"font: 2em Tahoma; color: white\">Restaurant Name and ID Do Not Match!<span>";
				echo "<br />";
			}else{
				$_SESSION["name_operations"] = $restaurant_name;
				$_SESSION["id_operations"] = $restaurant_id;
				redirect_to("restaurant_operations.php");
			}
		}
	}
	
?>
<div><br /><br />
	<span style="font: 20px Tahoma; text-align: center; color: white" class="row">Add/Edit Operation Hours =></span><br /><br />
		<form action ="add_restaurant_next.php" enctype="multipart/form-data" method="post">
			<?php 
				$query = "SELECT * FROM restaurant";
				$result = mysqli_query($connection, $query);
				if (!$result) {
					die("Database connection failed.");
				}
			?>
			<select name="restaurant_name">
				<option selected>Select Restaurant</option>
				<?php 

					while($value = mysqli_fetch_assoc($result)){
						$option = "<option>"; 
						$option .= $value["restaurant_name"];
						$option .= "</option>";
						echo $option;
					}

				?>
			</select>
			<?php 
				$query = "SELECT * FROM restaurant";
				$result = mysqli_query($connection, $query);
				if (!$result) {
					die("Database connection failed.");
				}
			?>
			<select name="restaurant_id">
				<option selected>Select ID</option>
				<?php 

					while($value = mysqli_fetch_assoc($result)){
						$option = "<option>"; 
						$option .= $value["id"];
						$option .= "</option>";
						echo $option;
					}

				?>
			</select>
				<div id="appDjob">
					<input type="submit" value="Go" name="add_restaurant_next" />
				</div>
			</div>
	</form>
</div><!-- closes ret row -->
<?php close_db(); ?>
<?php ob_flush(); ?>