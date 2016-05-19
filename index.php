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
	    $url = "http://api.openweathermap.org/data/2.5/weather?q=$place&APPID=2bd428fa9cf856303ff450f01f4a97de&units=imperial";
		$opts = array(
		        'http' => array (
		            'method' => 'GET'
		        )   
		    );
		$context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
		$file = file_get_contents($url, false, $context);  //read the contents of a file into a string
		$obj = json_decode($file, false); 
	    
	    
	    
    }
    
    
    
    ?>
    
    
    <div class="text-center" style="margin-top: 100px;">
	    <h1>Where do you want to go?</h1>
		
		<!--<form action="" method="post" class="form-search">
			<input class="input" type="text" name="search"><br>
			<input class="btn btn-default" value="Search" type="submit" style="margin-top: 20px">
			
		</form>-->
		
		<form method="post">
		  <div class="form-group" style="max-width: 200px">
		    <input type="search" class="form-control" id="" placeholder="Write location here...">
		  </div>
		  <button type="submit" class="btn btn-default">Search now!</button>
		</form>
		
		
		
    </div>
    
    
   
    
    <?php
	    if(isset($_POST['search'])){
	?>
	<div class="text-center" style="margin-top: 50px">
		<h2>Mmmm in <b><?php echo $_POST['search']; ?></b> you have...</h2>
	<?php	    
		    echo "the Lon is: ".$obj->coord->lon;
			echo "<br>";
			echo "the Lon is: ".$obj->coord->lat;
			echo "<br>";
			echo "Weather description: ".$obj->weather[0]->description;
			echo "<br>";
			echo "Farenhei: ".$obj->main->temp;
	    
	
	?>
	
	</div>
	
	<?php  
	    }
	?>
    
    
    
    
  
    




<?php require_once 'includes/footer.php'; ?>


</body>
</html>