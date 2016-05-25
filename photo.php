<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


$photo_id = $_GET['photo_id'];
//get the photo details
$plan = new Plan();
$result = $plan->getPhotoDetails($_SESSION['id'],$photo_id);
//not my photo then redirect
if($result==false){
	header('Location: myhikes.php');
}
if(isset($_GET['option'])&&($_GET['option']=='setaspublic')){
	$plan->setPhotoAsPublic($_SESSION['id'],$photo_id);
}

if(isset($_GET['option'])&&($_GET['option']=='setasprivate')){
	$plan->setPhotoAsPrivate($_SESSION['id'],$photo_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/header.php';?>

<body>
    <title>hikeMe</title>
     <?php
	 require_once'includes/navbar.php';?>
    <div class="container">
    	<div class="text-center" style="margin-top: 100px;">
		    <h1>Your Photo</h1>
			<p>Make your photo public, and share it in hikeMe's trail search.</p>
			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					
					<img src="uploads/<?php echo $result['photo_name']; ?>" width=500px"/>
					<?php
						if($result['public_photo']==0){
					?>
						
					<div style="margin-top:50px">
						<a href="photo.php?photo_id=<?php echo $_GET['photo_id']; ?>&option=setaspublic" class="btn btn-default">Make Public</a>
					</div>
					<?php
						}else{
							?>
							<div style="margin-top:50px">
							<a href="photo.php?photo_id=<?php echo $_GET['photo_id']; ?>&option=setasprivate" class="btn btn-default">Set back to Private</a>
							</div>
						<?php
						}	
						
					?>
					<br>
				</div>
			</div>
		</div>
    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>