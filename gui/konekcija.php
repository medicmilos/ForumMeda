<?php 
	$konekcija = mysql_connect('localhost', 'root', '0454527676842');
	$database = mysql_select_db('meda_forum') or die( "Database in unavailable!"); 
	
	if (!$konekcija) {
		die('Database connection has timed out! '.mysql_error());
	}
?> 