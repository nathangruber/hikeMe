<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';




if(isset($_POST['date'])){
	$hike = new Hike();
	
	$hike_id=$_POST['hike_id'];
	$user_id=$_SESSION['id'];
	$hike->done($hike_id,$user_id,$date);
	header('Location: myhikes.php');
}



$hike_id=$_POST['hike_id'];



$hike = new Hike();
$hike_info = $hike->getHikeInfo($hike_id,$_SESSION['id']);



	
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/header.php';?>

<body>
    <title>hikeMe</title>
<?php require_once'includes/navbar.php';?>
<img id="banner" src="assets/img/photographer-1031393_1920.jpg" alt="Photographer Banner Image">

    <div class="container">
    	<div class="text-center" style="margin-top: 50px;">
		    <h1>When did you do this hike?</h1>
			<p>Select the date you did this hike</p>
			<br>
			
						
			
			
			
			
			
			
			
		</div>
    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>