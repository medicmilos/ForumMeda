<?php
	$upit1 = "SELECT COUNT(*) as ukupno FROM posts"; 
		include("konekcija.php");
		$posts = mysql_query($upit1, $konekcija); 
		mysql_close($konekcija); 
	
	$pom1 = mysql_fetch_assoc($posts);
	$broj_postova = $pom1['ukupno'];


 
	/*$upit = "SELECT * FROM menu WHERE menu_place='2'";
		include("konekcija.php");
		$rezultat = mysql_query($upit, $konekcija);  
		mysql_close($konekcija);
		
		while($red = mysql_fetch_array($rezultat)){  
			$name = $red['name'];
			$link = $red['link'];
			
			echo ("<li><a href='$link'>$name</a></li>&nbsp;");
		}*/
	
?>
<div class="cisti"></div>
<div id="mainmenuwrapper">
	<div id="mainmenu">
		<ul id='navmenu'> 
			
			<?php  
				if(@$_REQUEST['page']=='0') {
					echo("<li class='active minuspad'><a href='index.php?page=0'><b>&starf;</b><span> ALL POSTS </span>(<span id='number'>$broj_postova</span>)</a></li>");
				}else {
					echo("<li class='hoveric'><a href='index.php?page=0'><b>&starf;</b><span>ALL POSTS </span>(<span id='number'>$broj_postova</span>)</a></li>");
				}
				if(@$_REQUEST['page']=='11') {
					echo("<li  class='active  minuspad'><a href='index.php?page=11'> <b>&starf;</b> <span> Members gallery </span></a></li>");
				}else {
					echo("<li class='hoveric'><a href='index.php?page=11'>&nbsp;  <b>&starf;</b> <span> Members gallery </span></a></li>");
				}
				if(@$_REQUEST['page']=='1') {
					echo("<li class='active  minuspad'><a href='index.php?page=1'> <b>&starf;</b ><span> Cpanel </span></a></li>");
				}else if(@$_SESSION['user_mod']=='1'){
					echo("<li class='hoveric'><a href='index.php?page=1'>&nbsp;  <b>&starf;</b ><span> Cpanel </span></a></li>");
				}else{
					
				}
			?> 
			
		</ul>
		<div class="clear-fix"></div>
	</div> 
</div> 