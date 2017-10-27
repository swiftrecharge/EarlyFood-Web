<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>

<?php 

	if (isset($_POST["add_restaurant_details_operations"])) {
		$restaurant_id = $_SESSION["id_operations"];
		
		
		if (operation_time_switch($restaurant_id)) {
			//add new registration

			$days_array = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
			foreach ($days_array as $day) {
			 	
				$morning = $day."_opening";
				$evening = $day."_closing";
				if ($_POST[$morning] == "Select" || $_POST[$evening] == "Select") {
					echo "You've not selected a valid opening or closing time!";
					echo "<br /><br />";
					echo "<span style=\"color: white; font: 2em Tahoma;\"><a href=\"restaurant_operations.php\">Back To Choose</a></span>";
					die();
				}
			}

			$opening_m = $_POST["monday_opening"]; $closing_m = $_POST["monday_closing"];
			$opening_t = $_POST["tuesday_opening"]; $closing_t = $_POST["tuesday_closing"];
			$opening_w = $_POST["wednesday_opening"]; $closing_w = $_POST["wednesday_closing"];
			$opening_th = $_POST["thursday_opening"]; $closing_th = $_POST["thursday_closing"];
			$opening_f = $_POST["friday_opening"]; $closing_f = $_POST["friday_closing"];
			$opening_sa = $_POST["saturday_opening"]; $closing_sa = $_POST["saturday_closing"];
			$opening_s = $_POST["sunday_opening"]; $closing_s = $_POST["sunday_closing"];
			opening_time($restaurant_id, $opening_m, $opening_t, $opening_w, $opening_th, $opening_f, $opening_sa, $opening_s);
			closing_time($restaurant_id, $closing_m, $closing_t, $closing_w, $closing_th, $closing_f, $closing_sa, $closing_s);
			echo "<br /><br />";
			echo "<a href=\"index.php\">Return Home</a>";
		}else{
			//update operation time

			$days_array = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
			foreach ($days_array as $day) {	
				$morning = $day."_opening";
				$evening = $day."_closing";
				$column = $day;
				if ($_POST[$morning] != "Select" || $_POST[$evening] != "Select") {
					$value1 = $_POST[$morning];
					$value2 = $_POST[$evening];
					update_operation_openingtime($restaurant_id, $column, $value1);
					update_operation_closingtime($restaurant_id, $column, $value2);
				}
			}
			echo "<br /><br />";
			echo "<a href=\"index.php\">Return Home</a>";
		}

	}

?>

<?php close_db(); ?>