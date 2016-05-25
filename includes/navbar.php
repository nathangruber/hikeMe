<nav class="navbar navbar-default navbar-fixed-top">
<!-- <nav class="navbar navbar-default"> -->

  <div class="container">
    <div class="navbar-header">

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="cover.php"><img src="assets/img/coollogo_com-20326892.png" alt="hikeMe logo" style="float:left;">>
        </a>
     </div>


   <div id="navbar" class="collapse navbar-collapse">

    <ul class="nav navbar-nav">

	    <li><a href="index.php">Home</a></li>
	    <li><a href="myhikes.php">My Hikes</a></li>
		<li><a href="contact.php">Contact Us</a></li>
	    <li><a href="sitemap.php">Site Map</a></li>
    </ul>
    
    <?php
	  if(!$logged){
	?>
		<ul class="nav navbar-nav pull-right">
			<li><a href="register.php">Register</a></li>
		    <li><a href="loginpage.php">Login</a></li>
	    </ul>
	<?php
	  }else{
	  
	  ?>
	  <ul class="nav navbar-nav pull-right">
			<li><a href="myhikes.php"><?php echo $_SESSION['name']; ?></a></li>
		    <li><a href="logout.php">Logout</a></li>
	    </ul>
	 <?php
	  }
  	?>
      
      </nav>