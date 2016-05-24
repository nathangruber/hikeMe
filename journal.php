<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


$plan_id = $_POST['plan_id'];

if(isset($_POST['option'])&&($_POST['option']=='addjournal')){
	$comment = $_POST['comment'];
	
	$plan = new Plan();
	$plan->addComment($_SESSION['id'],$plan_id,$comment);
	
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
		    <h1>Add journal</h1>
			<p>Write your comments now!</p>
			<div class="row text-left">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<form method="post" enctype="multipart/form-data">
					  <div class="form-group">
					    <input type="hidden" name="option" value="addjournal">
					    <input type="hidden" name="plan_id" value="<?php echo $plan_id; ?>">
					    <div class="form-group">
						  <label for="comment">Comments:</label>
						  <textarea name="comment" class="form-control" rows="5" id="comment"></textarea>
						</div>
					  </div>
					  <button type="submit" class="btn btn-default">Upload photo</button>
					</form>
					
				</div>
			</div>
		</div>
    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>