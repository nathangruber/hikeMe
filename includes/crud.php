 <?php


class User{
	
	public $id,$name,$username;
	
	public function create($name,$username,$password ){
		try{
			$pdo = Database::connect();
			$sql = "INSERT INTO user (name,username,password) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$username,$password)); //asks db for info array is replacing ?info
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

class Hike{
	public function addToFavorites($unique_id,$name,$city,$state,$description,$user_id){
		try{
			$pdo = Database::connect();
			$sql = "INSERT INTO hike (unique_id,name,city,state,description,user_fk) values(?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($unique_id,$name,$city,$state,$description,$user_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function removeFromFavorites($user_id,$hike_id){
		try{
			$pdo = Database::connect();
			$sql = "DELETE FROM hike where user_fk=? and id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id,$hike_id)); 
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function getMyFavorites($user_id,$type){
		try{
			$pdo = Database::connect();
			if($type =='planned'){
				$sql = "select * from hike where user_fk=? and date!='0000-00-00' and hiked_date ='0000-00-00'";
			}else if($type =='completed'){
				$sql = "select * from hike where user_fk=? and hiked_date!='0000-00-00'";
			}else{
				$sql = "select * from hike where user_fk=?";
			}
			$q = $pdo->prepare($sql);
			$q->execute(array($user_id)); //asks db for info array is replacing ?info
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
	
	public function getHikeInfo($hike_id,$user_id){
		try{
			$pdo = Database::connect();
			$sql = "select * from hike where id=? and user_fk=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($hike_id,$user_id)); //asks db for info array is replacing ?info
			$result=array();
			if($row = $q->fetch(PDO::FETCH_ASSOC)){
	       		$result = $row;
	       	}
       		
       		Database::disconnect();
       		return $result;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function getHikeInfoPublic($hike_id){
		try{
			$pdo = Database::connect();
			$sql = "select * from hike where id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($hike_id)); //asks db for info array is replacing ?info
			$result=array();
			if($row = $q->fetch(PDO::FETCH_ASSOC)){
	       		$result = $row;
	       	}
       		
       		Database::disconnect();
       		return $result;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function plan($hike_id,$user_id,$date,$weather_desc,$weather_temp,$weather_wind){
		try{
			$pdo = Database::connect();
			$sql = "UPDATE  `hike` SET  `date` =  ?,`weather_desc` =  ?,`weather_temp` =  ?,`weather_wind` =  ? WHERE  `id` =? and user_fk=?;";
			$q = $pdo->prepare($sql);
			$q->execute(array($date,$weather_desc,$weather_temp,$weather_wind,$hike_id,$user_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function done($hike_id,$user_id,$date){
		try{
			$pdo = Database::connect();
			$sql = "UPDATE  hike SET  hiked_date =  ? WHERE  id =? and user_fk=?;";
			$q = $pdo->prepare($sql);
			$q->execute(array($date,$hike_id,$user_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	
	
}

class Image{
	public function uploadPhoto($photo_name,$hike_id){
		try{
			$pdo = Database::connect();
			$sql = "INSERT INTO image (name,hike_fk) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($photo_name,$hike_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function getPhotos($hike_id){
		try{
			$pdo = Database::connect();
			$sql = "select * from image where hike_fk=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($hike_id)); //asks db for info array is replacing ?info
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
	
	
	public function getInfo($image_id){
		try{
			$pdo = Database::connect();
			$sql = "select * from image where id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($image_id)); 
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
	
	public function setAsPublic($image_id){
		try{
			$pdo = Database::connect();
			$sql = "UPDATE  image SET  `public` =  '1' where id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($image_id)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function setAsPrivate($image_id){
		try{
			$pdo = Database::connect();
			$sql = "UPDATE  image SET  `public` =  '0' where id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($image_id)); 
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	public function getPublic($unique_id){
		try{
			$pdo = Database::connect();
			$sql = "SELECT * FROM hike, image WHERE hike.unique_id =  ? AND hike.id = image.hike_fk AND image.public = 1 LIMIT 0 , 30";
			$q = $pdo->prepare($sql);
			$q->execute(array($unique_id)); 
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
	
	public function delete($unique_id){
		try{
			$pdo = Database::connect();
			$sql = "DELETE FROM image WHERE  id=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($unique_id)); //asks db for info array is replacing ?info
			
       		
       		Database::disconnect();
       		return true;
			
		}catch (PDOException $error){
			return false;
		}
	}
	
	
}


class Journal{
	/*public function addComments($hike_id,$date,$comments){
		try{
			$pdo = Database::connect();
			$sql = "INSERT INTO journal (hike_fk,date,comments) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($hike_id,$date,$comments));
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	*/
	public function get($hike_id){
		try{
			$pdo = Database::connect();
			$sql = "SELECT * FROM journal where hike_fk=? order by date asc";
			echo $sql;
			$q = $pdo->prepare($sql);
			$q->execute(array($hike_id)); //asks db for info array is replacing ?info
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
	
	public function saveJournal($hike_id,$comments){
		try{
			$pdo = Database::connect();
			$sql = "INSERT INTO journal (hike_fk,comments) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($hike_id,$comments));
			$count = $q->rowCount();
			if($count==0){//Wasn't possible to insert so update it
				echo "update ittttt";
			}
			
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			return false;
		}
	}
	
	
}

/*

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
*/
