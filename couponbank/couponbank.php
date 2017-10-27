<?php require_once("../includes/classes/includes.php");?>
<?php 
	/*
		1. coupon serial number
		2. coupon code
		3. coupon value
		4. coupon expiry date
		5. coupon user
		6. coupon status
		7. total number of active coupons with associated monetary value
		8. total number of used coupons with associated monetary value

	*/
//testing
		//echo $coupon -> get_expiry_date();
		//if(date('Y-m-d')  "2017-03-21"){echo "yes";}else{echo "no";}
			echo date('d/m/Y h : i : s');
?>
<?php 
	
	if(isset($_POST["textGenerateCode"])){
		$couponCount = $_POST["textCount"];
		$couponValue = $_POST["textValue"];
		$coupon -> generateCoupon($couponValue, $couponCount);
	}

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/couponbank.css">
		<link rel="stylesheet" type="text/css" href="../includes/layout/css/bootstrap.min.css">
		<script type="text/javascript" src="../includes/layout/js/bootstrap.min.js"></script>
	</head>
	<body>
		<section class="col-md-3" id="panel">
			<span id="cSpan">Generate New Coupons</span><br />
			<form method="post" action="couponbank.php">
				<select name="textValue">
					<option selected>Value of Coupon(GHC)</option>
					<option>10</option>
					<option>15</option>
					<option>20</option>
					<option>30</option>
					<option>40</option>
					<option>50</option>
					<option>100</option>
				</select><br /><br />
				<select name="textCount">
					<option selected>Number of Coupons</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
					<option>20</option>
					<option>30</option>
					<option>40</option>
					<option>50</option>
					<option>100</option>
					<option>200</option>
					<option>300</option>
				</select><br /><br />
				<input type="submit" name="textGenerateCode" value="Generate Coupons">
			</form>
		</section>
		<section class="col-md-9" id="coupons">
			<table class="table table-condensed table-striped table-bordered">
								
				<center><span id="cSpan">Coupon Status</span></center><br />
				<form>
					<div>           
			          <input type = "radio"
			                 name = "couponDisplay"
			                 id = "all"
			                 value = "all"
			                 checked = "checked" />
			          <label for = "all">All Coupons</label>
			          <input type = "radio"
			                 name = "couponDisplay"
			                 id = "new"
			                 value = "new" />
			          <label for = "new">New Coupons</label>
			          <input type = "radio"
			                 name = "couponDisplay"
			                 id = "used"
			                 value = "used" />
			          <label for = "used">Used Coupons</label>
					</div>
				</form><br />
				<tr>
					<th>
						<div id="article1_shipping_item" class="shipping_items_header">
							<span>Coupon Serial Number</span>
						</div>
					</th>
					<th>
						<div id="article1_shipping_price" class="shipping_items_header">
							<span>Coupon Code</span>
						</div>
					</th>
					<th>
						<div id="article1_shipping_qty" class="shipping_items_header">
							<span>Coupon Value</span>
						</div>
					</th>
					<th>
						<div id="article1_shipping_totalPrice" class="shipping_items_header">
							<span>Coupon Expiry Date</span>
						</div>
					</th>
					<th>
						<div id="article1_shipping_item" class="shipping_items_header">
							<span>Coupon User</span>
						</div>
					</th>
					<th>
						<div id="article1_shipping_price" class="shipping_items_header">
							<span>Usage Status</span>
						</div>
					</th>
				</tr>
				<?php
					$result = $coupon -> get_all_coupons();

					while ($value = mysqli_fetch_assoc($result)) {
						

					?>

						<tr ALIGN="center">
							<td>
								<div id="article1_shipping_item" class="shipping_items">
									<span><?php echo $value['serial_number']; ?></span>
								</div>
							</td>
							<td>
								<div id="article1_shipping_price" class="shipping_items">
									<span><?php echo $value['coupon_code']; ?></span>
								</div>
							</td>
							<td>
								<div id="article1_shipping_qty" class="shipping_items">
									<span><?php printf("%.2f", $value['coupon_value']); ?></span>
								</div>
							</td>
							<td>
								<div id="article1_shipping_item" class="shipping_items">
									<span><?php echo $value['expiry_date']; ?></span>
								</div>
							</td>
							<td>
								<div id="article1_shipping_item" class="shipping_items">
									<span><?php echo ""; //$value['expiry_date']; ?></span>
								</div>
							</td>
							<td>
								<div id="article1_shipping_price" class="shipping_items">
									<span><?php echo $value['coupon_status']; ?></span>
								</div>
							</td>
						</tr>

				<?php
					}
				 ?>
				<tr>
					<td><span style="font: 1.2em Tahoma; text-align: left;">Total Number of Active Coupons <?php echo $coupon -> get_active_coupons(); ?></span></td>
					<td colspan="2"><span style="font: 1.2em Tahoma; text-align: left;">Monetary Value of Active Coupons <?php //echo $coupon -> get_monetary_value_of_active_coupons();  ?></span></td>
					<td><span style="font: 1.2em Tahoma; text-align: left;">Total Number of Used Coupons<?php $coupon -> get_used_coupons(); ?></span></td>
					<td colspan="2"><span style="font: 1.2em Tahoma; text-align: left;">Monetary value of used coupons<?php //printf("%.2f", $total_shipping_cost + $total_cost) ?></span></td>
				</tr>
			</table>
		</section>
	</body>
</html>