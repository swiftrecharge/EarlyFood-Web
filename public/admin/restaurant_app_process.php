<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
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
					<form action="restaurant_app_process.php" method="get">
						Are You Sure You Want To DELETE <span style="font-weight: bolder;"> "<?php echo $result_array["restaurant_name"]; ?>"</span> Application???<br /><br /><br />
						<span>
							<a href="restaurant_app_process.php?no=redirect">No</a> 
						</sapn>
						<sapn>
							<a href="restaurant_app_process.php?yes=<?php echo $id_again; ?>">Yes</a>
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