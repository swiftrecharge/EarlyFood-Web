<?php ob_start(); ?>
<?php session_start();  ?>
<?php require_once("members.process.php"); // important to bring this here ?>
<?php 
	
	/* implementation hidden */
?>
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
				margin-top: 10%;
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
		<!--<form method="post" action="ResetPassword.php">
			<input type="password" name="textFpassword"  id="fname" value="" class="textInput" placeholder="New Password"><br /><br />
			<input type="password" name="textSpassword" value="" id="lname" class="textInput" placeholder="Confirm Password"><br /><br />
			<input type="submit" Value="Reset"  class="submitInput" name="postRegister" id="disabled">
		</form> -->
	</body>
</html>