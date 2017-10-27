<?php session_start(); ?>
<?php require_once("../../includes/redirect.php") ?>
<?php require_once("../../includes/functions.php") ?>
<?php connect_to_db(); ?>

<?php 
	if (isset($_POST["get_logo"])) {
		$restaurant_name = $_POST["name"];
		$restaurant_id = $_POST["id"];
		if (($restaurant_name!="Select Restaurant" && $restaurant_id!="Select ID")) {
			//confirm pair
			$query = "SELECT restaurant_name, logo FROM restaurant WHERE id = $restaurant_id";
			$result_array = mysqli_fetch_assoc(mysqli_query($connection, $query));
			if ($result_array["restaurant_name"]==$restaurant_name) {
				//everything is good proceed
				$_SESSION["logo_id"] = $restaurant_id;

					if ($result_array["logo"]!="") {
						// picture alredy exist request for update
						echo "This Is The current Image <br /><br />";
							$logo_id = $_SESSION["logo_id"];
							$query = "SELECT logo FROM restaurant WHERE id = $logo_id";
							$result_array = mysqli_fetch_assoc(mysqli_query($connection, $query));
							$image = $result_array["logo"];

							echo "<img src=\"../../restaurantspage/rlogo/$image\"><br /><br />";

							// option for update
							//close php for html
							
					?>

					 	<span>Upload A New File To Update It.  Note: The filename will be changed to the Restaurant ID.</span><br /><br />
					 	<form action="restaurant_logo_process.php" enctype="multipart/form-data" method="post">
							<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
							<input type="file" name="file_upload" />
							<input type="submit" value="Upload " name="upload" />
						</form>

					 <?php	

					}else{
						//picture does not exist request for upload 

					 ?>

					 	<span>Please Upload The Restaurant Logo.  Note: The filename will be changed to the Restaurant ID.</span><br /><br />
					 	<form action="restaurant_logo_process.php" enctype="multipart/form-data" method="post">
							<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
							<input type="file" name="file_upload" />
							<input type="submit" value="Upload " name="upload" />
						</form>

					 <?php
					}


			}else{
				echo "Restaurant Name and Restaurant ID do not match. Please Try again!";
			}
		}
	}
?>
<?php 
	//error uploads array
	$upload_errors = array(
			UPLOAD_ERR_OK			 => "No errors.",
			UPLOAD_ERR_INI_SIZE 	 => "Larger than upload_max_filesize.",
			UPLOAD_ERR_FORM_SIZE	 => "Larger than form MAX_FILE_SIZE.",
			UPLOAD_ERR_PARTIAL		 =>"Partial upload.",
			UPLOAD_ERR_NO_FILE		 => "No file.",
			UPLOAD_ERR_NO_TMP_DIR	 => "No temporary directory.",
			UPLOAD_ERR_CANT_WRITE 	 => "Can't write to disk.",
			UPLOAD_ERR_EXTENSION 	 => "File upload stopped by extension"
		);

	//move uploaded file from temporary folder
	if (isset($_POST['upload'])) {
		// you wont get the chance to run this code if the restaurant name and id do not match
		$logo_id = $_SESSION["logo_id"];
		$query = "SELECT id FROM restaurant WHERE id = $logo_id";
		$result_array = mysqli_fetch_assoc(mysqli_query($connection, $query));
		$image = $result_array["id"];

		$file_size = $_FILES['file_upload']['size'];
		$tmp_file = $_FILES['file_upload']['tmp_name'];
		$target_file = basename($_FILES['file_upload']['name']);
		$extension = strtolower(substr($target_file, strpos($target_file, ".") + 1));
		$_FILES['file_upload']['name'] = $image. "." . $extension;
		$target_file = basename($_FILES['file_upload']['name']);
		$upload_dir = "../../restaurantspage/rlogo";
		$type = $_FILES["file_upload"]['type'];
		//$size = getimagesize($tmp_file);
		//echo $size["0"];
		//echo $extension = strtolower(substr($target_file, strpos($target_file, ".") + 1));
		//use move_uploaded_file() php function it returns true or false
		if ($file_size<=209752 && ($type=="image/jpeg" || $type=="image/png")) {
			if (move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
				// proceed to record it in the database
				$column = "logo";
				$value = $target_file;
				if (update_logo($column, $value, $image)) {
					$message = "File Uploaded Successful";
				}else{
					$message = "There was a problem uploading the file. Try again.";
				}
			}else{
				$upload_message = $_FILES['file_upload']['error'];
				$message = $upload_errors[$upload_message];
			}
		}else{
			echo "File is not an image file";
		} 
	} 
?>
<html>
	<head>
		<style type="text/css">
			body{
				background-color: #333 ;
				color: #ccc;
			}
			#link{
				height: 30px;
				background-color: red;
				padding-top: 1em;
				width: 150px;
				text-align: center;
				border: 2px solid white;
				margin-top: 100px;
				font-family: Tahoma;
			}
			#link a{
				color: #ccc;
				text-decoration: none;
			}
			#link a:visited{
				color: #ccc;
			}
			#link a:hover{
				text-decoration: none;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<?php if(isset($message)){ echo $message ."<br />";} ?>
		<!--<form action="uploads.php" enctype="multipart/form-data" method="post">
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			<input type="file" name="file_upload" />
			<input type="submit" value="Upload " name="upload" />
		</form> -->
		<div id="link">
			<a href="index.php">Return To Home</a>
		</div>
	</body>
</html>