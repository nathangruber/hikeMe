<?php require_once 'includes/session.php';?>
<?php require_once 'includes/sessioncheck.php';?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/header.php';?>

<body>
    <title>hikeMe</title>
     <?php
	 require_once'includes/navbar.php';

	 
    
    
    ?>
    <div class="container">
    
    <div class="text-center" style="margin-top: 100px;">
	    <h1>Welcome Back <?php echo $name; ?></h1>
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<form method="post">
				  <div class="form-group">
				    <input type="search" class="form-control" name="search" placeholder="Write location here...">
				  </div>
				  <button type="submit" class="btn btn-default">Search</button>
				</form>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<h3>Activities planned:</h3>
			</div>
			<div class="col-xs-12 col-md-6">
				<h3>Activities done:</h3>
			</div>
		</div>
		
		
	</div>
    
    
   
    
    <?php
	    if(isset($_POST['search'])){
	?>
	
	<h2 class="text-center" style="margin-top: 100px">Hiking destinations in <b><?php echo $_POST['search']; ?></b></h2>
	
	<div class="row" style="margin-top: 20px">
		<div class="col-xs-12 col-md-4 col-md-offset-2 text-left">
			<h3>Trails</h3>
			<?php
				$total = count($obj2->places);
			?>	
				<h4><b>Total founds: </b><?php echo $total; ?></h4>    
			<?php    
			    
			    for($i=0;$i<$total;$i++){
					$place = $obj2->places[$i];
					
					echo "<b>Name: </b>".$place->name;
					echo "<br>";
					echo "<b>Directions: </b>".$place->directions;
					echo "<br>";
					echo "<b>Description: </b>".$place->activities[0]->description;
					echo "<br>";
					echo "<hr>";
					
				}
				
				
				
				
	    	?>
		</div>
		
		<div class="col-xs-12 col-md-4 text-left">
			<h3>Current Weather and Forecast</h3>
			<?php	    
				echo "<b>Weather description: </b>".$obj->weather[0]->description;
				echo "<br>";
				echo "<b>Current Temperature in Farenheit: </b>".$obj->main->temp;
				echo "<br>";
				echo "<b>Today's High: </b>".$obj->main->temp_max;
				echo "<br>";
				echo "<b>Today's Low: </b>".$obj->main->temp_min;
	    		echo "<br>";
	    		echo "<b>Wind Speed: </b>".$obj->wind->speed;


//http://api.openweathermap.org/data/2.5/forecast?q=milwaukee&APPID=2bd428fa9cf856303ff450f01f4a97de&units=imperial

//http://api.openweathermap.org/data/2.5/weather?q=$loc&APPID=2bd428fa9cf856303ff450f01f4a97de&units=imperial



	    	?>
		</div>
		
	
	
	</div>
	
	
	
	
	
 
  
    



    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>