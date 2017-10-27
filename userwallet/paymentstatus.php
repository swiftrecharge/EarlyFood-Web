<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../includes/classes/includes.php"); ?>
<?php //include("../includes/layout/header.php"); ?>
<?php //include("mpower_php/mpower.php"); ?>
<?php //require_once("mpower_config.php"); ?>

<?php 
	if (isset($_SESSION["deposit_invoice"])) {
		$get_id = $_GET["invoice_id"];
		//if ($get_id == $_SESSION["deposit_invoice"]) {
			#invoice numbers match
			$merchant_key = "dbf84458-212f-11e7-bf7c-f23c9170642f";
			$id = $_SESSION["deposit_invoice"];
			$ch = curl_init("https://community.ipaygh.com/v1/gateway/status_chk?invoice_id=$id&merchant_key=$merchant_key"); // such as http://example.com/example.xml
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$data = curl_exec($ch);
			$strArray = explode('~',$data);
			$name = $strArray[1];
			curl_close($ch);

			if ($name=="cancelled") {
				unset($_SESSION["deposit_invoice"]);
				echo "You Have Cancelled The Transaction!<br /><br />";
				echo "<a href=\"../memberspage/members.php\" target=\"_parent\">Click Here To Exit</a>";
			}elseif ($name=="paid") {
				unset($_SESSION["deposit_invoice"]);
				#payment successful, create record
				$totalCost = $_COOKIE["xyz"];
				$order_amount =  $totalCost;
				$user_id = $_SESSION['logged_user_id'];
				$orders -> update_balance_with_order($order_amount, $user_id);
				$transaction_id = 0;
				$transaction_amount = $totalCost;
				$balance = $coupon -> get_existing_balance($user_id);
				$transaction_details = "Deposited Money Into Your EarlyFood Wallet";
				$transaction_charges = 0;
				$orders -> create_transaction_record($user_id, $transaction_id, $balance, $transaction_amount, $transaction_details, $transaction_charges);
				echo "You Have Succesfully Deposited Money Into Your Wallet!<br /><br />";
				echo "<a href=\"../memberspage/members.php\" target=\"_parent\">Click Here To Exit</a>";
			}
	}
?>

<?php //include("../includes/layout/footer.php"); ?>
<?php ob_flush(); ?>