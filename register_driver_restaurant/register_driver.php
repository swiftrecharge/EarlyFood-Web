<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../includes/redirect.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layout/header.php"); //header file ?>

<?php connect_to_db() ?>

<?php 
	//session_unset();
	if (isset($_POST["register"])) {
	$email = $_POST["usermail"];
	$safe_email = mysql_prep($connection, $email);
	$station = $_POST["station_name"];
	$safe_sname = mysql_prep($connection, $station);
	$wnumb = $_POST["work_phone"];
	$safe_wnumb = mysql_prep($connection, $wnumb);
	$fname = $_POST["firstname"];
	$safe_fname = mysql_prep($connection, $fname);
	$lname = $_POST["lastname"];
	$safe_lname = mysql_prep($connection, $lname);
	$pnumb = $_POST["pphone"];
	$safe_pnumb = mysql_prep($connection, $pnumb);
	$empty_error_log = array(has_no_presence($email), has_no_presence($station), has_no_presence($fname), has_no_presence($lname), has_no_presence($pnumb));

	$error_logs_min = array(min_length($email), min_length($station), min_length($fname), min_length($lname));

	foreach($empty_error_log as $value){
		//remove empty spaces if there are no errors stored
		if (empty($value)) {
			array_shift($empty_error_log);
		}
	}
	foreach ($error_logs_min as $value) {
		if (empty($value)) {
			array_shift($error_logs_min);
		}
	}
					
	//email regex
	$email_regex = array("Email address not valid.");
	if (validate_email($email)) {
		array_shift($email_regex);
	}else{
		$_SESSION["email_regex"] = $email_regex[0];
	}
	if (empty($error_logs_min) && empty($empty_error_log) && empty($email_regex)) {
		//every thing is good query database
		$query = "INSERT INTO ";
		$query .= "pros_driver(first_name, last_name, email_address, station_name, home_contact, work_contact) ";
		$query .= "Values('{$safe_fname}', '{$safe_lname}', '{$safe_email}', '{$safe_sname}', 
			'{$safe_pnumb}', '{$safe_wnumb}')";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Database connection failed.");
		}else{
			//session_destroy();
			echo "<div style=\"height: 50px; background-color: red; color: white; font: 1.5em Tahoma; text-align: center;\">Your Form Have Been Submitted Successfully. You Wil Be Contacted Shortly!</div>";
		}
	}else{
		$_SESSION["empty_email"] = "Please Email is required.";
		$_SESSION["empty_station"] = "Station name is required."; 
		$_SESSION["empty_name"] = "Please input your name.";
		$_SESSION["empty_phone"] = "Enter your contact.";
		$_SESSION["email"] = $email;
		$_SESSION["station"] = $station;
		$_SESSION["wphone"] = $wnumb;
		$_SESSION["pphone"] = $pnumb;
		$_SESSION["fname"] = $fname;
		$_SESSION["lname"] = $lname;
	}

}else{
}
?>

<script type="text/javascript" src="js/register.js"></script>
<link rel="stylesheet" type="text/css" href="css/register.css">

<section id="registration_section">
	<article id="article1_register" class="row">
						<span id="cSpan"><center>Fill Out This Form And We Will Contact You!</center></span>
		<form action ="register_driver.php" method="post">
			<div class="regForm row">
				<div id="email" class="col-lg-4 col-md-4 col-sm-4">
					<span>Email<br></span>
					<input tpye="text" name="usermail" value="<?php if(isset($_SESSION["email"])){ echo $_SESSION["email"];} ?>"><br />
					<?php if(isset($_SESSION["email_regex"]) && !empty($email) )
							{echo "<span style=\"color: red;\">*</span>" . $_SESSION["email_regex"];
						} ?>
					<?php if(isset($_SESSION["empty_email"]) && empty($email)){echo "<span style=\"color: red;\">*</span>" . $_SESSION["empty_email"];} ?>
				</div>
				<div id="rest" class="col-lg-4 col-md-4 col-sm-4">
					<span>Station Name<br></span>
					<input type="text" name="station_name" value="<?php if(isset($_SESSION["station"])){ echo $_SESSION["station"];} ?>"><br />
					<?php if(isset($_SESSION["empty_station"]) && empty($station)){echo "<span style=\"color: red;\">*</span>" . $_SESSION["empty_station"];} ?>
				</div>
				<div id="wphone" class="col-lg-4 col-md-4 col-sm-4">
					<span>Work  Phone<br></span>
					<input type="text" id="work_phone" name="work_phone" value="<?php if(isset($_SESSION["wphone"])){ echo $_SESSION["wphone"];} ?>" onkeyup="digitsNumerals('work_phone');">
				</div>
				
			</div>
			<div class="regForm row">
				<div id="fName" class="col-lg-4 col-md-4 col-sm-4">
					<span>First Name<br></span>
					<input type="text" name="firstname" value="<?php if(isset($_SESSION["fname"])){ echo $_SESSION["fname"];} ?>"> <br />
					<?php if(isset($_SESSION["empty_name"]) && empty($fname)){echo "<span style=\"color: red;\">*</span>" . $_SESSION["empty_name"];} ?>
					
				</div>
				<div id="lName" class="col-lg-4 col-md-4 col-sm-4">
					<span>Last Name</span><br>
					<input type="text" name="lastname" value="<?php if(isset($_SESSION["lname"])){ echo $_SESSION["lname"];} ?>"> <br />
					<?php if(isset($_SESSION["empty_name"]) && empty($lname)){echo "<span style=\"color: red;\">*</span>" . $_SESSION["empty_name"];} ?>
				</div>
				<div id="pphone" class="col-lg-4 col-md-4 col-sm-4">
					<span>Personal Phone<br></span>
					<input type="text" id="p_phone" name="pphone" value="<?php if(isset($_SESSION["pphone"])){ echo $_SESSION["pphone"];} ?>" onchange="phoneDigits('p_phone');" onkeyup="digitsNumerals('p_phone')" ><br />
					<?php if(isset($_SESSION["empty_phone"]) && empty($pnumb)){echo "<span style=\"color: red;\">*</span>" . $_SESSION["empty_phone"];} ?>
				</div>
			</div>
			<div id="appDjob">
					<input type="submit" value="SEND" class="appDjob" name="register" />
				</div>
		</form>
	</article>
</section>

<?php include("../includes/layout/footer.php"); //header file ?>

<?php close_db(); ?>