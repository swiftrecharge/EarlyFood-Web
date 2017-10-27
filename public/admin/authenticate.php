<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<?php 
	$reg_msg = "";
	$log_msg = "";
	if (isset($_SESSION["admin_logged_in"])) {
		redirect_to("index.php");
	}

	if (isset($_POST["txtLogin"])) {
		$txtEmail = trim($_POST["txtEmail"]);
		$txtPassword = trim($_POST["txtPassword"]);
		if (!validate_email($txtEmail)) {
			$log_msg = "Invalid Email Address";
		}elseif (strlen($txtPassword) < 4) {
			$log_msg = "Password must be atleast four(4) Characters.";
		}else{
			if (login_admin($txtEmail, $txtPassword)) {
				$_SESSION["admin_logged_in"] = $txtEmail;
				redirect_to("index.php");
			}else{
				if ($_SESSION["admin_pend_error"]!="") {
					$log_msg = $_SESSION["admin_pend_error"];
				}else{
					$log_msg = "Invalid Email or Password";
				}
			}
		}
		# code...
	}elseif (isset($_POST["txtRegister"])) {
		# code...
		$txtEmail = trim($_POST["txtREmail"]);
		$txtPassword = trim($_POST["txtRPassword"]); 
		$txtPasswordc = trim($_POST["txtRPasswordC"]);
		if (!validate_email($txtEmail)) {
			$reg_msg = "Invalid Email Address";
		}elseif (strlen($txtPassword) < 4 || strlen($txtPasswordc)<4) {
			$reg_msg = "Password must be atleast four(4) Characters.";
		}elseif ($txtPasswordc != $txtPassword) {
			$reg_msg = "Passwords do not match";
		}else{
			create_admin($txtEmail, $txtPassword, $txtPasswordc);
			$reg_msg = "Account Created Successfully. Will be active after six hours";
		}
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" title="style (screen)" />
		<style type="text/css">
			#switch{
				margin-top: 10px;
				text-align: center;
			}
			.overlay {
			    /* Height & width depends on how you want to reveal the overlay (see JS below) */   
			    height: 100%;
			    width: 100%;
			    position: fixed; /* Stay in place */
			    z-index: 1; /* Sit on top */
			    left: 0;
			    top: 0;
			    padding-bottom: 20px;
			    background-color: rgb(0,0,0); /* Black fallback color */
			    background-color: rgba(0,0,0, 0.9); /* Black w/opacity */
			    overflow-x: hidden; /* Disable horizontal scroll */
			    transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
			}
			@media screen and (max-height: 450px) {
			    .overlay a {font-size: 20px}
			}
			.overlay-content {
			    position: relative;
			    top: 5%; 
			    width: 100%; /* 100% width */
			    text-align: center; /* Centered text/links */
			    margin-top: 30px; /* 30px top margin to avoid conflict with the close button on smaller screens */
			}
			/* The navigation links inside the overlay */
			.overlay a {
			    padding: 8px;
			    text-decoration: none;
			    font-size: 20px;
			    color: #818181;
			    display: block; /* Display block instead of inline */
			    transition: 0.3s; /* Transition effects on hover (color) */
			}
			.my_account{
				display: none;
				font: 1.2em Tahoma;
				color: white;
				padding: 2em;
			}
			/* When you mouse over the navigation links, change their color */
			.overlay a:hover, .overlay a:focus {
			    color: #f1f1f1;
			}
			#myNav input {
				text-align: center;
				font: 1.5em Tahoma;
				height: 50px;
				width: 80%;
			}
			#myNav .input-fields input {
				text-align: center;
				font: 1.5em Tahoma;
				border-radius: 15px;
				padding: 10px 20px;
				background-color: rgba(255, 255, 255, 0.5);
				border: 1px solid rgba(255, 255, 255, 0.3);
				color:white;
				-webkit-box-shadow: none !important;
				-moz-box-shadow: none !important;
				box-shadow: none !important;
			}
			.form-fields{
				width: 70%;
				margin: auto;
			}
			.submit-btn-input{
				margin: 0 auto;
				display: block;
				text-align: center;
				width: 30%;
				margin-left: 38%;
			}
			@media (max-width: 500px) {
				.form-fields{
					width: 100%;
					margin: auto;
				}
				#myNav input {
					height: 50px;
					width: 100%;
				}
				.submit-btn-input{
					margin: 0 auto;
					display: block;
					text-align: center;
					width: 90%;
					margin-left: 5%;
				}
			}
		</style>
	</head>
	<body>
		<section class="overlay" id="myNav">

			<div class="overlay-content">
				<article id = "return_new_login_register">
					<center><?php echo $log_msg; ?></center><br /><br />
					<div class = "row form-fields">
						<form method="post" action="authenticate.php" id="login">
							<div class="col-md-6 col-sm-6 col-xs-12 form-group input-fields">
								<input type="text" name="txtEmail" id="txtEmail" placeholder="Type Email Address" /><br /><br /><br />
							</div>
							
							<div class="col-md-6 col-sm-6 col-xs-12 form-group input-fields">
								<input type="password" name="txtPassword" id="txtPassword" placeholder="Type Password" /><br /><br />
							</div>
							<div class="submit-btn-input">
								<input type="submit" name="txtLogin" value="Login" class="btn btn-submit btn-block btn-i-sm uppercase txt-sm" data-loading-text="Loading..." id="login_user">
							</div>
						</form>
					</div>
					<br /><h1>Or</h1><br /><br />
					<div class = "row form-fields">
						<center><?php echo $reg_msg; ?></center><br /><br />
						<form method="post" action="authenticate.php" id="register">
							<div class="form-group input-fields">
								<input type="text" name="txtREmail" id="txtEmailRegister" placeholder="Type Email Address"><br /><br /><br />
							</div>
							<div class="form-group input-fields">
								<input type="password" name="txtRPassword" id="txtPasswordRegister" placeholder="Type Password"><br /><br /><br />
							<div class="form-group input-fields">
								<input type="password" name="txtRPasswordC" id="txtPasswordc" placeholder="Confirm Password"><br /><br />
							</div>
							<div class="submit-btn-input">
								<input type="submit" name="txtRegister" id="register_user" value="Register" class="btn btn-submit btn-block btn-i-sm uppercase txt-sm" data-loading-text="Loading...">
							</div>
						</form>
					</div><br /><br />
				</article>
				<!--<article class="my_account" id="load_account">
					Welcome to your account...<br /><br /><br />
					<div id="update_details" style="color:black">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 class="panel-title">
										<a href="#address" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Buy Credit</a>
									</h1>
								</div>
								<div class="panel-collapse collapse" id="address">
									<div class="panel_body">
										<!-load all available meters here for selection to buy credit->

										<br />
										<div id="meters_span">
											<span>Click on meter to purchase credit for that meter</span><br /><br/>
											
										</div><br /><br />
										<span id="amount_span">
											<select name="txtAmount" id="txtAmount">
												<option selected>Select Amount(GHS)</option>
												<?php 
													for ($i=5; $i < 200; $i+=5) { 
														echo "<option>".$i."</option>";
													}
												?>
											</select>
											<button id="purchase_credit">Purchase</button>
										</span>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 class="panel-title">
										<a href="#occupation" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Add Meter</a>
									</h1>
								</div>
								<div class="panel-collapse collapse" id="occupation">
									<div class="panel_body">
										<br />
										<center>
											
												<input type="text" id="txtMeterNumber" maxlength="30" placeholder="Type Meter Number" /><br /><br />
												<input type="text" id="txtMeterNumberC" maxlength="30" placeholder="Confirm Meter Number" /><br /><br />
												<input type="submit" value="Add" class="btn btn-submit btn-block btn-i-sm" id="add_meter" />
											
										</center>
										<br />
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 class="panel-title">
										<a href="#transaction" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">View Transactions History</a>
									</h1>
								</div>
								<div class="panel-collapse collapse" id="transaction">
									<div class="panel_body">
										<br />
										You haven't undertaken any transactions yet...
										<br />
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 class="panel-title">
										<a href="#notifs" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Visualize Power Consumption</a>
									</h1>
								</div>
								<div class="panel-collapse collapse" id="notifs">
									<div class="panel_body">
										<span class="sub-title-top">Credit Consumption By Meter</span><br /><br /><br />
										<canvas id="myChart" width="100%" height="400"></canvas>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 class="panel-title">
										<a href="#mail" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Update Email Address</a>
									</h1>
								</div>
								<div class="panel-collapse collapse" id="mail">
									<div class="panel_body">
										<br />
											<span>
												<input type="text" placeholder="Current Email Aaddress" id="txtOEmail"/><br /><br />
												<input type="text" placeholder="New Email Address" id="txtNEmail"/><br /><br />
												<input type="text" placeholder="Confirm New Email Address" id="txtCEmail"/><br /><br />
											</span>
											<button class="btn btn-submit btn-block btn-i-sm" id="btnUpdateEmail">Update</button>
										<br />
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 class="panel-title">
										<a href="#password" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse"> Update Password</a>
									</h1>
								</div>
								<div class="panel-collapse collapse" id="password">
									<div class="panel_body">
										<br />
									
											<span>
												<input type="password" id="txtOPassword" placeholder="Current Password" /><br /><br />
												<input type="password" id="txtNPassword" placeholder="New Password"/><br /><br />
												<input type="password" id="txtCPassword" placeholder="Confrim New Password"/><br /><br />
											</span>
											<button class="btn btn-submit btn-block btn-i-sm" id="btnUpdatePassword">Update</button>
										
										<br />
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 class="panel-title">
										<a href="#phone_number" class="accordion-toggle"  data-parent="#accordion" data-toggle="collapse">Update Phone Number</a>
									</h1>
								</div>
								<div class="panel-collapse collapse" id="phone_number">
									<div class="panel_body">
										<br />
										<form action="#0" method="post">
											<span>
												<input type="text" name="phone" id = "phone" /><br /><br />
												<input type="text" name="phone" id = "phone" /><br /><br />
											</span>
											<button class="btn btn-submit btn-block btn-i-sm">Update</button>
										</form>
										<br />
									</div>
								</div>
							</div>
						</div>
					</div>
				</article> -->
			</div>
		</section>
	</body>
</html>