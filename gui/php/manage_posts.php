<div id="sadrzaj"> 
		<div id='admin-nav'>
			<span class='admin-nav-cont'><a href='index.php?page=3'>Users</a></span>
			<span class='admin-nav-cont'><a href='index.php?page=12'>Posts</a></span>
			<span class='admin-nav-cont'><a href='index.php?page=15'>Comments</a></span>
			<span class='admin-nav-cont'><a href='index.php?page=16'>Nested comments</a></span>
			<span class='admin-nav-cont'><a href=''>Polls</a></span>
		</div>
	 
	<?php   
	
		$koliko_po_strani = 2;
		if(@$_GET['skriveno']) {
			$skriveno = $_GET['skriveno'];
		}else {
			$skriveno = 0;
		}
		include ("konekcija.php");
		$upit2 = mysql_query("SELECT count(id_posts) FROM posts");
		$niz = mysql_fetch_array($upit2);
		$ukupno_zapisa = $niz[0];
		$levo = $skriveno - $koliko_po_strani;
		$desno = $skriveno + $koliko_po_strani;
		// Zaglavlje tabele sa navigacijom
		echo ("<tr><td width=\"50px\">");
		$xyz="";
		if($levo<0){
			
			
			
			if(($ukupno_zapisa-$skriveno)<=$koliko_po_strani){
				$xyz="</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td width=\"50px\">";
			}else{
				$xyz="</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td width=\"50px\"><a class='naprednazad' href=\"index.php?page=12&skriveno=$desno\"> Forward</a>";
			}
			
			
		}elseif($desno >= $ukupno_zapisa){
			$xyz="</td><td><a href=\"index.php?page=12&skriveno=$levo\"  class='naprednazad' > Back </a></td><td></td><td></td><td></td><td></td><td></td><td></td><td width=\"50px\"> ";
		}else {
			$xyz="</td><td><a href=\"index.php?page=12&skriveno=$levo\" class='naprednazad' > Back </a></td><td></td><td></td><td></td><td></td><td></td><td></td><td width=\"50px\"><a href=\"index.php?page=12&skriveno=$desno\" class='naprednazad' > Forward </a>";
		}
			
		
		
		$upit = "SELECT * FROM posts LIMIT $koliko_po_strani OFFSET $skriveno";
				include("konekcija.php");
				$rezultat = mysql_query($upit, $konekcija);  
				mysql_close($konekcija);
			echo("<div class='tableusers tableposts'>");
			echo("<table border='2.75' width='100%'><form>");
			echo $xyz;
			echo ("</td></tr>"); 
			echo("<tr><td>ID</td><td>Title</td><td>Username</td><td>Views</td><td>Votes</td><td>Tags</td><td hidden>db_id</td><td>Manage</td><td>Delete</td></tr>");
			$pom = 0;
			while($red = mysql_fetch_array($rezultat)){  
				$idpost = $red['id_posts']; 
				$title = $red['title']; 
				$description = $red['description'];
				$username = $red['username'];
				$votes = $red['votes'];
				$views = $red['views'];
				$tags = $red['tags']; 
				$pom++;
				
				 
				echo("<tr>
					<td>$pom</td>
					<td>$title</td>  
					<td>$username</td>
					<td>$views</td>
					<td>$votes</td>
					<td>$tags</td>
					<td hidden>$idpost</td>
					<td id='xmark1'><a href='index.php?page=13&id=$idpost'>&#9997;</a></td>
					<td id='xmark2'><a href='index.php?page=12&delete=$idpost'>&#10006;</a></td>
				</tr>"); 
			}
			echo("</table></form>");
			echo("</div>")
			;
		if(isset($_REQUEST['delete'])){
			$upit = "DELETE FROM posts WHERE id_posts='".$_REQUEST['delete']."'";
				include("konekcija.php");
				$rezultat = mysql_query($upit, $konekcija);  
				mysql_close($konekcija);
		}
	
	?>
	
</div>
<div id="desno">
	<?php
		include("widget.php");
	?>
</div>
 