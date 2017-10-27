<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
<div id="order_title">
	<img class="main" src="images/logo.png" alt="" /><span><em>Registered Restaurants</em></span>
</div>
<form action="index.php?restaurantsPage=restaurant">
	<!-- these pages are included from the index.php page -->
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
			<input type="submit" value="View Registered Restaurants" name="view_rest" />
		</div>
		<div class="command">
			<input type="submit" value="Restaurants Application" name="restaurant_app" />
		</div>
		<div class="command">
			<input type="submit" value="Upload/Update Restaurant Logo" name="restaurant_logo" />
		</div>
		<div class="command">
			<input type="submit" value="Create Deliveries Account" name="deliveries" />
		</div>
		<div class="command">
			<input type="submit" value="Add/Update Restaurants Operation Time" name="add_restaurant_next" />
		</div>
		<div class="command">
			<input type="submit" value="Add/Update Restaurant Delivery Fee" name="delivery_fee" />
		</div>
		<div class="command">
			<input type="submit" value="Add/Update Restaurant Statement" name="restaurant_statement" />
		</div>
	</div>
</form>
				
					