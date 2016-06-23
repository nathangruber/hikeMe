<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


$show_error="";

if(isset($_POST['date'])){
	
	
	$hike_id=$_POST['hike_id'];
	$user_id=$_SESSION['id'];
	$date = $_POST['date'];
	
	//validate the date MM-DD-YYYY
	$month=substr($date, 0,2);
	$day=substr($date, 3,2);
	$year=substr($date, 6);
	
	if(checkdate($month,$day,$year)){
		$hike = new Hike();
		$hike->done($hike_id,$user_id,$year."-".$month."-".$day);
		
		header('Location: myhikes.php');
	}else{
		$show_error="Invalid date, the format must be: MM-DD-YYYY";
	}
	
	
	
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
<img id="banner" src="assets/img/stairway-1149473_1280.jpg" alt="Photographer Banner Image">

    <div class="container">
    	<div class="text-center" style="margin-top: 50px;">
		    <h1>When did you hike this trail?</h1>
			<p>Select the date you hiked it.</p>
			<br>
			
			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3">

				<form method="post" action="hikedone.php">
					<input type="hidden" name="hike_id" value="<?php echo $hike_id; ?>">
					<div class="form-group"> <!-- Date input -->
					<label class="control-label" for="date">Date</label>
					<input class="form-control" id="date" name="date" placeholder="MM-DD-YYYY" type="text"/>
					<?php
						if($show_error!=""){
							?>
							<div class="text-danger"><?php echo $show_error; ?></div>
							<?php
						}  
					  ?>
					</div>
					<div class="form-group">
					<button class="btn btn-success " name="submit" type="submit">Submit</button><br>
					</div>
				</form>	
				</div>
			</div>
		</div>
    </div>
<?php require_once 'includes/footer.php'; ?>
</body>
</html>