<?php 
session_start(); 
if (!isset($_SESSION['auth'])) {
	unset($_SESSION['auth']);
}
if (!isset($_SESSION['school_id'])) {
	unset($_SESSION['school_id']);
}
setcookie('school_id');

session_destroy();

header("Location: index.php");

?>