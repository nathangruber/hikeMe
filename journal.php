<?php 
require_once 'includes/session.php';
require_once 'includes/sessioncheck.php';
require_once 'includes/database.php';
require_once 'includes/crud.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/header.php';?>

<body>
    <title>hikeMe</title>
     <?php
	 require_once'includes/navbar.php';?>
	 <div class="container">
	  <div class="form-group">
  <label for="comment">Hiking Journal:</label>
	  <textarea class="form-control" rows="5" id="comment"></textarea>
	 </div>
