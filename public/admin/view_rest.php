<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<?php $a = "gosdjasdimmciwujaxckk=348792jkxc8ucjdfkhsdkfjnhdmhdjwjk&hkjewjemklwejlkkjcashjcajhasdcajsj=jkkhfsdfjs2189jfc8cmsjdkfksdjfs2cu&sdjksdfjsdkjsdjjjdjsk&jkasduwmcvxuemewiewcmereysdryercyeweoueuwiei=2729asj8&hjsywehbiAsjdsj=euwe723822jsjsjd&sjkfsjkdfsdfk893=sdi289sdfjk89fjd&jmlksdjksjfsj=uqu782jsdjjsdjfsdmynamewaswahtithoughtittobenenever&ajdajsdmjemkldsfsqonxnzsdfsh=djbateioerwj38sudf87wu89jkfje8r92ijsdbhayd723heiywj"; 
	$b = "jkasduwmcvxuemewiewcmereysdryercyeweoueuwiei=2729asj8&hjsywehbiAsjdsj=euwe723822jsjsjd&sjkfsjkdfsdfk893=sdi289sdfjk89fjd&jmlksdjksjfsj=uqu782jsdjjsdjfsdmynamewaswahtithoughtittobenenever&ajdajsdmjemkldsfsqonxnzsdfsh=djbateioerwj38sudf87wu89jkfje8r92ijsdbhayd723heiywj";
?>
<link rel="stylesheet" type="text/css" href="css/restaurant.css">
<div id="order_title">
	<img class="main" src="images/logo.png" alt="" /><span><em>Registered Restaurants</em></span>
</div>		

<!-- //obtain the restaurant details  //option to delete  //view corresponding menu -->
<table border="0" CELLSPACING="20">
	<tr>
		<th>Restaurant ID</th>
		<th>Name</th>
		<th>Region</th>
		<th>District</th>
		<th>Street Address</th>
		<th>Working Days</th>
		<th>Working Hours</th>
		<th>Visibility Status</th>
		<th>Slogan</th>
	</tr>
	<?php 
		$query = "SELECT * FROM restaurant";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Database connection failed. " . mysqli_error($connection));
		}else{
			while ($value = mysqli_fetch_assoc($result)) { ?>
				<tr>
					<td><?php echo $value["id"] ?></td>
					<td><?php echo $value["restaurant_name"]; ?></td>
					<td><?php echo $value["loc_region"]; ?></td>
					<td><?php echo $value["loc_district"]; ?></td>
					<td><?php echo $value["street_address"]; ?></td>
					<td><?php echo $value["working_days"]; ?></td>
					<td><?php echo $value["working_hours"]; ?></td>
					<td><?php echo $value["visible"]; ?></td>
					<td><?php echo $value["slogan"]; ?></td>
					<td>
						<a href="view_rest_process.php?<?php echo $a; ?>&delete=<?php echo $value["id"] ?>&<?php echo $b; ?>">Delete</a><br /><br />
						<a href="view_rest_process.php?menu=<?php echo $value["id"] ?>">View Menu</a>
					</td>
				</tr
				<tr>
					<td border="0" colspan="9"><hr></td>
				</tr>
		<?php		
			}
		}
	?>
</table>				
<?php close_db(); ?>