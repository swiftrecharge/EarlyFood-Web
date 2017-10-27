<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
<div id="order_title">
	<img class="main" src="images/logo.png" alt="" /><br /><span><em>Registered Restaurants</em></span>
</div>

<!--<form action="add_restaurant.php" method="post">
	<div class="panel_buttons">
		<input type="submit" value="+Add New Restaurant" name="add_restaurant" class="btn btn-warning"/>

		<input type="submit" value="Update Restaurant Details" name="update_restaurant" class="btn btn-warning" />

		<input type="submit" value="+Add Restaurant Menu" name="add_menu" class="btn btn-warning" />

		<input type="submit" value="Update Restaurant Menu" name="update_menu" class="btn btn-warning" />

		<input type="submit" value="Delete Restaurant Application" name="delete_app" class="btn btn-warning" />

		<input type="submit" value="Delete Restaurant" name="delete_restaurant" class="btn btn-warning" />

		<input type="submit" value="View Registered Restaurants" name="view_rest" class="btn btn-warning" />

		<input type="submit" value="Restaurants Application" name="restaurant_app" class="btn btn-warning" />
	</div>
</form> -->
					
<span style="font: 30px Tahoma;">Update Restaurant =></span> <br /><br />
<form action ="update_restaurant_process.php" method="post">
	<select name="id">
		<option>Restaurant ID</option>
			<?php
				$query = "SELECT * FROM restaurant";
				$result = mysqli_query($connection, $query);
				while($id = mysqli_fetch_assoc($result)){ ?>
				
					 <option><?php echo $id["id"]; ?></option>
			<?php
				}
			?>
		</select>
		<br /><br />
		<div class="regForm">
			<div id="rest_name">
				<span>New Restaurant Name</span><br />
				<input tpye="text" name="restaurant_name" value=""><br />
			</div><br />
			<div id="slogan">
				<span>New Slogan<br></span>
				<input tpye="text" name="slogan" value=""><br />
			</div><br />
			<div id="address">
				<span>New Street Address<br></span>
				<textarea name="address" cols="24"></textarea>
			</div>
			<div id="working_days">
				<span>New Working Days<br></span>
				<select name="working_days">
					<option>Select</option>
					<option>Week Days Only</option>
					<option>Week Days and Saturdays</option>
					<option>Week Days and Weekends</option>
					<option>Weekends  Only</option>
				</select> <br />
			</div>
			<div id="region">
				<span>New Region<br></span>
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
				<span>New District<br></span>
				<select name="district">
					<option>Select</option>
					<option>Nadowli Kaleo</option>
				</select>
			</div>
			<div id="working_hours">
				<span>New Working Hours</span><br>
				<select name="working_hours">
					<option>Select</option>
					<option>Day Time</option>
					<option>Night</option>
					<option>Day and Night</option>
				</select>
			</div>
			<div id="display">
				<span>Display<br></span>
				<select name="visible">
					<option>Select</option>
					<option select="selected">
						Yes
					</option>
					<option>
						No
					</option>
				</select>
				
			</div>
			<div id="appDjob">
				<input type="submit" value="UPDATE" class="appDjob" name="update" />
			</div>
		</div>
</form>
<?php close_db(); ?>