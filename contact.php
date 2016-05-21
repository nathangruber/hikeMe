<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Blake's Butcher Shop</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Libre+Baskerville' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link rel="icon" type="image/x-icon" href="file:///Users/ngruber/Dropbox/github/nathangruber.github.io/projects/biz-project/assets/img/6954.jpg"/>
  <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
<header class="main-header" role="banner">
  <img src="assets/img/blakelogo.png" alt="Banner Image" width="400">
     </header> 
</head>

  



  <body>
<?php
require_once('navbar.php');
?>

    <div class="container">
        <div class = "row">
         <div class="col-md-4">
    
      
         <h2></h2>
<div class = "contactus">       
<p>Contact Us</p> 
</div>      
    
<form name="contactform" method="post" action="emailform.php">
 
 
  <label for="first_name">First Name *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
 
 
  <input  type="text" name="first_name" maxlength="45" size="30">
 
 
  <label for="last_name">Last Name *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
 
 
  <input  type="text" name="last_name" maxlength="45" size="30">
 
 
  <label for="email">Email Address *</label>
 
 
  <input  type="text" name="email" maxlength="45" size="30">
 
 
  <label for="telephone">Phone Number*</label>
 
  <input  type="text" name="telephone" maxlength="30" size="30">
 
  <label for="comments">Comments *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
 
  <textarea  name="comments" maxlength="1000" cols="30" rows="5"></textarea>
 
  <input type="submit" value="Submit">  

 
</form>
        </div>
      </div>
     </div> 

<?php
require_once('footer.php');
?>

   
  </body>
</html>