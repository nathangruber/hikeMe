<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


if(isset($_POST['option'])&&($_POST['option']=='setashiked')){
	$plan_id = $_POST['plan_id'];
	
	$plan = new Plan();
	$plan->setAsHiked($_SESSION['id'],$plan_id);
	
	$message_favorites_show = true;
	$message_favorites_text = "This hike ".$name." is now hiked";
	
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
		    <h1>Upload photo</h1>
			
			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<form>
					  <div class="form-group">
					    <label for="exampleInputFile">File input</label>
					    <input type="file" id="exampleInputFile">
					    <p class="help-block">Upload your photo</p>
					  </div><button type="submit" class="btn btn-default">Upload</button>
					</form>
				</div>
			</div>
		</div>
    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>