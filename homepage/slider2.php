<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, width=device-width">
<script type="text/javascript" src="jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="jquery.bgswitcher.js"></script>
<script type="text/javascript" src="home.js"></script>
<style type="text/css">
.box {
	margin-top: -26px;
	height: 100%;
	width: 100%;
	background-color: red;
}
#search_2 span a{
	font-family: Tahoma;
	padding: 10px;
	background-color: red;
	color: white;
	font-style: bold;
}
#search{
	position: relative;
	margin-left: 75%;
	margin-top: 50px;
	text-align: center;
	width: 250px;
	background-color: white;
	border: 10px solid black;
}
@media only screen and (max-width: 767px){
	#search{
		margin-left: 25%;
		/*background-color: yellow;*/
	}
	#text{
		display: none;
	}
}
@media only screen and (max-width: 500px){
	#search{
		margin-top: 100px;
		margin-left: auto;
		margin-right: auto;
		/*background-color: red;*/

	}
}
@media only screen and (min-width: 768px ){
	#search{
		margin-left: 37%;
		float: left;
		/*background-color: black; */
	}
	#text{
		padding: 3em;
		float: left;
	}
	#text span{
		font: 5em Tahoma;
		color: white;
		font-style: italic;
	}
}
@media only screen and (min-width: 768px) and (max-width: 1000px){
	#search{
		margin-left: 20%;
		float: left;
		/*background-color: green;*/
	}
}
.top_qtn{
	margin-top: -10px;
	width: 33%;
	float: left;
	padding: 1em;
	font: 1.0em Tahoma;
}
.top_qtn img{
	width: 100%;
	height: 40px;
}
#search_1{
	height: 65px;
	background-color: #E6E6FA;
}
#search_2 {
	margin-top: 5px;
	margin-bottom: 10px;
}
#search_2 span{
	margin-top: 10px;
	padding: 0.5em;
	font: Tahoma;
	font-weight: bold;
	margin-bottom: 15px;
}
#search_2 span a{
	color: white;
}
#search_2 span a:visited{
	color: white;
}
#search_3 input{
	margin-top: 10px;
	padding: 0.5em;
	text-align: center;
	font: 1.0em Tahoma;
}
#search_4 input{
	
	text-align: center;
	font: 1.0em Tahoma;
	background-color: red;
	color: white;
	border: 0px;
}
#search_4 span{
	margin-top: 10px;
	margin-bottom: 10px;
	background-color: red;
	padding: 0.5em;
	color: white;
}
#search_4 a{
	color: white;
	font: 1.0em Tahoma;
}
#search_4 a:hover{
	color: white;
	text-decoration: none;
}
</style>

<div class="box"><br /><br /><br />
	<div id="text">
		<span>SWIFT!</span><br /><br />
		<span>SAFE!</span><br /><br />
		<span>FRESH!</span><br /><br />
	</div>
	<div id="search">
		<div id="search_1">
			<center>
				<div class="top_qtn">Delivery
					<img src="homepage/images/delivery.ico"> 
				</div>
				<div class="top_qtn"> PickUp 
					<img src="homepage/images/pickup.ico">
				</div>
				<div class="top_qtn"> Office
					<img src="homepage/images/office.ico">
				</div>
			</center>
		</div>
		<div id="search_2">
			<span>
				<a href="loginpage/login.php"><span class="glyphicon glyphicon-edit"></span>Login / Create Account</a>
			</span>
		</div>
		<form action="restaurantspage/restaurants.php" method="post">
			<div id="search_3">
				<span>Enter Your Street Address</span><br />
				<input type="text" placeholder="Street Address" name="txtStreetAddress" id="searchTerm"><br /><br />
				<span>Enter Your Post Code</span><br />
				<input type="text" placeholder="Post Code(optional)" name="txtPostCode">
			</div>
			<div id="search_4">
				<span>
					<!--<a href=""><span class="glyphicon glyphicon-search"></span>FIND FOOD</a>-->
					<span class="glyphicon glyphicon-search"></span><input type="submit" value="FIND FOOD" name="find_food" id="btnSearch"/>
				</span>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(".box").bgswitcher({
		images: ["homepage/images/a.jpeg", "homepage/images/b.jpeg", "homepage/images/c.jpg", "homepage/images/d.jpeg", "homepage/images/e.jpg", "homepage/images/f.jpg", "homepage/images/g.jpg"],
		effect: "clip" //fade, blind, clip, slide, drop, hide
	});
</script>
