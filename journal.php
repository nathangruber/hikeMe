<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


$hike_id = $_POST['hike_id'];
$show_error="";
$comments="";
if(isset($_POST['option'])&&($_POST['option']=='addjournal')){
	$date = $_POST['date'];
	$comments = $_POST['comments'];
	
	//I validate the date MM-DD-YYYY
	$month=substr($date, 0,2);
	$day=substr($date, 3,2);
	$year=substr($date, 6);
	
	if(checkdate($month,$day,$year)){
		//I insert the comments
		$journal = new Journal();
		$journal->addComments($hike_id,$year."-".$month."-".$day,$comments);
		
		header('Location: myhikes.php');
	}else{
		$show_error="Invalid date, the format must be: MM-DD-YYYY";
	}
	
	
	
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
						  <input type="text" name="date" class="form-control" id="date" placeholder="MM-DD-YYYY"></textarea>
						  <?php
							if($show_error!=""){
								?>
								<div class="text-danger"><?php echo $show_error; ?></div>
								<?php
							}  
						  ?>
						</div>
					    <div class="form-group">
						  <label for="comments">Journal:</label>
						  <textarea name="comments" class="form-control" rows="5" id="comments"><?php echo $comments; ?></textarea>
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