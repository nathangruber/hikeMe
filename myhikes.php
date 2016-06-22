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
	$message_favorites_text = "Your hike, ".$name." has been added to your hikes list.";
}

if(isset($_POST['option'])&&($_POST['option']=='removefromfavorites')){
	$hike_id = $_POST['hike_id'];
	
	$hike = new hike();
	$hike->removeFromFavorites($_SESSION['id'],$hike_id);
	
	$message_favorites_show = true;
	$message_favorites_text = "You removed your hike from your hike list.";
	
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
	<!--<center>
		<div class="show">
			 
			<a href="list.php?show=All" style="text-decoration margin-right: 20px">All&nbsp;-</a>
			<a href="list.php?show=Planned" style="text-decoration margin-right: 20px">Planned&nbsp;-</a>
			<a href="list.php?show=Completed" style="text-decoration margin-right: 20px">Hiked</a>
		</div>
	
	</center>
	-->
			<?php
				for($i=0;$i<count($favorite_hikes);$i++){
					?>
					<div class="row">
						<div class="col-xs-12">
							<?php
							
							
							
							//type of hike
							$type_hike='';
							if($favorite_hikes[$i]['date']!="0000-00-00"){
								$type_hike='planned';
								
								$current_date=date('Y-m-d');
								
								//compare if the date planned is in the past (then hiked)
								if($favorite_hikes[$i]['date']<$current_date){
									$type_hike='hiked';
								}
								
							}
							
							
							
							echo "<h3><a style='padding-right: 10px' class='text-info' href='hike.php?id=".$favorite_hikes[$i]['id']."'>".$favorite_hikes[$i]['name']."</a>";
							if($type_hike=='planned'){
								echo "<i class='text-info glyphicon glyphicon-time'></i>";
							}else if($type_hike=='hiked'){
								echo "<i class='text-success glyphicon glyphicon-ok'></i>";
							}
							
							echo "</h3>";
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