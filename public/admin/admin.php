
<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>
<link rel="stylesheet" type="text/css" href="css/admin.css">
	
<div id="add_admin" class="jumbotron">
	<!--<span>ADD ADMININSTRATOR</span><br /><br />-->
	<form method="post" action="index.php" class="row">
		<input type="submit" name="txtLogoutAdmin" value="Logout" class="col-sm-4">
	</form> <br /><br />
	<?php 

		if ($_SESSION["admin_logged_in"]=="dakurahsixtus@yahoo.com"){
			echo "Pending Admins<br /><br />";
			$result = get_pending_admins();
			while ($result_array = mysqli_fetch_assoc($result)) {
				?>
					<form method="post" action="index.php">
						<button><?php echo $result_array["email"]; ?></button>
						<input type="text" name="adminId" value="<?php echo $result_array["id"]; ?>">
						<input type="submit" value ="Click to Verify" name="verifyAdmin">
					</form>
				<?php
			}
		}

	?>

</div>
<div id="remove_admin">

</div>
<div id="suspend_admin">

</div>
<div id="pending_task_admin">

</div>
	