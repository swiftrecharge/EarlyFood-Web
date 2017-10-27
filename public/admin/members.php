<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/members.css">
	<section>
		<div id="order_title" class="">
			<img class="main" src="images/logo.png" alt="" /><br /><span><em>Members</em></span>
		</div>
		<?php 
			//retrieve current orders
			$query = "SELECT * FROM members ";
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
										<span style="font: 1.5em Tahoma; text-align: center;"><?php echo $values["user_registrationdate"]; ?></span>

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
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Birth Date</span>
											
										</th>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Phone Number</span>
											
										</th>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Occupation</span>
											
										</th>
										<th>
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Email Status</span>
											
										</th>
										<th class="article1_shipping">
											
												<span style="font: 1.5em Tahoma; text-decoration: underline;">Text Status</span>
											
										</th>
									</tr>
									<tr>
										<td>
											<div id="article1_shipping_item">
												<span style="font: 1.0em Tahoma; "><?php echo $values['email_address']; ?></span>
											</div>
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma; "><?php echo $values['birth_date']; ?></span>
											
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma; "><?php echo $values['phone_number']; ?></span>
											
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma;"><?php echo $values['occupation']; ?></span>
											
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma;"><?php echo $values['email_notifs']; ?></span>
											
										</td>
										<td>
											
												<span style="font: 1.0em Tahoma;"><?php echo $values['text_notifs']; ?></span>
											
										</td>
									</tr>
									
								</table>
							</div>
							<div class="delivered">
								<form action="orders.php" method="post">
									<input type="submit" value="Remove User" name="mark_as_delivered" />
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