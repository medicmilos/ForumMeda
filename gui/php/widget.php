<?php
	$upit1 = "SELECT COUNT(*) as ukupno FROM posts";
	$upit2 = "SELECT COUNT(*) as ukupno FROM users";
	$upit3 = "SELECT COUNT(*) as ukupno FROM comments";
		include("konekcija.php");
		$posts = mysql_query($upit1, $konekcija);
		$users = mysql_query($upit2, $konekcija);
		$comments = mysql_query($upit3, $konekcija);
		mysql_close($konekcija); 
	
	$pom1 = mysql_fetch_assoc($posts);
	$broj_postova = $pom1['ukupno'];
	
	$pom2 = mysql_fetch_assoc($users);
	$broj_usera = $pom2['ukupno'];
	
	$pom3 = mysql_fetch_assoc($comments);
	$broj_komentara = $pom3['ukupno'];

	echo (
		"<div id='desnocontent'>
			<p>STATISTICS</p>
			<div id='statistika'> 
				<div class='tridela' id='members'>
					<span class='brojevi' id='broj'>$broj_usera</span>
					<span class='spanovi' >MEMBERS</span>
				</div>
				<div class='tridela' id='posts'>
					<span class='brojevi' id='posts'>$broj_postova</span>
					<span class='spanovi'>POSTS</span>
				</div>
				<div class='tridela' id='comments'>
					<span class='brojevi' id='comments'>$broj_komentara</span>
					<span class='spanovi'>COMMENTS</span>
				</div>
			</div>
		</div>"
	);
?>