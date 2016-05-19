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
    
    
    if(isset($_POST['search'])){
	    //We make the call to the API and get the results...
	    $place = $_POST['search'];
	    $loc = urlencode($place);
	    $url = "http://api.openweathermap.org/data/2.5/weather?q=$loc&APPID=2bd428fa9cf856303ff450f01f4a97de&units=imperial";
		$opts = array(
		        'http' => array (
		            'method' => 'GET'
		        )   
		    );
		$context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
		$file = file_get_contents($url, false, $context);  //read the contents of a file into a string
		$obj = json_decode($file, false); 
	    
	    
	    
	    
	    
	    //Second API
	    $url = "https://trailapi-trailapi.p.mashape.com/?q[city_cont]=$loc";
		$opts = array(
		        'http' => array (
		            'method' => 'GET',
		            'header' =>  "Accept: plain/text\r\n". "X-Mashape-Key:F1piInHfmpmsh4V6tDTrAboircv8p1s3rgAjsnO6TthOVVt9rJ "   
		        )   
		    );
		$context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
		$file = file_get_contents($url, false, $context);  //read the contents of a file into a string
		$obj2 = json_decode($file);    //Takes a JSON encoded string and converts it into a PHP variable.
	    
	    
	    
	    
    }
    
    
    
    ?>
    <div class="container">
    
    <div class="text-center" style="margin-top: 100px;">
	    <h1>Where do you want to go?</h1>
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<form method="post">
				  <div class="form-group">
				    <input type="search" class="form-control" name="search" placeholder="Write location here...">
				  </div>
				  <button type="submit" class="btn btn-default">Search now!</button>
				</form>
			</div>
		</div>
		
		
    </div>
    
    
   
    
    <?php
	    if(isset($_POST['search'])){
	?>
	
	<h2 class="text-center" style="margin-top: 100px">Mmm let's see what's going on in <b><?php echo $_POST['search']; ?></b></h2>
	
	<div class="row" style="margin-top: 20px">
		<div class="col-xs-12 col-md-4 col-md-offset-2 text-left">
			<h3>Hiking information</h3>
			<?php
				$total = count($obj2->places);	    
			    
			    echo "We found: $total <br>";
			    
			    /*for($i=0;$i<$total;$i++){
					$place = $obj2->places[$i];
					
					echo "<b>Name: </b>".$place->name;
					echo "<br>";
					echo "<b>Directions: </b>".$place->directions;
					
				}*/
				
				
				
	    	?>
		</div>
		
		<div class="col-xs-12 col-md-4 text-left">
			<h3>Weather information</h3>
			<?php	    
			    echo "<b>the Lon is: </b>".$obj->coord->lon;
				echo "<br>";
				echo "<b>the Lon is: </b>".$obj->coord->lat;
				echo "<br>";
				echo "<b>Weather description: </b>".$obj->weather[0]->description;
				echo "<br>";
				echo "<b>Farenhei: </b>".$obj->main->temp;
	    	?>
		</div>
		
	
	
	</div>
	
	
	
	
	<?php  
	    }
	?>
    
 
  
    



    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>