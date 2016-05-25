<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


$plan_id = $_POST['plan_id'];

if(isset($_POST['option'])&&($_POST['option']=='uploadphoto')){
	$plan_id = $_POST['plan_id'];
	
	$target_dir = "uploads/";
	
	$new_name_file = $_SESSION['id']."-".rand(1,9999999) .basename($_FILES["fileToUpload"]["name"]);
	$target_file = $target_dir . $new_name_file;
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	        
	        //Store in the database the name of the file of this user
	        
	        
	        //echo '<img src="'.$target_file.'"/>';
			
	        
	        $plan = new Plan();
	        $plan->uploadPhoto($_SESSION['id'],$new_name_file,$_POST['plan_id']);
	        
	        header('Location: myhikes.php');
	        
	        
	        
	    } else {
	        echo "Sorry, there was an error uploading your photo.";
	    }
	}
}



	
	
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/header.php';?>

<body>
    <title>hikeMe</title>
<?php require_once'includes/navbar.php';?>
<img id="banner" src="assets/img/photographer-519565_640.jpg" alt="Photographer Banner Image">

    <div class="container">
    	<div class="text-center" style="margin-top: 100px;">
		    <h1>Upload Photo to hikeMe</h1>
			<p>Make your photo public, and share it in the trail search.</p>
			<br>
			<div class="row text-left">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<form method="post" enctype="multipart/form-data">
					  <div class="form-group">
					    <input type="hidden" name="option" value="uploadphoto">
					    <input type="hidden" name="plan_id" value="<?php echo $plan_id; ?>">
					    <input type="file" name="fileToUpload" id="fileToUpload">
					  </div><button type="submit" class="btn btn-default">Upload Photo</button>
					</form>
					<br>	
				</div>
			</div>
		</div>
    </div>
<?php require_once 'includes/footer.php'; ?>


</body>
</html>