<?php

require_once 'includes/session.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';


if ( !empty($_POST)) {
	// keep track validation errors
	$nameError = null;
	$usernameError = null;
	$passwordError = null;

	// keep track post values
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	// validate input
	$valid = true;
	if (empty($name)) {
		$nameError = 'Please enter your Name';
		$valid = false;
	}
	if (empty($username)) {
		$usernameError = 'Please enter your Username';
		$valid = false;
	}
	if (empty($password)) {
		$passwordError = 'Please enter your Password';
		$valid = false;
	}

	// insert data
	if ($valid) {
		$user = new User();
		if($user->create($name,$username,$password)){
			header("Location: registrationsuccess.php");
		}else{
			echo 'validate doesnt exissss';
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html lang="en">
<?php require_once 'includes/header.php';?>

<head>
    <title>Registration</title>
</head>

<body>
    <?php require_once('includes/navbar.php');?>

    <div class="container" style="margin-top: 100px">
        <?php if(!$logged){ ?>

			<h1 class="text-center m-t-lg">Register</h1>            
			<div class="row">
				<div class="col-xs-12 col-md-4 col-md-offset-4">	
			
					<form class="form-horizontal" action="register.php" method="post">
					  <div class="form-group">
					    <label for="name">Name</label>
					    <input name="name" id="name" type="text" class="form-control" placeholder="Name..." value="<?php echo !empty($name)?$name:'';?>">
					    <?php if (!empty($nameError)): ?> <span class="help-inline"><?php echo $nameError;?></span> <?php endif; ?>
					  </div>
					  
					  <div class="form-group">
					    <label for="username">Username</label>
					    <input name="username" id="username" type="text" class="form-control" placeholder="Username..." value="<?php echo !empty($username)?$username:'';?>">
					    <?php if (!empty($usernameError)): ?> <span class="help-inline"><?php echo $usernameError;?></span> <?php endif;?>
					  </div>
					  
					  <div class="form-group">
					    <label for="name">Password</label>
					    <input name="password" id="name" type="password" class="form-control" placeholder="Password..." value="<?php echo !empty($password)?$password:'';?>">
					    <?php if (!empty($passwordError)): ?> <span class="help-inline"><?php echo $passwordError;?></span> <?php endif;?>
					  </div>
					  <div class="form-group">
					  <button type="submit" class="btn btn-success">Create</button> <a class="btn btn-default" href="index.php">Back</a>
					  </div>
					</form>
			
            <?php }else{ ?>

            <h3>You are currently logged in, please log out in order to create a new user.</h3><?php  } ?>
				</div>
			</div>
    </div><!-- /container -->
    <?php
require_once 'includes/footer.php';
?>
</body>
</html>
