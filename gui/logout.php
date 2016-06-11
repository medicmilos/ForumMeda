<?php
	session_start();  
	if(isset($_SESSION['username'])){
		unset($_SESSION['id_users']);
		unset($_SESSION['username']);
		session_destroy();
		header("location:index.php?page=0&message= <div class='info'> See you later ".$_SESSION['username']."!</div>");
	}
?>