<?php session_start();  ?>
<?php require_once("../includes/redirect.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php connect_to_db(); ?>
<html>
	<head>
		<style type="text/css">
			#overlay{
				display: none;
				z-index: 2;
				background: #000;
				position: fixed;
				width: 100%;
				height: 100%;
				top: 0px;
				left: 0px;
				text-align: center;
			}
			#chatBox{
				margin-top: 10%;
				color: #ccc;
			}
			#tab textarea{
				padding: 0.3em;
			}
			#tab input{
				background: red;
				color: white;
				padding: 0.3em;
				font: 1.0em Tahoma;
			}
			#messages{
				background: grey;
				height: 300px;
				width: 20%;
				color: white;
				overflow-y: scroll;
			}
			#overlay input{
				padding: 0.3em;
				font: 1.0em Tahoma;
			}
		</style>
		<title>arlyFood | Update</title>
		<link rel='shortcut icon' type='image/x-icon' href="../includes/layout/images/favicon.png" />
	</head>
	<body>
		<div id="overlay">
			<div id="chatBox">
				<?php 
				//email update
					if (isset($_POST["email"])) {
						$email = $_POST["mail_address"];
						if(validate_email($email)){
							$column = "email_address";
							$value = $email;
							$id = $_SESSION["logged_user_id"];
							//check to ensure the email does not already exist

							//if(email_exist($email)){
							//	echo "Email Address is already in our system.";
							if (update_user($column, $value, $id)) {
								echo "Email was successfully updated. Thank You!";
							}else{
								echo "There was a problem updating. Please Try again Later.";
							}
						}else{
							echo "Your new email address is not valid! Please Use a valid email.";
						}
					}
				?>
				<?php 
				//password update 
					if (isset($_POST["pass"])) {
						$old_pass = $_POST["password_old"];
						$new_pass = $_POST["password_new"];
						if (!empty($old_pass)&& !empty($new_pass)) {
							//retrive old password
							isset($_SESSION["logged_user_id"]) ? $user_id = $_SESSION["logged_user_id"] :  $user_id = null;
							if ($user_id!=null) {
								$query = "SELECT members.user_password FROM  members WHERE members.id = $user_id ";
								$result = mysqli_query($connection, $query);
								if (!$result) {
									echo "There was a problem confirming your request! Please Try again shortly.";
								}else{
									$result_array = mysqli_fetch_assoc($result);
									$stored_pass = $result_array["user_password"];
									//now confirm that the old pass is equal to the stored one
									//return $confirm = encrypt($old_pass)===$stored_pass ? true : false;
									if (decrypt($old_pass, $stored_pass)) {
										//proceed to verify new one
										$column = "user_password";
										$value = encrypt($new_pass);
										$id = $_SESSION["logged_user_id"];
										if (update_user($column, $value, $id)) {
											echo "Password was succcessfully updated.";
										}else{
											echo "There was a problem updating. Try again";
										}
									}else{
										echo "Current password does not match what you've provided. Please Try again!.";
									}

								}
							}
						}else{
							echo " Make sure both the current password and old passowrd are present.";
						}
					}
				?>
				<?php 
					//phone update
					if (isset($_POST["phone_update"])) {
						$phone = $_POST["phone"];
						if (is_numeric($phone)) {
							$column = "phone_number";
							$value = $phone;
							$id = $_SESSION["logged_user_id"];
							if (update_user($column, $value, $id)) {
								echo "Phone Number was successfully updated";
							}else{
								echo "There was a problem updating your contact. Please try again!";
							}
						}else{
							echo "This is not a valid phone number. Please input a valid phone number!";
						}
					}

				?>
				<?php 
					//update occupation
					if (isset($_POST["occu_update"])) {
						$occu = $_POST["occu"];
						if (!empty($occu)) {
							$column = "occupation";
							$value = $occu;
							$id = $_SESSION["logged_user_id"];
							if (update_user($column, $value, $id)) {
								echo "Occupation Update Successful!";
							}else{
								echo "There was a problem updating Occupation. Please try again!";
							}
						}else{
							echo "Field is empty. Please type your occupation!";
						}
					}
				?>
				<?php 
					//update address
					if (isset($_POST["address_update"])) {
						$address = $_POST["address"];
						if (!empty($address)) {
							$column = "street_address";
							$value = $address;
							$id = $_SESSION["logged_user_id"];
							if (update_user($column, $value, $id)) {
								echo "Street address Update Successful!";
							}else{
								echo "There was a problem updating Address. Please try again!";
							}
						}else{
							echo "Field is empty. Please type your address!";
						}
					}
				?>
			</div><br /><br /><br /><br /><br /><br />
			<center><input type="button" value="Ok" onClick="return_to()";></center>
		</div>
		<script type="text/javascript">
			function return_to(){
				window.location = "members.php";
			}
			function toggleChat(){
				var overlay = document.getElementById('overlay');
				var closeOverlay = document.getElementById('close_overlay');
				overlay.style.opacity = 0.9;
				if (overlay.style.display == "block") {
					overlay.style.display = "none";
					closeOverlay.style.display = "none";
				}else{
					overlay.style.display = "block";
					closeOverlay.style.display = "block";
				}
			}
			window.load(toggleChat());
		</script>
	</body>
</htnl>
<?php close_db(); ?>