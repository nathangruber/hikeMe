<?php
session_start();
	
	$logged = false;
	if (!empty($_SESSION['id']) && !empty($_SESSION['username'])) {
		$logged = true;
		$name = $_SESSION['name'];
	}
	
error_reporting(E_ALL);
require_once 'database.php';
require_once 'crud.php';
