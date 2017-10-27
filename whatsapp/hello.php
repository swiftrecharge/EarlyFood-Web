<?php ob_start(); ?>
<?php session_start(); ?>
<?php //include("includes/classes/includes.php"); ?>
<?php include("includes/layout/headerindex.php"); //header file ?>

<!-- useful links   -->
<script type="text/javascript" src="homepage/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="homepage/js/cycle2.js"></script>
<script type="text/javascript" src="homepage/js/jquery.bgswitcher.js"></script>
<script type="text/javascript" src="homepage/js/home.js"></script>
<link rel="stylesheet" type="text/css" href="homepage/css/homepage.css" />

		<section class="row" id="section_wrapper">
			<header class="jumbotron_custom" id="slide_Show">
				<?php require_once("homepage/slider2.php"); ?>
			</header>
			<h3><span class="" >How Do I Order?</span></h3>
			<article class="" id="article1">
				<div id="step1" class="steps">
					<span>Step 1</span><br>
					Enter Your Street Address<br>
					<center><img class="img img-responsive" src="homepage/images/img_step01.png"></center>
				</div>
				<div id="step2" class="steps">
					<span>Step 2</span><br>
					Select A Restaurant<br>
					<center><img class="img img-responsive"  src="homepage/images/img_step02.png"></center>
				</div>
				<div id="step3" class="steps">
					<span>Step 3</span><br>
					Select  Food Items<br>
					<center><img class="img img-responsive"  src="homepage/images/img_step03.png"></center>
				</div>
				<div id="step4" class="steps">
					<span>Step 4</span><br>
					Enjoy!<br>
					<center><img class="img img-responsive"  src="homepage/images/img_step04.png"></center>
				</div>
				
			</article>


			<article class="row" id="article2">
				<div id="article2_1" class="article2_all">
					<div class="article2_sub">
						<div class="img_text">
							<img src="homepage/images/price-tag-7.png">
						</div>
						<div id="deliveryFee">
							<span>Delivery Fee</span><br><br>
							<div class="all_text">
								1-3 miles ........... GHC0.49<br><br>
								3-5 miles ........... GHC0.99<br><br>
								5-7 miles ........... GHC1.99<br><br>
								7-10 miles .......... GHC2.99<br><br>
								10+ miles ........... GHC3 + <br>
							</div>
						</div>	
					</div>
					<div id="" class="article2_sub">
						<div class="img_text">
							<img src="homepage/images/clock.png" class="img img-responsive">
						</div>
						<div id="deliveryTime">
							<span>Delivery Time</span><br><br>
							<div class="all_text">
								99% of all deliveries are made in under an <br>
								hour. Delivery times vary based on traffic, <br>
								the restaurant's ability to prepare food and <br>
								weather conditions. We recommend that large<br>
								orders be placed at least two hours in advance,<br>
								but if you require a specific lunch time delivery,<br>
								24 hour notice is recommended.
							</div>
						</div>
					</div>
				</div>
				<div id="article2_2" class="article2_all">
					<div id="" class="article2_sub">
						<div class="img_text">
							<img src="homepage/images/money.png">
						</div>
						<div id="formPayment">
							<span>Forms of Payment</span><br><br>
							<div class="all_text">
								We accept Cash, Visa, Master Card,<br>
								Vodafone Cash, Airtel Mobile Money,<br>
								MTN Mobile Money, Glo Mobile Money,<br>
								and Tigo Cash. We do not currently<br>
								accept personal checks.<br />
								You can also opt for payment on delivery.
							</div>
						</div>
						
					</div>
					<div id="" class="article2_sub">
						<div class="img_text">
							<img src="homepage/images/office.png">
						</div>
						<div id="officeLunches">
							<span>office Lunches</span><br><br>
							<div class="all_text">
								We specialize in group lunch deliveries<br>
								and drop off catering! Give our local<br>
								Catering Manager a call for more <br>
								details regarding keeping your<br>
								office well fed!
							</div>
						</div>
						
					</div>
				</div>
				<div id="article2_3" class="article2_all">
					<div id="" class="article2_sub">
						<div class="img_text">
							<img src="homepage/images/smartphone-2.png">
						</div>
						<div id="phoneOrder">
							<span>Phone Order</span><br><br>
							<div class="all_text">
								All phone-in orders will incur<br>
								a GHC0.99 phone-in fee. Orders<br>
								placed online are not subject<br>
								to this fee.
							</div>
						</div>
						 
					</div>
					<div id="" class="article2_sub">
						<div class="img_text">
							<img src="homepage/images/briefcase-1.png">
						</div>
						<div id="cashDiscount">
							<span>Cash Discount</span><br><br>
							<div class="all_text">
								All prices listed on our website reflect<br>
								a 3.5% cash discount. Paying with credit<br>
								card will result in a 3.5% increase on <br>
								all menu pricing.
							</div>
						</div>
					</div>
				</div>
				<!--<div id="store" class="article2_all">
					<div id="ios" class="article2_sub">
						<a href="#"><img src="images/icon-ios.png"></a>
					</div>
					<div id="android" class="article2_sub">
						<a href="#"><img src="images/icon-google.png"></a>
					</div>
				</div> -->
			</article>
		</section>
		<br><br><br><hr>

<!-- location detection -->

		<script type="text/javascript">
			if (document.cookie.indexOf("location")=='-1') {
				
				$.get("http://ipinfo.io", function(response) {
					  //document.write(response.ip);
					  //document.write(response.country);
					  //document.write(response.region);
					  var d = new Date();
					  var cname = "location";
					  var cvalue = response.region;
					  exdays = 3;
					  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
					  var expires = "expires="+d.toUTCString();
					  document.cookie = cname + "=" + cvalue + ";" + expires;
					}, "jsonp")
			}else{
				//alert('hello');
				//alert(document.cookie.indexOf("location"));
			}
		</script>
<?php include("includes/layout/footerindex.php");  //footer file ?>
		