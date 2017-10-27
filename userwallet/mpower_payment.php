<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("../includes/layout/header.php"); ?>
<?php include("mpower_php/mpower.php"); ?>
<?php require_once("mpower_config.php"); ?>


<?php 
	
	//Setup your Store information
	MPower_Checkout_Store::setName("EarlyFood");
	MPower_Checkout_Store::setTagline("EarlyFood Wallet");
	MPower_Checkout_Store::setPhoneNumber("050-138-4064/0541772320");
	MPower_Checkout_Store::setPostalAddress("West End Drive Way, Kumasi");
 
 if (isset($_POST["txtDeposit"])) {
 	// If you wish to accept payments directly on your service
 	$totalAmount = $_POST["txtAmount"];
 	//echo $totalAmount;
	//$invoice = new MPower_Onsite_Invoice();
	$direct_pay = new MPower_DirectPay();
	if ($direct_pay->creditAccount("0541772320",100)) {
	  print $direct_pay->description;
	  print $direct_pay->response_text;
	  print $direct_pay->transaction_id;
	}else{
	  print $direct_pay->response_text;
	}
 }
	
?>
<?php include("../includes/layout/footer.php"); ?>
<?php ob_flush(); ?>