<?php 
	include('user_management.php');
	session_destroy();
	header('Location: index.php');
 ?>