<?php
	$upit1 = "SELECT COUNT(*) as ukupno FROM posts"; 
		include("konekcija.php");
		$posts = mysql_query($upit1, $konekcija); 
		mysql_close($konekcija); 
	
	$pom1 = mysql_fetch_assoc($posts);
	$broj_postova = $pom1['ukupno']; 
?>
<div class="cisti"></div>
<div id="mainmenuwrapper">
	<div id="mainmenu">
		<ul id="navmenu">

			<li class="active">
				<a href="index.php">
					<b>&starf;</b>
					<span>ALL POSTS</span>
					(<span id="number"><?php echo("$broj_postova")?></span>)
				</a>
			</li>

			<li>
				<a href="#">
					<b>&plus;</b>
					<span>Following</span>
				</a>
			</li>
		</ul>
		<div class="clear-fix"></div>
	</div> 
</div> 