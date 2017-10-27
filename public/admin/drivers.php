<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/members.css">
	<section>
		<div id="order_title" class="">
			<img class="main" src="images/logo.png" alt="" /><br /><span><em>Drivers Application</em></span>
		</div>
		<?php 
			//retrieve current orders
			$query = "SELECT * FROM pros_driver ";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("No results coul be retrieved. " . mysqli_error($connection));
			}else{
				while ($values = mysqli_fetch_assoc($result)) { ?>
					<div class="row">
						<div class="orderer_details">
							<div class="date">
								<span class="green">
										<span style="font: 1.5em Tahoma; text-align: center; color: #ccc;">Date Registered<br /></span>
										<span style="font: 1.5em Tahoma; text-align: center;"><?php echo $values["date_registered"]; ?></span>

								</span>
							</div>
							<div class="details">
								<table border="0" width="100%" CELLSPACING="20" class="article1_shipping">
									<caption ALIGN="center"><span id="cSpan"><?php echo $values['first_name']. " ". $values['last_name'];?></span><br /></caption>
									<tr>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-align: center;">Email Address</span>
											
										</th>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Station Name</span>
											
										</th>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Personal Contact</span>
											
										</th>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Work Contact</span>
											
										</th>
									</tr>
									<tr>
										<td>
											<div id="article1_shipping_item">
												<span style="font: 1.0em Tahoma; "><?php echo $values['email_address']; ?></span>
											</div>
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma; "><?php echo $values['station_name']; ?></span>
											
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma; "><?php echo $values['home_contact']; ?></span>
											
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma;"><?php echo $values['work_contact']; ?></span>
											
										</td>
									</tr>
									
								</table>
							</div>
							<div class="delivered">
								<form action="orders.php" method="post">
									<input type="submit" value="Register Driver" name="mark_as_registered" /><br /><br />
									<input type="submit" value="Remove Application" name="mark_as_delivered" />
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