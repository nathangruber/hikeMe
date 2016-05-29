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
			
			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-4">
				<form method="post" action="hikedone.php">
					<div class="form-group"> <!-- Date input -->
					<label class="control-label" for="date">Date</label>
					<input class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" type="text"/>
					</div>
					<div class="form-group"> <!-- Submit button -->
					<button class="btn btn-primary " name="submit" type="submit">Submit</button>
					</div>
				</form>	
				</div>
			</div>
			
			
			
			
			
			
			
		</div>
    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>