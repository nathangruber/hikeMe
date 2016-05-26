<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

session_start();
$logged = false;
if (!empty($_SESSION['id']) && !empty($_SESSION['username'])) {
	$logged = true;
	$name = $_SESSION['name'];
}
