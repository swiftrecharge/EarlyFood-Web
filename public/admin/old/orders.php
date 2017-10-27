<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php require_once("panel.php"); ?>
<?php connect_to_db(); ?>
<div class="col-lg-9 col-md-9 col-sm-9" >
	<section>
		<div id="order_title" class="jumbotron">
			<a href="#"><img class="main" src="images/logo.png" alt="" /></a><span><em>CURRENT ORDERS</em></span>
		</div>
		<?php 
			//retrieve current orders
			$query = "SELECT * FROM orders, menu, restaurant, members WHERE orders.delivered = 0 AND orders.menu_id = menu.id AND orders.restaurant_id = restaurant.id AND orders.user_id = members.id ORDER BY orders.order_time DESC";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("No results coul be retrieved. " . mysqli_error($connection));
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
										<td class="article1_shipping">
											
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
									<tr>
										<th class="article1_shipping"><span style="font: 1.5em Tahoma; text-align: center;">Restaurant</span></th>
										<th class="article1_shipping" colspan="2"><span style="font: 1.5em Tahoma; text-align: center;">Addrress</span></th>
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
								<form action="orders.php" method="post">
									<input type="submit" value="Delivered ?" name="mark_as_delivered" />
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
<?php close_db(); ?>