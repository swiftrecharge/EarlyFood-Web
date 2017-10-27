<?php 
	
	if (isset($_POST['load_coupon_personal'])) {
		$mess = "";
		$code1 = $_POST['coupon_code1'];
		$code2 =$_POST['coupon_code2'];
		if (empty($code1) || empty($code2)) {
			$mess = $coupon -> couponLoadStatus = "All Fields are Required.";
		}elseif ($code1!==$code2) {
			$mess = $coupon -> couponLoadStatus = "Coupon Codes Donot Match.";
		}else{
			if ($coupon -> load_coupon($code1)) {
				//coupon load successfull
				$mess = $coupon -> couponLoadStatus; 
			}else{
				$mess = $coupon -> couponLoadStatus; 
			}
		}
	}
	
?>
