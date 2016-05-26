<?php
require_once('session.php');
require_once ('database.php');
require_once ('crud.php');

if(!empty($_POST['username']) && !empty($_POST['password'])){
		
	$username = $_POST['username'];
	$password = $_POST['password'];
    
    $user = new User();
    if($user->login($username,$password)){
	    $_SESSION['name'] = $user->name;
		$_SESSION['username'] = $user->username;
		$_SESSION['id'] = $user->id;
	    header('Location: ../myhikes.php');
	    
    }else{
	    header('Location: ../loginpage.php?result=error');
    }
}