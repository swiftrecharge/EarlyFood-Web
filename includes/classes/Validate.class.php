<?php require_once("includes.php"); ?>
<?php 
	class ValidateRegistration { 

		public $error_email_message;
		public $error_pass_message;
		public $error_min_max;

		public function strong_password($txtPassword){

			//should not be empty or have a zero value
			//should have atleast one uppercase and lowercase letter
			// should have one symbol
			// should have one numeral

			/*if (empty($txtPassword)) {
				$this -> error_pass_message = "Password is empty!";
				return false;
			}elseif(!ereg('[A-Z]', $txtPassword)){
				$this -> error_pass_message = "Password Should have atleast one uppper case letter.";
				return false;
			}elseif(!ereg('[a-z]', $txtPassword)){
				$this -> error_pass_message = "Password Should have atleast one lower case letter.";
				return false;

			}elseif (!ereg('[0-9]', $txtPassword)) {
				$this -> error_pass_message = "Password should contain atleast one numeral.";
				return false;
			}elseif(!ereg("@#*", $txtPassword)){
				$this ->error_pass_message = "Password should contain atleast one special symbol eg (@ # *)";
				return false;
			}else{
				return true;
			} */

			if (empty($txtPassword)) {
				$this -> error_pass_message = "Password is empty!";
				return false;
			}elseif (strlen($txtPassword) < 4 ) {
				$this -> error_pass_message = "Password must be atleast four(4) Characters.";
			}else{
				return true;
			}
		}
	 	
		public function validate_email($txtEmail){
			$database = new Database();
			if(empty($txtEmail)){
				$this -> error_email_message = "Email is empty!";
				return false;
			}elseif (!(filter_var($txtEmail, FILTER_VALIDATE_EMAIL))) {
				$this -> error_email_message = "Email not valid!";
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
				if (mysqli_num_rows($result)!=0) {
					$this -> error_email_message = "Email Already Used!";
					return false;
				}else{
					return true;
				}
			}
		}
	 
		public function min_max_name($txtName){
			if (strlen($txtName) < 3) {
				$this -> error_min_max = "Characters Should Be Atleast Three.";
				return false;
			}elseif (strlen($txtName) > 30) {
				$this -> error_min_max = "Characters must not exceed thirty(30).";
				return false;
			}else{
				return true;
			}
		}
	}
?>

<?php $validate_registration = new ValidateRegistration(); ?>

<?php 

	class ValidateLogin {
		public $error_mail_message;
		public $error_pass_message;
		private $user_id;
		public function login_user($txtEmail, $txtPass){
			$database = new Database();
			if (empty($txtEmail)) {
				$this -> error_mail_message = "Email is empty!";
				return false;
			}elseif(empty($txtPass)){
				$this -> error_pass_message = "Password is empty";
				return false;
			}else{
				//check that the said email is in the database
				$ref = "email_address";
				$value = $txtEmail;
				$database -> set_table("members");
				$database -> get_table();
				$database -> find_by_sql($ref, $value);
				$database -> set_result();
				$result = $database -> get_result();
				$result_array = mysqli_fetch_assoc($result);
				if (mysqli_num_rows($result)==0) {
					$this -> error_mail_message = "Email Not Found!";
					return false;
				}else{
					$hashedPass = $result_array["user_password"];
					if ($database -> decrypt($txtPass, $hashedPass)) { 
						//$lecturer -> get_lecturerId(); no need to get it here
						$this -> user_id = $result_array["id"];
						$this -> set_userid();
						return true;
					}else{
						$this -> error_pass_message = "Wrong Password! Try Again.";
						return false;
					}
				}

			}
		}

		public function set_userid(){
				return $this -> user_id;
			}

		public function get_userid(){
			return $this -> set_userid();
		}
		
	}
?>
<?php $validate_login = new ValidateLogin(); ?>