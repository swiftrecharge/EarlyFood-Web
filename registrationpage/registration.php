<?php session_start(); ?>
<?php require_once("registration.process.php"); ?>
<?php include("../includes/layout/header.php"); //header file ?>

<link rel="stylesheet" type="text/css" href="css/registrationpage.css">
<script type="text/javascript" src="js/registration.js"></script>
<?php 

	if (isset($_SESSION["p_transfer"])) {
		echo "<br />";
		echo "<div id=\"prompt\" class=\"row\"><center>Hi " .ucfirst($_SESSION["n_transfer"]). ", You May Please Create An Account To View Your Delivery Status.</center></div>";
	}
?>	
<section id="registration_section" class="row">
		<article id="article2_register" class="col-lg-3 col-md-3 col-sm-3 col-lg-push-8 col-md-push-8 col-sm-push-9 col-lg-offset-1 col-md-offset-1">
			<span>Account Benefits</span>
			<ul>
				<li>Save Your Address For Easy Ordering</li><br>
				<li>Easily Reorder Your Previous Order</li><br>
				<li>Get Access To Coupon Codes</li><br>
			</ul>
		</article>

		<article id="article1_register" class="col-lg-7 col-md-7 col-sm-8 col-lg-pull-3 col-md-pull-3 col-sm-pull 3">
		<span id="cSpan">Create An Account</span>
			<div id="form_all" class="">
				<form action ="registration.php" method="post">
					<div class="regForm row">
						<div id="email" class="col-lg-6 col-md-6 col-sm-6">
							<span>Email</span><br />
							<input tpye="text" name="txtEmail" value="<?php if(isset($registration -> Email)){echo $registration -> Email;}  ?>" onkeydown="hide_text();"><br />
							<span><?php 
									if (isset($registration -> mail)){ ?>
									<span class="errors_em"><?php echo "<span style=\"color: red\">*</span>". $registration -> mail; ?></span>
								<?php 
									}
								?>
							</span>
						</div>
						<div id="pass" class="col-lg-6 col-md-6 col-sm-6">
							<span>Password<br></span>
							<input type="password" name="txtPassword" value="" onkeydown="hide_text();"><br />
							<span><?php 
									if (isset($registration -> pass)){ ?>
									<span class="errors_em"><?php echo "<span style=\"color: red\">*</span>". $registration -> pass; ?></span>
								<?php 
									}
								?>
							</span>
						</div>
					</div>
					<div class="regForm row">
						<div id="fName" class="col-lg-6 col-md-6 col-sm-6">
							<span>First Name<br></span>
							<input type="text" name="txtFname" value="<?php if(isset($registration -> Fname)){echo $registration -> Fname;}elseif(isset($_SESSION["n_transfer"])){echo $_SESSION["n_transfer"];} ?>" onkeydown="hide_text();"><br />
							<span><?php 
									if (isset($registration -> min_max)){ ?>
									<span class="errors_em"><?php echo "<span style=\"color: red\">*</span>". $registration -> min_max; ?></span>
								<?php 
									}
								?>
							</span>
						</div>
						<div id="lName" class="col-lg-6 col-md-6 col-sm-6">
							<span>Last Name</span><br>
							<input type="text" name="txtLname" value="<?php if(isset($registration -> Lname)){echo $registration -> Lname;}  ?>" onkeydown="hide_text();"><br />
							<span><?php 
									if (isset($registration -> min_max)){ ?>
									<span class="errors_em"><?php echo "<span style=\"color: red\">*</span>". $registration -> min_max; ?></span>
								<?php 
									}
								?>
							</span>
						</div>
					</div>
					<div class="regForm row">
						<div id="pNumber" class="col-lg-6 col-md-6 col-sm-6">
							<span>Phone Number</span><br>
							<input type="text" name="txtPhone" id="phone" value="<?php if(isset($registration -> Phone)){echo $registration -> Phone;}elseif(isset($_SESSION["p_transfer"])){echo $_SESSION["p_transfer"];} ?>" onchange="phoneDigits();" onkeyup = "digitsNumerals();" onkeydown="hide_text();"><br />
							<span><?php 
									if (isset($registration -> min_max)){ ?>
									<span class="errors_em"><?php echo "<span style=\"color: red\">*</span>". $registration -> min_max; ?></span>
								<?php 
									}
								?>
							</span>
						</div>
						<div id="comp" class="col-lg-6 col-md-6 col-sm-6">
							<span>Occupation</span><br>
							<input type="text" name="txtOccupation" value="<?php if(isset($registration -> Occupation)){echo $registration -> Occupation;} ?>" onkeydown="hide_text();"><br />
							<span><?php 
									if (isset($registration -> min_max)){ ?>
									<span class="errors_em"><?php echo "<span style=\"color: red\">*</span>". $registration -> min_max; ?></span>
								<?php 
									}
								?>
							</span>
						</div>
					</div>
					<div class="regForm row">
						<div id="bDay" class="col-lg-6 col-md-6 col-sm-6">
							<span>Birthday</span><br>
						<select name="txtDay" onchange="hide_text();">
							<?php 
								for ($i=0; $i<=31 ; $i++) { ?>
								<?php 
									if($i===0){
										$day = "Day";
										echo "<option selection=\"select\"> {$day} </option>";
									}else{
										echo "<option> $i </option>";
									}
								?>
							<?php
								}
							?>
						</select>
						<select name ="txtMonth" onchange="hide_text();">
							<option>Month</option>
							<option>January</option>
							<option>February</option>
							<option>March</option>
							<option>April</option>
							<option>May</option>
							<option>June</option>
							<option>July</option>
							<option>August</option>
							<option>September</option>
							<option>October</option>
							<option>November</option>
							<option>December</option>
						</select>
						<select name="txtYear" onchange="hide_text();">
							<?php 
								for ($i=2011; $i>1945 ; $i--) { ?>
								<?php 
									if($i===2011){
										$year = "Year";
										echo "<option selection=\"select\"> {$year} </option>";
									}else{
										echo "<option> $i </option>";
									}
								?>
							<?php
								}
							?>
						</select><br />
						<span><?php 
								if (isset($registration -> birthday)){ ?>
								<span class="errors_em"><?php echo "<span style=\"color: red\">*</span>". $registration -> birthday; ?></span>
							<?php 
								}
							?>
						</span>
						</div>
						<div id="aboutU" class="col-lg-6 col-md-6 col-sm-6">
							<span>How did you hear about us?</span><br />
							<select name = "txtReferer" onchange="hide_text();">
								<option>Select</option>
								<option>Social Media</option>
								<option>Friend</option>
								<option>Restaurant</option>
								<option>Search Engine</option>
								<option>Other</option>
							</select><br />
							<span><?php 
									if (isset($registration -> referer)){ 
									?>
									<span class="errors_em"><?php echo "<span style=\"color: red\">*</span>". $registration -> referer; ?></span>
									<?php 
										}
									?>
							</span>
						</div>
			
					</div>
					<div id="notifs" class="regForm">
						<input type="checkbox" name="txtEmailnotif" checked><span> I would like to receive status notification emails for my orders.</span><br /> 
						<input type="checkbox" name="txtSMSnotif" checked><span> I would like to receive status notification texts for my orders.<span/>
					</div> 
					<div id="create_account" class="regForm row">
						<input type="submit" name="postRegister" value="Create Account" id="create_account">
					</div>
				</form>
			</div>
		</article>
	</section>
<?php include("../includes/layout/footer.php"); //footer file ?>
<?php $database -> close_db(); ?>