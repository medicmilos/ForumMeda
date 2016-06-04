<div id="sadrzaj"> 
		<div id='admin-nav'>
			<span class='admin-nav-cont'><a href='index.php?page=3'>Users</a></span>
			<span class='admin-nav-cont'><a href='index.php?page=12'>Posts</a></span>
			<span class='admin-nav-cont'><a href='index.php?page=15'>Comments</a></span>
			<span class='admin-nav-cont'><a href='index.php?page=16'>Nested comments</a></span>
			<span class='admin-nav-cont'><a href=''>Polls</a></span>
		</div>
	 
	<?php   
	
		$koliko_po_strani = 3;
		if(@$_GET['skriveno']) {
			$skriveno = $_GET['skriveno'];
		}else {
			$skriveno = 0;
		}
		include ("konekcija.php");
		$upit2 = mysql_query("SELECT count(id_comments) FROM comments");
		$niz = mysql_fetch_array($upit2);
		$ukupno_zapisa = $niz[0];
		$levo = $skriveno - $koliko_po_strani;
		$desno = $skriveno + $koliko_po_strani;
		// Zaglavlje tabele sa navigacijom
		echo ("<tr><td width=\"50px\">");
		$xyz="";
		if($levo<0){
			
			
			
			if(($ukupno_zapisa-$skriveno)<=$koliko_po_strani){
				$xyz="<td></td><td></td><td></td><td></td><td width=\"50px\">";
			}else{
				$xyz="<td></td><td></td><td></td><td></td><td width=\"50px\"><a class='naprednazad' href=\"index.php?page=15&skriveno=$desno\"> Forward</a>";
			}
			
			
		}elseif($desno >= $ukupno_zapisa){
			$xyz="<td><a href=\"index.php?page=15&skriveno=$levo\"  class='naprednazad' > Back </a></td><td></td><td></td><td></td><td width=\"50px\"> ";
		}else {
			$xyz="<td><a href=\"index.php?page=15&skriveno=$levo\" class='naprednazad' > Back </a></td><td></td><td></td><td></td><td width=\"50px\"><a href=\"index.php?page=15&skriveno=$desno\" class='naprednazad' > Forward </a>";
		}
			
		
		
		$upit = "SELECT * FROM comments LIMIT $koliko_po_strani OFFSET $skriveno";
				include("konekcija.php");
				$rezultat = mysql_query($upit, $konekcija);  
				mysql_close($konekcija);
			echo("<div class='tableusers tableposts2'>");
			echo("<table border='2.75' width='100%'><form>");
			echo $xyz;
			echo ("</td></tr>"); 
			echo("<tr><td>ID</td><td>Username</td><td>Comment</td><td hidden>db_id</td><td>Manage</td><td>Delete</td></tr>");
			$pom = 0;
			while($red = mysql_fetch_array($rezultat)){  
				$idcomment = $red['id_comments']; 
				$username = $red['username']; 
				$comment = $red['comment']; 
				
				$pom++;
				
				 
				echo("<tr>
					<td>$pom</td>  
					<td>$username</td>
					<td>$comment</td> 
					<td hidden>$idcomment</td>
					<td id='xmark1'><a href='index.php?page=14&id=$idcomment'>&#9997;</a></td>
					<td id='xmark2'><a href='index.php?page=15&delete=$idcomment'>&#10006;</a></td>
				</tr>"); 
			}
			echo("</table></form>");
			echo("</div>");
			
		if(isset($_REQUEST['delete'])){
			$upit = "DELETE FROM comments WHERE id_comments='".$_REQUEST['delete']."'";
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
 