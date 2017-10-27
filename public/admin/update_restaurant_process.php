<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<?php 
//process restaurant details update.
		//check for fields that contain values keeping in mind the select options
		$id = $_POST["id"];
		$restaurant_name = $_POST["restaurant_name"]; $safe_restaurant_name = mysql_prep($connection, $restaurant_name);
		$address = $_POST["address"]; $safe_address = mysql_prep($connection, $address);
		$working_days = $_POST["working_days"]; $safe_working_days = mysql_prep($connection,$working_days);
		$region = $_POST["region"];
		$district = $_POST["district"];
		$working_hours = $_POST["working_hours"]; $safe_working_hours = mysql_prep($connection ,$working_hours);
		$visible = $_POST["visible"];
		$slogan = $_POST["slogan"]; $safe_slogan = mysql_prep($connection, $slogan);
		
		if(!empty($restaurant_name)){
			update("restaurant", "restaurant_name", $safe_restaurant_name, $id, "Restaurant name");
		}
		if(!empty($slogan)){
			update("restaurant", "slogan", $safe_slogan, $id, "Slogan");
		}
		if(!empty($address)){
			update("restaurant", "street_address", $safe_address, $id, "Restaurant Address");
		}
		if(!empty($working_days) && $working_days!=="Select"){
			update("restaurant", "working_days", $safe_working_days, $id, "Working Days");
		}
		if(!empty($working_hours) && $working_hours!=="Select"){
			update("restaurant", "working_hours", $safe_working_hours, $id, "Working Hours");
		}
		if(!empty($region) && $region!=="Select"){
			update("restaurant", "loc_region", $region, $id, "Region");
		}
		if(!empty($district) && $district!=="Select"){
			update("restaurant", "loc_district", $district, $id, "District");
		}
		if(!empty($visible) && $visible!=="Select"){
			update("restaurant", "visible", $visible, $id, "Display");
		}
?>
<html>
	<head>
		<style type="text/css">
			body{
				background-color: #333 ;
				color: #ccc;
			}
			#link{
				height: 30px;
				background-color: red;
				padding-top: 1em;
				width: 150px;
				text-align: center;
				border: 2px solid white;
				margin-top: 100px;
				font-family: Tahoma;
			}
			#link a{
				color: #ccc;
				text-decoration: none;
			}
			#link a:visited{
				color: #ccc;
			}
			#link a:hover{
				text-decoration: none;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div id="link">
			<a href="index.php">Return To Home</a>
		</div>
	</body>
</html>