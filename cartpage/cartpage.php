<?php ob_start(); ?>
<?php date_default_timezone_set('UTC'); ?>
<?php session_start();  ?>
<?php require_once("../includes/redirect.php"); ?>
<?php if(!isset($_SESSION["logged_user_id"])){
		//redirect_to("../loginpage/login.php");
	} 
?>
<?php require_once("../includes/functions.php"); ?>
<?php connect_to_db(); ?>
<?php include("../includes/layout/header.php"); ?>
<script type="text/javascript" src=""></script>
<link rel="stylesheet" type="text/css" href="css/cartpage.css">
<?php 
	//if(!isset($_SESSION["logged_user_id"])){
	//	redirect_to("../loginpage/login.php");
	//can be uncommented for future development to enforce account creation before orders can be placed
	//}else{ 
if (isset($_SESSION['checkout_method'])) {
		unset($_SESSION['checkout_method']);
	}
?>

	<?php define("shippingCost", 5); //no longer used ?>
	<section id="cart_section" class="row" >
		<div id="menu_panel" class="jumbotron-custom">
			<?php 
				if (isset($_GET['id']) && isset($_GET['name'])){
					$id = $_GET['id'];
					$name = $_GET['name'];
					//query to select menu
					$query = "SELECT menu.id, menu.restaurant_id, menu.food_item, menu.price, restaurant.restaurant_name  FROM menu, restaurant WHERE menu.restaurant_id = $id AND restaurant.restaurant_name='$name' ";
					$result = mysqli_query($connection, $query);
					if (!$result) {
						//die(); // user inputted wrong values in the address bar
					}else{

						if (mysqli_num_rows($result)!==0) {
							$_SESSION["sessionId"] = $id;
							$_SESSION["sessionName"] = $name;
							//close php to develop html
							?>
								<article id="top_rest" style="">
									<div id="top_restaurant_description" class="col-sm-7">
										<div id="set_img_desc" class="col-md-3">
											<?php
												
												$query = "SELECT * FROM restaurant WHERE id = $id LIMIT 1";
												$result1 = mysqli_query($connection, $query);
												$values = mysqli_fetch_assoc($result1);
												if ($values["logo"]!="") {
													$image = $values["logo"];
													
													if (file_exists("../restaurantspage/rlogo/{$image}")) {
														//echo "restaurantspage/rlogo/{$image}";
														echo "<img src=\"../restaurantspage/rlogo/$image\">";	
													}else{

													}
												}else{
													$image = 1;
													if (file_exists("../restaurantspage/alogo/{$image}.jpg")) {
														//echo "restaurantspage/alogo/{$image}.jpg";
														echo "<img src=\"../restaurantspage/alogo/{$image}.jpg\">";	
													}else{
														
													}
													//echo "<img src=\"restaurantspage/alogo/$image\">"; 
												}
											
											?>
										</div>
										<div id="set_text_desc" class="col-md-9">
											<span style="font-size: 2em; font-weight: bold;"><?php echo $values["restaurant_name"]; ?><span><br /><br />
											<!--<span style="font-size: 0.8em; font-style: italic;"><?php echo $values["slogan"]; ?><span><br /> -->
											<span style="font-size: 0.7em; font-style: italic;"><?php echo $values["street_address"]; ?></span> 
										</div> 
										<br /><br />
										<?php
											 $query1 = "SELECT *  FROM restaurant_opentime WHERE restaurant_opentime.restaurant_id = $id";
											 $result1 = mysqli_query($connection, $query1); 
											 $result_array1  = mysqli_fetch_assoc($result1);

											 $query2 = "SELECT *  FROM restaurant_closetime WHERE restaurant_closetime.restaurant_id = $id";
											 $result2 = mysqli_query($connection, $query2); 
											 $result_array2  = mysqli_fetch_assoc($result2);

											 $query3 = "SELECT *  FROM restaurant_statement WHERE restaurant_statement.restaurant_id = $id LIMIT 1";
											 $result3 = mysqli_query($connection, $query3); 
											 $result_array3  = mysqli_fetch_assoc($result3);
											 $test = $result_array1["monday"];
										?>
											<span style="font: 1.2em Tahoma">This Restaurant Takes Deliveries and Take-out </span><br /><br />
						
											<?php 
												//get the day of the week from server time
												//retreive the order time
												//check availabilabilty and set appropriate variables
				
												# code...
												$current = strtotime('now');
												$dayOfWeek = strtolower(date('l', $current));
												$dbOperationTimeBegin = $result_array1[$dayOfWeek];
												$dbOperationTimeEnd = $result_array2[$dayOfWeek];
												$operationTimeBegin = strtotime($dbOperationTimeBegin);
												$operationTimeEnd = strtotime($dbOperationTimeEnd. ' +12 hours');
												?>
													<center>
														<div id="order_time">
															<div class="col-xs-2 time"><?php echo $dbOperationTimeBegin ?></div>
															<div class="col-xs-8 time_text">Ordering Hours</div>
															<div class="col-xs-2 time"><?php echo $dbOperationTimeEnd ?></div>
														</div>
													</center>
												<?php
												$ct = $current - $operationTimeBegin;
												$co = $current - $operationTimeEnd;
												

												if ($ct <=0 || $co >=0) {
													# closed
													//echo "closed";
													?>
														<center><img src="images/closed.ico" height="15%" width="15%"style="margin-top:-33px;"></center>
													<?php
												}else{
													#opened
													
													
													?>
														<center><img src="images/open.ico" height="15%" width="15%" style="margin-top:-33px;"></center>
													<?php

												}

											?>
											<!--<span style="font: 1.2em Tahoma;">Monday: <?php //echo $result_array1["monday"]. " ----- ". $result_array2["monday"]; ?></span>
											<hr>
											<span style="font: 1.2em Tahoma;">Tuesday: <?php //echo $result_array1["tuesday"]. " ----- ". $result_array2["tuesday"]; ?></span>
											<hr>
											<span style="font: 1.2em Tahoma;">Wednesday: <?php //echo $result_array1["wednesday"]. " ----- ". $result_array2["wednesday"]; ?></span>
											<hr>
											<span style="font: 1.2em Tahoma;">Thursday: <?php //echo $result_array1["thursday"]. " ----- ". $result_array2["thursday"]; ?></span>
											<hr>
											<span style="font: 1.2em Tahoma;">Friday: <?php //echo $result_array1["friday"]. " ----- ". $result_array2["friday"]; ?></span>
											<hr>
											<span style="font: 1.2em Tahoma;">Saturday: <?php //echo $result_array1["saturday"]. " ----- ". $result_array2["saturday"]; ?></span>
											<hr>
											<span style="font: 1.2em Tahoma;">Sunday: <?php //echo $result_array1["sunday"]. " ----- ". $result_array2["sunday"]; ?></span><hr> -->
									</div>
									<div id="top_order_options" class="col-sm-5">
										<span><span class="glyphicon glyphicon-cutlery"></span> 
										<?php 
												$val_general = $result_array3['general_statement'];
												if ($val_general !='') {
													echo $val_general;
												}else{
													echo "We priorotize our kitchen environment, making good hygienic practices a pre-requisite!";
												}
											?>
									</span><br /><br />
										<span>
											Our Highly trained chefs and caterers ensures we meet your desired food requirements.
										</span><br /><br />
										<span>
											<span class="glyphicon glyphicon-globe"></span> 
											<?php 
												$val_kitchen = $result_array3['kitchen_statement'];
												if ($val_kitchen !='') {
													echo $val_kitchen;
												}else{
													echo "We operate in a transparent glass enclosed kitchen making you a part of the food preparation process.";
												}
											?>
										</span><br/><br />
										<span>
											<?php 
												$val_suggestion = $result_array3['suggestions'];
												if ($val_suggestion !='') {
													echo $val_suggestion;
												}else{
													echo "Our doors are open to constructive suggestions that will help us serve you better and grow our customer base.";
												}
											?>
											
										</span>
										<hr>
										<span><span class="glyphicon glyphicon-heart"></span> Wishing You Great Appetite!<br /> Sincerely, <?php echo $name; ?> Team.</span>
									</div>
								</article><br /> 
						<article style="">
							<?php 
							echo "<center><span style=\" padding: 0.3em; font: 20px Tahoma;\">$name  Menu</span></center>";
							echo "<br /><br />";
							echo "<center><span style=\" font-family: Tahoma;\">Add Food Items To Cart And Click Order!</span></center><br />";
							while($values = mysqli_fetch_assoc($result)){ // this retrieves the restaurant menu ?>
							<form action="../checkout/checkout.php" method="post">
								<div class="set" style="display:block;">
									<div class="food-image">
										<?php 
											$file_name = "food/".$values["id"].".jpg";
											if (getimagesize($file_name)) {
												?>
												<img src="<?php echo "food/".$values["id"].".jpg"; ?>">
												<?php
											}else{ ?>
												<img src="food/food.png">
												<?php
											}
										?>
									</div>
									<div class="set_text" id="foodChecked<?php echo $values["id"]; ?>">
										<div id="check_item"><input type="checkbox" class="check_item_disabled" name="foodChecked<?php echo $values["id"]; ?>"/></div><br />
										<div id="food_item"><input type="button" value="<?php echo $values["food_item"]; ?>"></div>
										<div class="">
											<div id="food_price" class="col-xs-7"><input type="button" value="<?php  echo  "GHC "; printf("%.2f", $values["price"]); ?>"></div>
											<div id="numberof_plates" class="col-xs-5">
												<select name="numberOfPlates<?php echo $values["id"]; ?>">
													<option selected>1</option>
													<?php for ($i=2; $i <=10; $i++) {?> <option><?php echo $i; ?></option> <?php } ?>
												</select><br /> <span>Plate(s)</span>
											</div>
										</div><br /><br />
										<div style="height:20px;">
											<center><h5 style="color:white;"></h5></center>
										</div>
										<div id="add_to_cart"><input type="button" value="Add to cart"></div>
									</div>
								</div>
							
								<?php	
									}// while loop end
								?>
								
									<!--<div class="" style="background-color:red">
										<div style="float: left; margin: 10px;">
											<div style="padding: 1em;">Delivery</div> 
											<div style="float: left;"><input type="radio" name="order_delivery_option" value="delivery" checked> </div>
										</div>
										<div style="float: left; margin: 10px;">
											<div style="padding: 1em;"> Takeout</div> 
											<div style="float: left;"><input type="radio" value="takeout" name="order_delivery_option"></div>
										</div><br /><br />
										

									</div> -->
									<!--<div id="orderButton"> -->
										<input type="submit" value="ORDER" name="orderSelected" id="orderSelectedButton">
									<!--</div> -->
							</form>
						</article>
							<?php

							}else{
								echo "<div style=\"font: 2em Tahoma; text-align: center; margin-bottom: 100px;\"> This Restaurant is Not Available for Online Ordering at the Moment. Check Back Shortly!</div>";
								echo "<center><div style=\"font: 1.2em Tahoma; margin-bottom: 100px; text-align:center; width: 200px; height: 45px; background-color: red\"> <a href=\"../restaurantspage/restaurants.php\" style=\"color: white\">Select A Different Restaurant</a></div></center>";
								//die();//user might have inputted wrong values or menu is not available. mysqli_error($connection) . mysqli_errno($connection));
							}// result row return if statement
					} //result boolean test else statement end
				}else{
					//redirect_to("restaurants.php");
				}
			?>
		</div>
		<?php
			//if (!isset($_POST["orderSelected"])) {// so that it only displays when you are to check food items ?>	
		<!--<div id="pricecalculator_cart" class="col-lg-2 col-md-2 col-sm-2">
			<span style="font: 1.5em Tahoma; text-decoration: underline;">How To Order</span>
			<ul>
				<li>Check The Food Items</li>
				<li>Click Order</li>
				<li>You will be redirected to:
						<ul style="text-align: center; list-style: none;">
							<i>
								<li>Enter Your Phone Number</li>
								<li>Your Name And</li>
								<li>Street Address</li>
							</i>
						</ul>
				</li>
				
			</ul>	
		</div> -->
	<?php//	}

		 ?>

	</section>
