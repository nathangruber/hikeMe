<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


$message_favorites_show=false;

/*
//Testing add plan
$_POST['option'] = 'addtofavorites';
$_POST['city'] = '4ffr56';
$_POST['state'] = 'milton';
$_POST['name'] = 'peterdf fall';
$_POST['unique_id'] = '678';
$_POST['description'] = 'super description';
*/


if(isset($_POST['option'])&&($_POST['option']=='addtofavorites')){
	
	$city = $_POST['city'];
	$state = $_POST['state'];
	$name = $_POST['name'];
	$unique_id = $_POST['unique_id'];
	$description = $_POST['description'];
	
	$plan = new Plan();
	
	$plan->addToFavorites($_SESSION['id'],$city,$state,$name,$unique_id,$description);
	
	$message_favorites_show = true;
	$message_favorites_text = "Your hike ".$name." has been saved to your favorites";
}


if(isset($_POST['option'])&&($_POST['option']=='removefromfavorites')){
	$plan_id = $_POST['plan_id'];
	
	$plan = new Plan();
	$plan->removeFromFavorites($_SESSION['id'],$plan_id);
	
	$message_favorites_show = true;
	$message_favorites_text = "This hike ".$name." was one of your favorites";
	
}




	

$plan = new Plan();
$favorite_plans = $plan->getMyFavorites($_SESSION['id']);

	
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/header.php';?>

<body>
    <title>hikeMe</title>
     <?php
	 require_once'includes/navbar.php';?>
    <div class="container">
    
    <?php if($message_favorites_show){ ?>
    <div class="alert alert-success" role="alert"><?php echo $message_favorites_text; ?></div>
    <?php } ?>
    
    <div class="text-center" style="margin-top: 100px;">
	    <h1>Welcome Back <?php echo $name; ?></h1>
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<form method="post" action="index.php">
				  <div class="form-group">
				    <input type="search" class="form-control" name="search" placeholder="Write location here...">
				  </div>
				  <button type="submit" class="btn btn-default">Search</button>
				</form>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-xs-12 col-md-3 text-left">
				<h3>My Favorite Hikes:</h3>
				
				<?php
				for($i=0;$i<count($favorite_plans);$i++){
					echo "<b>Name: </b>".$favorite_plans[$i]['name'];
					echo "<br>";
					echo "<b>City: </b>".$favorite_plans[$i]['city'];
					echo "<br>";
					echo "<b>State: </b>".$favorite_plans[$i]['state'];
					echo "<br>";
					echo "<b>Description: </b>".$favorite_plans[$i]['description'];
					echo "<br>";
					
					?>
					<form method="post">
					  <div class="form-group">
					    <input type="hidden" name="option" value="removefromfavorites">
					    <input type="hidden" name="plan_id" value="<?php echo $favorite_plans[$i]['id']; ?>">
					  </div>
					  <button type="submit" class="btn btn-default">Remove Favorite</button>
					</form>
					<?php
					echo "<hr>";
					
				
				}	
				?>
				
				
				
			</div>
			<div class="col-xs-12 col-md-3">
				<h3>Planned:</h3>
			</div>
			<div class="col-xs-12 col-md-3">
				<h3>Done:</h3>
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
			<h3>Current Weather</h3>
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
	
	
	
	
	<?php  
	    }
	?>
    
 
  
    



    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>