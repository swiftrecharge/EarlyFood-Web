<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<span>Add Or Update The Restaurant Statement.</span><br />
<span>For Updates, Just Input Text for the Relevant  Columns</span><br /><br />
<form method="post" action="restaurant_statement_process.php">
	<select name="id">
		<option>Restaurant ID</option>
			<?php
				$query = "SELECT * FROM restaurant";
				$result = mysqli_query($connection, $query);
				while($id = mysqli_fetch_assoc($result)){ ?>
				
					 <option><?php echo $id["id"]; ?></option>
			<?php
				}
			?>
		</select>
		<br /><br />
	<div id="address">
		<span>General Statement</span><br />
		<textarea name="general_statement" cols="30" rows="5"></textarea>
	</div><br />
	<div id="address">
		<span>Kitchen Statement</span><br />
		<textarea name="kitchen_statement" cols="30" rows="5"></textarea>
	</div><br />
	<div id="address">
		<span>Suggestion Statement</span><br />
		<textarea name="suggestion_statement" cols="30" rows="5"></textarea>
	</div><br />
	<input type="submit" name="submit_statement" value ="Add/Update">
</form>
<?php close_db(); ?>
<?php ob_flush(); ?>