<?php


//} ?>

<script type="text/javascript">
	/* this is to simply disbale the order button until a food item is checked */
	//window.onload = disableOrder;
	function disableOrder(){
		var checkValue = document.getElementsByClassName('check_item_disabled');
		orderButton = document.getElementById('orderSelectedButton');
		$('.check_item_disabled').change(function () {
		    $('#orderSelectedButton').prop("disabled", !this.checked);
		}).change()
	
		/*if (checkValue.checked == true) {
			/*orderButton.disabled = false; *
		}else{
			/*orderButton.disabled = true; *
		}*/
	}

	$(document).ready(function(){
	$('.set_text').on('click', function(){
		var classClicked = this.getElementsByTagName('input')[0];
		var nameText = classClicked.id;
		if(classClicked.checked == false){
			classClicked.checked = true;
			var divId = this.id;
			this.getElementsByTagName('h5')[0].innerHTML = "added to cart";
			but = this.getElementsByTagName('input')[3]; // = "remove from cart"
			but.value="remove from cart";
			$('#'+divId).css('background-color', 'red');
			//disableOrder();
			//alert(this.id);
		}else{
			classClicked.checked = false;
			//disableOrder();
			var divId = this.id;
			this.getElementsByTagName('h5')[0].innerHTML = "";
			but = this.getElementsByTagName('input')[3]; // = "remove from cart"
			but.value="Add to cart";
			this.getElementsByTagName('h5').innerHTML = '';
			$('#'+divId).css('background-color', 'white');
			//alert("you just unchecked me");
		}

	});
});
</script>
<?php include("../includes/layout/footer.php") ?>
<?php close_db(); ?>
<?php ob_flush(); ?>