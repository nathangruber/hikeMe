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
	       		$row['comments']=$this->getCommentsOfPlan($user_id,$row['id']);
	       		
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
	
	public function setAsHiked($user_id,$plan_id,$todays_weather){
		try{
			$pdo = Database::connect();
			$sql = "UPDATE  plan SET  `type` =  'HIKED',`hiked_day` =  now(),`hiked_weather` =  ? where user_id=? and id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($todays_weather,$user_id,$plan_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function uploadPhoto($user_id,$photo_name,$plan_id){
		try{
			
			$unique_id = $this->getUniqueId($plan_id);
			
			$pdo = Database::connect();
			$sql = "INSERT INTO upload_images (user_id,photo_name,plan_id,unique_id) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$photo_name,$plan_id,$unique_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function getUniqueId($plan_id){
		try{
			$pdo = Database::connect();
			$sql = "select * from plan where id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($plan_id)); //asks db for info array is replacing ?info
			$result=array();
			if($row = $q->fetch(PDO::FETCH_ASSOC)){
				
	       		return $row['unique_id'];
	       	}
       		
       		Database::disconnect();
       		return $result;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	
	public function getPhotosOfPlan($user_id,$plan_id){
		try{
			$pdo = Database::connect();
			$sql = "select * from upload_images where user_id=? and plan_id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$plan_id)); //asks db for info array is replacing ?info
			$result=array();
			while($row = $q->fetch(PDO::FETCH_ASSOC)){
				
	       		$result['name'][]=$row['photo_name'];
	       		$result['id'][]=$row['id'];
	       		$result['public_photo'][]=$row['public_photo'];
	       	}
       		
       		Database::disconnect();
       		return $result;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function getPublicPhotosOfPlan($unique_id){
		try{
			$pdo = Database::connect();
			$sql = "select * from upload_images where unique_id=? and public_photo=1";
			$q = $pdo->prepare($sql);
			$q->execute(array($unique_id)); //asks db for info array is replacing ?info
			$result=array();
			while($row = $q->fetch(PDO::FETCH_ASSOC)){
				
	       		$result[]=$row;
	       	}
       		
       		Database::disconnect();
       		return $result;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function addComment($user_id,$plan_id,$comment){
		try{
			$pdo = Database::connect();
			$sql = "INSERT INTO journal (user_id,plan_id,comment) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$plan_id,$comment)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function getCommentsOfPlan($user_id,$plan_id){
		try{
			$pdo = Database::connect();
			$sql = "select * from journal where user_id=? and plan_id=? order by id desc";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$plan_id)); //asks db for info array is replacing ?info
			$result=array();
			while($row = $q->fetch(PDO::FETCH_ASSOC)){
				
	       		$result[]=$row['comment'];
	       	}
       		
       		Database::disconnect();
       		return $result;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	
	public function getPhotoDetails($user_id,$photo_id){
		try{
			$pdo = Database::connect();
			$sql = "select * from upload_images where user_id=? and id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$photo_id)); //asks db for info array is replacing ?info
			$result=array();
			if($row = $q->fetch(PDO::FETCH_ASSOC)){
				
	       		$result=$row;
	       	}else{
		       	Database::disconnect();
			   	return false;
	       	}
       		
       		Database::disconnect();
       		return $result;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function setPhotoAsPublic($user_id,$photo_id){
		try{
			$pdo = Database::connect();
			$sql = "UPDATE  upload_images SET  `public_photo` =  '1' where user_id=? and id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$photo_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function setPhotoAsPrivate($user_id,$photo_id){
		try{
			$pdo = Database::connect();
			$sql = "UPDATE  upload_images SET  `public_photo` =  '0' where user_id=? and id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$photo_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	
}

