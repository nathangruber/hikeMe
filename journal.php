<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


$hike_id = $_POST['hike_id'];

if(isset($_POST['option'])&&($_POST['option']=='addjournal')){
	$date = $_POST['date'];
	$comments = $_POST['comments'];
	
	$journal = new Journal();
	$journal->addComments($hike_id,$date,$comments);
	
	header('Location: myhikes.php');
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
		    <h1>Trail Journal</h1>
			<div class="row text-left">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<form method="post" enctype="multipart/form-data">
					  <div class="form-group">
					    <input type="hidden" name="option" value="addjournal">
					    <input type="hidden" name="hike_id" value="<?php echo $hike_id; ?>">
					    <div class="form-group">
						  <label for="comments">Date:</label>
						  <input type="text" name="date" class="form-control" id="date" placeholder="YYYY-MM-DD"></textarea>
						</div>
					    <div class="form-group">
						  <label for="comments">Comments:</label>
						  <textarea name="comments" class="form-control" rows="5" id="comments"></textarea>
						</div>
					  </div>
					  <button type="submit" class="btn btn-default">Submit</button>
					</form>
					
				</div>
			</div>
		</div>
    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>