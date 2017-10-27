<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>

<?php 
	$id = $_POST['id'];
	$general_statement = $_POST["general_statement"]; $safe_general_statement = mysql_prep($connection, $general_statement);
	$kitchen_statement = $_POST["kitchen_statement"]; $safe_kitchen_statement = mysql_prep($connection, $kitchen_statement);
	$suggestion_statement = $_POST["suggestion_statement"]; $safe_suggestion_statement = mysql_prep($connection, $suggestion_statement);
	if (is_numeric($id)) {
		if (checkstatus($id)) {
			#update
			if (!empty($general_statement)) {
				$column = "general_statement";
				update_statement($id, $column, $safe_general_statement);
				echo "<br />";
			}
			if (!empty($kitchen_statement)) {
				$column = "kitchen_statement";
				update_statement($id, $column, $safe_kitchen_statement);
				echo "<br />";
			}
			if (!empty($suggestion_statement)) {
				$column = "suggestions";
				update_statement($id, $column, $safe_suggestion_statement);
				echo "<br />";
			}
		}else{
			#create
			if(add_statement($id, $safe_general_statement, $safe_kitchen_statement, $safe_suggestion_statement)){
				echo "<br />";
			}

		}
	}else{
		echo "Please Select the right id";
	}
?>


<?php close_db(); ?>
<?php ob_flush(); ?>