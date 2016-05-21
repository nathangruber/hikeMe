<?php

// helper function for validation
function valid($varname){
	return ( !empty($varname) && isset($varname) );
}

class user {

	public function create($name, $birth_date, $email_address, $username, $password ){
		if (!valid($name) || !valid($birth_date) || !valid($email_address)|| !valid($username)|| !valid($password) ) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "INSERT INTO customer (name,birth_date,email_address,username,password) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$birth_date,$email_address,$username,$password)); //asks db for info array is replacing ?info
			Database::disconnect();
			return true;
		}
	}

	public function read($user_id){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM user WHERE id = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($customer_id));
			$data = $q->fetch(PDO::FETCH_ASSOC);
			Database::disconnect();
			return $data;
		} catch (PDOException $error){
			return NULL;
			//header( "Location: 500.php" );
			//echo $error->getMessage();
			//die();

		}

	}

	public function update($name, $birth_date, $email_address, $username, $user_id){
		if (!valid($name) || !valid($birth_date) || !valid($email_address)|| !valid($username) || !valid($user_id) ) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE user SET name = ?, birth_date = ?, email_address = ?, username = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$birth_date,$email_address,$username,$user_id));
			Database::disconnect();
			return true;
		}
	}

	public function delete($user_id){

		$pdo = Database::connect();
		$sql = "DELETE FROM user WHERE id = ?"; //taken from SQL query on phpMyAdmin
		$q = $pdo->prepare($sql);
		$q->execute(array($user_id));
		Database::disconnect();
		return true;

	}
}



class customerCreditcards {


	public $customer_id;


	public function __construct($customer_id){
		$this->customer_id = $customer_id;
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM creditcard where customer_fk = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->customer_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
			Database::disconnect();
			return $data;
		} catch (PDOException $error){

			header( "Location: 500.php" );
			die();

		}
	}
}
	
/*
class product {

	public $product_id;



	public function __construct($product_id){
		$this->product_id = $product_id;
	}

	public function create($product_name, $description, $price, $category_fk){
		if (!valid($product_name) || !valid($description) || !valid($price) || !valid($category_fk)) {
			return false;
		} else {
			try{
				$pdo = Database::connect();
				$sql = "INSERT INTO  `E-Commerce`.`product` (`product_name` ,`description` ,`price` ,`category_fk`) VALUES (?, ?, ?, ?);";
				$q = $pdo->prepare($sql);
				$q->execute(array($product_name,$description,$price,$category_fk));
				$product_id = $pdo->lastInsertId();

				$sql = "INSERT INTO product_bin (product_FK,bin_FK) values(?, ?)";
				$q = $pdo->prepare($sql);
				$q->execute(array($product_id,$bin_FK));

				Database::disconnect();
				return true;
			} catch(PDOException $error) {
				echo $error->getMessage();
			}
		}
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM product where id = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->product_id));
			$data = $q->fetch(PDO::FETCH_ASSOC);
			Database::disconnect();
			return $data;
		} catch (PDOException $error){

			header( "Location: 500.php" );
			//echo $error->getMessage();
		}
	}



	public function readAllCategory($category_id){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM product where category_fk = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($category_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
			Database::disconnect();
			return $data;
		} catch (PDOException $error){

			header( "Location: 500.php" );
			//echo $error->getMessage();
		}
	}

	public function delete($product_id){
		try{
			$pdo = Database::connect();
			$sql = "DELETE FROM product WHERE id=?"; //taken from SQL query on phpMyAdmin
			$q = $pdo->prepare($sql);
			$q->execute(array($product_id));
			Database::disconnect();
			return true;
		}catch (PDOException $error){
			echo $error->getMessage();
			die();
			//return false;
		}
	}
}

class category {



	public function create($name){
		if (!valid($name)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "INSERT INTO category (name) values(?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name)); //asks db for info array is replacing ?info
			$category_id = $pdo->lastInsertId();
			Database::disconnect();
			return true;
		}
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM category ORDER BY name';
			$data = $pdo->query($sql);
			Database::disconnect();
			return $data;
		} catch (PDOException $error){
			header( "Location: 500.php" );
			//echo $error->getMessage();
			//die();

		}
	}


	public function update($name, $category_id){
		if (!valid($name) ) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE category SET name = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$category_id));
			Database::disconnect();
			return true;
		}
	}

	public function delete($category_id){

		$pdo = Database::connect();
		$sql = "DELETE FROM category WHERE id = ?"; //taken from SQL query on phpMyAdmin
		$q = $pdo->prepare($sql);
		$q->execute(array($category_id));
		Database::disconnect();
		return true;

	}
}
*/

?>
