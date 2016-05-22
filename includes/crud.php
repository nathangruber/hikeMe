<?php


class User{
	
	public $id,$name,$birth_date,$email_address,$username;
	
	
	
	public function create($name, $birth_date, $email_address, $username, $password ){
		try{
			$pdo = Database::connect();
			$sql = "INSERT INTO user (name,birth_date,email_address,username,password) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$birth_date,$email_address,$username,$password)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function login($username,$password){
		try{
			$pdo = Database::connect();
			$sql = "select * from user where username=? and password=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($username,$password)); //asks db for info array is replacing ?info
			$result=false;
			if($query = $q->fetch(PDO::FETCH_ASSOC)){
	       		
	       		$this->id=$query['id'];
	       		$this->name=$query['name'];
	       		$this->birth_date=$query['birth_date'];
	       		$this->email_address=$query['email_address'];
	       		$this->username=$query['username'];
	       		
	       		$result= true;
       		}
       		
       		Database::disconnect();
       		return $result;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	
}


class Plan{
	public function addToFavorites($user_id,$city,$state,$name,$unique_id,$description){
		try{
			$pdo = Database::connect();
			$sql = "INSERT INTO plan (user_id,city,state,name,unique_id,description) values(?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$city,$state,$name,$unique_id,$description)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function getMyFavorites($user_id){
		try{
			$pdo = Database::connect();
			$sql = "select * from plan where user_id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id)); //asks db for info array is replacing ?info
			$result=array();
			while($row = $q->fetch(PDO::FETCH_ASSOC)){
	       		//Select all the pictures of that plan
	       		
	       		$row['photos']=$this->getPhotosOfPlan($user_id,$row['id']);
	       		
	       		$result[]=$row;
	       		
	       		
       		}
       		
       		Database::disconnect();
       		return $result;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function removeFromFavorites($user_id,$plan_id){
		try{
			$pdo = Database::connect();
			$sql = "DELETE FROM plan where user_id=? and id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$plan_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function setAsPlanned($user_id,$plan_id){
		try{
			$pdo = Database::connect();
			$sql = "UPDATE  plan SET  `type` =  'PLANNED' where user_id=? and id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$plan_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function setAsHiked($user_id,$plan_id){
		try{
			$pdo = Database::connect();
			$sql = "UPDATE  plan SET  `type` =  'HIKED' where user_id=? and id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$plan_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function uploadPhoto($user_id,$photo_name,$plan_id){
		try{
			$pdo = Database::connect();
			$sql = "INSERT INTO upload_images (user_id,photo_name,plan_id) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$photo_name,$plan_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	
	public function getPhotosOfPlan($user_id,$plan_id){
		try{
			$pdo = Database::connect();
			$sql = "select photo_name from upload_images where user_id=? and id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$plan_id)); //asks db for info array is replacing ?info
			$result=array();
			echo 'eyyyhello';
			while($row = $q->fetch(PDO::FETCH_ASSOC)){
				
	       		$result[]=$row['photo_name'];
	       		echo $row['photo_name'];
	       	}
	       	echo 'bye';
       		
       		Database::disconnect();
       		return $result;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	
}



?>
