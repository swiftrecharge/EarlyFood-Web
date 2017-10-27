<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<?php
	if (!isset($_SESSION["name_delivery"]) && !isset($_SESSION["id_delivery"])) {
		die("Please Select Resturant Name and Id");
	}
?>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
<style type="text/css">
	table{
		padding: 2em;
		text-align: center;
		border: 2px solid white;
		margin-left: 27%;
		color: white;
	}

	table tr{
		font: 1.5em Tahoma;
		border: 2px solid white;
	}
	option{
		padding: 0.1em;
		font-weight: bold;
	}
	select{
		font: 1.5em Tahoma;
	}
</style>
<div id="order_title">
	<img class="main" src="images/logo.png" alt="" /><br /><span><em>Registered Restaurants</em></span>
</div>

<div style="color: white; text-align: center;"><br /><br />
	<span style="font: 20px Tahoma; text-align: center;" class="row">Add/Update Restaurant Delivery Fee For <?php $str = "<span style=\"font: 1.5em Tahoma; color: red;\">";
																												  $str .= $_SESSION["name_delivery"];
																												  $str .= "</span>";
																												  echo $str; ?></span><br /><br />
		<form action ="deliveries_fee_process.php" method="post">
			<div class="regForm">
				
				<div style="color: white;">
					<select name="fee">
						<option selected>Select</option>
						<?php 
							for ($i=0.0; $i <= 10 ; $i += 0.05) { 
								echo "<option>$i</option>";
							}
						?>
					</select>
				</div>
				<div id="appDjob">
					<input type="submit" value="ADD" name="delivery_fee_set"/>
				</div>
			</div>
	</form>
</div><!-- closes ret row -->
		
<?php close_db(); ?>
<?php ob_flush(); ?>