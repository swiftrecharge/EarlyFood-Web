<?php
//require_once("../../includes/functions.php");
//include_once("../includes/classes/includes.php");
if(!empty($_POST['ratingPoints'])){
    $postID = $_POST['postID'];
    $ratingNum = 1;
    $ratingPoints = $_POST['ratingPoints'];
    
    //Check the rating row with same post ID
    $prevRatingQuery = "SELECT * FROM post_rating WHERE post_id = ".$postID;
    $prevRatingResult = mysqli_query($connection, $prevRatingQuery);
    if(mysqli_num_rows($database-> connection, $prevRatingResult) > 0):
        $prevRatingRow = mysqli_fetch_assoc($prevRatingResult);
        $ratingNum = $prevRatingRow['rating_number'] + $ratingNum;
        $ratingPoints = $prevRatingRow['total_points'] + $ratingPoints;
        //Update rating data into the database
        $query = "UPDATE post_rating SET rating_number = '".$ratingNum."', total_points = '".$ratingPoints."', modified = '".date("Y-m-d H:i:s")."' WHERE post_id = ".$postID;
        $update = mysqli_query($connection, $query);
        //$database -> confirm_query($update);
    else:
        //Insert rating data into the database
        $query = "INSERT INTO post_rating (post_id,rating_number,total_points,created,modified) VALUES(".$postID.",'".$ratingNum."','".$ratingPoints."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')";
        $insert = mysqli_query($connection, $query);
    endif;
    
    //Fetch rating deatails from database
    $query2 = "SELECT rating_number, FORMAT((total_points / rating_number),1) as average_rating FROM post_rating WHERE post_id = ".$postID." AND status = 1";
    $result = mysqli_query($connection, $query);
    $ratingRow = mysqli_fetch_assoc($query);
    
    if($ratingRow){
        $ratingRow['status'] = 'ok';
    }else{
        $ratingRow['status'] = 'err';
    }
    
    //Return json formatted rating data
    echo json_encode($ratingRow);
}
?>