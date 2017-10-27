<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../../includes/redirect.php"); ?>
<?php require_once("../../../includes/functions.php"); ?>
<?php connect_to_db(); ?>

<!DOCTYPE html>
<html>
<?php 

if (isset($_POST["submitLogin"])) {
	$Code = $_POST["txtCode"];
	$txtlogin = $_POST["txtlogin"];
	$perm_log = isset($txtlogin) ? 1 : 0;
	if (!empty($Code)) {
		$query = "SELECT * FROM deliveries_account WHERE unique_code = '{$Code}'";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)!=0) {
			# results were found
			$result_array = mysqli_fetch_assoc($result);
			$pass = $result_array["unique_code"];
			$id = $result_array["restaurant_id"];
			$given_id = substr($pass, 5);
			if ($id == $given_id) {
				# cool redirect/login
				$_SESSION["get_id_details"] = $id;
				redirect_to("status.php");
			}else{
				echo "Wrong Code. Please Try Again!";
			}
		}else{
			echo "Wrong Code. Please Try Again!";
		}
	}else{
		echo "Please Type In Your Unique Code.";
	}
}

?>

	<head>
		<style type="text/css">
			*{
				margin: 0px
			}
			body{
				width: 100%;
				height: 100%;
				margin: auto;
				color: white;
				background-color: black;
				opacity: 0.9;
				text-align: center;
			}
			body div{
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
			@media only screen  and (max-width: 769px){
				body div{
					font: 1em Tahoma;
					background-color: red;
					margin: auto;
					color: white;
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
		</style>

		<title>liteFood | Welcome</title>
		<link rel='shortcut icon' type='image/x-icon' href="../../../includes/layout/images/favicon.png" />
		<meta charset="utf-8" lang="en">
	</head>

	<body>
		<div>Login To Update The Status Of Your Deliveries</div><br /><br />
		<form method="post" action="index.php">
			<input type="text" name="txtCode"  id="fname" value="" class="textInput" placeholder="Unique Code"><br /><br />
			<!--<input type="text" name="textPassword" value="" id="lname" class="textInput" placeholder="Password"><br /><br /> -->
			<input type="submit" value="Login"  class="submitInput" name="submitLogin" id="disabled"><br /><br />
			<input type="checkbox" name="txtlogin" checked><span> Keep me Logged-In</span>
		</form>
	</body>

</html>
<?php ob_flush(); ?>
<?php close_db(); ?>