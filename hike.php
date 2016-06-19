<?php 
require_once 'includes/session.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';





$id=$_GET['id'];
$hike = new Hike();
$hike_info = $hike->getHikeInfo($id,$_SESSION['id']);


//Type of the hike
$type_hike='';
if(($hike_info['date']!="0000-00-00")&&($hike_info['hiked_date']=="0000-00-00")){
	$type_hike='planned';
}

if($hike_info['hiked_date']!="0000-00-00"){
	$type_hike='hiked';
}



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
			
  <center><h1>Hike</h1></center><!--<h1><?php echo $_GET['show'];?>&nbsp;Hikes</h1> -->		
  
  <?php
	if($type_hike==''){
	?>
		<div class="row" style="margin-bottom: 30px">
		  	<div class="col-xs-12 col-md-3">
				<form method="post" action="planhike.php">
				  <div class="form-group">
				    <input type="hidden" name="option" value="setasplanned">
				    <input type="hidden" name="hike_id" value="<?php echo $hike_info['id']; ?>">
				  </div>
				  <button type="submit" class="btn btn-default btn-block" style="font-size: 20px"><i style="font-size: 40px"  class="glyphicon glyphicon-time"></i><br>Plan your Hike</button>
				</form>
		  	</div>
		  	<div class="col-xs-12 col-md-3">
			  	<form method="post" action="myhikes.php">
				  <div class="form-group">
				    <input type="hidden" name="option" value="removefromfavorites">
				    <input type="hidden" name="hike_id" value="<?php echo $hike_info['id']; ?>">
				  </div>
				  <button type="submit" class="btn btn-danger btn-block" style="font-size: 20px"><i style="font-size: 40px"  class="glyphicon glyphicon-remove"></i><br>Remove Hike</button>
				</form>
		  	</div>
		</div>
	<?php
	}else if($type_hike=='planned'){
	?>
		<div class="alert alert-info" role="alert" style="margin-top: 20px;">
			<b style="font-size: 16px;">PLANNED</b><br>
			<b>Day: </b><?php echo $hike_info['date']; ?><br>
			<b>Weather Temperature: </b><?php echo $hike_info['weather_temp']; ?><br>
			<b>Weather Wind: </b><?php echo $hike_info['weather_wind']; ?><br>
			<b>Weather Description: </b><?php echo $hike_info['weather_desc']; ?><br>
		</div>
		
		<div class="row" style="margin-bottom: 30px">
		  	<div class="col-xs-12 col-md-3">
				<form method="post" action="hikedone.php">
				  <div class="form-group">
				    <input type="hidden" name="hike_id" value="<?php echo $hike_info['id']; ?>">
				  </div>
				  <button type="submit" class="btn btn-default btn-block" style="font-size: 20px"><i style="font-size: 40px"  class="glyphicon glyphicon-ok"></i><br>Set As Hiked</button>
				</form>
		  	</div>
		  	<div class="col-xs-12 col-md-3">
			  	<form method="post" action="myhikes.php">
				  <div class="form-group">
				    <input type="hidden" name="option" value="removefromfavorites">
				    <input type="hidden" name="hike_id" value="<?php echo $hike_info['id']; ?>">
				  </div>
				  <button type="submit" class="btn btn-danger btn-block" style="font-size: 20px"><i style="font-size: 40px"  class="glyphicon glyphicon-remove"></i><br>Remove Hike</button>
				</form>
		  	</div>
		</div>
	<?php
	}else  if($type_hike=='hiked'){
	?>
		<div class="alert alert-success" role="alert" style="margin-top: 20px;">
			<b style="font-size: 16px;">HIKED</b><br>
			<b>Day: </b><?php echo $hike_info['hiked_date']; ?><br>
		</div>
		
		<div class="row" style="margin-bottom: 30px">
		  	<div class="col-xs-12 col-md-3">
				<form method="post" action="journal.php">
				  <div class="form-group">
				    <input type="hidden" name="hike_id" value="<?php echo $hike_info['id']; ?>">
				  </div>
				  <button type="submit" class="btn btn-default btn-block" style="font-size: 20px"><i style="font-size: 40px"  class="glyphicon glyphicon-pencil"></i><br>Add Trail Journal</button>
				</form>
		  	</div>
		  	<div class="col-xs-12 col-md-3">
				<form method="post" action="uploadphoto.php">
				  <div class="form-group">
				    <input type="hidden" name="hike_id" value="<?php echo $hike_info['id']; ?>">
				  </div>
				  <button type="submit" class="btn btn-default btn-block" style="font-size: 20px"><i style="font-size: 40px"  class="glyphicon glyphicon-camera"></i><br>Upload Photo</button>
				</form>
		  	</div>
		  	<div class="col-xs-12 col-md-3">
			  	<form method="post" action="myhikes.php">
				  <div class="form-group">
				    <input type="hidden" name="option" value="removefromfavorites">
				    <input type="hidden" name="hike_id" value="<?php echo $hike_info['id']; ?>">
				  </div>
				  <button type="submit" class="btn btn-danger btn-block" style="font-size: 20px"><i style="font-size: 40px"  class="glyphicon glyphicon-remove"></i><br>Remove Hike</button>
				</form>
		  	</div>
		</div>
	<?php
	} 
  ?>
  
  
  <div class="row">
	  
	  <div class="col-xs-12 col-md-4">
		  <div style="font-size:18px;margin-bottom:20px"><b>Information</b></div>
		  <?php
			echo "<b>Name: </b>".$hike_info['name'];
			echo "<br>";
			echo "<b>City: </b>".$hike_info['city'];
			echo "<br>";
			echo "<b>State: </b>".$hike_info['state'];
			echo "<br>";
			echo "<b>Description: </b>".$hike_info['description'];
			echo "<br>";
			
			if($type_hike=='hiked'){
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
			<?php
			}
			?>
		  
	  </div>
	  <div class="col-xs-12 col-md-4">
		  <div style="font-size:18px;margin-bottom:20px"><b>Photos</b></div>
		  <div class="row">
			<?php
				
				$image = new Image();
				$aimages = $image->getPhotos($hike_info['id']);
				$number_of_photos = count($aimages);
				
			for($j=0;$j<$number_of_photos;$j++){
				?>
				
					<div class="col-xs-12 col-md-6">
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
		  
	  </div>
	  <div class="col-xs-12 col-md-4">
		  <div style="font-size:18px;margin-bottom:20px"><b>Journal</b></div>
		  <?php
									
			$journal = new Journal();
			$comments = $journal->get($hike_info['id']);
			
			for($j=0;$j<count($comments);$j++){
				echo "<p><b>".$comments[$j]['date'].": </b><i>";
				echo $comments[$j]['comments'];
				echo "</i></p>";
			}
		?>
		  
	  </div>
	  
	  
	  
  </div>
  
  
  
  
  
  
  
  
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
    
    
</div>
<?php require_once 'includes/footer.php'; ?>
</body>
</html>