<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/orders.css">
	<section>
		<div id="order_title" class="">
			<img class="main" src="images/logo.png" alt="" /><br /><span><em>CURRENT ORDERS</em></span>
		</div>
		<?php 
			//retrieve current orders
			$query = "SELECT * FROM orders, menu, restaurant, members WHERE orders.delivered = 0 AND orders.menu_id = menu.id AND orders.restaurant_id = restaurant.id AND orders.user_id = members.id ORDER BY orders.order_time DESC";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("No result could be retrieved. " . mysqli_error($connection));
			}else{
				while ($values = mysqli_fetch_assoc($result)) { ?>
					<div class="row">
						<div class="orderer_details">
							<div class="date">
								<span class="green">
										<span style="font: 1.5em Tahoma; text-align: center; color: white;">Order Time<br /></span>
										<span style="font: 1.5em Tahoma; text-align: center;"><?php echo $values["order_time"]; ?></span>

								</span>
							</div>
							<div class="details">
								<table border="5" width="100%" CELLSPACING="20" class="article1_shipping">
									<caption ALIGN="center"><span id="cSpan"><?php echo $values['first_name']. " ". $values['last_name'];?></span><br /></caption>
									<tr>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-align: center;">Food Item</span>
											
										</th>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Price/Item(GHC)</span>
											
										</th>
										<th>
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Quantity</span>
											
										</th>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Total Cost</span>
											
										</th>
									</tr>
									<tr>
										<td>
											<div id="article1_shipping_item">
												<span style="font: 1.0em Tahoma; "><?php echo $values['food_item']; ?></span>
											</div>
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma; "><?php echo $values['price']; ?></span>
											
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma; "><?php echo $values['qty_ordered']; ?></span>
											
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma;"><?php echo $values['total_cost']; ?></span>
											
										</td>
									</tr>
									<tr >
										<td colspan="4" style="border: 0px;"><hr></td>
									</tr>
									<tr>
										<th class="article1_shipping"><span style="font: 1.5em Tahoma; text-align: center;">Restaurant</span></th>
										<th class="article1_shipping" colspan="2"><span style="font: 1.5em Tahoma; text-align: center;">Address</span></th>
										<th class="article1_shipping"><span style="font: 1.5em Tahoma; text-align: center;">Phone Number</span></th>
									</tr>
									<tr>
										<td><?php echo $values['restaurant_name']; ?></td>
										<td colspan="2"><?php echo $values['orderer_address']; ?></td>
										<td><?php echo $values['orderer_phone']; ?></td>
									</tr>
								</table>
							</div>
							<div class="delivered">
								<form action="index.php?ordersPage=orders" method="post">
									<input type="submit" value="Delivered?" name="mark_as_delivered"/>
									<input type="hidden" value="<?php echo $values['user_id']; ?>" name="txtuser_id" />
									<input type="hidden" value="<?php echo $values['restaurant_id']; ?> " name="txtrestaurant_id" />
									<!--<input type="hidden" value=""/> -->
									<input type="hidden" value="<?php echo $values['orderer_phone']; ?> " name="txtorder_phone" />
									<input type="hidden" value="<?php echo $values['order_time']; ?> " name="txtorder_time" />
								</form>
							</div>
						</div>
					</div>
					<?php
				}
			}

		?>

		<!-- this takes care of the non-acccount holders -->
		<?php 
			//retrieve current orders
			$query = "SELECT * FROM orders, menu, restaurant WHERE orders.delivered = 0 AND orders.menu_id = menu.id AND orders.restaurant_id = restaurant.id AND orders.user_id = 0 ORDER BY orders.order_time DESC";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("No result could be retrieved. " . mysqli_error($connection));
			}else{
				while ($values = mysqli_fetch_assoc($result)) { ?>
					<div class="row">
						<div class="orderer_details">
							<div class="date">
								<span class="green">
										<span style="font: 1.5em Tahoma; text-align: center; color: white;">Order Time<br /></span>
										<span style="font: 1.5em Tahoma; text-align: center;"><?php echo $values["order_time"]; ?></span>

								</span>
							</div>
							<div class="details">
								<table border="5" width="100%" CELLSPACING="20" class="article1_shipping">
									<caption ALIGN="center"><span id="cSpan"><?php echo $values['orderer_name'];?></span><br /></caption>
									<tr>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-align: center;">Food Item</span>
											
										</th>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Price/Item(GHC)</span>
											
										</th>
										<th>
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Quantity</span>
											
										</th>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Total Cost</span>
											
										</th>
									</tr>
									<tr>
										<td>
											<div id="article1_shipping_item">
												<span style="font: 1.0em Tahoma; "><?php echo $values['food_item']; ?></span>
											</div>
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma; "><?php echo $values['price']; ?></span>
											
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma; "><?php echo $values['qty_ordered']; ?></span>
											
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma;"><?php echo $values['total_cost']; ?></span>
											
										</td>
									</tr>
									<tr >
										<td colspan="4" style="border: 0px;"><hr></td>
									</tr>
									<tr>
										<th class="article1_shipping"><span style="font: 1.5em Tahoma; text-align: center;">Restaurant</span></th>
										<th class="article1_shipping" colspan="2"><span style="font: 1.5em Tahoma; text-align: center;">Address</span></th>
										<th class="article1_shipping"><span style="font: 1.5em Tahoma; text-align: center;">Phone Number</span></th>
									</tr>
									<tr>
										<td><?php echo $values['restaurant_name']; ?></td>
										<td colspan="2"><?php echo $values['orderer_address']; ?></td>
										<td><?php echo $values['orderer_phone']; ?></td>
									</tr>
								</table>
							</div>
							<div class="delivered">
								<form action="index.php?ordersPage=orders" method="post">
									<input type="submit" value="Delivered?" name="mark_as_delivered"/>
									<input type="hidden" value="<?php echo $values['user_id']; ?>" name="txtuser_id" />
									<input type="hidden" value="<?php echo $values['restaurant_id']; ?> " name="txtrestaurant_id" />
									<!--<input type="hidden" value=""/> -->
									<input type="hidden" value="<?php echo $values['order_time']; ?> " name="txtorder_time" />
									<input type="hidden" value="<?php echo $values['orderer_phone']; ?> " name="txtorder_phone" />
		
								</form>
							</div>
						</div>
					</div>
					<?php
				}
			}

		?>


	</section>
</div>
</div>
</body>
</div><!-- this closes the container -->

</html>
<?php
	
	if (isset($_POST["mark_as_delivered"])) {
		#update the delivery status
		$user_id  = $_POST["txtuser_id"];
		$restaurant_id = $_POST["txtrestaurant_id"];
		$orderer_phone= $_POST["txtorder_phone"];
		$order_time = $_POST["txtorder_time"];
		//die($orderer_phone);
		#echo $user_id . "<br />";
		#echo $restaurant_id."<br />";
		#echo $order_time."<br />";
		delivered($user_id, $restaurant_id, $orderer_phone, $order_time);
			
		echo "<meta http-equiv='refresh' content='0'>";

	}

?>
<?php close_db(); ?>