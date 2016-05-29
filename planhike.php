<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';



$hike_id=$_POST['hike_id'];



$hike = new Hike();
$hike_info = $hike->getHikeInfo($hike_id,$_SESSION['id']);



print_r($hike_info);


//Get wheather for that city in the next 7 days...
$loc=$hike_info['city'];
$url = "http://api.openweathermap.org/data/2.5/forecast?q=$loc&APPID=2bd428fa9cf856303ff450f01f4a97de&units=imperial";
$opts = array(
        'http' => array (
            'method' => 'GET'
        )   
    );
$context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
$file = file_get_contents($url, false, $context);  //read the contents of a file into a string

$obj = json_decode($file, false);  //Takes a JSON encoded string and converts it into a PHP variable.

print_r($obj);
	
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/header.php';?>

<body>
    <title>hikeMe</title>
<?php require_once'includes/navbar.php';?>
<img id="banner" src="assets/img/photographer-1031393_1920.jpg" alt="Photographer Banner Image">

    <div class="container">
    	<div class="text-center" style="margin-top: 50px;">
		    <h1>Plan your hike</h1>
			<p>Choose what day do you want to plan</p>
			<br>
			
			<div class="row">
				<?php
				for($i=0;$i<6;$i++){
					echo '<div class="col-xs-12 col-md-2">';
					echo "<h4><b>Day: </b>".substr($obj->list[$i]->dt_txt, 0,10)."</h4>";  //substr - returns part of string from api list
					echo "<b>Weather description: </b>".$obj->list[$i]->weather[0]->description;
					echo "<br>";
					echo "<b>Current Temperature in &#8457: </b>".$obj->list[$i]->main->temp;
					echo "<br>";
					echo "<b>Today's High: </b>".$obj->list[$i]->main->temp_max;
					echo "<br>";
					echo "<b>Today's Low: </b>".$obj->list[$i]->main->temp_min;
		    		echo "<br>";
		    		echo "<b>Wind Speed: </b>".$obj->list[$i]->wind->speed;
					echo '<hr>';
					echo '</div>';
				}
				?>
			</div>
			
			
			
			
			
			
			
			
		</div>
    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>