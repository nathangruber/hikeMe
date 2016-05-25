<?php 
require_once'includes/session.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html lang="en">
<?php require_once 'includes/header.php';?>

<head>
    <title>Site Map</title>
</head>

<body>
    <?php require_once'includes/navbar.php';?>
    <br>
    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>Site Map</h2>
                <p><a href="cover.php">Cover Page</a></p>

                <ul>
                    <li>Enter hikeMe</li>
                </ul>
                
                <p><a href="index.php">Home Page</a></p>

                <ul>
                    <li>Search for your next hiking adventure.</li>
                </ul>

                <p><a href="myHikes.php">My Hikes</a></p>

                <ul>
                    <li>Favorite Hikes</li>

                    <li>Plan your Hikes</li>

                    <li>Rememeber your Hikes</li>
                </ul>

                <p><a href="contact.php">Contact hikeMe</a></p>

                <ul>
                    <li>Contact Us</li>
                </ul>

                <p><a href="register.php">Register</a></p>

                <ul>
                    <li>Register</li>
                </ul>

                <p><a href="loginpage.php">Login</a></p>

                <ul>
                    <li>Login</li>
                </ul>

               
            </div>
        </div>
    </div>
    <?php
require_once 'includes/footer.php';
?>
</body>
</html>
