<?php ob_start(); ?>
<?php session_start();  ?>
<!-- minor change above edit in server -->
<?php require_once("../includes/redirect.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layout/header.php"); //header file ?>
<?php connect_to_db(); ?>
<?php //session_unset(); ?>
		<?php 
		   if (isset($_COOKIE['location'])) {
		   		//echo $_COOKIE['location'];
		   }
		?>
<?php 

	if (!isset($_POST['find_food'])) {
		//redirect_to("homepage.php");
	}
?>
<script type="text/javascript" src="js/restaurants.js"></script>
<link rel="stylesheet" type="text/css" href="css/restaurantspage.css">
<section id="restaurants_section" class="row">
	<article id="article1_restaurants" class="col-lg-2 col-md-3 col-sm-3">
		<form action="restaurants.php" method="post">
			<span style="font-family: Tahoma">Find Restaurants In </span><br />
			<select name="findByRegion">
				<option selected>Select Region</option>
				<option>Greater Accra</option>
				<option>Ashanti</option>
				<option>Central</option>
				<option>Northern</option>
				<option>Upper West</option>
				<option>Upper East</option>
				<option>Eastern</option>
				<option>Volta</option>
				<option>Western</option>
				<option>Brong-Ahafo</option>
			</select> <input type="submit" name="findRegion" value="Find"><br /><br />
		</form>
		<form action="restaurants.php" method="post">
			<span style="font-family: Tahoma">Restaurants By Type</span><br />
			<select name="findByType" style="width: 150px;">
				<option selected>Select Type</option>
				<option>Cuisines</option>
				<option>Fast Food</option>
				<option>Continental</option>
				<option>Traditional</option>
			</select> <input type="submit" name="findType" value="Find"><br /><br />
		</form>
		<form action="restaurants.php" method="post">
			<span style="font-family: Tahoma">Search For</span><br />
			<input type="text" placeholder="Type Restaurant Name" name="findByName" style="width: 100%;"/> <input type="submit" value="Search" name="findName">
		</form>
		
	</article>
	<article id="article2_restaurants" class="col-lg-9 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset col-sm-offset-1">
		<!-- container for adding restaurants -->
		<div class="article2_restaurants">
			<?php require_once("../search_algorithms/search.php"); ?>
		</div>			
	</article>
</section>
<?php include("../includes/layout/footer.php"); //footerr file ?>
<?php close_db(); ?>
<?php ob_flush(); ?>