<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
   <title>Test Page</title>
   <script>
    function passVal(){
        var data = {
            fn: "filename",
            str: "this_is_a_dummy_test_string"
        };

        $.post("location.php", data);
    }
    passVal();

    $('#editRole').on('show.bs.modal', function (e) {  

        $roleID =  $(e.relatedTarget).attr('data-id');

        //ajax call 
        $.ajax({
             url: "location.php",
             data: { role: $roleID }
        });                             
    }); 
   </script>

</head>
<body>
</body>
<?php 
 echo input('role');
   //$fn  = $_POST['fn'];
   //$str = $_POST['str'];
   //$file = fopen("/opt/lampp/htdocs/passVal/".$fn.".record","w");
   //echo fwrite($file,$str);
   //fclose($file);
?>
</html>