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

                            <form name="contactform" method="post" action="emailform.php">
                            <label for="first_name">First Name *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                            <input type="text" name="first_name" maxlength="45" size="30"> 
                            <br>
                            <label for="last_name">Last Name     *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                            <input type="text" name="last_name" maxlength="45" size="30"> 
                            <br>
                            <label for="email">Email Address *&nbsp;</label>
                             <input type="text" name="email" maxlength="45" size="30"> 
                             <br>
                             <label for="telephone">Phone Number*&nbsp;</label> 
                             <input type="text" name="telephone" maxlength="30" size="30"> 
                            <br>
                             <label for="comments">Comments *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                            <textarea name="comments" maxlength="1000" cols="40" rows="15">
                            </textarea> <input class="btn btn-default" type="submit" value="Submit">
                        </form>
                </div>
            </div>
        </div>
    </div> 
<form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Email Address</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Comments</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
    <?php require_once 'includes/footer.php';?>
</body>
</html>
