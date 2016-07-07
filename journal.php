<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


$hike_id = $_POST['hike_id'];
$show_error="";
$comments="";
if(isset($_POST['option'])&&($_POST['option']=='addjournal')){
	$comments = $_POST['comments'];
	

	
	
		//save journal
		$journal = new Journal();
		$journal->saveJournal($hike_id,$comments);
		
		header('Location: hike-edit.php?id='.$hike_id);
}

$journal = new Journal();
$results = $journal->get($hike_id);

if($results!=false){
	$comments = $results['comments'];
}else{
	$comments="";
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
					  <div class="paper">
					    <input type="hidden" name="option" value="addjournal">
					    <input type="hidden" name="hike_id" value="<?php echo $hike_id; ?>">
					    <div class="paper-content">
						  <label for="comments">Journal:</label>
						  <textarea autofocus name="comments" class="form-control" rows="20" id="comments"><?php echo $comments; ?></textarea>
						</div>
					  </div>
					  <button type="submit" class="btn btn-success">Submit</button>
					</form>
					
				</div>
			</div>
		</div>
    </div>
<?php require_once 'includes/footer.php'; ?>
</body>
</html>