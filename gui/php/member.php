<?php 
//postavljanje avatara za profil

	$medic = @$_REQUEST['pomocnapom'];
	if($medic == 'meda'){
		if(isset($_FILES['file']['tmp_name'])){
		move_uploaded_file($_FILES['file']['tmp_name'],"../images/members/".$_FILES['file']['name']);
		$upit2 = "UPDATE users SET image = '".$_FILES['file']['name']."' WHERE username = '".$_SESSION['username']."'";
		include("konekcija.php");
		$rezultat = mysql_query($upit2, $konekcija); 
		mysql_close($konekcija);
	} 
	}
	
	if(isset($_REQUEST['usernamem'])){ 
		$upit = "SELECT * FROM users WHERE username = '".$_REQUEST['usernamem']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
		
	}else{
		$upit = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija); 
	}

	$username = '';
	$time2 = '';
	$maliavatar = '';
	$slika = ''; 
	while($red = mysql_fetch_array($rezultat)){
		$slika .= $red['image'];  
		$time2 = $red['time']; 
		
	} 
	$time2 = strtotime($time2);
	$time2 = date('M d, Y', $time2);
	
	if($slika == ''){ 
		$maliavatar = "<img src='../images/members/default.png' width='145px' height='155px' alt='default_img' >";   
	}else{ 
		$maliavatar = "<img src='../images/members/$slika' width='145px' height='155px' alt='default_img' >";
	} 
//deskripcija korisnika

	if(isset($_REQUEST['btnSaveDesc'])){
		$deskripcija = ($_REQUEST['taEditProfile']);
		
		$upit = "UPDATE users SET description = '".$deskripcija."' WHERE username = '".$_SESSION['username']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija); 
	}
	
	
	if(isset($_REQUEST['usernamem'])){  
			$upit2 = "SELECT * FROM users WHERE username = '".$_REQUEST['usernamem']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit2, $konekcija);  
			mysql_close($konekcija);
		
	}else{
		$upit2 = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit2, $konekcija);  
			mysql_close($konekcija); 
	}
	
		$descript = '';
		while($red = mysql_fetch_array($rezultat)){
			$descript = $red['description']; 
			if($descript == ''){
				$descript = "This user did not update his description yet.";
			}else{
				$descript;
			}
		}
//topics created part 1
	if(isset($_REQUEST['usernamem'])){
		$upit4 = "SELECT COUNT(*) as ukupno FROM posts where username = '".$_REQUEST['usernamem']."'";
	include("konekcija.php"); 
	$users = mysql_query($upit4, $konekcija); 
	mysql_close($konekcija); 
	$pom2 = mysql_fetch_assoc($users);
	$broj_usera = $pom2['ukupno'];
	
	$broj_postova3 = $broj_usera;
	$broj_postova2 = '';
	if($broj_usera == '0'){
		$broj_postova2 = "<p>&#9888; 0 topics created.</p>"; 
	}else{
		if($broj_postova3 == '1'){
			$broj_postova2 = "<p>&#9888; $broj_postova3 topic created.</p>";
		}else{
			$broj_postova2 = "<p>&#9888; $broj_postova3 topics created.</p>";
		} 
	}
		
	}else{
		$upit4 = "SELECT COUNT(*) as ukupno FROM posts where username = '".$_SESSION['username']."'";
	include("konekcija.php"); 
	$users = mysql_query($upit4, $konekcija); 
	mysql_close($konekcija); 
	$pom2 = mysql_fetch_assoc($users);
	$broj_usera = $pom2['ukupno'];
	
	$broj_postova3 = $broj_usera;
	$broj_postova2 = '';
	if($broj_usera == '0'){
		$broj_postova2 = "<p>&#9888; 0 topics created.</p>"; 
	}else{
		if($broj_postova3 == '1'){
			$broj_postova2 = "<p>&#9888; $broj_postova3 topic created.</p>";
		}else{
			$broj_postova2 = "<p>&#9888; $broj_postova3 topics created.</p>";
		} 
	}
	}
	
//topics created part2
	
		
	if(isset($_REQUEST['usernamem'])){ 
			$upit3 = "SELECT * FROM posts where username = '".$_REQUEST['usernamem']."'";
		include("konekcija.php");
		$rezultat = mysql_query($upit3, $konekcija);  
		mysql_close($konekcija);
		
	}else{
		$upit3 = "SELECT * FROM posts where username = '".$_SESSION['username']."'";
		include("konekcija.php");
		$rezultat = mysql_query($upit3, $konekcija);  
		mysql_close($konekcija);
	}
	
	
	
	
		$title = '';
		$idpost = '';
		$description = '';
		$username = '';
		$tags = ''; 
		$time = '';
		$sadrzaj_postovi = '';
	while($red = mysql_fetch_array($rezultat)){
		$title = $red['title'];
		$idpost = $red['id_posts'];
		$description = $red['description'];
		$username = $red['username'];
		$tags = $red['tags']; 
		$time = $red['time'];
 
		$time = time() - strtotime($time);
			 
		if ($time<60) {
			if($time == 1){
				$time = round($time)." sec";
			}else{
				$time = round($time)." secs";
			}
		} elseif ($time<3600-1) {
			if(($time>60) && ($time<3600-1)){
				$time = round($time / 60)." mins";
			}else{
				$time = round($time / 60)." min";
			}
		} elseif ($time<86400) {
			$time = round($time / 60 / 60)." hours";
		}elseif ($time<604800) {
			$time = round($time / 60 / 60 / 60 +1)." days"; 
		}elseif ($time<31536000) {
			$time = round($time / 60 / 60 / 60 / 12 + 1)." months";
		}else{
			$time = round($time / 60 / 60 / 60 / 60 /60 + 1)." years";
		}
 
		$pomocna = '';
		if(!isset($_SESSION['id_users'])){
			$pomocna = "<a href='javascript:void(0);'>$title</a>";	
		}else{
			$pomocna = "<a href='index.php?page=7&title=$title&idposta=$idpost'>$title</a>";
			$_SESSION['lazarzmaj'] = "index.php?page=7&title=$title&idposta=$idpost";
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
		$sadrzaj_postovi .= "<div class='sadrzaj_paket'>
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
					<span class='paket_desno_tagovi_tag'>$tags</span> 
				</div>
				<div class='paket_desno_opis'>
					<span class='paket_desno_opis_time'>asked ".$time." ago&nbsp;by</span>
					<span class='paket_desno_opis_user'><a href='index.php?page=4&usernamem=$username'>$username</a></span>
				</div>
			</div>
			</div> 
			<div class='cisti'></div>";  
	} 
	//sadaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
	
	
	
	
	
?>

 
			<div id='sadrzaj'>
				<?php
					include("user.php");
				?>
			</div>
			 <div id="desno">
	<?php
		include("widget.php");
	?>
</div>