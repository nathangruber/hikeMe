<?php
error_reporting(E_ALL);
require_once 'includes/database.php';

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
		try {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO user (name,birth_date,email_address,permissions,username,password) values(?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$birth_date,$email_address,0,$username,$password));
			Database::disconnect();
			header("Location: registrationsuccess.php");
		} catch (PDOException $e) {
			Database::disconnect();
			echo "msg: " . $e->getMessage();
			die();
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

    <div class="container">
        <?php if(!$logged){ ?>

        <div class="span10 offset1">
            <div class="row">
                <h3>Register</h3>
            </div>

            <form class="form-horizontal" action="register.php" method="post">
                <div class="control-group &lt;?php echo !empty($nameError)?'error':'';?&gt;">
                    <label class="control-label">Name</label>

                    <div class="controls">
                        <input name="name" type="text" placeholder="Name" value="<?php echo !empty($name)?$name:'';?>"> <?php if (!empty($nameError)): ?> <span class="help-inline"><?php echo $nameError;?></span> <?php endif; ?>
                    </div>
                </div>
                <div class="control-group &lt;?php echo !empty($birth_dateError)?'error':'';?&gt;">
                    <label class="control-label">Date of Birth</label>

                    <div class="controls">
                        <input name="birth_date" type="text" placeholder="Date of Birth" value="<?php echo !empty($birth_date)?$birth_date:'';?>"> <?php if (!empty($birth_dateError)): ?> <span class="help-inline"><?php echo $birth_dateError;?></span> <?php endif;?>
                    </div>
                </div>
                <div class="control-group &lt;?php echo !empty($email_addressError)?'error':'';?&gt;">
                    <label class="control-label">Email Address</label>

                    <div class="controls">
                        <input name="email_address" type="text" placeholder="Email Address" value="<?php echo !empty($email_address)?$email_address:'';?>"> <?php if (!empty($email_addressError)): ?> <span class="help-inline"><?php echo $email_addressError;?></span> <?php endif;?>
                    </div>
                </div>

                <div class="control-group &lt;?php echo !empty($usernameError)?'error':'';?&gt;">
                    <label class="control-label">Username</label>

                    <div class="controls">
                        <input name="username" type="text" placeholder="Username" value="<?php echo !empty($username)?$username:'';?>"> <?php if (!empty($usernameError)): ?> <span class="help-inline"><?php echo $usernameError;?></span> <?php endif;?>
                    </div>
                </div>

                <div class="control-group &lt;?php echo !empty($passwordError)?'error':'';?&gt;">
                    <label class="control-label">Password</label>

                    <div class="controls">
                        <input name="password" type="password" placeholder="Password" value="<?php echo !empty($password)?$password:'';?>"> <?php if (!empty($passwordError)): ?> <span class="help-inline"><?php echo $passwordError;?></span> <?php endif;?>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Create</button> <a class="btn btn-default" href="index.php">Back</a>
                </div>
            </form><?php }else{ ?>

            <h3>You are currently logged in, please log out in order to create a new user.</h3><?php  } ?>
        </div>
    </div><!-- /container -->
    <?php
require_once 'includes/footer.php';
?>
</body>
</html>
