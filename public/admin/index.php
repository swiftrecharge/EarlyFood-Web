<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php 
	if (isset($_POST["txtLogoutAdmin"])) {
		log_out();
		redirect_to("authenticate.php");
	}
?>
<?php 
	if (!isset($_SESSION["admin_logged_in"])) {
		redirect_to("authenticate.php");
	}
?>
<?php 
	if (isset($_POST["verifyAdmin"])) {
		connect_to_db(); 
		$id = $_POST["adminId"];
		$status = "verified";
		$column = "status";
		update_admin_status($id, $status, $column);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="_your description goes here_" />
<meta name="keywords" content="_your,keywords,goes,here_" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen" title="style (screen)" />
<title>Panel</title>
<!--[if lte IE 6]>
<style type="text/css">
html, body
	{
	height: 100%;
	overflow: auto;
	}
#left {
	position: absolute; left: 0;
	width: 35%;
}

</style>
<![endif]-->
</head>

<body>

<div id="left">
 <div id="outer">
	<img class="lime" src="lime.jpg" alt="" /><h1><span class="green">e</span><span class="yellow">f</span>oo<span class="green">d</span></h1><br /><br />
	<form method="post" action="index.php">
		<a class="nav" href="index.php?adminPage=admin">Admin</a>
		<a class="nav" href="index.php?ordersPage=orders">Orders</a>
		<a class="nav" href="index.php?driversPage=drivers">Drivers</a>
		<a class="nav" href="index.php?membersPage=members">Members</a>
		<a class="nav" href="index.php?restaurantsPage=restaurants">Restaurants</a>
	</form>
 </div>
</div>

<div id="main">

<?php
	$pageArray = array("adminPage" => "admin", "ordersPage" => "orders", "driversPage" => "drivers", "membersPage" => "members", "restaurantsPage" => "restaurants");
	foreach ($pageArray as $key => $page) {
		if (isset($_GET[$key]) && $_GET[$key]==$page) {
			$requestedPage = $page . ".php";
			require_once($requestedPage);
			break;
		}
	}
 ?>
 <?php 
 	//restaurants section
 	$restaurants_panel_array = array("add_restaurant", "update_restaurant", "add_menu", "update_menu", "view_rest", "restaurant_app", "restaurant_logo", "deliveries", "add_restaurant_next", "delivery_fee", "restaurant_statement");
 	foreach ($restaurants_panel_array as $value) {
 		if (isset($_GET[$value])) {
 			$name = $value . ".php";
 			require_once($name);
 			break;	
 		}
 	}
 ?>
</div>


</body>

</html>