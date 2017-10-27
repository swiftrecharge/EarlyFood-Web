<?php include("includes/classes/includes.php"); ?>


<?php 
	$str = strtotime('11:19 AM');
	$now = "now";
	$current = strtotime($now);
	$time = "11:19 AM"; 
	$str = strtotime($time. ' +4 hours');
	echo date(DATE_RSS, $current);
	echo "<br />";
	echo date(DATE_RSS, $str);
	echo "<br />";
	$day = date('l', $str);
	echo $day;
	echo "<br />";
	$current = strtotime('now');
	if ($str > $current){
		echo "Its not yet time. Restaurant to open at ". date(DATE_RSS, $str). " current time is ". date(DATE_RSS, $current);
		echo "<br />";
		echo $str;
		echo "<br />";
		echo strtotime('now');
		echo "<br />";
		echo date(DATE_RSS, $current);
	}else{
		echo "Its time. Restaurant to open at ". date(DATE_RSS, $str). " current time is ". date(DATE_RSS, $current);
		echo "its not time";
		echo "<br />";
		echo $str;
		echo "<br />";
		echo strtotime('now');
		echo "<br />";
		echo date(DATE_RSS, $current);
	}
?>
