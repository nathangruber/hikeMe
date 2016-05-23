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
            <div class="col-md-6">
                <div class="contactus">
                    <br>
                    <br>

                    <p>Contact Us</p><br>
                     <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEmail3" placeholder="First Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEmail3" placeholder="Last Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Email Address</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputPassword3" placeholder="Email Address">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Comments</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" rows="3"></textarea>
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
    </div> 

    <?php require_once 'includes/footer.php';?>
</body>
</html>
