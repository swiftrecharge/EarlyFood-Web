<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
<div id="order_title">
	<img class="main" src="images/logo.png" alt="" /><br /><span><em>Registered Restaurants</em></span>
</div>

<div><br /><br />
	<span style="font: 20px Tahoma; text-align: center;" class="row">Add Restaurant =></span>
		<form action ="add_restaurant_process.php" enctype="multipart/form-data" method="post">
			<div class="regForm">
				<div><!-- rest_name and slogan row -->
						<div id="rest_name">
							<span>Restaurant Name</span><br />
							<input tpye="text" name="restaurant_name" value="<?php if(isset($_SESSION["name"])){echo $_SESSION["name"];} ?>">
						</div><br />
						<div id="slogan" class="row">
							<span>Slogan</span><br />
							<input type="text" name="slogan" value="<?php if(isset($_SESSION["slogan"])){echo $_SESSION["slogan"];} ?>">
						</div>
				</div>
				<div>
					<div id="address">
						<span>Street Address</span><br />
						<textarea name="address" cols="30" rows="5"></textarea>
					</div><br />
				</div><br />
				<div><!-- rest_name and slogan row -->
						<div id="rest_name">
							<span>Restaurant Email</span><br />
							<input tpye="text" name="restaurant_email" value="<?php if(isset($_SESSION["mail"])){echo $_SESSION["mail"];} ?>">
						</div><br />
						<div id="slogan" class="row">
							<span>Order Receiving Phone Number</span><br />
							<input type="text" name="order_phone" value="<?php if(isset($_SESSION["o_phone"])){echo $_SESSION["order_phone"];} ?>">
						</div><br />
						<div id="slogan" class="row">
							<span>Work Contact</span><br />
							<input type="text" name="work_contact" value="<?php if(isset($_SESSION["w_contact"])){echo $_SESSION["work_contact"];} ?>">
						</div>
				</div><br />
				<div id="logo">
					<span>Restaurant Logo</span><br />
					<input type="file" name="logo">
				</div>
				<div>
					<!--<div id="working_days">
						<span>Working Days<br></span>
						<select name="working_days">
							<option>Select</option>
							<option>Week Days Only</option>
							<option>Week Days and Saturdays</option>
							<option>Week Days and Weekends</option>
							<option>Weekends  Only</option>
						</select> <br />
					</div> -->
					<div id="display">
						<span>Display<br></span>
						<select name="visible">
							<option select="selected">
								Yes
							</option>
							<option>
								No
							</option>
						</select>	
					</div>
				</div>
				<div class="row" >
					<div id="region">
						<span>Region</span><br>
						<select name="region">
							<?php 
								$regions = array("Select", "Greater Accra", "Ashanti", "Central", "Western", "Eastern", "Brong-Ahafo", "Northern", "Upper West", "Upper East", "Volta");
								foreach ($regions as$value) {
									if ($value == "Select") {
										echo "<option select=\"selected\">$value</option>";
									}else{
										echo "<option>$value</option>";
									}
								}
							?>
						</select>
					</div>
					<div id="district">
						<span>District</span><br>
						<select name="district">
							<option>Select</option>
							<option>Nadowli Kaleo</option>
						</select>
					</div>
					<!--<div id="working_hours">
						<span>Working Hours</span><br>
						<select name="working_hours">
							<option>Select</option>
							<option>Day Time</option>
							<option>Night</option>
							<option>Day and Night</option>
						</select>
					</div> -->
				</div>
				<div id="appDjob">
					<input type="submit" value="ADD" name="add_restaurant_details" />
				</div>
			</div>
	</form>
</div><!-- closes ret row -->
		
<?php close_db(); ?>