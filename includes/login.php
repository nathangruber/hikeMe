<?php
require_once('session.php');
	if(!empty($_POST['username']) && isset($_POST['username'])){
		if(!empty($_POST['password']) && isset($_POST['password'])){
			
			
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
	}
	
?>