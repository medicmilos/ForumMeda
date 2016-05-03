<?php
	session_start();  
	if(isset($_SESSION['username'])){
		unset($_SESSION['id_users']);
		unset($_SESSION['username']);
		session_destroy();
		header('Location: index.php');
	}
?>