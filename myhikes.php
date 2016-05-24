<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


$message_favorites_show=false;
if(isset($_POST['option'])&&($_POST['option']=='addtofavorites')){   //form submission/isset determines if var is set, not null 
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

if(isset($_POST['option'])&&($_POST['option']=='setasplanned')){
	$plan_id = $_POST['plan_id'];
	
	$plan = new Plan();
	$plan->setAsPlanned($_SESSION['id'],$plan_id);
	
	$message_favorites_show = true;
	$message_favorites_text = "This hike ".$name." is now planned";
	
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
	$message_favorites_text = "This hike ".$name." is now hiked";
	
}




	

$plan = new Plan();
$favorite_plans = $plan->getMyFavorites($_SESSION['id']);


	
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/header.php';?>
	<meta property="og:http://ec2-54-213-132-61.us-west-2.compute.amazonaws.com/hikeMe/cover.php"content="http://www.your-domain.com/your-page.html" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Your Website Title" />
	<meta property="og:description"   content="Your description" />
	<meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />
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
    <div class="container">
    
    <?php if($message_favorites_show){ ?>
    <div class="alert alert-success" role="alert"><?php echo $message_favorites_text; ?></div>
    <?php } ?>
    
    <div class="text-center" style="margin-top: 100px;">
	    <h1>Welcome Back, <?php echo $name; ?></h1>
		
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
			<div class="col-xs-12 text-left">
				<h3>My Favorite Hikes:</h3>
				
				<div class="left">
				<div><a href="https://twitter.com/intent/tweet?text=" class="twitter-share-button left-button" data-show-count="false">Tweet</a></div></div><script type="text/javascript">
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
                </script>
				
				<div class="right">

				<div class="fb-share-button right-button" data-href="http://ec2-54-213-132-61.us-west-2.compute.amazonaws.com/hikeMe/cover.php" data-layout="button" data-mobile-iframe="true"></div></div>
<br>				
<br>
				<?php
				for($i=0;$i<count($favorite_plans);$i++){
					?>
					<div class="row">
						<div class="col-xs-12 col-md-9">
							<?php
							echo "<b>Name: </b>".$favorite_plans[$i]['name'];
							if($favorite_plans[$i]['type']=="PLANNED"){
							?>
								<span class="label label-info" style="font-size: 16px">PLANNED</span>
							<?php
							}
							if($favorite_plans[$i]['type']=="HIKED"){
							?>
								<span class="label label-success" style="font-size: 16px">HIKED on <?php echo $favorite_plans[$i]['hiked_day']; ?> - weather was: <?php echo $favorite_plans[$i]['hiked_weather']; ?> Farenheit</span>
							<?php
							}
							
							
							echo "<br>";
							echo "<b>City: </b>".$favorite_plans[$i]['city'];
							echo "<br>";
							echo "<b>State: </b>".$favorite_plans[$i]['state'];
							echo "<br>";
							echo "<b>Description: </b>".strip_tags($favorite_plans[$i]['description']);
							echo "<br>";
							?>
							
							<div class="row">
							<?php
								
								if(isset($favorite_plans[$i]['photos']['id'])){
									$number_of_photos = count($favorite_plans[$i]['photos']['id']);
								}else{
									$number_of_photos=0;
								}
								
							for($j=0;$j<$number_of_photos;$j++){
								?>
								
									<div class="col-xs-12 col-md-2">
										<div style="margin-right:25px;margin-top:25px;margin-bottom:45px">
											<a href="photo.php?photo_id=<?php echo $favorite_plans[$i]['photos']['id'][$j]; ?>"  >
												<img src="uploads/<?php echo $favorite_plans[$i]['photos']['name'][$j]; ?>" width="120px"/>
											</a>
											<div>
												<?php
													if($favorite_plans[$i]['photos']['public_photo'][$j]==1){
														echo 'public';
													}
												?>
											</div>
										</div>
									</div>
								
								<?php
							}
							
							
							
							?>
							</div>
							<div style="margin-top: 30px">
								<b>My comments:</b>
							</div>
							<?php
								for($j=0;$j<count($favorite_plans[$i]['comments']);$j++){
									echo "<p>";
									echo $favorite_plans[$i]['comments'][$j];
									echo "</p>";
									echo "<hr>";
								}
							?>
							
						</div>
						<div class="col-xs-12 col-md-3">
							
							
							<?php
							if($favorite_plans[$i]['type']!="PLANNED"){	
							?>
							
							<form method="post">
							  <div class="form-group">
							    <input type="hidden" name="option" value="setasplanned">
							    <input type="hidden" name="plan_id" value="<?php echo $favorite_plans[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Set as planned</button>
							</form>
							<?php
							}	
							?>
							
							
							<?php
							if($favorite_plans[$i]['type']!="HIKED"){	
							?>
							<form method="post">
							  <div class="form-group">
							    <input type="hidden" name="option" value="setashiked">
							    <input type="hidden" name="city" value="<?php echo $favorite_plans[$i]['city']; ?>">
							    <input type="hidden" name="plan_id" value="<?php echo $favorite_plans[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Set as hiked</button>
							</form>
							<?php
							}	
							?>
							
							<form method="post" action="journal.php">
							  <div class="form-group">
							    <input type="hidden" name="plan_id" value="<?php echo $favorite_plans[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Add journal</button>
							</form>
							
							<form method="post" action="uploadphoto.php">
							  <div class="form-group">
							    <input type="hidden" name="plan_id" value="<?php echo $favorite_plans[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Upload photo</button>
							</form>
							
							<form method="post">
							  <div class="form-group">
							    <input type="hidden" name="option" value="removefromfavorites">
							    <input type="hidden" name="plan_id" value="<?php echo $favorite_plans[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-danger btn-block">Remove Favorite</button>
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