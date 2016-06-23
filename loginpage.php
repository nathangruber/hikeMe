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
		            <p class="lead">Enter Username and Password to Login.<br></p>
		        </div>
		
		            <form class="form-horizontal" action="includes/login.php" method="post">
					  <div class="form-group">
					    <label for="username">Username</label>
					    <input name="username" id="username" type="text" class="form-control" placeholder="Username...">
					  </div>
					  
					  <div class="form-group">
					    <label for="name">Password</label>
					    <input name="password" id="name" type="password" class="form-control" placeholder="Password...">
					  </div>
					  
					  <div class="form-group">
					  <button type="submit" class="btn btn-success">Login</button>
					  </div>
					</form>
		        <div>
		            <center><p>No Account? Register Below</p></center>
		            <center><a href="register.php" class="btn btn-default">Register</a></center>
		            <br>
		        </div>
		    </div>
	    </div>
    </div>
<?php require_once 'includes/footer.php';?>
</body>
</html>
