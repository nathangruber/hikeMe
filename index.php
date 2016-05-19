<!DOCTYPE html>

<html lang="en">
<?php require_once 'includes/header.php';?>

<body>
    <title>hikeMe</title>
     <?php
    if ($admin) {
        require_once'includes/adminNavbar.php';
    } else {
        require_once'includes/navbar.php';
    }
    ?>
    <?php
    if ($logged) {
        echo "Welcome Back, ";
        echo $_SESSION['name'];
    }
    ?>
 

 <!-- http://api.openweathermap.org/data/2.5/forecast/city?id=524901&APPID=2bd428fa9cf856303ff450f01f4a97de  -->
<br>
<br>
<br>
<br>
<br>
<br>
<?php
 $url = "http://api.openweathermap.org/data/2.5/weather?q=milwaukee&APPID=2bd428fa9cf856303ff450f01f4a97de";
 $opts = array(
        'http' => array (
            'method' => 'GET'
        )   
    );
 $context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
 $file = file_get_contents($url, false, $context);  //read the contents of a file into a string
 $obj = json_decode($file);    //Takes a JSON encoded string and converts it into a PHP variable.
 print_r($obj);

 ?>

 <?php
 $url = "https://trailapi-trailapi.p.mashape.com/?q[city_cont]=Milwaukee";
 $opts = array(
        'http' => array (
            'method' => 'GET',
            'header' =>  "Accept: plain/text\r\n". "X-Mashape-Key:F1piInHfmpmsh4V6tDTrAboircv8p1s3rgAjsnO6TthOVVt9rJ "   
        )   
    );
 $context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
 $file = file_get_contents($url, false, $context);  //read the contents of a file into a string
 $obj = json_decode($file);    //Takes a JSON encoded string and converts it into a PHP variable.
 print_r($obj);

 ?>

    




<?php require_once 'includes/footer.php'; ?>


</body>
</html>