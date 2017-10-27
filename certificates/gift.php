<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("../includes/layout/header.php"); //header file ?>

<!-- useful links   -->

<script type="text/javascript" src="js/gift.js"></script>
<link rel="stylesheet" type="text/css" href="css/gift.css" />

<section class="row">
	<article class="decscriptive_text row" id="article2">
		<div id="comment">
			<div id="comment_sub">
				<h2>Purchase a Gift Certificate</h2>
					<form method="post" action="">
						<h3>Your Information</h3><br />
						<div class="row">
							<div class="col-md-4">
								<label>First Name</label><br />
								<input type="text" name="txtFname">
							</div>
							<div class="col-md-4">
								<label>Last Name</label><br />
								<input type="text" name="txtEmal">
							</div>
							<div class="col-md-4">
								<label>Email Address</label><br />
								<input type="text" name="txtEmail">
							</div>
						</div><br />
						<h3>Recipient's Information</h3><br />
						<div class="row">
							<div class="col-md-4">
								<label>First Name</label><br />
								<input type="text" name="txtRFname">
							</div>
							<div class="col-md-4">
								<label>Last Name</label><br />
								<input type="text" name="txtRLname">
							</div>
							<div class="col-md-4">
								<label>Email Address</label><br />
								<input type="text" name="txtREmail">
							</div>
						</div><br/>
						<h3>Certificate Information</h3><br />
						<div class="row">
							<div class="col-md-4">
								<label>Amount</label><br />
								<select name="txtAmount">
									<?php 
										for ($i=10; $i <101 ; $i+=10) {
												$format = "GHS" .  $i .".00";
											echo "<option>$format</option>";
										}
									?>
								</select>
							</div>
							<div class="col-md-8">
								<label>How Do You Want The Certificate Delivered?</label><br />
								<select>
									<option>By Email</option>
									<option>By Post</option>
									<option>Personal</option>
								</select>
							</div>
						</div><br /><br />
							<div class="">
								<div>
									<h4>Message To Appear On The Gift Certificate</h4>
									<textarea name="txtMmessage"></textarea>
								</div>
							</div><br /><br />
							<div class="" id="payment">
								<h3>Form Of Payment <span class="glyphicon glyphicon-hand-down"></span></h3><br />
								<select name="txtPayment" id="">
									<option class="none" selected>Select</option>
									<option class = "mobile">MTN Mobile Money</option>
									<option class = "mobile">Glo Mobile Money</option>
									<option class = "mobile">AIRTEL Money</option>
									<option class = "mobile">Vodafone Cash</option>
									<option class = "mobile">Tigo Cash</option>
									<option class = "card">Credit Card</option>
								</select>
							</div><br />

							<div id="mode_payment">
								<div id="mobile_payment">
									<label id="label_1">Mobile Money Number</label><br />
									<input id="mobile_number" type="text" name="txtMobile" /><br /><br />
									<!--<label id="label_2">Mobile Money Pin</label><br />
									<input id="pin" type="password" name="txtPin" /><br /> -->
								</div><br /><br />
								<div id="credit_card">

									<h3>Payment Information</h3><br />
									<div class="row">
										<div class="col-md-4">
											<label>First Name</label><br />
											<input type="text" name="txtPFname">
										</div>
										<div class="col-md-4">
											<label>Last Name</label><br />
											<input type="text" name="txtPLname">
										</div>
										<div class="col-md-4">
											<label>Address</label><br />
											<input type="text" name="txtAddress">
										</div>
									</div><br /><br />
									<div class="row">
										<div class="col-md-6">
											<label>Card Number</label><br />
											<input type="text" name="txtCardNumber">
										</div>
										<div class="col-md-2">
											<label>Expiry Month</label><br />
											<select name="txtExpiryMonth">
												<option>-</option>
												<?php 
													for ($i=1; $i <=12 ; $i++) { 
														if ($i<10) {
															echo "<option>0$i</option>";
														}else{
															echo "<option>$i</option>";
														}
													}
												?>
											</select>
										</div>
										<div class="col-md-2">
											<label>Expiry Year</label><br />
											<select name="txtExpiryYear">
												<option>-</option>
												<?php 
													for ($i=2017; $i <=2030 ; $i++) { 
														echo "<option>$i</option>";
													}
												?>
											</select>
										</div>
										<div class="col-md-2">
											<label>CVV</label><br />
											<input type="password" name="txtCvv" />
										</div>
									</div>
									<br /><br />

								</div>
							</div>
						<div id="command">
							<input type="submit" name="postPurchase" value="Purchase Gift Certificate" style="background-color: red; color: white; width: auto;">
						</div>
					</form>
				</div>
		</div><br /><br />
		<div id="location">
			A gift certificate is the perfect present for friends, family, or co-workers
			Upon purchase, the recipient will be able to enter the gift certificate's code during checkout & enjoy!<br />
			<i style="color: red">Can I use the gift certificate more than once?</i><br />
			Of course! You will be able to use your gift certificate as many times as you would like until there is no remaining credit.<br />
			<i style="color: red">How can I send the gift certificate?</i> <br />
			You can choose to send the gift certificate in an email, or print it off to give out later!<br />
			If you have any questions, please contact us.
		</div>
	</article>
</section>

<?php include("../includes/layout/footer.php");  //footer file ?>