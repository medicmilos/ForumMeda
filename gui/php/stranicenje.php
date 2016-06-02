 
		<?php
			$koliko_po_strani = 5;
			if($_GET['skriveno']) {
				$skriveno = $_GET['skriveno'];
			}else {
				$skriveno = 0;
			}
			include ("konekcija.php");
			$upit2 = mysql_query("SELECT count(id) FROM users");
			$niz = mysql_fetch_array($upit2);
			$ukupno_zapisa = $niz[0];
			$levo = $skriveno - $koliko_po_strani;
			$desno = $skriveno + $koliko_po_strani;
			// Zaglavlje tabele sa navigacijom
			echo ("<tr><td width=\"50px\">");
			xyz="";
			if($levo<0){
				xyz=" Pocetak </td><td width=\"50px\"><a href=\"index.php?page=3&skriveno=$desno\"> Naredni</a>";
			}elseif($desno > $ukupno_zapisa){
				xyz=" <a href=\"index.php?page=3&skriveno=$levo\"> Prethodni </a></td><td width=\"50px\">Kraj ";
			}else {
				xyz="<a href=\"index.php?page=3&skriveno=$levo\"> Prethodni </a></td><td width=\"50px\"><a href=\"index.php?page=3&skriveno=$desno\"> Naredni </a>";
			}
				echo ("</td></tr>");
			$rezultat2 = mysql_query("SELECT id_users FROM users LIMIT $koliko_po_strani OFFSET $skriveno ");
			while($niz1 = mysql_fetch_array($rezultat2)){
				xyz2="<tr> <td colspan=\"2\" align=\"center\"> $niz1[0]</td> </tr>";
			}
			 
		?>
 