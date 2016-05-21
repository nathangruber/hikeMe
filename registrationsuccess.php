<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<?php require_once 'includes/header.php';?>

<head>
    <title>Success</title>
</head>

<body>
    <?php
    if ($admin) {
        require_once'includes/adminNavbar.php';
    } else {
        require_once'includes/navbar.php';
    }
    ?>
	
	<div class="text-center" style="margin-top: 100px">
    <h1>Successfully Registered</h1>
	</div>
    <center>
        <p>You have successfully created an account at BBS, please login.</p>
    

    <p>go <a class="btn btn-default" href="index.php">Back</a> or <a class="btn btn-default" href="loginpage.php">Login</a>.</p></center><?php require_once 'includes/footer.php'; ?>
</body>
</html>
