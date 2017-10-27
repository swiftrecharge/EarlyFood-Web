<?php include("../../includes/layout/header.php"); //header file ?>

<!-- useful links   -->

<script type="text/javascript" src=""></script>
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
												$format = "$" .  $i .".00";
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
									<h4>Message To Aappear On The Gift Certificate</h4>
									<textarea name="txtMmessage"></textarea>
								</div>
							</div><br /><br />
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
							<div class="">
								<h3>Select Form Of Payment</h3><br />
								<select name="txtPayment">
									<option>MTN Mobile Money</option>
									<option>Glo Mobile Money</option>
									<option>AIRTEL Money</option>
									<option>Vodafone Cash</option>
									<option>Tigo Cash</option>
									<option>Credit Card</option>
								</select>
							</div><br />
						<input type="submit" name="postPurchase" value="Purchase Gift Certificate" style="background-color: red; color: white; width: auto;">
					</form>
				</div>
		</div><br /><br />
		<div id="location">
			A gift certificate is the perfect present for friends, family, or co-workers
			Upon purchase, the recipient will be able to enter the gift certificate's code during checkout & enjoy!<br />
			<i style="color: red">Can I use the gift certificate more than once?</i><br />
			Of course! You will be able to use your gift certificate as many times as you would like until there is no remaining credit.
			<i style="color: red">How can I send the gift certificate?</i> <br />
			You can choose to send the gift certificate in an email, or print it off to give out later!<br />
			If you have any questions, please contact us.
		</div>
	</article>
</section>

<?php include("../../includes/layout/footer.php");  //footer file ?>