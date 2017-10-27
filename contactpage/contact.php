<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("../includes/layout/header.php"); //header file ?>
<!-- useful links   -->

<script type="text/javascript" src=""></script>
<link rel="stylesheet" type="text/css" href="css/contact.css" />

<section class="row">
	<article class="decscriptive_text row" id="article1">
		<div id="step1" class="col-md-4">
			<h2>Drivers <span class="glyphicon glyphicon-hand-down"></span></h2><br />
			We love friendly & outgoing people,<br />
			because that is how we keep our customers happy. <br />
			This is a fun & active job, where you will meet <br />
			many different people. You will be able to make <br />
			your own hours, make people happy, and make good money!<br />
			For more information, visit the <a href="../driverpage/driverpage.php">earlyFood driver page.</a>
		</div>
		<div id="step2" class="col-md-4">
			<h2>Restaurant Owners <span class="glyphicon glyphicon-hand-down"></span></h2><br />
			Are you interested in providing a great service<br />
			to your existing customers, tapping into a giant<br />
			new customer base, and increasing your out of house revenue? <br />
			Contact us to set up a meeting with a member of our team, <br />
			or learn more about <a href="../partnerspage/partners.php">partnering your restaurant with earlyFood.</a>
		</div>
		<div id="step3" class="col-md-4">
			<h2>Entrepreneures <span class="glyphicon glyphicon-hand-down"></span></h2><br />
				Have you ever wanted to own your own business, <br />
				or supplement your current income by owning a <br />
				fun & easy to operate company? Contact us today <br />
				to see how we can bring earlyFood to your neighborhood, <br />
				and money into your pockets!
		</div>				
	</article>
	<article id="article3">
		<?php include("aboutUs/index.html"); ?>
	</article>
	<article id="article2" class="">
		<div class="col-md-7" id="comment">
			<div id="comment_sub">
				<form method="post">
					<label>Subject</label><br />
					<select name="txtSubject">
						<option>Need Help Placing A New Order</option>
						<option>Need Help with an existing order</option>
						<option>Want To be a driver for eFood</option>
						<option>Restaurant Owner and Want to partner us</option>	
						<option>Interested in working for eFood</option>
					</select><br /><br />
					<label>Message</label><br />
					<textarea rows="2"></textarea><br /><br />
					<label>Full Name</label><br />
					<input type="text" name="txtFullName" /><br /><br />
					<label>E-mail</label><br />
					<input type="text" name="txtEmail" /><br /><br />
					<label>Phone</label><br />
					<input type="text" name="txtPhone" /><br /><br />
					<input type="submit" name="postComment" value="Send Comment" style="background-color: red; color: white; width: auto;">
				</form>
			</div>
		</div>
		<div class="col-md-5" id="location">
			<!--<img src="images/map.jpg" alt="Location On Google Map">
			 google map iframe -->
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.766565196232!2d-1.5655624859989088!3d6.67581792322783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdb946394f26ce3%3A0x6e8231ab7e28d6dd!2sContinental+Supermarket!5e0!3m2!1sen!2sgh!4v1473078655263" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			<div id="addresss" >
				<p>
					<i>earlyFood Delivery Service</i>, West End Drive Way<br />
					Off the KNUST Ayeduase Road.<br />
				</p>
				<p>
					Phone: +233-501384064 / +233-572922135<br />
					Email: support@earlyfood.com
				</p>
			</div>
		</div>
	</article>
</section>

<?php include("../includes/layout/footer.php");  //footer file ?>