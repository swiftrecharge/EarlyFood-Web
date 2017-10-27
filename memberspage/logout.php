<?php ob_start(); ?>
<?php require_once("../includes/redirect.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php session_start(); ?>
<?php 
if (isset($_POST["logout"])) {
	session_destroy();
	redirect_to("members.php");
}
	
?>
<?php ob_flush(); ?>