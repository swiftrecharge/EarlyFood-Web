
<!-- this is no longer useful -->
<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
				<div id="order_title">
					<img class="main" src="images/logo.png" alt="" /><span><em>Registered Restaurants</em></span>
				</div>
				<form action="restaurants.php" method="post">
					<div class="commands_block"> <!-- row2 -->
						<div class="command">
							<input type="submit" value="+Add New Restaurant" name="add_restaurant" />
						</div>
						<div class="command">
							<input type="submit" value="Update Restaurant Details" name="update_restaurant" />
						</div>
						<div class="command">
							<input type="submit" value="+Add Restaurant Menu" name="add_menu" />
						</div>

						<div class="command">
							<input type="submit" value="Update Restaurant Menu" name="update_menu" />
						</div>
					</div>
					<div class="commands_block"><!-- row3 -->
						<div class="command">
							<input type="submit" value="Delete Restaurant Application" name="delete_app" />
						</div>
						<div class="command">
							<input type="submit" value="Delete Restaurant" name="delete_restaurant" />
						</div>
						<div class="command">
							<input type="submit" value="View Registered Restaurants" name="view_rest" />
						</div>
						<div class="command">
							<input type="submit" value="Restaurants Application" name="restaurant_app" />
						</div>
						<div class="command">
							<input type="submit" value="Create Deliveries Acconut" name="deliveries" />
						</div>
					</div>
				</form>
				
					<?php 
						if (isset($_POST["add_restaurant"])) { //close php to design form ?>
					<div id="commands_display" class="jumbotron">
						<div class="row" ><!-- add rest row -->
							<span style="font: 20px Tahoma; text-align: center;" class="row">Add Restaurant =></span>
								<form action ="restaurants.php" method="post">
									<div class="regForm">
										<div class="row"><!-- rest_name and slogan row -->
												<div id="rest_name" class="row">
													<span>Restaurant Name</span><br />
													<input tpye="text" name="restaurant_name" value="<?php if(isset($_SESSION["name"])){echo $_SESSION["name"];} ?>">
												</div>
												<div id="slogan" class="row">
													<span>Slogan</span><br />
													<input type="text" name="slogan" value="<?php if(isset($_SESSION["slogan"])){echo $_SESSION["name"];} ?>">
												</div>
										</div>
										<div class="row">
											<div id="address">
												<span>Street Address</span><br />
												<textarea name="address" cols="30" rows="5"><?php if(isset($_SESSION["add"])){echo $_SESSION["add"];} ?></textarea>
											</div>
										</div>
										<div class="row">
											<div id="working_days" class="col-lg-8 col-md-8 col-sm-8">
												<span>Working Days<br></span>
												<select name="working_days">
													<option>Select</option>
													<option>Week Days Only</option>
													<option>Week Days and Saturdays</option>
													<option>Week Days and Weekends</option>
													<option>Weekends  Only</option>
												</select> <br />
											</div>
											<div id="display" class="col-lg-4 col-md-4 col-sm-4">
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
											<div id="region" class="col-lg-4 col-md-4 col-sm-4">
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
											<div id="district" class="col-lg-4 col-md-4 col-sm-4">
												<span>District</span><br>
												<select name="district">
													<option>Select</option>
													<option>Nadowli Kaleo</option>
												</select>
											</div>
											<div id="working_hours" class="col-lg-4 col-md-4 col-sm-4">
												<span>Working Hours</span><br>
												<select name="working_hours">
													<option>Select</option>
													<option>Day Time</option>
													<option>Night</option>
													<option>Day and Night</option>
												</select>
											</div>
										</div>
										<div id="appDjob">
											<input type="submit" value="ADD" name="add_restaurant_details" />
										</div>
									</div>
							</form>
						</div><!-- closes ret row -->

						<?php //open php tags for the next button

						}elseif (isset($_POST["update_restaurant"])) { //close php to work on html ?>
						<div id="commands_display" class="jumbotron">
							<span style="font: 30px Tahoma;">Update Restaurant =></span> <br /><br />
							<form action ="restaurants.php" method="post">
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
						<?php //open php tags again
						
						}elseif (isset($_POST["add_menu"])) { //close php to work on html ?>
						<div id="commands_display" class="jumbotron">
						<div class="row">
							<span style="font: 30px Tahoma;">Add Menu Items =></span>
							<form action="restaurants.php" method="post">
							<div class="row">
								<div class="description_price">
									<div class="col-lg-7 col-md-7 col-sm-7">
										<div class="description">
											<select name="restaurantname" style="height: 50px; font-size: 30px;">
												<option>Select Restaurant</option>
												<?php 
													$query = "SELECT restaurant.restaurant_name  FROM restaurant ";
													$result = mysqli_query($connection, $query);
													while($id = mysqli_fetch_assoc($result)){ ?>
													<option><?php echo $id["restaurant_name"]; ?> </option>;
												<?php	
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
										<div class="price">
											<!-- <input name="rest_id" placeholder="ID" /> -->
											<select name="rest_id" style="height: 50px; font-size: 30px;">
												<option>Select</option>
												<?php 
													$query = "SELECT restaurant.id  FROM restaurant ";
													$result = mysqli_query($connection, $query);
													while($id = mysqli_fetch_assoc($result)){ ?>
													<option><?php echo $id["id"]; ?> </option>;
												<?php	
													}
												?>
											</select>	
										</div>
									</div>
									</div>
							</div>
							<div class="row">
								<div class="description_price">
									<div class="col-lg-9 col-md-9 col-sm-9">
										<div class="description">
											<input type="text" name="item1" placeholder="Food Description" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="price">
											<input name="price1" placeholder="Price" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="description_price">
									<div class="col-lg-9 col-md-9 col-sm-9">
										<div class="description">
											<input type="text" name="item2" placeholder="Food Description" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="price">
											<input name="price2" placeholder="Price" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="description_price">
									<div class="col-lg-9 col-md-9 col-sm-9">
										<div class="description">
											<input type="text" name="item3" placeholder="Food Description" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="price">
											<input name="price3" placeholder="Price" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="description_price">
									<div class="col-lg-9 col-md-9 col-sm-9">
										<div class="description">
											<input type="text" name="item4" placeholder="Food Description" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="price">
											<input name="price4" placeholder="Price" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="description_price">
									<div class="col-lg-9 col-md-9 col-sm-9">
										<div class="description">
											<input type="text" name="item5" placeholder="Food Description" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="price">
											<input name="price5" placeholder="Price" />
										</div>
									</div>
								</div>
							</div>
								<div id="additem" class="row">
									<input type="submit" value="ADD" name="add_menu_item" />
								</div>
							</form>
						</div>
						<?php
							
						}elseif (isset($_POST["update_menu"])) { ?>
						<div id="commands_display" class="jumbotron">
						<div class="row">
							<span style="font: 30px Tahoma;">Update Menu Items =></span>
							<form action="restaurants.php" method="post">
							<div class="row">
								<div class="description_price">
									<div class="col-lg-7 col-md-7 col-sm-7">
										<div class="description">
											<select name="restaurantname" style="height: 50px; font-size: 30px;">
												<option>Select Restaurant</option>
												<?php 
													$query = "SELECT restaurant.restaurant_name  FROM restaurant ";
													$result = mysqli_query($connection, $query);
													while($id = mysqli_fetch_assoc($result)){ ?>
													<option><?php echo $id["restaurant_name"]; ?> </option>;
												<?php	
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
										<div class="id_update">
											<!-- <input name="rest_id" placeholder="ID" /> 
											<span style="font-size: 30px;">ID</span> -->
											<select name="rest_id" style="height: 50px; font-size: 30px;">
												<option>Slct</option>
												<?php 
													$query = "SELECT *  FROM restaurant ";
													$result = mysqli_query($connection, $query);
													while($id = mysqli_fetch_assoc($result)){ ?>
													<option><?php echo $id["id"]; ?> </option>;
												<?php	
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="description_price_update">
									<div class="col-lg-7 col-md-7 col-sm-7">
										<div class="description_update">
											<input type="text" name="item1" placeholder="Food Description" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="price_update">
											<input name="price1" placeholder="Price" />
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2">
										<div class="id_update">
											<!-- <input name="rest_id" placeholder="ID" /> 
											<span style="font-size: 30px;">ID</span> -->
											<select name="menu_id1" style="height: 50px; font-size: 30px;">
												<option>Slct</option>
												<?php 
													$query = "SELECT *  FROM menu ";
													$result = mysqli_query($connection, $query);
													while($id = mysqli_fetch_assoc($result)){ ?>
													<option><?php echo $id["id"]; ?> </option>;
												<?php	
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="description_price_update">
									<div class="col-lg-7 col-md-7 col-sm-7">
										<div class="description_update">
											<input type="text" name="item2" placeholder="Food Description" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="price_update">
											<input name="price2" placeholder="Price" />
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2">
										<div class="id_update">
											<!-- <input name="rest_id" placeholder="ID" /> 
											<span style="font-size: 30px;">ID</span> -->
											<select name="menu_id2" style="width: height: 50px; font-size: 30px;">
												<option>Slct</option>
												<?php 
													$query = "SELECT *  FROM menu ";
													$result = mysqli_query($connection, $query);
													while($id = mysqli_fetch_assoc($result)){ ?>
													<option><?php echo $id["id"]; ?> </option>;
												<?php	
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="description_price_update">
									<div class="col-lg-7 col-md-7 col-sm-7">
										<div class="description_update">
											<input type="text" name="item3" placeholder="Food Description" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="price_update">
											<input name="price3" placeholder="Price" />
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2">
										<div class="id_update">
											<!-- <input name="rest_id" placeholder="ID" /> 
											<span style="font-size: 30px;">ID</span> -->
											<select name="menu_id3" style="height: 50px; font-size: 30px;">
												<option>Slct</option>
												<?php 
													$query = "SELECT *  FROM menu ";
													$result = mysqli_query($connection, $query);
													while($id = mysqli_fetch_assoc($result)){ ?>
													<option><?php echo $id["id"]; ?> </option>;
												<?php	
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="description_price_update">
									<div class="col-lg-7 col-md-7 col-sm-7">
										<div class="description_update">
											<input type="text" name="item4" placeholder="Food Description" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="price_update">
											<input name="price4" placeholder="Price" />
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2">
										<div class="id_update">
											<!-- <input name="rest_id" placeholder="ID" /> 
											<span style="font-size: 30px;">ID</span> -->
											<select name="menu_id4" style="height: 50px; font-size: 30px;">
												<option>Slct</option>
												<?php 
													$query = "SELECT *  FROM menu ";
													$result = mysqli_query($connection, $query);
													while($id = mysqli_fetch_assoc($result)){ ?>
													<option><?php echo $id["id"]; ?> </option>;
												<?php	
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="description_price_update">
									<div class="col-lg-7 col-md-7 col-sm-7">
										<div class="description_update">
											<input type="text" name="item5" placeholder="Food Description" />
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="price_update">
											<input name="price5" placeholder="Price" />
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2">
										<div class="id_update">
											<!-- <input name="rest_id" placeholder="ID" /> 
											<span style="font-size: 30px;">ID</span> -->
											<select name="menu_id5" style="height: 50px; font-size: 30px;">
												<option>Slct</option>
												<?php 
													$query = "SELECT *  FROM menu ";
													$result = mysqli_query($connection, $query);
													while($id = mysqli_fetch_assoc($result)){ ?>
													<option><?php echo $id["id"]; ?> </option>;
												<?php	
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
								<div id="additem" class="row">
									<input type="submit" value="UPDATE" name="update_menu_item" />
								</div>
							</form>
						</div>
					<?php
							
						}elseif (isset($_POST["delete_restaurant"])) {
							
						}elseif (isset($_POST["restaurant_app"])) {
							
						}elseif (isset($_POST["view_rest"])) {
							
						}elseif (isset($_POST["delete_app"])) {
							
						}elseif (isset($_POST["deliveries"])) {
							?>

							<?php
						}
					?>
			</div>
		<?php 
			// process restaurant addition
			if(isset($_POST["add_restaurant_details"])){
				$restaurant_name = $_POST["restaurant_name"]; $safe_restaurant_name = mysql_prep($connection, $restaurant_name);
				$slogan = $_POST["slogan"]; $safe_slogan = mysql_prep($connection, $slogan); 
				$address = $_POST["address"]; $safe_address = mysql_prep($connection, $address);
				$working_days = $_POST["working_days"]; $safe_working_days = mysql_prep($connection,$working_days);
				$region = $_POST["region"];
				$district = $_POST["district"];
				$working_hours = $_POST["working_hours"]; $safe_working_hours = mysql_prep($connection ,$working_hours);
				$visible = $_POST["visible"];
				$empty_restaurant_log = array(has_no_presence($restaurant_name), has_no_presence($address));
				$empty_select = array();
				
				
				if($empty_restaurant_log[0]===null && $empty_restaurant_log[1]===null){
					$_SESSION["name"] = $restaurant_name;
					$_SESSION["add"] = $address;
					$_SESSION["slogan"] = $slogan;
					if(selected($working_days) && selected($working_hours) && selected($district) && selected($region) && selected($visible)){
						//everything is good proceed to create restaurant
						$_SESSION["name"] = null;
						$_SESSION["add"] = null;
						//query database
						$query = "INSERT INTO restaurant(restaurant_name, loc_region, loc_district, street_address, working_days, working_hours, visible, slogan) VALUES('$safe_restaurant_name', '$region', '$district', '$safe_address', '$safe_working_days', '$safe_working_hours', '$visible', '$safe_slogan')";
						$result = mysqli_query($connection, $query);
						if(!$result){
							die("Database connection failed." . mysqli_error($connection) );
						}
					}else{
						echo "<span style=\"font-size: 30px;\">Restaurant  Addition was not successful. Try Aagain!</span><br /> <br />";
						echo "<span style=\"font-size: 30px; color: red;\">Check to Ensure You've Selected all Labels</span><br /> <br />";
					}
				}else{
					$_SESSION["name"] = null;
					$_SESSION["add"] = null;
					echo "<span style=\"font-size: 30px;\">Restaurant  Addition was not successful. Try Aagain!</span><br /> <br />";
					echo "<span style=\"font-size: 30px; color: red;\">Restaurant Name and Address are Required</span> <br />";
				}
			}
		?>
		<?php 
			//process restaurant details update.
			if(isset($_POST["update"])){
				//check for fields that contain values keeping in mind the select options
				$id = $_POST["id"];
				$restaurant_name = $_POST["restaurant_name"]; $safe_restaurant_name = mysql_prep($connection, $restaurant_name);
				$address = $_POST["address"]; $safe_address = mysql_prep($connection, $address);
				$working_days = $_POST["working_days"]; $safe_working_days = mysql_prep($connection,$working_days);
				$region = $_POST["region"];
				$district = $_POST["district"];
				$working_hours = $_POST["working_hours"]; $safe_working_hours = mysql_prep($connection ,$working_hours);
				$visible = $_POST["visible"];
				$slogan = $_POST["slogan"]; $safe_slogan = mysql_prep($connection, $slogan);
				
				if(!empty($restaurant_name)){
					update("restaurant", "restaurant_name", $safe_restaurant_name, $id, "Restaurant name");
				}
				if(!empty($slogan)){
					update("restaurant", "slogan", $safe_slogan, $id, "Slogan");
				}
				if(!empty($address)){
					update("restaurant", "street_address", $safe_address, $id, "Restaurant Address");
				}
				if(!empty($working_days) && $working_days!=="Select"){
					update("restaurant", "working_days", $safe_working_days, $id, "Working Days");
				}
				if(!empty($working_hours) && $working_hours!=="Select"){
					update("restaurant", "working_hours", $safe_working_hours, $id, "Working Hours");
				}
				if(!empty($region) && $region!=="Select"){
					update("restaurant", "loc_region", $region, $id, "Region");
				}
				if(!empty($district) && $district!=="Select"){
					update("restaurant", "loc_district", $district, $id, "District");
				}
				if(!empty($visible) && $visible!=="Select"){
					update("restaurant", "visible", $visible, $id, "Display");
				}
			}
		?>

		<?php 
			// process menu addition
			if (isset($_POST["add_menu_item"])) {
				$restaurant_name = $_POST["restaurantname"]; $restaurant_id = $_POST["rest_id"];
				$item1 = $_POST["item1"]; $safe_item1 = mysql_prep($connection, $item1); $price1 = $_POST["price1"]; $safe_price1 = mysql_prep($connection, $price1);
				$item2 = $_POST["item2"]; $safe_item2 = mysql_prep($connection, $item2); $price2 = $_POST["price2"]; $safe_price2 = mysql_prep($connection, $price2);
				$item3 = $_POST["item3"]; $safe_item3 = mysql_prep($connection, $item3); $price3 = $_POST["price3"]; $safe_price3 = mysql_prep($connection, $price3);
				$item4 = $_POST["item1"]; $safe_item4 = mysql_prep($connection, $item4); $price4 = $_POST["price4"]; $safe_price4 = mysql_prep($connection, $price4);
				$item5 = $_POST["item5"]; $safe_item5 = mysql_prep($connection, $item5); $price5 = $_POST["price5"]; $safe_price5 = mysql_prep($connection, $price5);

				if (!empty($restaurant_name) && ($restaurant_id!=="Select"  && $restaurant_name!=="Select Restaurant") ) {
					//check to ensure that the name and id selected corresponds
					$query = "SELECT restaurant.id, restaurant.restaurant_name FROM restaurant WHERE restaurant.id = $restaurant_id LIMIT 1";
					$result = mysqli_query($connection, $query);
					if (!$result) {
						die("Could Not Find Restaurant " . mysqli_error($connection));
					}else{
						$result_array = mysqli_fetch_assoc($result);
						if ($result_array['restaurant_name']==$restaurant_name) {
							
							if ($item1!=null && $price1!=null) {
								add_menu_item($restaurant_id, $safe_item1, $safe_price1);
							}
							if ($item2!=null && $price2!=null) {
								add_menu_item($restaurant_id, $safe_item2, $safe_price2);
							}
							if ($item3!=null && $price3!=null) {
								add_menu_item($restaurant_id, $safe_item3, $safe_price3);
							}
							if ($item4!=null && $price4!=null) {
								add_menu_item($restaurant_id, $safe_item4, $safe_price4);
							}
							if ($item5!=null && $price5!=null) {
								add_menu_item($restaurant_id, $safe_item5, $safe_price5);
							}
						}else{
							echo "Restaurant Name Does Not Correspond To The Chosen Restaurant ID.";
						}
					}
					
				}else{
					echo "Please Select Restaurant Name Or Select ID!";
					//session variables to save already typed values
				}
			}
		?>
		<?php 
			// process menu upate
			if (isset($_POST["update_menu_item"])) {
				$restaurant_name = $_POST["restaurantname"]; $restaurant_id = $_POST["rest_id"]; 
				$item1 = $_POST["item1"]; $safe_item1 = mysql_prep($connection, $item1); $price1 = $_POST["price1"]; $safe_price1 = mysql_prep($connection, $price1); $menu_id1 = $_POST["menu_id1"];
				$item2 = $_POST["item2"]; $safe_item2 = mysql_prep($connection, $item2); $price2 = $_POST["price2"]; $safe_price2 = mysql_prep($connection, $price2); $menu_id2 = $_POST["menu_id2"];
				$item3 = $_POST["item3"]; $safe_item3 = mysql_prep($connection, $item3); $price3 = $_POST["price3"]; $safe_price3 = mysql_prep($connection, $price3); $menu_id3 = $_POST["menu_id3"];
				$item4 = $_POST["item4"]; $safe_item4 = mysql_prep($connection, $item4); $price4 = $_POST["price4"]; $safe_price4 = mysql_prep($connection, $price4); $menu_id4 = $_POST["menu_id4"];
				$item5 = $_POST["item5"]; $safe_item5 = mysql_prep($connection, $item5); $price5 = $_POST["price5"]; $safe_price5 = mysql_prep($connection, $price5); $menu_id5 = $_POST["menu_id5"];
				if (!empty($restaurant_name) && (!empty($restaurant_id) && $restaurant_id!=="Slct" ) ) {
					//construct query to ensure tha credentials match
					$query = "SELECT restaurant.restaurant_name, restaurant.id, menu.restaurant_id FROM restaurant, menu WHERE restaurant.id = menu.restaurant_id LIMIT 1";
					$result = mysqli_query($connection, $query);
					if (!$result) {
								die("Selected Restaurant Does Not Have Any Menu. " . mysqli_error($connection));						
					}else{
						$result_array = mysqli_fetch_assoc($result);
						if ($result_array["restaurant_name"]==$restaurant_name) {
							if ($item1!=null && $price1!=null && (!empty($menu_id1) && $menu_id1!=="Slct" ) ) {
								update_menu_item($menu_id1, $safe_item1, $price1);
							}
							if ($item2!=null && $price2!=null && (!empty($menu_id1) && $menu_id2!=="Slct" ) ) {
								update_menu_item($menu_id2, $safe_item2, $price2);
							}
							if ($item3!=null && $price3!=null && (!empty($menu_id1) && $menu_id3!=="Slct" ) ) {
								update_menu_item($menu_id3, $safe_item3, $price3);
							}
							if ($item4!=null && $price4!=null && (!empty($menu_id1) && $menu_id4!=="Slct" ) ) {
								update_menu_item($menu_id4, $safe_item4, $price4);
							}
							if ($item5!=null && $price5!=null && (!empty($menu_id1) && $menu_id5!=="Slct" ) ) {
								update_menu_item($menu_id5, $safe_item5, $price5);
							}
						}else{
							echo "Restaurant Name Sselected Does Not Match Restaurant ID";
						}
					}
				}else{
					echo "Please Type Restaurant Name Or Select ID and Make Sure Menu ID is also selected!!";
					//session variables to save already typed values
				}
			}
		?>
	</div>
</div><!-- this closes the col1-->

</body>
</div><!-- this closes the container -->

</html>
<?php close_db(); ?>