<?php ob_start(); ?>
<?php require_once("../includes/classes/includes.php"); ?>
<?php 
	if (isset($_POST["postRegister"])) {
		if ($registration -> create_user()) {
			if (isset($_SESSION["p_transfer"])) {
				unset($_SESSION["p_transfer"]);
			}
			
			redirect_to("../loginpage/login.php");
		}
	}
?>
<?php ob_flush(); ?>