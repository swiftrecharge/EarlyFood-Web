<?php ob_start(); ?>
<?php session_start();  ?>
<?php require_once("../includes/classes/includes.php"); ?>
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
		</style>
		<title>arlyFood | Reset</title>
		<link rel='shortcut icon' type='image/x-icon' href="../includes/layout/images/favicon.png" />
	</head>	
	<?php 
		
		if (isset($_POST["postReset"])) {
			$login -> reset_password();
		}

	?>
	<body>
		<span><?php if (isset($login -> reset_error)){ echo $login -> reset_error;} ?></span>
		<div>Please Enter The Email You Used In Registering</div><br /><br />
		<form method="post" action="reset.php">
			<input type="text" name="textRegisteredEmail" value="" class="textInput" placeholder="Type Email Here...."><br />
			<input type="submit" Value="Send" class="submitInput" name="postReset">
		</form>
	</body>
</html>
<?php ob_flush(); ?>