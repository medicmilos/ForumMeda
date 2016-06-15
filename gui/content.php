<?php  
	if(isset($_REQUEST['btnPost'])) {
		$title = trim($_REQUEST['tbTitle']); 
		$post = trim($_REQUEST['taPost']); 
		$tags = trim($_REQUEST['tbTags']); 
		
		$rtitle = "/^[\w\s\/\.\:\,\?\!\_\d]{2,500}$/"; 
		$rpost = "/^[\w\s\/\.\:\,\?\!\_\d]{2,500}$/"; 
		$rtags = "/^[\w\s\/\.\:\,\?\!\_\d]{2,55}$/";
		$greske = array(); 
		
		if(!preg_match($rtitle, $title)){
			$greske[] = " greska u naslovu";
		} 
		if(!preg_match($rpost, $post)){
			$greske[] = " greska u postu"; 
		}  
		if(!preg_match($rtags, $tags)){ 
			$greske[] = " greska u tagu "; 
		}  

		if(empty($greske)){
			
			
			
			$upit = "INSERT INTO posts (id_posts, title, description, username, tags) VALUES (NULL, '".$title."', '".$post."', '".$_SESSION['username']."', '".$tags."')";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
			//header("Location: $_SERVER[PHP_SELF]");
		} 
	}  
?>

<div id="sadrzaj">

<?php 

