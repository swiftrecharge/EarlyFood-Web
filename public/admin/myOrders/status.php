<?php ob_start(); ?>
<?php session_start();  ?>
<?php require_once("../../../includes/redirect.php") ?>
<?php require_once("../../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<?php 
	$id = $_SESSION["get_id_details"];
	!isset($id) ? redirect_to("index.php") : true;
	$query = "SELECT restaurant.restaurant_name FROM restaurant WHERE restaurant.id = $id";
	$result = mysqli_query($connection, $query);
	$rest_name = mysqli_fetch_assoc($result)["restaurant_name"];

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../../../includes/layout/css/bootstrap.min.css">

		<style type="text/css">
			*{
				margin: 0px
			}
			body{
				font-size: bolder;
				width: 100%;
				height: 100%;
				margin: auto;
				color: white;
				background-color: black;
				opacity: 0.9;
				text-align: center;
			}
			body span.top{
				font: 2em Tahoma;
				background-color: red;
				margin: auto;
				padding: 0.5em;
				color: white;
			}
			body input.textInput{
				padding: 0.5em;
				border: 2px solid black;
				font: 1.2em Tahoma;
				text-align: center;
				width: 350px;
			}
			body input.submitInput{
				color: white;
				padding: 0.5em;
				background-color: red;
				margin-top: 10px;
				font: 1.2em Tahoma;

			}

			th.article1_shipping{
				text-align: center;
			}

			td{
				text-align: center;
			}
			@media only screen  and (max-width: 769px){
				body span.top{
					font: 1em Tahoma;
					background-color: red;
					margin: auto;
					color: white;
				}

				th.article1_shipping {
					font: 0.5em Tahoma;
				}

				td {
					font: 1em Tahoma;
				}

				body input.textInput{
					padding: 0.5em;
					border: 2px solid black;
					font: 1.2em Tahoma;
					text-align: center;
					width: auto;
				}
			}
			body select{
				font: 1.5em Tahoma;
			}
			#cSpan{
				text-align: center;
				font: 2em Tahoma;
				color: white;
			}
		</style>
		<title>liteFood | <?php echo $rest_name; ?></title>
		<link rel='shortcut icon' type='image/x-icon' href="../../../includes/layout/images/favicon.png" />

	</head>	
	<body>
		<span class="top"><?php echo $rest_name; ?> Current  Orders</span><br /><br />
		
		<section class="container">
		<!--<div id="order_title" class="">
			<img class="main" src="images/logo.png" alt="" /><br /><span><em>CURRENT ORDERS</em></span>
		</div> -->
		<?php 
			//retrieve current orders
			$query = "SELECT * FROM orders, menu, restaurant, members WHERE orders.delivered = 0 AND orders.menu_id = menu.id AND orders.restaurant_id = restaurant.id AND orders.user_id = members.id AND orders.restaurant_id = $id ORDER BY orders.order_time DESC";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("No result could be retrieved. " . mysqli_error($connection));
			}elseif(mysqli_num_rows($result)==0){
				echo "You have no current orders";
			}else{
				while ($values = mysqli_fetch_assoc($result)) { ?>
				<hr>
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
										<th class="article1_shipping">
											
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
								<form action="status.php" method="post">
									<input type="submit" value="Delivered?" name="mark_as_delivered" style="background-color: red"/>
									<input type="hidden" value="<?php echo $values['user_id']; ?>" name="txtuser_id" />
									<input type="hidden" value="<?php echo $values['restaurant_id']; ?> " name="txtrestaurant_id" />
									<!--<input type="hidden" value=""/> -->
									<input type="hidden" value="<?php echo $values['order_time']; ?> " name="txtorder_time" />
								</form>
							</div>
						</div>
					</div>
					<hr>
					<?php
				}
			}

		?>
	</section>
	</body>
	<script type="text/javascript" href="../../../includes/layout/js/bootstrap.min.js"></script>
</html>
<?php
	
	if (isset($_POST["mark_as_delivered"])) {
		#update the delivery status
		$user_id  = $_POST["txtuser_id"];
		$restaurant_id = $_POST["txtrestaurant_id"];
		$order_time = $_POST["txtorder_time"];
		#echo $user_id . "<br />";
		#echo $restaurant_id."<br />";
		#echo $order_time."<br />";
		delivered($user_id, $restaurant_id, $order_time);
			
		echo "<meta http-equiv='refresh' content='0'>";

	}

?>
<?php ob_flush(); ?>
<?php close_db(); ?>