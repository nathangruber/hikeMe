<?php
echo "document root is: ".$_SERVER['DOCUMENT_ROOT'];

require_once 'includes/session.php';



if ( !empty($_POST)) {
	// keep track validation errors
	$nameError = null;
	$birth_dateError = null;
	$email_addressError = null;
	$usernameError = null;
	$passwordError = null;

	// keep track post values
	$name = $_POST['name'];
	$birth_date = $_POST['birth_date'];
	$email_address = $_POST['email_address'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	// validate input
	$valid = true;
	if (empty($name)) {
		$nameError = 'Please enter your Name';
		$valid = false;
	}
	if (empty($birth_date)) {
		$birth_dateError = 'Please enter your Date of Birth';
		$valid = false;
	}
	if (empty($email_address)) {
		$email_addressError = 'Please enter a valid Email Address';
		$valid = false;
	} else if ( !filter_var($email_address,FILTER_VALIDATE_EMAIL) ) {
			$email_addressError = 'Please enter a valid Email Address';
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
		if($user->create($name,$birth_date,$email_address,$username,$password)){
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
					    <label for="birth_date">Date of Birth</label>
					    <input name="birth_date" id="birth_date" type="text" class="form-control" placeholder="Date of birth..." value="<?php echo !empty($birth_date)?$birth_date:'';?>">
					    <?php if (!empty($birth_dateError)): ?> <span class="help-inline"><?php echo $birth_dateError;?></span> <?php endif;?>
					  </div>
					  
					  <div class="form-group">
					    <label for="email_address">Email</label>
					    <input name="email_address" id="email_address" type="email" class="form-control" placeholder="Email..." value="<?php echo !empty($email_address)?$email_address:'';?>">
					    <?php if (!empty($email_addressError)): ?> <span class="help-inline"><?php echo $email_addressError;?></span> <?php endif;?>
					  </div>
					  
					  <div class="form-group">
					    <label for="username">User name</label>
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
