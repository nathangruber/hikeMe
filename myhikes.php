<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


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
	$plan_id = $_POST['plan_id'];
	
	$plan = new Plan();
	$plan->removeFromFavorites($_SESSION['id'],$plan_id);
	
	$message_favorites_show = true;
	$message_favorites_text = "You removed your hike from your favorites.";
	
}

if(isset($_POST['option'])&&($_POST['option']=='setasplanned')){
	$plan_id = $_POST['plan_id'];
	
	$plan = new Plan();
	$plan->setAsPlanned($_SESSION['id'],$plan_id);
	
	$message_favorites_show = true;
	$message_favorites_text = "This hike is now planned.";
	
}

if(isset($_POST['option'])&&($_POST['option']=='setashiked')){
	$plan_id = $_POST['plan_id'];
	$city = $_POST['city'];
	
	$plan = new Plan();
	
	//we call the weather forecast for that location
	$city = urlencode($city);
    $url = "http://api.openweathermap.org/data/2.5/forecast?q=$city&APPID=2bd428fa9cf856303ff450f01f4a97de&units=imperial";
	$opts = array(
	        'http' => array (
	            'method' => 'GET'
	        )   
	    );
	$context = stream_context_create($opts);   //Creates and returns a stream context with any options supplied in options preset.
	$file = file_get_contents($url, false, $context);  //read the contents of a file into a string
	
	$obj = json_decode($file, false);  //Takes a JSON encoded string and converts it into a PHP variable.
	$todays_weather =$obj->list[0]->main->temp;
	
	
	$plan->setAsHiked($_SESSION['id'],$plan_id,$todays_weather);
	
	$message_favorites_show = true;
	$message_favorites_text = "This hike has been Explored.";
	
}

$hike = new Hike();
$favorite_hikes = $hike->getMyFavorites($_SESSION['id']);
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
    
    <div class="text-center" style="margin-top: 100px;">
	    <h1>hikeMe</h1>
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<form method="post" action="index.php">
				  <div class="form-group">
				    <input type="search" class="form-control" name="search" placeholder="Search by nearest city to trail...">
				  </div>
				  <button type="submit" class="btn btn-default">Search</button>
				</form>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-xs-12 text-left">
				<h3>Trails:</h3>
				<a data-pin-do="buttonPin" data-pin-count="above" data-pin-round="true" href="https://www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fec2-54-213-132-61.us-west-2.compute.amazonaws.com%2FhikeMe%2Fcover.php&media=https%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=Next%20stop%3A%20Pinterest"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_round_red_16.png" /></a>
				<div><a href="https://twitter.com/intent/tweet?text=" class="twitter-share-button left-button" data-show-count="false">Tweet</a></div></div><script type="text/javascript">
				!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
                </script>
				<div class="right">
				<div class="fb-share-button right-button" data-href="http://ec2-54-213-132-61.us-west-2.compute.amazonaws.com/hikeMe/cover.php" data-layout="button" data-mobile-iframe="true"></div></div>

			<?php
				for($i=0;$i<count($favorite_hikes);$i++){
					?>
					<div class="row">
						<div class="col-xs-12 col-md-9">
							<?php
							echo "<b>Name: </b>".$favorite_hikes[$i]['name'];
							if($favorite_hikes[$i]['type']=="PLANNED"){
							?>
								<span class="label label-info" style="font-size: 16px">PLANNED</span>
							<?php
							}
							if($favorite_hikes[$i]['type']=="HIKED"){
							?>
							<span class="label label-success" style="font-size: 15px">Hiked on <?php echo $favorite_hikes[$i]['hiked_day']; ?> - Temperature was: <?php echo $favorite_hikes[$i]['hiked_weather']; ?>&#8457</span>
							<?php
							}
							
							
							echo "<br>";
							echo "<b>City: </b>".$favorite_hikes[$i]['city'];
							echo "<br>";
							echo "<b>State: </b>".$favorite_hikes[$i]['state'];
							echo "<br>";
							echo "<b>Description: </b>".$favorite_hikes[$i]['description'];
							echo "<br>";
							?>
							
							<div class="row">
							<?php
								
								if(isset($favorite_hikes[$i]['photos']['id'])){
									$number_of_photos = count($favorite_hikes[$i]['photos']['id']);
								}else{
									$number_of_photos=0;
								}
								
							for($j=0;$j<$number_of_photos;$j++){
								?>
								
									<div class="col-xs-12 col-md-2">
										<div style="margin-right:25px;margin-top:25px;margin-bottom:45px">
											<a href="photo.php?photo_id=<?php echo $favorite_hikes[$i]['photos']['id'][$j]; ?>"  >
												<img src="uploads/<?php echo $favorite_hikes[$i]['photos']['name'][$j]; ?>" width="120px"/>
											</a>
											<div>
												<?php
													if($favorite_hikes[$i]['photos']['public_photo'][$j]==1){
														echo 'public';
													}
												?>
												<small><p>click to enlarge<br>or make public</p></small>

											</div>
										</div>
									</div>
								
								<?php
							}
							
							
							
							?>
							</div>
							<div style="margin-top: 30px">
								<b>My Trail Journal:</b>
							</div>
							<?php
								for($j=0;$j<count($favorite_hikes[$i]['comments']);$j++){
									echo "<p>";
									echo $favorite_hikes[$i]['comments'][$j];
									echo "</p>";
								}
							?>
							
						</div>
						<div class="col-xs-12 col-md-3">
							
							
							<?php
							if($favorite_hikes[$i]['type']!="PLANNED"){	
							?>
							
							<form method="post">
							  <div class="form-group">
							    <input type="hidden" name="option" value="setasplanned">
							    <input type="hidden" name="plan_id" value="<?php echo $favorite_hikes[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Plan your Hike</button>
							</form>
							<?php
							}	
							?>
							
							
							<?php
							if($favorite_hikes[$i]['type']!="HIKED"){	
							?>
							<form method="post">
							  <div class="form-group">
							    <input type="hidden" name="option" value="setashiked">
							    <input type="hidden" name="city" value="<?php echo $favorite_hikes[$i]['city']; ?>">
							    <input type="hidden" name="plan_id" value="<?php echo $favorite_hikes[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Set as Hiked</button>
							</form>
							<?php
							}	
							?>
							
							<form method="post" action="journal.php">
							  <div class="form-group">
							    <input type="hidden" name="plan_id" value="<?php echo $favorite_hikes[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Add Trail Journal</button>
							</form>
							
							<form method="post" action="uploadphoto.php">
							  <div class="form-group">
							    <input type="hidden" name="plan_id" value="<?php echo $favorite_hikes[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Upload Photo</button>
							</form>
							
							<form method="post">
							  <div class="form-group">
							    <input type="hidden" name="option" value="removefromfavorites">
							    <input type="hidden" name="plan_id" value="<?php echo $favorite_hikes[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-danger btn-block">Remove Hike</button>
							</form>
							
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