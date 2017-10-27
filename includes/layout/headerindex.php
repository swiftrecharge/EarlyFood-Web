<!DOCTYPE html>
<html>
	<head>
		<title> EarlyFood Delivery Service | Food Delivery Now</title>
		<meta name="description" content="Order food online in Ghana from a large list of nice restaurants near you, ghana food, fast food, food delivery services"/>
 
        <meta name="keywords" content="Restaurants in Ghana, Ghanaian food, Order food online, early food"/>

        <meta name="robots" content="index,follow"/>

       <meta name="description" content="Order food delivery now! Choose from the best local restaurants. Hundreds of menus, and easy online ordering to your home, office, or hotel."/>
       <meta name="author" content="EarlyFood" />
       <!-- Open Graph Data --><meta property="og:title" content="EarlyFood Delivery Service | Food Delivery Now!" />
       <meta property="og:url" content="https://earlyfood.com/" />
       <meta property="og:type" content="website" />
       <meta property="og:description" content="Order food delivery now! Choose from the best local restaurants. Hundreds of menus, and easy online ordering to your home, office, or hotel."/>
       <meta property="og:image" content="https://earlyfood.com/editables/logo.png" />
        <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="1200">
		<link rel='shortcut icon' type='image/x-icon' href="includes/layout/images/favicon.png" />
		<link rel="stylesheet" type="text/css" href="includes/layout/css/header.css" /> 
		<link rel="stylesheet" type="text/css" href="includes/layout/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="includes/layout/css/custom.css">
		<meta charset="utf-8" lang="en" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="google-site-verification" content="eZoXJOcgnq-egVkmjXRVAO-5sUuU7VXZiN07dkzN8es" />
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-89151892-1', 'auto');
		  ga('send', 'pageview');
		</script>
	</head>
	<body>
	<div class="container">
		<header id="top_header" class="row">
			<?php 

				if (isset($_SESSION["logged_user_id"])) {
					$id = $_SESSION["logged_user_id"];
					$first_name = $_SESSION["logged_user_first_name"];
					//echo ucfirst($first_name);
					#display welcome
					?>

						<div class="col-lg-6 col-md-5.3 col-sm-6">
							<ul>
								<li id="top_welcome">
									<span id="tpw_style">Welcome </span><a id="createAccount" href="../loginpage/login.php"><?php echo ucfirst($first_name); ?></a><span id="tpw_style"></span>
									<!--<a href="registrationpage/registration.php" id="createAccount">Create An Account</a> -->	
								</li>
							</ul>
						</div>
						<div class="col-lg-6 col-md-6.7 col-sm-6">
							<ul>
								<li id="bcomPartner">
									<a href="partnerspage/partners.php" class="header_links">Become A Restaurant Partner</a>
								</li>
								<li id="bcomDriver">
									<a href="driverpage/driverpage.php" class="header_links">Become A Driver</a>
								</li>
								<li id="contactUs">
									<a href="contactpage/contact.php" class="header_links">Contact Us</a> 
								</li>
								<li id="cart_ordered">
									<a href="#" class="header_links">Cart <span class="glyphicon glyphicon-shopping-cart" style="color: white"></span></a> 
								</li>
							</ul>
						</div>

					<?php
				}else{
					#display login tabs
					?>

					<div class="col-lg-6 col-md-5.3 col-sm-6">
						<ul>
							<li id="top_welcome">
								<span id="tpw_style">Welcome, Please </span><a id="createAccount" href="loginpage/login.php">Login</a><span id="tpw_style"> Or </span>
								<a href="registrationpage/registration.php" id="createAccount">Create An Account</a>	
							</li>
						</ul>
					</div>
					<div class="col-lg-6 col-md-6.7 col-sm-6">
						<ul>
							<li id="bcomPartner">
								<a href="partnerspage/partners.php" class="header_links">Become A Restaurant Partner</a>
							</li>
							<li id="bcomDriver">
								<a href="driverpage/driverpage.php" class="header_links">Become A Driver</a>
							</li>
							<li id="contactUs">
								<a href="contactpage/contact.php" class="header_links">Contact Us</a> 
							</li>
							<li id="cart_ordered">
								<a href="#" class="header_links">Cart <span class="glyphicon glyphicon-shopping-cart" style="color: white"></span></a> 
							</li>
						</ul>
					</div>

					<?php
				}

			?>
			
		</header>
		
		<div class="row">
			<nav id="main_links">
				<div class="col-lg-5 col-md-3 col-sm-2 " id="logo">
					<div class="col-xs-8">
					 	<img src="includes/layout/images/logo.png" alt="earlyFood"> 
						<!--<img src="logo.png" alt="e-Food" class="img img-responsive"> -->
					</div>
					<div class="col-xs-4" id="short_menu">
						<li class="dropdown">
							<a href="" data-toggle="dropdown">

								<button type="button" class="btn btn-warning">
									<span>Menu</span>
									<span class="icon-bar"></span><span class="caret" style="width: 5px; height: 5px;"></span>
								</button>

							</a>
							<ul class="dropdown-menu" id="links_ul">
								<!-- smaller screen size links -->
								<li id="">
									<a href="index.php" class="head_links" id="home"><span class="glyphicon glyphicon-home" style="color: white"></span> HOME</a>
								</li>
								<li id="">
									<a href="loginpage/login.php" class="head_links">MY ACCOUNT</a>
								</li>
								<li id="">
									<a href="restaurantspage/restaurants.php" class="head_links">RESTAURANTS</a>
								</li>
								<li id="">
									<a href="certificates/gift.php" class="head_links">GIFT CERTIFICATES</a>
								</li>
							</ul>
						</li>
					</div>
				</div>
				<div class="col-lg-6 col-md-7 col-sm-9 " id="headLinks">
					<div id="main_nav">
						<ul>
							<li id="">
								<a href="index.php" class="head_links" id="home"><span class="glyphicon glyphicon-home" style="color: white"></span> HOME</a>
							</li>
							<li id="">
								<a href="restaurantspage/restaurants.php" class="head_links">RESTAURANTS</a>
							</li>
							<li id="">
								<a href="certificates/gift.php" class="head_links">GIFT CERTIFICATES</a>
							</li>
							<li id="">
								<a href="loginpage/login.php" class="head_links">MY ACCOUNT</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>

	<script type="text/javascript" src="includes/layout/js/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="includes/layout/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="includes/layout/js/custom.js"></script>













