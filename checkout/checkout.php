<?php session_start();  ?>
<?php require_once("../includes/redirect.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php connect_to_db(); ?>
<?php //session_unset(); ?>

<?php include("../includes/layout/header.php"); // header file ?>
<script type="text/javascript" src="js/checkout.js"></script>
<link rel="stylesheet" type="text/css" href="css/checkout.css">
<link rel="stylesheet" type="text/css" href="walletCheckout/css/rest.css">
<link rel="stylesheet" type="text/css" href="walletCheckout/css/style.css">
<link rel="stylesheet" type="text/css" href="walletCheckout/css/mpower.css">
<link rel="stylesheet" type="text/css" href="walletCheckout/css/wallet.css">
<?php define("shippingCost", 5); ?>
	<section id="cart_section" class="row">
		<?php 
			if (isset($_SESSION["sessionId"]) && isset($_SESSION["sessionName"])){ ?>
				<div id="shipping" class="">
					<article id="article1_shipping" class="">
					
						<table border="5" class="table table-striped table-condensed">
							
							<center><span style="font: 1.1em Tahoma; color: red;"><?php if(isset($_SESSION["success"])){ echo $_SESSION["success"];} ?></span></center>
							
							<caption><center><span id="cSpan">You Are Ordering The Following From <?php echo $_SESSION["sessionName"]; ?></span></center></caption><br />
							<tr>
								<th>
									<div id="article1_shipping_item" class="shipping_items_header">
										<span>Food Item</span>
									</div>
								</th>
								<th>
									<div id="article1_shipping_price" class="shipping_items_header">
										<span>Price/Item(GHC)</span>
									</div>
								</th>
								<th>
									<div id="article1_shipping_qty" class="shipping_items_header">
										<span>Quantity</span>
									</div>
								</th>
								<th>
									<div id="article1_shipping_totalPrice" class="shipping_items_header">
										<span>Total Cost</span>
									</div>
								</th>
							</tr>
						<?php
							//session values are set here to prevent double checking for the availability of results
							$sessionId = $_SESSION["sessionId"];
							$sessionName = $_SESSION["sessionName"];
							//construct query to retrieve menu items selected
							$query = "SELECT menu.id, menu.food_item, menu.price, menu.restaurant_id, restaurant.restaurant_name FROM menu, restaurant WHERE (menu.restaurant_id = {$sessionId} AND restaurant.restaurant_name = '{$sessionName}') ";
							$result = mysqli_query($connection, $query);
							$overAllCost = 0;
							if (!$result) {
								die("Ordering Failed. " . mysqli_error($connection));
							}else{
								$total_shipping_cost = 0;
							while ($value = mysqli_fetch_assoc($result)) {
								//$shipping_cost = 0;
								//Delivery fee will not vary with quantity
								$cost_per_unit = delivery_fee($sessionId);
								//loop through the menu table and return food items with the corresponding checked
								if (isset($_POST["foodChecked{$value['id']}"]) && isset($_POST["numberOfPlates{$value['id']}"])) { 
										 $quatitySelected = $_POST["numberOfPlates{$value['id']}"];

										 $shipping_cost = $cost_per_unit;

										 $total_shipping_cost = $cost_per_unit; 

										 $shipping_cost_array[] = $shipping_cost;

										 $_SESSION["shipping_cost"] = $shipping_cost_array;

										 $foodItem = $value["food_item"];
										 $pricePerQuantity = $value["price"];
										 $totalCost = $quatitySelected * $pricePerQuantity;
										 $totalCost_array[] = $quatitySelected * $pricePerQuantity;
										 $_SESSION["total_cost"] = $totalCost_array;
										 $menuid_array[] = $value['id'];
										 $_SESSION["menuid_array"] = $menuid_array;
										 $overAllCost += $totalCost;
										 $_SESSION["overAllCost"] = $overAllCost;
										 $food_array[] = $foodItem;
										 $_SESSION["food_array"] = $food_array;
										 $price_array[] = $pricePerQuantity;
										 $_SESSION["price_array"] = $price_array;
										 $qty_array[] = $quatitySelected; 
										 $_SESSION["qty_array"] = $qty_array;
								// this closes the if statement?>
								<tr ALIGN="center">
									<td>
										<div id="article1_shipping_item" class="shipping_items">
											<span><?php echo $foodItem; ?></span>
										</div>
									</td>
									<td>
										<div id="article1_shipping_price" class="shipping_items">
											<span><?php printf("%.2f", $pricePerQuantity); ?></span>
										</div>
									</td>
									<td>
										<div id="article1_shipping_qty" class="shipping_items">
											<span><?php echo $quatitySelected; ?></span>
										</div>
									</td>
									<td>
										<div id="article1_shipping_totalPrice" class="shipping_items">
											<span><?php printf("%.2f", $totalCost); ?></span>
										</div>
									</td>
								</tr>
									
								<?php // this opens the if statement
								}//isset if statement
							}//while loop
						}//end of resulting availability if //pass the array through session
					}	
						// this closes the session checking if?>
					<tr>
						<td><span style="font: 1.2em Tahoma; text-align: left;">Shipping Cost = GHC <?php printf("%.2f", $total_shipping_cost); ?></span></td>
						<td colspan="2"><span style="font: 1.2em Tahoma; text-align: left;">Overall Cost  = GHC <?php printf("%.2f", $overAllCost + $total_shipping_cost); ?></span></td>
					</tr>
				</table>
				<?php 
					if (isset($_SESSION["logged_user_id"])) {
						$user_id = $_SESSION["logged_user_id"];
						$query = "SELECT members.first_name, members.last_name, members.phone_number, members.street_address FROM members WHERE id = $user_id ";
						$result = mysqli_query($connection, $query);
						if ($result) {
							$result_array = mysqli_fetch_assoc($result);
							$name = $result_array["first_name"] . " " . $result_array["last_name"];
							$pnumb = $result_array["phone_number"];
							$add = $result_array["street_address"];
						}
					}
				?>
				<form action ="process.php" method="post" class="form_details">
					<div id="ordererDetails">
						<span>Your Name</span><br />
						<input type="text" name="ordererName" id="name" class="form-field" placeholder="Name" value="<?php if(isset($name)){echo $name;} ?>"><br /><br />
						<span>Your Phone Number</span><br />
						<input type="text" name="ordererPhone1" class="form-field" id="phone1" placeholder="Phone Number" value="<?php if(isset($pnumb)){echo $pnumb;} ?>"><br /><br />
						<span>Repeat Phone Number</span><br />
						<input type="text" name="ordererPhone2" class="form-field" id="rphone" placeholder="Repeat Phone Number" value="<?php if(isset($pnumb)){echo $pnumb;} ?>"><br /><br />
						<span>Your Street Address</span><br />
						<input type="text" name="ordererAddress" id="address" class="form-field" style="height: 70px;" value="<?php if(isset($add)){echo $add;} ?>"><br />
						<span>eg. First Floor, Ministry of Defence Block, Peace Street.</span><br />
						<span>Or(Students) Great Hostel, Room 110B, Ground Floor.</span>
						<br /><br/>
						<!--Please Indicate Delivery Mode Appropriately<br />
						<div style="display: inline-block">
							<div style="float: left; margin: 10px;">
								<div style="padding: 1em; float: left">Delivery</div> 
								<div style="float: left;"><input type="radio" name="order_delivery_option" checked> </div>
							</div>
							<div style="float: left; margin: 10px;">
								<div style="padding: 1em; float: left"> Takeout</div> 
								<div style="float: left;"><input type="radio" name="order_delivery_option"></div>
							</div>
						</div> -->

						<br /><br />
						<span>Checkout Option</span><br/>


						<!-- display status -->
						<!-- end of pop out -->
					<div style="display: inline-block">
						<?php 
							if(!isset($_SESSION['logged_user_id'])){
								//not logged in cannot use oupon
								?>
									<div style="margin: 10px;">
										 
										<div style="text-align: center;">
											<a class="trigger_delivery" href="#">
												<span class="mpower_button">On Delivery</span>
											</a>
											<!--<input type="radio" name="order_checkout_option" checked> -->
											<nav>	
												<div class="cd-primary-nav">
													<div style="float:right; top:0; padding: 5px;margin-top: -10px;">
														<a href="#0" class="trigger_delivery"><img src="images/cancel.jpeg" alt="&times" style="height:50px; width:50px;"></a> 
													</div>
													<div class="cd-label" style="list-style: none; font: 1.5em Tahoma; color: white">Checkout Option</div>
					
														<span style="font:1.5em Tahoma; color:white">You will pay for the ordered items on delivery. Items once ordered cannot be cancelled!</span><br /><br />
														<span style="font:1.5em Tahoma; color:white">To enjoy coupons and price discounts, please <a href="../registrationpage/registration.php">Register</a> for an EarlyFood account.</span><br /><br />
														<span style="font:1.5em Tahoma; color:white">Simply Click The Red 'Place Order' Button To Order Your Food.</span><br /><br />
														<span style="font:1.5em Tahoma; color:white">Good Appetite!</span>
																		
												</div>
											</nav> 
										</div>
									</div>
									<div id="place_order">
										<br /><br /><br />
										<input type="submit" value="Place Order" name="placeOrder" id="check_order">
									</div>
									<script type="text/javascript">
										jQuery(document).ready(function() {
												  
										  $('#check_order').click(function($){
										  		a = document.getElementById('name').value;
										  		b = document.getElementById('phone1').value;
										  		c = document.getElementById('rphone').value;
										  		d = document.getElementById('address').value;
										  		if (a==='' ) {
										  			alert('Name is Required');
										  			return false;
										  		}else if(b===''){
										  			alert('Phone Number is Required');
										  			return false;
										  		}else if(c===''){
										  			alert('Phone Number is Required');
										  			return false;
										  		}else if(d===''){
										  			alert('Address is Required');
										  			return false;
										  		}else if(b!==c){
										  			alert('Phone Numbers Do Not Match ');
										  			return false;
										  		}else{
										  			return true;
										  		}
										  	
										  })
										});
									</script>
								<?php
							}elseif (isset($_SESSION['logged_user_id'])) {
								//user is logged in. present wallet check out option
								$id = $_SESSION['logged_user_id'];
								?>

									<div style="float: left; margin: 10px;">
										<div style="float: left;">
											<div id="targetRefresh">
												<?php 

													//use the sesion variable to control display
													isset($_SESSION['checkout_method']) ? $method_selected = $_SESSION['checkout_method']: $method_selected = null;
													if ($method_selected == "w") {
														//successfully padi via wallet
														echo "<span id=\"paid_notice\" class=\"wallet_button\" style=\"display:block;\">Paid</span>";
													}elseif($method_selected=="p"){
														//payment on delivery
														echo "<span id=\"paid_notice\" class=\"wallet_button\" style=\"display:block;\">To Be Paid On Delivery</span>";
													}else{
														//session could not be set
														//echo "nope";
													}
												?>
											</div>
											<a class="trigger" href="#" id="wallet_pay">
												<span class="mpower_button">Choose Option</span><span class="cd-menu-icon"></span>	
											</a>
											<div id="place_order">
												<br /><br />
												<input type="submit" value="Place Order" name="placeOrder" id="check_order" style="display:none">
											</div>
											<script type="text/javascript">
												jQuery(document).ready(function() {
												  
												  $('#check_order').click(function($){
												  		a = document.getElementById('name').value;
												  		b = document.getElementById('phone1').value;
												  		c = document.getElementById('rphone').value;
												  		d = document.getElementById('address').value;
												  		if (a==='' ) {
												  			alert('Name is Required');
												  			return false;
												  		}else if(b===''){
												  			alert('Phone Number is Required');
												  			return false;
												  		}else if(c===''){
												  			alert('Phone Number is Required');
												  			return false;
												  		}else if(d===''){
												  			alert('Address is Required');
												  			return false;
												  		}else if(b!==c){
												  			alert('Phone Numbers Do Not Match');
												  			return false;
												  		}else{
												  			return true;
												  		}
												  	
												  })
												});
											</script>
											<!--<input type="radio" name="order_checkout_option"></div> -->

											<nav>	
												<div class="cd-primary-nav" id="cd-primary-nav">
													<div style="float:right; top:0; padding: 5px;margin-top: -50px;">
														<a href="#0" class="trigger"><img src="images/cancel.jpeg" style="height:50px; width:50px;"></a> 
													</div>
													<div class="cd-label" style="list-style: none; font: 1.5em Tahoma; color: white">Choose Checkout Option</div>
					
														<?php include("walletCheckout/wallet.php"); ?>
														<br /><br />
														<?php include("walletCheckout/mpower.php"); ?>
																		
												</div>
											</nav>
										</div>
									</div>
									<input type="hidden" value="<?php echo $id; ?>" id="user_id" name="txtId">

								<?php
							}
						?>
						<!--<div id="place_order">
							<br /><br /><br /><br />
							<input type="submit" value="Place Order" name="placeOrder" id="check_order">
						</div> -->
					</div>
				</form>
			</article>
		</div>
	</section>
	<script type="text/javascript" src="walletCheckout/js/main.js"></script>
<script type="text/javascript" src="walletCheckout/js/modernizr.js"></script>
<?php include("../includes/layout/footer.php") ?>
<?php close_db(); ?>