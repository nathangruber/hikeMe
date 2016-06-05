<nav class="navbar navbar-default navbar-fixed-top">

  <div class="container">
    <div class="navbar-header">

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
    </button>
       <a class="navbar-brand" href="coverhikeMe.php"><img src="assets/img/coollogo_com-20326892.png" alt="hikeMe logo" style="float:left"></a>
   </div>

   <div id="navbar" class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
		<li><a href="index.php">Home</a></li>
	    <li><a href="myhikes.php">My Hikes</a></li>
		<li><a href="contact.php">Contact Us</a></li>
    </ul>
   
	<form method="post" action="index.php" class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search by city..." name="search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
	
	
   	<ul class="nav navbar-nav pull-right">
	   	
	   	
    <?php
	  if(!$logged){
		echo '<li><a href="register.php">Register</a></li>';
	    echo '<li><a href="loginpage.php">Login</a></li>';
	  }else{
	  	echo '<li><a href="myhikes.php">' . $_SESSION['name'] . '</a></li>';
		echo '<li><a href="logout.php">Logout</a></li>';
	  }
  	?>
  	</ul>
</nav>