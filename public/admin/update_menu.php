<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="bootstrap.min.js"></script>
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
<span style="font: 30px Tahoma;">Update Menu Items =></span>
<form action="update_menu_process.php" method="post">
<div class="row">
	<div class="description_price">
		<div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
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
		<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
		<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
		<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
		<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
		<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
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
					
<?php close_db(); ?>