<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<?php
	if (!isset($_SESSION["name_operations"]) && !isset($_SESSION["id_operations"])) {
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
	<span style="font: 20px Tahoma; text-align: center;" class="row">Add/Update Restaurant Working Hours of <?php $str = "<span style=\"font: 1.5em Tahoma; color: red;\">";
																												  $str .= $_SESSION['name_operations'];
																												  $str .= "</span>";
																												  echo $str; ?></span><br /><br />
	<span>For Update, Just Set The Updated Time for Only those days and click ADD</span><br /><br />
		<form action ="restaurant_operations_process.php" method="post">
			<div class="regForm">
				
				<div style="color: white;">
					<table>
						<tr>
							<td>Day of the Week</td>
							<td>Opening Hours</td>
							<td>Closing Hours</td>
						</tr>
						<?php 

							$days_array = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
							foreach ($days_array as $day) {
							 	?>
							 		<tr>
										<td><?php echo ucfirst($day) ?></td>
										<td>
											<select name="<?php echo $day."_opening" ?>">
												<option selected>Select</option>
												<?php 

													for ($i=5; $i < 12 ; $i++) { 
														$hour = $i < 10 ? "0".$i : $i;
														
														for ($k=0; $k <= 45 ; $k += 15) { 
															$minute = $k < 10 ? "0".$k : $k;
															$time = $hour.":".$minute." AM";
															echo "<option>$time</option>";
														}
													}

												?>
												<option>12:00 PM</option>
												<option>1:00 PM</option>
												<option>2:00 PM</option>
												<option>3:00 PM</option>
												<option>4:00 PM</option>
												<option>5:00 PM</option>
												<option>Not Available</option>
											</select>
										</td>
										<td>
											<select name="<?php echo $day."_closing"?>">
												<option selected>Select</option>
												<?php 

													for ($i=1; $i <= 12 ; $i++) { 
														$hour = $i < 10 ? "0".$i : $i;
														
														for ($k=0; $k <= 45 ; $k += 15) { 
															$minute = $k < 10 ? "0".$k : $k;
															$time = $hour.":".$minute." PM";
															echo "<option>$time</option>";
														}
													}

												?>
												<option>Not Available</option>
											</select>
										</td>
									</tr>
							 	<?php
							 } 
						?>
					</table>
				</div>

				<div id="appDjob">
					<input type="submit" value="ADD" name="add_restaurant_details_operations" />
				</div>
			</div>
	</form>
</div><!-- closes ret row -->
		
<?php close_db(); ?>