<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<style type="text/css">
	tr{
		border: 2px solid white;
	}
	td{
		border: 2px solid white;
		padding: 2em;
	}
</style>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
<div id="order_title">
	<img class="main" src="images/logo.png" alt="" /><br /><span><em>Registered Restaurants</em></span>
</div>

					
<span style="font: 30px Tahoma;">Create Deliveries Account =></span> <br /><br />
<form action ="deliveries_process.php" method="post">
	<select name="txtname">
		<option>Restaurant Name</option>
			<?php
				$query = "SELECT * FROM restaurant";
				$result = mysqli_query($connection, $query);
				while($id = mysqli_fetch_assoc($result)){ ?>
				
					 <option><?php echo $id["restaurant_name"]; ?></option>
			<?php
				}
			?>
		</select>
			<div id="appDjob">
				<input type="submit" value="Generate Code" class="appDjob" name="g_password" />
			</div>
		</div>
</form>

<div>

	<table style="float: right; margin-right: 20%; font: 2em Tahoma; border: 5px solid white; padding: 0.5em;">
		<tr>
			<th>Restaurant Name</th>
			<th>Unique ID</th>
		</tr>
		<?php
			$query = "SELECT * FROM deliveries_account, restaurant WHERE deliveries_account.restaurant_id = restaurant.id";
			$result = mysqli_query($connection, $query);
			while($value = mysqli_fetch_assoc($result)){ ?>
			
			<tr>
				<td><?php echo $value["restaurant_name"]; ?></td>
				<td><?php echo $value["unique_code"]; ?></td>
			</tr>
				 
			<?php
		}
		?>

	</table>

</div>
<?php close_db(); ?>