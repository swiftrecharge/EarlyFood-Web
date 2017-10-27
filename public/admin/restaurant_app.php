<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
<div id="order_title">
	<img class="main" src="images/logo.png" alt="" /><span><em>Registered Restaurants</em></span>
</div>		

<!-- //obtain the restaurant details  //option to delete  //view corresponding menu -->
<table border="0" CELLSPACING="20">
	<tr>
		<th>Applicant First Name</th>
		<th>Applicant Last Name</th>
		<th>Email Address</th>
		<th>Restaurant Name</th>
		<th>Home Contact</th>
		<th>Work  Contact</th>
	</tr>
	<?php 
		$query = "SELECT * FROM pros_restaurant";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Database connection failed. " . mysqli_error($connection));
		}else{
			while ($value = mysqli_fetch_assoc($result)) { ?>
				<tr>
					<td><?php echo $value["first_name"]; ?></td>
					<td><?php echo $value["last_name"]; ?></td>
					<td><?php echo $value["email_address"]; ?></td>
					<td><?php echo $value["restaurant_name"]; ?></td>
					<td><?php echo $value["home_contact"]; ?></td>
					<td><?php echo $value["work_contact"]; ?></td>
					<td>
						<a href="restaurant_app_process.php?delete=<?php echo $value["id"] ?>">Delete</a>
						
					</td>
				</tr>
				<tr>
					<td border="0" colspan="9"><hr></td>
				</tr>
		<?php		
			}
		}
	?>
</table>				
<?php close_db(); ?>