if(!isset($_SESSION['id_users'])){
	
}else{
	echo("
	<form action='". $_SERVER['PHP_SELF'] ."' method='GET' onSubmit='return provera1();'>
	<input type='hidden' name='page' value='0' />	
		<input type='text' name='tbTitle' id='tbTitle' placeholder='Whats your question? Be specific.'/><br/> 
		<div id='dodatak'>
			<textarea name='taPost' id='taPost' rows='6' cols='98.5'></textarea>
			<input type='text' name='tbTags' id='tbTags'  placeholder='at least one tag such as (javascript, php), separated by coma, max 5 tags'/><br/>
			<div id='p'></div><br/> 
			<input type='submit' name='btnPost' id='btnPost' value='Submit post'/>
			<input type='button' name='btnClose' id='btnClose' value='Close'/></br>
		</div>
	</form>	");			
}
//onkeypress='enter(event);'
?>  
	
	<?php 
	
	
	
	
	
	/////////////////////////////// PAGINACIJA /////////////////////////////////////////////////////////////////////////////////////////
	
		include('konekcija.php');
		$sql=mysql_query("SELECT * FROM posts ORDER BY views DESC",$konekcija); //uzimamo sve vesti izz baze
		mysql_close($konekcija);
		
		$nr=mysql_num_rows($sql); //prebrojimo redove
		if(isset($_GET['pn'])) //uzmemo vrednost iz URL adrese
		{
			$pn=preg_replace('#[^0-9]#i','',$_GET['pn']); //stavimo samo broj iz te vrednosti u promenljivu
		}
		else
		{
			$pn=1; //ako nema vrednosti znaci da je korisnik prvi put tu i dolazimo na prvo stranu
		}
		
		$items_per_page=5; 
		
		$last_page=ceil($nr/$items_per_page); //broj redova kroz broj vesti po strani
		if($pn<1)
		{
			$pn=1;
		}
		else if($pn>$last_page)
		{
			$pn=$last_page;
		}
		
		
		//////////////////////////////////////////////
		
		$center_pages=''; //prikaz brojeva stranica
		$sub1=$pn-1; //jedna manje
		$sub2=$pn-2;
		$add1=$pn+1; //jedna vise
		$add2=$pn+2;
		
		if($pn == 1)  //ako je na prvoj strani
		{
			$center_pages.="&nbsp; <span class='page_num_active'>$pn</span>&nbsp;"; //prikazemo taj broj gde se nalazi
			$center_pages.="&nbsp; <a href='index.php?page=0&pn=$add1'>$add1</a> &nbsp;"; //i opciju da doda jos jednu stranicu
		}
		else if($pn == $last_page) //ako je na zadnjoj strani
		{
			$center_pages.="&nbsp; <a href='index.php?page=0&pn=$sub1'>$sub1</a> &nbsp;"; //prikazemo opciju za jednu manje
			$center_pages.="&nbsp; <span class='page_num_active'>$pn</span>&nbsp;"; //i stranicu gde se sad nalazi
		}
		else if($pn > 2 && $pn < ($last_page-1))
		{
			$center_pages.="&nbsp; <a href='index.php?page=0&pn=$sub2'>$sub2</a> &nbsp;";
			$center_pages.="&nbsp; <a href='index.php?page=0&pn=$sub1'>$sub1</a> &nbsp;";
			$center_pages.="&nbsp; <span class='page_num_active'>$pn</span>&nbsp;";
			$center_pages.="&nbsp; <a href='index.php?page=0&pn=$add1'>$add1</a> &nbsp;";
			$center_pages.="&nbsp; <a href='index.php?page=0&pn=$add2'>$add2</a> &nbsp;";
		}
		else if($pn > 1 && $pn < $last_page)
		{
			$center_pages.="&nbsp; <a href='index.php?page=0&pn=$sub1'>$sub1</a> &nbsp;";
			$center_pages.="&nbsp; <span class='page_num_active'>$pn</span>&nbsp;";
			$center_pages.="&nbsp; <a href='index.php?page=0&pn=$add1'>$add1</a> &nbsp;";
		}
		
		///////////////////////////////////////////////////// 
  
		 
		
		$pagination_display=''; //setujemo promenljivu
		
		if($last_page != "1") //ako ima vise od jedne strane, ako nema nista od ovoga se nece prikazati
		{
			//$pagination_display.="Page <strong>$pn</strong> od $last_page"; //prikaze stranu gde se nalazimo od kolikog broja strana
			
			if($pn != 1) //ako nismo na prvoj strani
			{
				$previous=$pn - 1;
				$pagination_display.="&nbsp; <a href='index.php?page=0&pn=$previous' class='nazad'>&#10092;&#10092; Prev</a>"; //dodajemo na prethodni pagination_display, prikazacemo dugme nazad koje nas vodi na prethodnu stranicu
			}
			
			$pagination_display.="<span class='pagination_numbers'>$center_pages<span>"; //broj strane gde se nalazimo uvek ce biti u sredini
			
			if($pn != $last_page) //ako nismo na zadnjoj strani
			{ 
				$next_page=$pn+1; 
				$pagination_display.="&nbsp; <a href='index.php?page=0&pn=$next_page' class='napred'>Next &#10093;&#10093;</a>"; //dodajemo na prethodni pagination_display, prikazacemo dugme naprede koje nas vodi na prethodnu stranicu
			}
		}
		 
	 
	
		if(isset($_REQUEST['rbKategorija'])){
			$upit = "SELECT * FROM posts where tags LIKE '%".$_REQUEST['rbKategorija']."%'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
		
		while($red = mysql_fetch_array($rezultat)){
			$title = $red['title'];
			$idpost = $red['id_posts'];
			$description = $red['description'];
			$username = $red['username'];
			$tags = $red['tags']; 
			$time = $red['time'];
  
  
  
			$tags = explode(',', $tags);
			$tagovi='';
			foreach($tags as $r){  
				$tagovi .= "<span class='paket_desno_tagovi_tag'>$r</span> ";
			}
  
   
			$time = time() - strtotime($time);
			if ($time<60) {
				if($time == 1){
					$time = round($time)." sec";
				}else{
					$time = round($time)." secs";
				}
			} else if ($time<3600-1) {
				if(($time>60) && ($time<3600-1)){
					$time = round($time / 60)." mins";
				}else{
					$time = round($time / 60)." min";
				}
			} else if ($time<86400) {
				$time = round($time / 60 / 60)." hours";
			}else if ($time<604800) {
				$time = round($time / 60 / 60 / 60 +1)." days"; 
			}else if ($time<31536000) {
				$time = round($time / 60 / 60 / 60 / 12 + 1)." months";
			}else{
				$time = round($time / 60 / 60 / 60 / 60 /60 + 1)." years";
			}
  
			$pomocna = '';
			if(!isset($_SESSION['id_users'])){
				$pomocna = "<a href='#' class='titlenolog'>$title</a>";
			}else{
				$pomocna = "<a href='index.php?page=7&title=$title&username=$username&idposta=$idpost'>$title</a>";
				$_SESSION['pomocniurl'] = "$title";
				
			} 
//izlistavanje broja odgovora
			$upit3 = "SELECT COUNT(*) as ukupno FROM comments c  INNER JOIN posts p ON c.id_posts=p.id_posts WHERE c.id_posts= '".$idpost."'";
				include("konekcija.php"); 
				$comments = mysql_query($upit3, $konekcija);
				mysql_close($konekcija); 
				
				$pom3 = mysql_fetch_assoc($comments); 
				$broj_komentara = $pom3['ukupno'];
				$odgovori = '';
				if($broj_komentara == 1){
					$odgovori = "answer";
				}else{
					$odgovori = "answers";
				}
				
				
				
//izlistavanje broja pregleda 

			$upit4 = "SELECT views FROM posts WHERE id_posts= '".$idpost."'";
				include("konekcija.php"); 
				$result2 = mysql_query($upit4, $konekcija);
				mysql_close($konekcija);
				
				$broj_pregleda = '';
				while($row = mysql_fetch_array($result2)){
					$broj_pregleda = $red['views'];
				}
				if($broj_pregleda == 1){
					$pregledi = "view";
				}else{
					$pregledi = "views";
				}
			
			echo ("<div class='sadrzaj_paket'>
			<div class='paket_levo'> 
				<div class='paket_levo_glasovi'>
					<span class='paket_levo_glasovi_broj'>$broj_komentara</span>
					<span class='paket_levo_glasovi_tekst'>$odgovori</span>
				</div>
				<div class='paket_levo_glasovi'>
					<span class='paket_levo_glasovi_broj'>$broj_pregleda</span>
					<span class='paket_levo_glasovi_tekst'> $pregledi</span>
				</div>
			</div>
			<div class='paket_desno'>
				<div class='paket_desno_naslov'>$pomocna</div>
				<div class='paket_desno_tagovi'>
					$tagovi
				</div>
				<div class='paket_desno_opis'>
					<span class='paket_desno_opis_time'>asked ".$time." ago&nbsp;by</span>
					<span class='paket_desno_opis_user'><a href='index.php?page=4&usernamem=$username'>$username</a></span>
				</div>
			</div>
		</div> 
		<div class='cisti'></div>");
		 
		
		}
		}else{
			$upit = "SELECT * FROM posts  ORDER BY time DESC LIMIT ".($pn-1)*$items_per_page.",$items_per_page";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
		
		while($red = mysql_fetch_array($rezultat)){
			$title = $red['title'];
			$idpost = $red['id_posts'];
			$description = $red['description'];
			$username = $red['username'];
			$tags = $red['tags']; 
			$time = $red['time'];
  
  
  
			$tags = explode(',', $tags);
			$tagovi='';
			foreach($tags as $r){  
				$tagovi .= "<span class='paket_desno_tagovi_tag'>$r</span> ";
			}
  
   
			$time = time() - strtotime($time);
			if ($time<60) {
				if($time == 1){
					$time = round($time)." sec";
				}else{
					$time = round($time)." secs";
				}
			} else if ($time<3600-1) {
				if(($time>60) && ($time<3600-1)){
					$time = round($time / 60)." mins";
				}else{
					$time = round($time / 60)." min";
				}
			} else if ($time<86400) {
				$time = round($time / 60 / 60)." hours";
			}else if ($time<604800) {
				$time = round($time / 60 / 60 / 60 +1)." days"; 
			}else if ($time<31536000) {
				$time = round($time / 60 / 60 / 60 / 12 + 1)." months";
			}else{
				$time = round($time / 60 / 60 / 60 / 60 /60 + 1)." years";
			}
  
			$pomocna = '';
			if(!isset($_SESSION['id_users'])){
				$pomocna = "<a href='#' class='titlenolog'>$title</a>";//javascript:void(0);	
			}else{
				$pomocna = "<a href='index.php?page=7&title=$title&username=$username&idposta=$idpost'>$title</a>";
				$_SESSION['pomocniurl'] = "$title";
				
			} 
//izlistavanje broja odgovora
			$upit3 = "SELECT COUNT(*) as ukupno FROM comments c  INNER JOIN posts p ON c.id_posts=p.id_posts WHERE c.id_posts= '".$idpost."'";
				include("konekcija.php"); 
				$comments = mysql_query($upit3, $konekcija);
				mysql_close($konekcija); 
				
				$pom3 = mysql_fetch_assoc($comments); 
				$broj_komentara = $pom3['ukupno'];
				$odgovori = '';
				if($broj_komentara == 1){
					$odgovori = "answer";
				}else{
					$odgovori = "answers";
				}
				
				
				
//izlistavanje broja pregleda 

			$upit4 = "SELECT views FROM posts WHERE id_posts= '".$idpost."'";
				include("konekcija.php"); 
				$result2 = mysql_query($upit4, $konekcija);
				mysql_close($konekcija);
				
				$broj_pregleda = '';
				while($row = mysql_fetch_array($result2)){
					$broj_pregleda = $red['views'];
				}
				if($broj_pregleda == 1){
					$pregledi = "view";
				}else{
					$pregledi = "views";
				}
			
			echo ("<div class='sadrzaj_paket'>
			<div class='paket_levo'> 
				<div class='paket_levo_glasovi'>
					<span class='paket_levo_glasovi_broj'>$broj_komentara</span>
					<span class='paket_levo_glasovi_tekst'>$odgovori</span>
				</div> 
				<div class='paket_levo_glasovi'>
					<span class='paket_levo_glasovi_broj'>$broj_pregleda</span>
					<span class='paket_levo_glasovi_tekst'> $pregledi</span>
				</div>
			</div>
			<div class='paket_desno'>
				<div class='paket_desno_naslov'>$pomocna</div>
				<div class='paket_desno_tagovi'>
					$tagovi
				</div>
				<div class='paket_desno_opis'>
					<span class='paket_desno_opis_time'>asked ".$time." ago&nbsp;by</span>
					<span class='paket_desno_opis_user'><a href='index.php?page=4&usernamem=$username'>$username</a></span>
				</div>
			</div>
		</div> 
		<div class='cisti'></div>");
		 
		
		}echo ("<div id='pagination'>$pagination_display</div>");
		}
	
	
	
	
	
	
	
		
	?>	 
 	 
	
</div>
<div id="desno">
	<?php
		include("widget.php");
	?>	
	
	<?php	
	
	if(isset($_SESSION['id_users'])){
				$upit21 = "SELECT DISTINCT tags FROM posts";
		include("konekcija.php"); 
		$rezultat21 = mysql_query($upit21, $konekcija);
		mysql_close($konekcija); 
		 
		echo("
			<div id='kategorije1'>
				<p>CATEGORIES</p>
			</div>
			<div id='kategorije'>
				<form action='". $_SERVER['PHP_SELF'] ."' method='POST' id='filterforma' ><input type='hidden' name='page' value='0'/>
				<ul>
		"); 
		$tagovi='';
		while($red = mysql_fetch_array($rezultat21)){ 
			$tags3 = $red['tags'];  
			$tags3 = explode(',', $tags3);
			
			foreach($tags3 as $r2){  
				$tagovi .= " $r2";
			} 
		} 
		$novo = explode(' ', $tagovi);
		$result = array_unique($novo);
			$tagovi33='';
			$i = 0;				
			foreach($result as $r23){  
				if(++$i > 10) break;
				$tagovi33 = "$r23";
		 
				if($tagovi33==''){
				}else{
					
					if($tagovi33==@$_REQUEST['rbKategorija']){
						echo("<li><input type='radio' name='rbKategorija' class='filterrb' value='$tagovi33' checked/><a href='#'>$tagovi33</a></li>");
					}else{
						echo("<li><input type='radio' name='rbKategorija' class='filterrb' value='$tagovi33' /><a href='#'>$tagovi33</a></li>");
					}
					
				}		
			}
		 echo("</ul> 
		 </form></div>"); 
			} 
		
	?>			 
		
	
</div>