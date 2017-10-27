<?php session_start(); ?>
<?php require_once("../includes/classes/includes.php"); ?>

<?php
	$textEmail = $_SESSION["textRegisteredEmail"];
	if (!empty($textEmail)) {
		$result = $member -> reset_password($textEmail);
		if ($result) {
			# reset link successfully sent
			echo "<div>A Reset Link Has Just Been Sent to Your Mail. Click on it to Reset Your Password. Thank You!</div><br /><br />";

			echo "<img src=\"images/loading.gif\"><br />
			Redirecting... <span id=\"count_down\">10</span>";
			unset($_SESSION["textRegisteredEmail"]);
		}else{
			echo "<div>Operation was not successful. Please try again!</div><br /><br />";
			echo "<img src=\"images/loading.gif\"><br />
			Redirecting... <span id=\"count_down\">10</span>";
		}
	}
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
			body img{
				height: 100px;
				width: 100px;
			}

			body span{
				font: 1.5em Tahoma;
				border-radius: 5px solid white;
				box-shadow: 1px 1px 1px 1px;
				background-color: white;
				color: red;
				padding: 0.1em;
			}
			@media only screen  and (max-width: 769px){
				body div{
					font: 1em Tahoma;
					background-color: red;
					margin: auto;
					color: white;
				}
				body img{
				height: 100px;
				width: 100px;
				}
			}
		</style>
		<title>arlyFood | Success</title>
		<link rel='shortcut icon' type='image/x-icon' href="../includes/layout/images/favicon.png" />
	</head>	
	<body>
		
		
		<script type="text/javascript">
			function countDown(){
				currentValue = document.getElementById("count_down").innerHTML;
				newValue = currentValue -1;
				//if (newValue > 0) {
					document.getElementById("count_down").innerHTML = newValue;
				//}else{
					//break;
				//}
				
			}
			function Redirect(){
				window.location = '../index.php';
			}
			setInterval(countDown, 1000);
			setTimeout(Redirect, 10000);
		</script>
	</body>
</html>