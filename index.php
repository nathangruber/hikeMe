<?php 
require_once 'includes/session.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/header.php';?>

<body>
    <title>hikeMe</title>
 <?php require_once 'includes/navbar.php';


    if(isset($_GET['search'])){
	    $_POST['search'] = urldecode($_GET['search']);
	}
	
	if(isset($_GET['page'])){
		$page=$_GET['page'];
	}else{
		$page = 1;
	}
    
    if(isset($_POST['search'])){
	    //Weather API forecast
	    $place = $_POST['search'];
	    $loc = urlencode($place);
	    $url = "http://api.openweathermap.org/data/2.5/forecast?q=$loc&APPID=2bd428fa9cf856303ff450f01f4a97de&units=imperial";
		$opts = array(
		        'http' => array (
		            'method' => 'GET'
		        )   
		    );
		$context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
		$file = file_get_contents($url, false, $context);  //read the contents of a file into a string
		
		$obj = json_decode($file, false); 
	    
	    
	    
	    //Trail API
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
	    <h1>Where do you want to hike?</h1>
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<form action="index.php" method="post">
				  <div class="form-group">
				    <input type="search" class="form-control" name="search" placeholder="Write location here...">
				  </div>
				  <button type="submit" class="btn btn-default">Search</button>
				</form>
			</div>
		</div>
	</div>
  </div><img id="banner" src="assets/img/mountain-1075914_1920.jpg" alt="Banner Image">



    
    
   
    
    <?php
	    if(isset($_POST['search'])){
	?>
	
	<h3 class="text-center" style="margin-top: 100px">Hiking destinations in <b><?php echo $_POST['search']; ?></b></h3>
	
	<div class="row" style="margin-top: 20px">
		<div class="col-xs-12 col-md-4 col-md-offset-2 text-left">
			<h3>Trails</h3>
			<?php
				$total = count($obj2->places);
			?>	
				<h4><b>Total founds: </b><?php echo $total; ?></h4>    
			<?php 
				
				if($page==1){
				 	$init = 0;
				 	$end = 5;
				}else{
					$init = 5 * $page - 5;
					$end = 5 * $page;
				}
				
				
				if($end>$total){
					$end=$total;
				}
				
				
			    
			    for($i=$init;$i<$end;$i++){
					$place = $obj2->places[$i];
					
					echo "<b>".($i+1).".</b>";
					echo "<br>";
					echo "<b>Name: </b>".$place->name;
					echo "<br>";
					echo "<b>Directions: </b>".$place->directions;
					echo "<br>";
					echo "<b>Description: </b>".$place->activities[0]->description;
					echo "<br>";
					?>
					<form method="post" action="myhikes.php">
					  <div class="form-group">
					    <input type="hidden" name="option" value="addtofavorites">
					    <input type="hidden" name="city" value="<?php echo $place->city;?>">
					    <input type="hidden" name="state" value="<?php echo $place->state;?>">
					    <input type="hidden" name="name" value="<?php echo $place->activities[0]->name;?>">
					    <input type="hidden" name="unique_id" value="<?php echo $place->activities[0]->unique_id;?>">
					    <input type="hidden" name="description" value="<?php echo $place->activities[0]->description;?>">
					  </div>
					  <button type="submit" class="btn btn-default">Add to my favorites</button>
					</form>
					<?php
					echo "<hr>";
					
				}
				
				if($page==1){
					?>
					<a class="btn btn-default" href="index.php?search=<?php echo urlencode($_POST['search']);?>&page=2">Next</a>
					<?php
				}else{
					?>
					<a class="btn btn-default" href="index.php?search=<?php echo urlencode($_POST['search']);?>&page=<?php echo $page-1; ?>">Back</a>
					
					
					<?php
					if($end!=$total){
					?>
					<a class="btn btn-default" href="index.php?search=<?php echo urlencode($_POST['search']);?>&page=<?php echo $page+1; ?>">Next</a>
					<?php
					}
					
				}
				
				
				
				
	    	?>
		</div>
		
		<div class="col-xs-12 col-md-4 text-left">
			<h3>Current weather:</h3>
			<?php	    
				/*echo "<b>Weather description: </b>".$obj->weather[0]->description;
				echo "<br>";
				echo "<b>Current Temperature in Farenheit: </b>".$obj->main->temp;
				echo "<br>";
				echo "<b>Today's High: </b>".$obj->main->temp_max;
				echo "<br>";
				echo "<b>Today's Low: </b>".$obj->main->temp_min;
	    		echo "<br>";
	    		echo "<b>Wind Speed: </b>".$obj->wind->speed;
				*/
				
				
				$num_elements = count($obj->list);
				//echo $num_elements;
				
				
				echo "<b>Weather description: </b>".$obj->list[0]->weather[0]->description;
				echo "<br>";
				echo "<b>Current Temperature in Farenheit: </b>".$obj->list[0]->main->temp;
				echo "<br>";
				echo "<b>Today's High: </b>".$obj->list[0]->main->temp_max;
				echo "<br>";
				echo "<b>Today's Low: </b>".$obj->list[0]->main->temp_min;
	    		echo "<br>";
	    		echo "<b>Wind Speed: </b>".$obj->list[0]->wind->speed;
				
				
				echo '<hr>';
				
				
				
			echo '<h3>Forecast:</h3>';
			
			for($i=1;$i<5;$i++){
				
				echo "<h4><b>Day: </b>".substr($obj->list[$i]->dt_txt, 0,10)."</h4>";  
				echo "<b>Weather description: </b>".$obj->list[$i]->weather[0]->description;
				echo "<br>";
				echo "<b>Current Temperature in Farenheit: </b>".$obj->list[$i]->main->temp;
				echo "<br>";
				echo "<b>Today's High: </b>".$obj->list[$i]->main->temp_max;
				echo "<br>";
				echo "<b>Today's Low: </b>".$obj->list[$i]->main->temp_min;
	    		echo "<br>";
	    		echo "<b>Wind Speed: </b>".$obj->list[$i]->wind->speed;
				echo '<hr>';
				
			}
			
			
			

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