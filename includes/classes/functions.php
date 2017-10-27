<?php 
	function redirect_to($new_location){
		Header("Location: $new_location");
		exit;
	}
	function Selected($default_string, $string){
		return $default_string != $string ? true : false;
	}
	function log_erros($string){
		error_log($string, 0);
	}
?>