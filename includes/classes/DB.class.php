<?php require_once("includes.php"); ?>
<?php 
	class Database{
		public $connection;
		protected $table_name;

		public function connect_to_db(){

			$this -> connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			if (!$this -> connection) {
				die("Could not estatblish connection. ". mysqli_connect_error());
			}
		}

		public function __construct(){
			//this ensures that my connection property is always available
			$this -> connect_to_db();
		}

		public function confirm_query($result){
			if (!$result) {
				die("Database connetion failed. " . mysqli_error($this -> connection));
			}else{
				return true;
			}
		}

		public function find_by_mail($email){
			$query = "SELECT id FROM members WHERE email_address = '$email' LIMIT 1";
			$result = $this -> find_by_query($query);
			return $result;
		}
		public function get_last_inserted_id($sql){
			if (mysqli_query($this -> connection, $sql)) {
			    $last_id = mysqli_insert_id($this -> connection);
			    echo "New record created successfully. Last inserted ID is: " . $last_id;
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($this -> connection);
			}
		}

		public function set_table($table){
			return $this -> table_name = $table;
		}

		public function get_table(){
			return $this -> set_table($this -> table_name);
		}

		public function find_by_id($id=""){
			//this uses the find by sql method
			$table = $this -> get_table();
			$this -> result = $this -> find_by_sql("id", $id);
			if ($this -> confirm_query($this -> result)) {
				return $this -> result;
			}else{
				die("Database connection failed. " . mysqli_error($thsi -> connection));
			}
		}

		public function find_by_sql($ref, $value){
			$table = $this -> get_table();
			$this -> query = "SELECT * FROM $table WHERE $ref = '{$value}' LIMIT 1";
			$this -> result = mysqli_query($this -> connection, $this -> query);
			if ($this -> confirm_query($this -> result)) {
				#everything is good
				return $this -> result;
			}else{
				die("Database connection failed." . mysqli_error($this -> connection));
			}
		}

		public function find_by_query($query){
			$result = mysqli_query($this -> connection, $query);
			if($this -> confirm_query($result)){
				return $result;	
			}
			
		}

		public function user_ip(){
			$clientIp = $_SERVER['HTTP_CLIENT_IP'];
			$xForwardedFor = $_SERVER['HTTP_XFORWADED_FOR'];
			$remoteAddress = $_SERVER['REMOTE_ADDR'];
			if (!empty($clientIp)) {
				$userIp = $clientIp;
			}elseif (!empty($xForwardedFor)) {
				$userIp = $xForwardedFor;
			}else{
				$userIp = $remoteAddress;
			}

			return $userIp;
		}

		public function set_result(){
			return $this -> result; 
		}

		public function get_result(){
			//obtain the result and set it
			return $this -> set_result();
		}

		public function encrypt($password){
			/* implementation taken out */
			return $hashed_password;
		}

		public function generate_salt($length){
			/* implementation taken out */
			return $salt;
		}

		public function decrypt($password, $existing_hash){
			$hash = crypt($password, $existing_hash);
			if ($hash === $existing_hash) {
				return true;
			}else{
				return false;
			}
		}

		public function escape_string($string){
			return mysqli_real_escape_string($this -> connection, $string);
		}

		public function register_user($safeFname, $safeLname, $safeEmail,
									  $hashed_pass, $safeOccupation,
									  $birth_date, $emailNotif, $smsNotif,
									  $safePhone, $safeReferer){
			$query  = "INSERT INTO  ";
			$query .= "members (first_name, last_name, email_address, user_password, occupation, birth_date, email_notifs, text_notifs, phone_number, referer) ";
			$query .= "VALUES ('{$safeFname}', '{$safeLname}', '{$safeEmail}', '{$hashed_pass}', '{$safeOccupation}', '{$birth_date}', {$emailNotif}, {$smsNotif}, {$safePhone}, '{$safeReferer}') ";
			$result = mysqli_query($this -> connection, $query);
			return $this -> confirm_query($result);
		}

		public function update_user($column, $value, $id){
			$query = "UPDATE members SET $column = '{$value}' WHERE id = $id LIMIT 1 ";
			$result = mysqli_query($this -> connection, $query);
			if(!$result){
				die("Database connection failed. " . mysqli_error($this -> connection));
				return false;
			}else{
				return true;
			}
		}

		public function create_reset_record($user_id, $hashed_string){
			$query  = "INSERT INTO  ";
			$query .= "password_reset (hashed_link, user_id) ";
			$query .= "VALUES ('{$hashed_string}', $user_id) ";
			$result = mysqli_query($this -> connection, $query);
			return $this -> confirm_query($result);
			echo $user_id;
			echo $hashed_string;
			die(mysqli_connect_error($database -> connection));
		}

		public function update_reset_record($user_id, $hashed_string){
			$query = "UPDATE password_reset SET hashed_link = '$hashed_string' WHERE user_id = $user_id";
			$result = mysqli_query($this -> connection, $query);
			return $this -> confirm_query($result);
		}

		public function create_or_update($user_id, $hashed_string){
			$query = "SELECT * FROM password_reset WHERE user_id = $user_id";
			$result = $this -> find_by_query($query);

			if (mysqli_num_rows($result)==0) {
				$this -> create_reset_record($user_id, $hashed_string);
				
			}else{
				# update record already exist
				$this -> update_reset_record($user_id, $hashed_string);
			}
		}

		public function delete_reset_record($user_id){
			$query = "DELETE FROM password_reset WHERE user_id = $user_id LIMIT 1";
			$result = mysqli_query($this -> connection, $query);
			return $this -> confirm_query($result);
		}
		public function close_db(){
			return mysqli_close($this -> connection);
		}

	}
	$database = new Database();
?>