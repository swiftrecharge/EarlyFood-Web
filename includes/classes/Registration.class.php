<?php require_once("includes.php"); ?>
<?php 
	class Registration{
		public $min_max; public $mail; public $pass; public $birthday; public $referer; 
		public $Fname; public $Lname; public $Email; 
		public $Occupation; public $Referer; public $Birthday;

		public function create_user(){

					$txtEmail = trim($_POST["txtEmail"]);
					$txtPassword = trim($_POST["txtPassword"]); 
					$txtFname = trim($_POST["txtFname"]); 
					$txtLname = trim($_POST["txtLname"]); 
					$txtPhone = trim($_POST["txtPhone"]); 
					$txtOccupation = trim($_POST["txtOccupation"]); 
					$txtDay = $_POST["txtDay"]; 
					$txtMonth = $_POST["txtMonth"]; 
					$txtYear = $_POST["txtYear"]; 
					$txtReferer = $_POST["txtReferer"];
					$txtEmailnotif = $_POST["txtEmailnotif"];
					$txtSMSnotif = $_POST["txtSMSnotif"];

					$this -> Fname = $txtFname; $this -> Lname = $txtLname; $this -> Email = $txtEmail;
					$this -> Email = $txtEmail; $this -> Phone = $txtPhone; $this -> Occupation =  $txtOccupation;

					$database = new Database();
					$coupon = new CouponBank();
					$validate_registration = new ValidateRegistration();

					if (!($validate_registration -> validate_email($txtEmail))) {
						//echo $validate_registration -> error_email_message;
						$this -> mail = $validate_registration -> error_email_message;
						return false;
					}elseif (!($validate_registration -> strong_password($txtPassword))) {
						$this -> pass = $validate_registration -> error_pass_message;
						return false;
					}elseif (!($validate_registration -> min_max_name($txtFname))) {
						$this -> min_max = $validate_registration -> error_min_max;
						return false;
					}elseif (!($validate_registration -> min_max_name($txtLname))) {
						$this -> min_max = $validate_registration -> error_min_max;
						return false;
					}elseif (!Selected("Day", $txtDay) || !Selected("Month", $txtMonth) || !Selected("Year", $txtYear)) {
						$this -> birthday = "Birthdate not complete!";
						return false;
						
					}elseif (!Selected("Select", $txtReferer)) {
						$this -> referer = "Please Select";
						return false;
					}else{
						$smsNotif = isset($txtSMSnotif) ? 1 : 0;
						$emailNotif = isset($txtEmailnotif) ? 1 : 0;
						$database = new Database();
						$safeFname = $database -> escape_string($txtFname);
						$safeLname = $database -> escape_string($txtLname);
						$safePass = $database -> escape_string($txtPassword);
						$hashedPass = $database -> encrypt($safePass);
						$safeEmail = $database -> escape_string($txtEmail);
						$safeOccupation =  $database -> escape_string($txtOccupation);
						$safePhone = $database -> escape_string($txtPhone);
						$birth_date = $txtDay . " " . $txtMonth . " " . $txtYear;

						$success = $database -> register_user(
													  $safeFname, $safeLname, $safeEmail,
													  $hashedPass, $safeOccupation,
													  $birth_date, $emailNotif, $smsNotif,
													  $safePhone, $txtReferer
												  );
						if (!$success) {
							return false;
						}else{
							// account was successfully created, initailize wallet
							$result = $database -> find_by_mail($safeEmail);
							$user_id = mysqli_fetch_assoc($result)['id'];
							$check = $coupon -> get_existing_balance($user_id);
							if (is_null($check)) {
								#initialize
								$coupon -> initialise_wallet($user_id);
								return true;
							}else{
								//account probably already exist
							}
						}
					}

				}
	} 

	$registration = new Registration();
?>