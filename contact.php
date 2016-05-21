<?php require_once('includes/session.php');?>
<!DOCTYPE html>

<html lang="en">
<?php require_once 'includes/header.php';?>

<head>
    <title>Contact Us</title>
</head>

<body>
    <?php require_once'includes/navbar.php';?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contactus">
                    <br>
                    <br>

                    <p>Contact Us</p><br>

                    <form name="contactform" method="post" action="emailform.php">
                        <label for="first_name">First Name</label> <input type="text" name="first_name" maxlength="45" size="30"> <label for="last_name">Last Name </label> <input type="text" name="last_name" maxlength="45" size="30"> <label for="email">Email Address *&nbsp;</label> <input type="text" name="email" maxlength="45" size="30"> <label for="telephone">Phone Number*</label> <input type="text" name="telephone" maxlength="30" size="30"> <label for="comments">Comments *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                        <textarea name="comments" maxlength="1000" cols="30" rows="5">
</textarea> <input class="btn btn-default" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div><?php
                require_once('includes/footer.php');
                ?>
    </div>
</body>
</html>
