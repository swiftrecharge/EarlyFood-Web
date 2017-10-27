<?php ob_start(); ?>
<?php session_start();  ?>
<?php require_once("members.process.php"); // important to bring this here ?>
<?php 
	
if (!isset($_SESSION["user_id_reset"])) {
	redirect_to("../index.php");
}
					
?>

<?php 
		
		if (isset($_POST["postRegister"])) {
			$textpassword1 = trim($_POST["textFpassword"]);
			$textpassword2 = trim($_POST["textSpassword"]);
			if ($textpassword2 !== $textpassword1) {
				echo"Passwords Do Not Match!";
			}else{
				if ($validate_registration -> strong_password($textpassword1)) {
					$new_pass = $database -> escape_string($textpassword1);
					# everything is cool proceed to update the password
					$user_id = $_SESSION["user_id_reset"];
					if ($user_id!=null) {
								$query = "SELECT * FROM  members WHERE members.id = $user_id LIMIT 1";
								$result = mysqli_query($database -> connection, $query);
								if (!$result) {
									echo "There was a problem confirming your request! Please Try again shortly.";
								}else{
									$result_array = mysqli_fetch_assoc($result);
									$user_id = $result_array["id"];
										$column = "user_password";
										$value = $database -> encrypt($new_pass);
										if ($database -> update_user($column, $value, $user_id)) {
											//Password was succcessfully updated.";
											//delete reset record
											$database -> delete_reset_record($user_id);
											redirect_to("ResetPasswordSuccess.php");
											unset($_SESSION["user_id_reset"]);
										}else{
											echo "There was a problem updating. Try again shortly!";
										}
							}
					}		
				}else{
					echo "Password Must contain one special symbol( @, #, *), a numeral and uppercase letter";
				}
			}
		}

	?>

<?php echo "<br /><br />"; ?>
<html>
	<head>

		<style type="text/css">
			*{
				margin: 0px
			}
			body{
				width: 100%;
				height: 100%;
				margin: auto;
				margin-top: 5%;
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
		<title>arlyFood | Reset Password</title>
		<link rel='shortcut icon' type='image/x-icon' href="../includes/layout/images/favicon.png" />
	</head>	
	<body>
		<form method="post" action="Reset.php">
			<input type="password" name="textFpassword"  id="fname" value="" class="textInput" placeholder="New Password"><br /><br />
			<input type="password" name="textSpassword" value="" id="lname" class="textInput" placeholder="Confirm Password"><br /><br />
			<input type="submit" Value="Reset"  class="submitInput" name="postRegister" id="disabled">
		</form>
	</body>
</html>

<?php ob_flush(); ?>
<script type="text/javascript">
button  = document.getElementById("disabled");
button.onclick = function(){
	fname = document.getElementById("fname").value;
	lname = document.getElementById("lname").value;
	
	
	if (fname.length=0 || lname.length=0) {
			return false;
		}else{
			return true;
		}
}

	function hide_text(){
		$('.errors_em').hide();
		
	}
window.onload = passEqual;
function passEqual(){
	fpass = document.getElementById("fname");
	lpass = document.getElementById("lname");

	lpass.onchange = function(){
		if (fpass.value !== lpass.value) {
			alert('Passwords Donot Match');
			fpass.value = "";
			lpass.value = "";
		};
	}
}
</script>