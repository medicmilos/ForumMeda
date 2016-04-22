<?php
	@mysql_set_charset('utf8');
	@$conn = mysql_connect('localhost', 'root', '');
	$database = mysql_select_db('root', $conn);
	
	if (!$conn) {
		die('Veza sa serverom baze podataka nije uspostavljena! ');
	}
?> 