<?php  
	if(isset($_REQUEST['btnPost'])) {
		$title = trim($_REQUEST['tbTitle']); 
		$post = trim($_REQUEST['taPost']); 
		$tags = trim($_REQUEST['tbTags']); 
		
		$rtitle = "/^[\w\s\/\.\_\d]{4,}$/"; 
		$rpost = "/^[\w\s\/\.\_\d]{4,}$/"; 
		$rtags = "/^[\w\s\/\.\,\_\d]{4,}$/";
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
				$pomocna = "<a href='index.php?page=0&message= <div class='info'> Login to see or comment topic!</div>'>$title</a>";
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
					<span class='paket_levo_glasovi_broj'>0</span>
					<span class='paket_levo_glasovi_tekst'>votes</span>
				</div>
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
			$upit = "SELECT * FROM posts";
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
				$pomocna = "<a href='javascript:void(0);'>$title</a>";	
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
				if(++$i > 17) break;
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