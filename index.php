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
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
 <?php
 $url = "http://api.openweathermap.org/data/2.5/weather?q=milwaukee&APPID=2bd428fa9cf856303ff450f01f4a97de&units=imperial";
 $opts = array(
        'http' => array (
            'method' => 'GET'
        )   
    );
 $context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
 $file = file_get_contents($url, false, $context);  //read the contents of a file into a string
 $obj = json_decode($file, false); 
 //show data
 //var_dump($obj);

 //description
 //echo $obj['weather'][0]['description'];
 //temperature
 //echo $obj['main']['temp'];

echo "the Lon is: ".$obj->coord->lon;
echo "<br>";
echo "the Lon is: ".$obj->coord->lat;
echo "<br>";
echo "Weather description: ".$obj->weather->description;
echo "<br>";
echo "Farenhei: ".$obj->main->temp;

 //print_r($obj);

 ?>


 
    




<?php require_once 'includes/footer.php'; ?>


</body>
</html>