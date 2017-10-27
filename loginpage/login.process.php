<?php ob_start(); ?>
<?php require_once("../includes/classes/includes.php"); ?>
<?php 
	if (isset($_SESSION["logged_user_id"])) {
	 	redirect_to("../memberspage/members.php");
	 }
?>

<?php 
	if (isset($_POST["postLogin"])) {
		if($login -> login_user()){
			redirect_to("../memberspage/members.php");
		}
	}
?>
<?php ob_flush(); ?>