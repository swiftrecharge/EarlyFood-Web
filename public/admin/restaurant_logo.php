<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
<form action="restaurant_logo_process.php" method="post">
	<span>Select Restaurant Details</span><br /><br />
	<select name="name">
		<option selected>Select Restaurant</option>
		<?php
			$query = "SELECT restaurant_name FROM restaurant";
			$result = mysqli_query($connection, $query);
			while ($name = mysqli_fetch_assoc($result)) { ?>
				<option>
					<?php echo $name["restaurant_name"]; ?>
				</option>
		<?php
			}
		 ?>
	</select>
	<select name="id">
		<option selected>Select ID</option>
		<?php
			$query = "SELECT id FROM restaurant";
			$result = mysqli_query($connection, $query);
			while ($id = mysqli_fetch_assoc($result)) { ?>
				<option>
					<?php echo $id["id"]; ?>
				</option>
		<?php
			}
		 ?>
	</select><br /><br />
	<input type="submit" name="get_logo" value="Go">
</form>


<?php close_db(); ?>