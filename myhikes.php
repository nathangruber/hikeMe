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
    
    <div style="margin-top: 100px;">
	    <div class="text-center">
	    	<!--<h1><?php echo $_GET['show'];?>&nbsp;Hikes</h1> -->
	    	<h1>My Hikes</h1>
	    </div>
		
		<div>
			Show: 
			<a href="myhikes.php?show=All" style="margin-right: 20px">All</a>
			<a href="myhikes.php?show=Planned" style="margin-right: 20px">Planned</a>
			<a href="myhikes.php?show=Completed" style="margin-right: 20px">Completed</a>
		</div>
				<h3>Trails:</h3>
			<?php
				for($i=0;$i<count($favorite_hikes);$i++){
					?>
					<div class="row">
						<div class="col-xs-12 col-md-9">
							<?php
							
							//ask if it is planned
							if(($favorite_hikes[$i]['date']!="0000-00-00")&&($favorite_hikes[$i]['hiked_date']=="0000-00-00")){
							?>
								<div class="alert alert-info" role="alert" style="margin-top: 20px;">
									<b style="font-size: 16px;">PLANNED</b><br>
									<b>Day: </b><?php echo $favorite_hikes[$i]['date']; ?><br>
									<b>Weather Temperature: </b><?php echo $favorite_hikes[$i]['weather_temp']; ?><br>
									<b>Weather Wind: </b><?php echo $favorite_hikes[$i]['weather_wind']; ?><br>
									<b>Weather Description: </b><?php echo $favorite_hikes[$i]['weather_desc']; ?><br>
								</div>
							<?php
							}
							//ask if it is hiked
							if($favorite_hikes[$i]['hiked_date']!="0000-00-00"){
							?>
								<div class="alert alert-success" role="alert" style="margin-top: 20px;">
									<b style="font-size: 16px;">HIKED</b><br>
									<b>Day: </b><?php echo $favorite_hikes[$i]['hiked_date']; ?><br>
								</div>
							<?php
							}
							
							echo "<b>Name: </b>".$favorite_hikes[$i]['name'];
							echo "<br>";
							echo "<b>City: </b>".$favorite_hikes[$i]['city'];
							echo "<br>";
							echo "<b>State: </b>".$favorite_hikes[$i]['state'];
							echo "<br>";
							echo "<b>Description: </b>".$favorite_hikes[$i]['description'];
							echo "<br>";
							
							
							//Photos and journal will only be shown if it is hiked
							if($favorite_hikes[$i]['hiked_date']!="0000-00-00"){
							?>
							
							
							
							
							
								<div class="row">
								<?php
									
									$image = new Image();
									$aimages = $image->getPhotos($favorite_hikes[$i]['id']);
									$number_of_photos = count($aimages);
									
								for($j=0;$j<$number_of_photos;$j++){
									?>
									
										<div class="col-xs-12 col-md-2">
											<div style="margin-right:25px;margin-top:25px;margin-bottom:45px">
												<a href="photo.php?image_id=<?php echo $aimages[$j]['id']; ?>"  >
													<img src="uploads/<?php echo $aimages[$j]['name']; ?>" width="120px"/>
												</a>
												<div>
													<?php
														if($aimages[$j]['public']==1){
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
									
									$journal = new Journal();
									$comments = $journal->get($favorite_hikes[$i]['id']);
									
									for($j=0;$j<count($comments);$j++){
										echo "<p><b>".$comments[$j]['date'].": </b><i>";
										echo $comments[$j]['comments'];
										echo "</i></p>";
									}
								?>
							<?php
							}	
							?>	
						</div>
							
							
							
							
						<div class="col-xs-12 col-md-3">
							
							
							<?php
							if(($favorite_hikes[$i]['date']=="0000-00-00")&&($favorite_hikes[$i]['hiked_date']=="0000-00-00")){	
							?>
							
							<form method="post" action="planhike.php">
							  <div class="form-group">
							    <input type="hidden" name="option" value="setasplanned">
							    <input type="hidden" name="hike_id" value="<?php echo $favorite_hikes[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Plan your Hike</button>
							</form>
							<?php
							}	
							?>
							
							
							<?php
							if($favorite_hikes[$i]['hiked_date']=="0000-00-00"){	
							?>
							<form method="post" action="hikedone.php">
							  <div class="form-group">
							    <input type="hidden" name="hike_id" value="<?php echo $favorite_hikes[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Set as Hiked</button>
							</form>
							<?php
							}	
							?>
							<?php
								//ask if it hiked then show buttons
							if($favorite_hikes[$i]['hiked_date']!="0000-00-00"){	
							?>
							<form method="post" action="journal.php">
							  <div class="form-group">
							    <input type="hidden" name="hike_id" value="<?php echo $favorite_hikes[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Add Trail Journal</button>
							</form>
							
							<form method="post" action="uploadphoto.php">
							  <div class="form-group">
							    <input type="hidden" name="hike_id" value="<?php echo $favorite_hikes[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-default btn-block">Upload Photo</button>
							</form>
							<?php
							}	
							?>
							
							
							<form method="post" action="myhikes.php">
							  <div class="form-group">
							    <input type="hidden" name="option" value="removefromfavorites">
							    <input type="hidden" name="hike_id" value="<?php echo $favorite_hikes[$i]['id']; ?>">
							  </div>
							  <button type="submit" class="btn btn-danger btn-block">Remove Hike</button>
							</form>
							
							<?php
								$text_twitter = urlencode('Ey check out this trial: '.$favorite_hikes[$i]['name']);	
								
							?>
							<div class="row" style="margin-top: 15px">
								<div class="col-xs-12 col-md-4">
									<a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo $text_twitter; ?>">Tweet</a>
								</div>
								<div class="col-xs-12 col-md-4">
									<div class="fb-share-button" data-href="http://ec2-54-213-132-61.us-west-2.compute.amazonaws.com/hikeMe/myhikes.php" data-layout="button" data-mobile-iframe="true"></div>
								</div>
								<div class="col-xs-12 col-md-4">
									<a data-pin-do="buttonBookmark" href="https://www.pinterest.com/pin/create/button/"></a>
								</div>
							</div>
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