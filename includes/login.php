<?php
require_once('database.php');
	if(!empty($_POST['username']) && isset($_POST['username'])){
		if(!empty($_POST['password']) && isset($_POST['password'])){
			
			$pdo = Database::connect();
			$username = $_POST['username'];
			$password = $_POST['password'];
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "SELECT * FROM user WHERE username = ? AND password =?";
		    $q = $pdo->prepare($sql);
       		$q->execute(array($username,$password));
       		if($query = $q->fetch(PDO::FETCH_ASSOC)){
	       		session_start();
				$_SESSION['name'] = $query['name'];
				$_SESSION['username'] = $query['username'];
				$_SESSION['id'] = $query['id'];
				$_SESSION['permissions'] = $query['permissions'];
	       		//print_r($query);
				header('Location: ../myhikes.php');
       		}else{
	       		header('Location: ../loginpage.php?result=error');
       		}
       		
       		
		    Database::disconnect();
		    
		    
       					
		}
	}
	
?>