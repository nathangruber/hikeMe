<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';




if(isset($_POST['date'])){
	$hike = new Hike();
	
	$hike_id=$_POST['hike_id'];
	$user_id=$_SESSION['íd'];
	$weather_desc=$_POST['weather_desc'];
	$weather_temp=$_POST['weather_temp'];
	$weather_wind=$_POST['weather_wind'];
	$hike->plan($hike_id,$user_id,$date,$weather_desc,$weather_temp,$weather_wind);
	
	echo 'planned';
	
}



$hike_id=$_POST['hike_id'];



$hike = new Hike();
$hike_info = $hike->getHikeInfo($hike_id,$_SESSION['id']);



print_r($hike_info);


//Get wheather for that city in the next 7 days...
$loc=$hike_info['city'];
$url = "http://api.openweathermap.org/data/2.5/forecast/daily?q=$loc&APPID=2bd428fa9cf856303ff450f01f4a97de&units=imperial";
$opts = array(
        'http' => array (
            'method' => 'GET'
        )   
    );
$context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
$file = file_get_contents($url, false, $context);  //read the contents of a file into a string

$obj = json_decode($file, false);  //Takes a JSON encoded string and converts it into a PHP variable.

	
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
					
					$timestamp=$obj->list[$i]->dt;
					$theday= gmdate("m / d / Y", $timestamp);
					echo "<h4><b>Day: </b>".$theday."</h4>";  //substr - returns part of string from api list
					echo "<b>Weather description: </b>".$obj->list[$i]->weather[0]->description;
					echo "<br>";
					echo "<b>Current Temperature in &#8457: </b>".$obj->list[$i]->temp->day;
					echo "<br>";
					echo "<b>Today's High: </b>".$obj->list[$i]->temp->max;
					echo "<br>";
					echo "<b>Today's Low: </b>".$obj->list[$i]->temp->min;
		    		echo "<br>";
		    		echo "<b>Wind Speed: </b>".$obj->list[$i]->speed;
					
					
					?>
					<form action="planhike.php" method="post">
						<input type="hidden" name="hike_id" value="<?php echo $hike_id; ?>">
						<input type="hidden" name="date" value="<?php echo gmdate("Y-m-d", $timestamp); ?>">
						<input type="hidden" name="weather_desc" value="<?php echo $obj->list[$i]->weather[0]->description; ?>">
						<input type="hidden" name="weather_temp" value="<?php echo $obj->list[$i]->temp->day; ?>">
						<input type="hidden" name="weather_wind" value="<?php echo $obj->list[$i]->speed; ?>">
						<input class="btn btn-default" type="submit" value="Choose">
						
					</form>
					
					
					<?php
					
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