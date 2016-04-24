<?php
	$username = $_REQUEST['username'];
	$code = $_REQUEST['code'];
	
	include('konekcija.php');
	$upit = "SELECT username, password FROM users WHERE username='".$username."' AND password='".$code."' ";
	$rezultat = mysql_query($upit, $konekcija);
	
	if($rezultat){
		$upit = "UPDATE users SET active='1' WHERE username='".$username."' and password='".$code."' ";
		$rezultat = mysql_query($upit, $konekcija);
		header("location: register.php?message=<div id='uspesno'>Registration was successful, you can login now.</div>");
	}
?>