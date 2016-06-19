<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


if(!isset($_GET['show'])){
	$_GET['show']='all';
}

$message_favorites_show=false; //
if(isset($_POST['option'])&&($_POST['option']=='addtofavorites')){   //form submission/isset determines if var is set, not null 
	$city = $_POST['city'];
	$state = $_POST['state'];
	$name = $_POST['name'];
	$unique_id = $_POST['unique_id'];
	$description = $_POST['description'];
	
	$hike = new Hike();
	
	
	$hike->addToFavorites($unique_id,$name,$city,$state,$description,$_SESSION['id']);
	
	
	$message_favorites_show = true;
	$message_favorites_text = "Your hike, ".$name." has been added to your favorites.";
}


if(isset($_POST['option'])&&($_POST['option']=='removefromfavorites')){
	$hike_id = $_POST['hike_id'];
	
	$hike = new hike();
	$hike->removeFromFavorites($_SESSION['id'],$hike_id);
	
	$message_favorites_show = true;
	$message_favorites_text = "You removed your hike from your favorites.";
	
}


$type = $_GET['show'];

$hike = new Hike();
$favorite_hikes = $hike->getMyFavorites($_SESSION['id'], strtolower($type));
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/header.php';?>
<body>
	

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>	
	

	<title>hikeMe</title>
     <?php
	 require_once'includes/navbar.php';?>
    <div class="jumbotron">
	</div>
	<div class="container">
	</div>
    <div class="container">
    <?php if($message_favorites_show){ ?>
    <div class="alert alert-success" role="alert"><?php echo $message_favorites_text; ?></div>
    <?php } ?>
			
  <center><h1>My Hikes</h1></center><!--<h1><?php echo $_GET['show'];?>&nbsp;Hikes</h1> -->		
	<center>
		<div class="show">
			 
			<a href="myhikes.php?show=All" style="text-decoration margin-right: 20px">All&nbsp;-</a>
			<a href="myhikes.php?show=Planned" style="text-decoration margin-right: 20px">Planned&nbsp;-</a>
			<a href="myhikes.php?show=Completed" style="text-decoration margin-right: 20px">Hiked</a>
		</div>
	</center>
			<?php
				for($i=0;$i<count($favorite_hikes);$i++){
					?>
					<div class="row">
						<div class="col-xs-12">
							<?php
							
							
							
							echo "<h3><a href='hike.php?id=".$favorite_hikes[$i]['id']."'>".$favorite_hikes[$i]['name']."</a></h3>";
							echo "<br>";
							echo "<b>City: </b>".$favorite_hikes[$i]['city'];
							echo "<br>";
							echo "<b>State: </b>".$favorite_hikes[$i]['state'];
							echo "<br>";
							echo "<b>Description: </b>".$favorite_hikes[$i]['description'];
							echo "<br>";
						?>	
							
								
						</div>
					</div>
					<hr>
					
				<?php
				}	
				?>
				
				
				
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
				<h4><b>Total found: </b><?php echo $total; ?></h4>    
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