<?php require_once'includes/session.php';?>
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
            <div class="col-md-4">
                <div class="contactus">
                    <br>
                  <p>Contact hikeMe</p>
                    <br>
                </div>
                     <form class="form-horizontal" name="contactform" method="post" action="emailform.php">
                      <div class="form-group">
                        <label for="first_name" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="first_name" placeholder="First Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email Address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="email" placeholder="Email Address">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="last_name" class="col-sm-2 control-label">Phone Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="telephone" placeholder="Last Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="comments" class="col-sm-2 control-label">Comments<br></label>
                        <div class="col-sm-10">
                       <p>&nbsp;</p><textarea class="form-control" rows="3" name="comments"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>

    <?php require_once 'includes/footer.php';?>
</body>
</html>
