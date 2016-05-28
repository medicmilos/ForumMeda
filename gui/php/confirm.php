<?php
	$username = $_REQUEST['username'];
	$code = $_REQUEST['code'];
	
	include('konekcija.php');
	$upit = "SELECT username, password FROM users WHERE username='".$username."' AND password='".$code."' ";
	$rezultat = mysql_query($upit, $konekcija);
	
	if($rezultat){
		$upit = "UPDATE users SET active='1' WHERE username='".$username."' and password='".$code."' ";
		$rezultat = mysql_query($upit, $konekcija); 
		header("location:index.php?message= <div class='success'> Registration was successful, you can login now!</div>");
	}
?>