<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>

<?php 
			// process menu upate
			if (isset($_POST["update_menu_item"])) {
				$restaurant_name = $_POST["restaurantname"]; $restaurant_id = $_POST["rest_id"]; 
				$item1 = $_POST["item1"]; $safe_item1 = mysql_prep($connection, $item1); $price1 = $_POST["price1"]; $safe_price1 = mysql_prep($connection, $price1); $menu_id1 = $_POST["menu_id1"];
				$item2 = $_POST["item2"]; $safe_item2 = mysql_prep($connection, $item2); $price2 = $_POST["price2"]; $safe_price2 = mysql_prep($connection, $price2); $menu_id2 = $_POST["menu_id2"];
				$item3 = $_POST["item3"]; $safe_item3 = mysql_prep($connection, $item3); $price3 = $_POST["price3"]; $safe_price3 = mysql_prep($connection, $price3); $menu_id3 = $_POST["menu_id3"];
				$item4 = $_POST["item4"]; $safe_item4 = mysql_prep($connection, $item4); $price4 = $_POST["price4"]; $safe_price4 = mysql_prep($connection, $price4); $menu_id4 = $_POST["menu_id4"];
				$item5 = $_POST["item5"]; $safe_item5 = mysql_prep($connection, $item5); $price5 = $_POST["price5"]; $safe_price5 = mysql_prep($connection, $price5); $menu_id5 = $_POST["menu_id5"];
				if (!empty($restaurant_name) && (!empty($restaurant_id) && $restaurant_id!=="Slct" ) ) {
					//construct query to ensure tha credentials match
					$query = "SELECT restaurant.restaurant_name, restaurant.id, menu.restaurant_id FROM restaurant, menu WHERE restaurant.id = menu.restaurant_id LIMIT 1";
					$result = mysqli_query($connection, $query);
					if (!$result) {
								die("Selected Restaurant Does Not Have Any Menu. " . mysqli_error($connection));						
					}else{
						$result_array = mysqli_fetch_assoc($result);
						if ($result_array["restaurant_name"]==$restaurant_name) {
							if ($item1!=null && $price1!=null && (!empty($menu_id1) && $menu_id1!=="Slct" ) ) {
								update_menu_item($menu_id1, $safe_item1, $price1);
							}
							if ($item2!=null && $price2!=null && (!empty($menu_id1) && $menu_id2!=="Slct" ) ) {
								update_menu_item($menu_id2, $safe_item2, $price2);
							}
							if ($item3!=null && $price3!=null && (!empty($menu_id1) && $menu_id3!=="Slct" ) ) {
								update_menu_item($menu_id3, $safe_item3, $price3);
							}
							if ($item4!=null && $price4!=null && (!empty($menu_id1) && $menu_id4!=="Slct" ) ) {
								update_menu_item($menu_id4, $safe_item4, $price4);
							}
							if ($item5!=null && $price5!=null && (!empty($menu_id1) && $menu_id5!=="Slct" ) ) {
								update_menu_item($menu_id5, $safe_item5, $price5);
							}
						}else{
							
							echo "<span style=\"font-size: 30px;\">Restaurant Name Selected Does Not Match Restaurant ID</span><br /> <br />";
						}
					}
				}else{
					echo "<span style=\"font-size: 30px;\">Update(s) was not successful.</span><br /> <br />";
					echo "<span style=\"font-size: 30px;\">Please Type Restaurant Name Or Select ID and Make Sure Menu ID is also selected!!</span><br /> <br />";
					
					//session variables to save already typed values
				}
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