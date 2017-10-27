<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="bootstrap.min.js"></script>
<div id="order_title">
	<img class="main" src="images/logo.png" alt="" /><br /><span><em>Registered Restaurants</em></span>
</div>
<!--<form action="add_menu.php" method="post">
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

<div><br /><br />
	<span style="font: 30px Tahoma; padding-left: 2em;">Add Menu Items =></span>
	<form action="add_menu_process.php" method="post">
	<div class="row">
		<div class="description_price">
			<div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
			<div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
			<div class="col-lg-7 col-md-7 col-sm-7 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
			<div class="col-lg-7 col-md-7 col-sm-7 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
			<div class="col-lg-7 col-md-7 col-sm-7 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
			<div class="col-lg-7 col-md-7 col-sm-7 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
			<div class="col-lg-7 col-md-7 col-sm-7 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
	// process menu addition
	//if (isset($_POST["add_menu_item"])) {
/*echo "Helllooooooo";
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
	//} */
?>