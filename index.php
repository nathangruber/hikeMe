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
 $url = "http://api.openweathermap.org/data/2.5/weather?q=milwaukee&APPID=2bd428fa9cf856303ff450f01f4a97de";
 $opts = array(
        'http' => array (
            'method' => 'GET'
        )   
    );
 $context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
 $file = file_get_contents($url, false, $context);  //read the contents of a file into a string
 $obj = json_decode($file,$true);    //Takes a JSON encoded string and converts it into a PHP variable.
 //echo $obj[0]['id']; // Fetches the first ID
 //echo $obj[0]['c_name']; // Fetches the first c_name
 
 print_r($obj);

 ?>


 $someObject = $obj; // Replace ... with your PHP Object
  foreach($someObject as $key => $value) {
    echo $value->weather . ", " . $value->main . "<br>";
  }

    




<?php require_once 'includes/footer.php'; ?>


</body>
</html>