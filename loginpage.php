<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html lang="en">
<?php require_once 'includes/header.php';?>

<head>
    <title>Login Page</title>
</head>

<body>
    <?php require_once 'includes/navbar.php';?>

    <div class="container">
	    <div class="row">
		    <div class="col-xs-12 col-md-4 col-md-offset-4">
			    
			    
			    
			    <h1 style="margin-top: 100px">Login</h1>
			    <?php
				  if($_GET['result']=='error'){
					  echo '<b class="text-danger">Username or password not valid.</b>';
				  }  
				?>
		        <div class="starter-template">
		            <p class="lead">Enter Username and Password to login.<br></p>
		        </div>
		
		        <div>
		            <form action="includes/login.php" method="post">
		                <input type="text" name="username" placeholder="username"> <input type="password" name="password" placeholder="password"> <input class="btn btn-default" type="submit" value="Login">
		            </form>
		        </div>
		
		        <div>
		            <p>No Account? Register below</p>
		        </div>
		
		        <div>
		            <form action="register.php" method="post">
		                <input class="btn btn-default" type="submit" value="Register">
		            </form>
		        </div>
		    </div>
	    </div>
    </div>
    
    
    <?php
require_once 'includes/footer.php';
?>
</body>
</html>
