<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>

<?php 

	if (isset($_POST["delivery_fee_set"])) {
		$restaurant_id = $_SESSION["id_delivery"];
		
		
		if (fee_switch($restaurant_id)) {
			//add new delivery fee

			if ($_POST["fee"] == "Select") {
				echo "You've not selected a valid delivery fee!";
				echo "<br /><br />";
				echo "<span style=\"color: white; font: 2em Tahoma;\"><a href=\"delivery_fee_set.php\">Back To Choose</a></span>";
				die();
			}else{
				$fee = $_POST["fee"];
			}
			

			create_fee($restaurant_id, $fee);
			echo "<br /><br />";
			echo "<a href=\"index.php\">Return Home</a>";
		}else{
			//update delivery fee
				if ($_POST["fee"] != "Select") {
					$fee = $_POST["fee"];
					$column = "delivery_fee";
					update_fee($restaurant_id, $column, $fee);
				}
			echo "<br /><br />";
			echo "<a href=\"index.php\">Return Home</a>";
		}

	}

?>

<?php close_db(); ?>