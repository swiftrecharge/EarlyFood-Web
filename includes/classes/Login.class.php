<?php require_once("includes.php"); ?>

<?php 
	
	class Login {

		public $Email; public $Password; public $userMail; public $reset_error;

		public function login_user(){

			$txtEmail = $_POST["txtEmail"];
			$txtPassword = $_POST["txtPassword"];
			$this -> userMail = $txtEmail;

			$validate_login = new ValidateLogin();
			$members = new Members();
			#that is been taken care of by the validate class
			if ($validate_login -> login_user($txtEmail, $txtPassword)) {
				$_SESSION["logged_user_id"] = $validate_login -> get_userid();
				$_SESSION["logged_user_first_name"] = $members -> first_name($_SESSION["logged_user_id"]);
				//checck to see cookie does not already exist
				$this -> userMail = "";
				return true;
			}elseif(!$validate_login -> login_user($txtEmail, $txtPassword)){
				$this -> Email  = $validate_login -> error_mail_message;
				$this -> Password = $validate_login -> error_pass_message;
				return false;
			}
		}

		public function reset_password(){
			$txtEmail = $_POST["textRegisteredEmail"];
			$_SESSION["textRegisteredEmail"] = $txtEmail;
			$database = new Database();
			if(empty($txtEmail)){
				$this -> reset_error = "Email is empty!";
				return false;
			}elseif (!(filter_var($txtEmail, FILTER_VALIDATE_EMAIL))) {
				$this -> reset_error = "Email not valid!";
				return false;
			}else{
				// check to ensure the mail does not already exist
				$ref = "email_address";
				$value = $txtEmail;
				$database -> set_table("members");
				$database -> get_table();
				$database -> find_by_sql($ref, $value);
				$database -> set_result();
				$result = $database -> get_result();
				if (mysqli_num_rows($result)==0) {
					$this -> reset_error = "Email Address Not Registered in Our System.";
					return false;
				}else{
					redirect_to("rSuccess.php");
				}
			}
		}

	}

	$login = new Login();

?>