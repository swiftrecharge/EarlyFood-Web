<?php
//include("../includes/classes/includes.php");
//require_once("../../includes/redirect.php");
//require_once("../../includes/functions.php");
//connect_to_db();
//Fetch rating deatails from database
$query = "SELECT rating_number, FORMAT((total_points / rating_number),1) as average_rating FROM post_rating WHERE post_id = 1 AND status = 1";
$result = mysqli_query($connection, $query);
$ratingRow = mysqli_fetch_assoc($result);
?>
<link href="rating/rating.css" rel="stylesheet" type="text/css">
<!--<script src="../includes/layout/js/jquery-2.2.4.min.js"></script> -->
<script type="text/javascript" src="rating/rating.js"></script>
<script language="javascript" type="text/javascript">
$(function() {
    $(".rating_star").codexworld_rating_widget({
        starLength: '5',
        initialValue: '',
        callbackFunctionName: 'processRating',
        imageDirectory: 'rating/images/',
        inputAttr: 'postID'
    });
});

function processRating(val, attrVal){
    $.ajax({
        type: 'POST',
        url: 'rating/rating.php',
        data: 'postID='+attrVal+'&ratingPoints='+val,
        dataType: 'json',
        success : function(data) {
            if (data.status == 'ok') {
                alert('You have rated');
                $('.avgrat').text(data.average_rating);
                $('.totalrat').text(data.rating_number);
            }else{
                alert('Some problem occured, please try again.');
            }
        }
    });
}
</script>
<style type="text/css">
    .overall-rating{font-size: 14px;margin-top: 5px;color: #8e8d8d;}
</style>
    
