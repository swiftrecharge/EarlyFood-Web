<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<?php $a = "gosdjasdimmciwujaxckk=348792jkxc8ucjdfkhsdkfjnhdmhdjwjk&hkjewjemklwejlkkjcashjcajhasdcajsj=jkkhfsdfjs2189jfc8cmsjdkfksdjfs2cu&sdjksdfjsdkjsdjjjdjsk&jkasduwmcvxuemewiewcmereysdryercyeweoueuwiei=2729asj8&hjsywehbiAsjdsj=euwe723822jsjsjd&sjkfsjkdfsdfk893=sdi289sdfjk89fjd&jmlksdjksjfsj=uqu782jsdjjsdjfsdmynamewaswahtithoughtittobenenever&ajdajsdmjemkldsfsqonxnzsdfsh=djbateioerwj38sudf87wu89jkfje8r92ijsdbhayd723heiywj"; 
	$b = "jkasduwmcvxuemewiewcmereysdryercyeweoueuwiei=2729asj8&hjsywehbiAsjdsj=euwe723822jsjsjd&sjkfsjkdfsdfk893=sdi289sdfjk89fjd&jmlksdjksjfsj=uqu782jsdjjsdjfsdmynamewaswahtithoughtittobenenever&ajdajsdmjemkldsfsqonxnzsdfsh=djbateioerwj38sudf87wu89jkfje8r92ijsdbhayd723heiywj";
?>
<?php 
	if (isset($_GET["delete"])) {
		$id = $_GET["delete"];
		if (is_numeric($id)) {
			$query = "SELECT restaurant.id, restaurant.restaurant_name FROM restaurant WHERE id = $id ";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Restaurant ID does not exist. " .mysqli_error($connection));
			}elseif(mysqli_num_rows($result)!=0){ 
					$result_array = mysqli_fetch_assoc($result);
					$id_again = $result_array["id"];
				?>
				<div id="decision">
					<form action="view_rest_process.php" method="get">
						Are You Sure You Want To DELETE <span style="font-weight: bolder;"> "<?php echo $result_array["restaurant_name"]; ?>"</span>???<br /><br /><br />
						<span>
							<a href="view_rest_process.php?no=redirect">No</a> 
						</sapn>
						<sapn>
							<a href="view_rest_process.php?yes=<?php echo $id_again; ?>">Yes</a>
						</span>	
					</form>
				</div>
		<?php
			}
		}else{
			redirect_to("index.php");
		}
		
	}
?>
<?php 
	if (isset($_GET["yes"])) {
		$yes_id  = $_GET["yes"];
		if (is_numeric($yes_id)) {
			//delete code goes here
			
		}
	}elseif (isset($_GET["no"])) {
		$no = $_GET["no"];
		if ($no === "redirect") {
			redirect_to("index.php");
		}else{
			die("oooooppss");
		}
	}
?>

<?php //menu view code 
	if (isset($_GET["menu"])) {
		$menu_id = $_GET["menu"];
		if (is_numeric($menu_id)) { ?>
			<table border="0" CELLSPACING="20">
				<tr>
					<th>Menu ID</th>
					<th>Restaurant Name (ID)</th>
					<th>Food Item</th>
					<th>Price</th>
				</tr>
				<?php 
					$query = "SELECT restaurant.restaurant_name, menu.id, menu.restaurant_id, menu.food_item, menu.price FROM restaurant, menu WHERE menu.restaurant_id=restaurant.id AND menu.restaurant_id=$menu_id ORDER BY menu.restaurant_id ASC";
					$result = mysqli_query($connection, $query);
					if (!$result) {
						die("Database connection failed. " . mysqli_error($connection));
					}else{ ?>


					<?php
						while ($value = mysqli_fetch_assoc($result)) { ?>
							<tr>
								<td><?php echo $value["id"] ?></td>
								<td><?php echo $value["restaurant_name"] ." (". $value["restaurant_id"] . ")"; ?></td>
								<td><?php echo $value["food_item"]; ?></td>
								<td><?php echo $value["price"]; ?></td>
								<td>
									<a href="view_rest_process.php?<?php echo $a; ?>&delete_menu=<?php echo $value["id"] ?>&<?php echo $b ?>">Delete</a><br /><br />
								</td>
							</tr>
							<tr>
								<td border="0" colspan="9"><hr></td>
							</tr>
					<?php		
						}
					}
				?>
			</table>
			<a href="view_rest_process.php?menu=echo $value["id"]">Print Menu</a>
	<?php	
		}
	}
?>

<?php 
//menu deletion code
	if (isset($_GET["delete_menu"])) {
		$menu_id = $_GET["delete_menu"];
		if (is_numeric($menu_id)) {
			$query = "SELECT menu.id, menu.food_item, restaurant.restaurant_name FROM menu, restaurant WHERE $menu_id = menu.id AND menu.restaurant_id = restaurant.id LIMIT 1 ";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Restaurant ID does not exist. " .mysqli_error($connection));
			}elseif(mysqli_num_rows($result)!=0){ 
					$result_array = mysqli_fetch_assoc($result);
					$menu_id_again = $result_array["id"];
				?>
				<div id="decision">
					<form action="view_rest_process.php" method="get">
						Are You Sure You Want To DELETE <span style="font-weight: bolder;"> <?php echo " ' ". $result_array["food_item"] ." ' " . " From " . $result_array["restaurant_name"]; ?></span> Menu???<br /><br /><br />
						<span>
							<a href="view_rest_process.php?no_menu=redirect">No</a> 
						</sapn>
						<sapn>
							<a href="view_rest_process.php?<?php echo $a ?>&yes_menu=<?php echo $menu_id_again; ?>&<?php echo $b; ?>">Yes</a>
						</span>	
					</form>
				</div>
		<?php
			}
		}else{
			redirect_to("index.php");
		}
		
	}
?>
<?php 
	if (isset($_GET["yes_menu"])) {
		$yes_menu_id  = $_GET["yes_menu"];
		if (is_numeric($yes_menu_id)) {
			$query = "DELETE FROM menu WHERE menu.id = $yes_menu_id LIMIT 1";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Could Not Delete Menu" . mysqli_error($connection));
			}else{
				echo 'Menu deletion successful';
			}
		}
	}elseif (isset($_GET["no_menu"])) {
		$no = $_GET["no_menu"];
		if ($no === "redirect") {
			redirect_to("index.php");
		}else{
			die("oooooppss");
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
			span a{
				color: #ccc;
				font-weight: bold;
				height: 30px;
				background-color: red;
				padding: 1em;
				width: 150px;
				text-align: center;
				border: 2px solid white;
				margin: 20px;
				margin-top: 100px;
				font-family: Tahoma;
				text-decoration: none;
			}
			span a:visited{
				color: #ccc;
			}
			span a:hover{
				text-decoration: italic;
				font-weight: bolder;

			}
			#decision{
				text-align: center; 
				color: #ccc; 
				font: 1.5em Tahoma; 
				width: 100%;
			}
			#decision input{
				margin: 40px;
				color: #ccc;
				background-color: red;
				padding: 0.5em;
				font: 1em Tahoma;
				cursor: hand;
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