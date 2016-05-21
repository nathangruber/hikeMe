<?php
error_reporting(E_ALL);
session_start();
$logged = false;
if (!empty($_SESSION['id']) && !empty($_SESSION['username'])) {
	$logged = true;
	$name = $_SESSION['name'];
	require_once 'includes/database.php';
	require_once 'includes/crud.php';
}
	


