<?php
	$username = $_REQUEST['username'];
	$token = $_REQUEST['token'];
	
	include('konekcija.php');
	$upit1 = "SELECT username, password FROM users WHERE username='".$username."' AND password='".$token."' ";
	$rezultat2 = mysql_query($upit1, $konekcija);
	mysql_close($konekcija);
	
	if($rezultat2){
		include('konekcija.php');
		$upit = "UPDATE users SET active='1' WHERE username='".$username."' ";
		$rezultat = mysql_query($upit, $konekcija); 
		mysql_close($konekcija);
		header("location:index.php?page=0&message= <div class='success'> Registration was successful, you can login now!</div>");
	}
?> 