<?php session_start();  ?>
<?php require_once("login.process.php"); ?>
<?php include("../includes/layout/header.php"); //header file ?>
<script type="text/javascript" src=""></script>
<link rel="stylesheet" type="text/css" href="css/loginpage.css">
		<section id="login_section" class="row">
			<article id="article1_login" class="col-lg-4 col-md-4 col-sm-4">
				<span>Account Benefits</span><br><br>
						<ul>
							<li>Save Your Address For Easy Ordering</li><br>
							<li>Easily Reorder Your Previous Order</li><br>
							<li>Get Access To Coupon Codes</li><br>
						</ul>
						<div id="article1_login_createAccount">
							<a href="../registrationpage/registration.php">Create an Account</a>
						</div>
			</article>
			<article id="article2_login" class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-sm-7 col-sm-offset-1">
				<span>Log In</span><br><br><br>
				<form action="login.php" method="post">
					<div id="email_box">
						<h4>Email</h4>
						<input id="email_box1" type="text" name="txtEmail" placeholder="Please Enter Your Email" value="<?php /*if (isset($login -> UserMail)) */ { echo $login -> userMail; } ?>">
						<?php
							$error_mail = isset($login -> Email) ? $login -> Email : null;
							$asterics = isset($error_mail) ? "<span style=\"color: red\">*</span>" : null;
							echo $asterics . $error_mail; 
						?><br>
					</div>
					<div id="password_box">
						<h4>Password</h4>
						<input id="password_box1" type="password" name="txtPassword" placeholder="Please Enter Password">
						<?php 
							$error_pass = isset($login -> Password) ? $login -> Password : null;
							$asterics = isset($error_pass) ? "<span style=\"color: red\">*</span>" : null;
							echo  $asterics . $error_pass;
						?>
					</div>
					<input type="submit" name="postLogin" value="Login" id="login_button"><br />
					<!-- dont think it is a good thing to do <input type="checkbox" name="keepmelogged_in" checked> <span style="font: 1em Tahoma;">Keep Me Logged In</span> -->
				</form>
				<div id="hepage">
					<?php //password_reset.php ?>
					<a href="reset.php">Having Trouble Logging In?</a> 
				</div>
			</article>
		</section>
<?php include("../includes/layout/footer.php"); //header file ?>
<?php $database -> close_db(); ?>