<?php  
	if(isset($_REQUEST['btnPost'])) {
		$title = trim($_REQUEST['tbTitle']); 
		$post = trim($_REQUEST['taPost']); 
		$tags = trim($_REQUEST['tbTags']);
		/*$rtitle = "//"; 
		$rpost = "//"; 
		$rtags = "//";
		$greske = array(); 
		
		if(!preg_match($rtitle, $title)){
			$greske[] = " greska u naslovu";
		}
		if(!preg_match($rpost, $post)){
			$greske[] = " greska u postu"; 
		} 
		if(!preg_match($rtags, $tags)){
			$greske[] = " greska u tagu "; 
		} */

		if(empty($greske)){
			$upit = "INSERT INTO posts (id_posts, title, description, username, tags) VALUES (NULL, '".$title."', '".$post."', '".$_SESSION['username']."', '".$tags."')";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
			header("Location: $_SERVER[PHP_SELF]");
		}	
	}  
?>

<div id="sadrzaj">

<?php
if(!isset($_SESSION['id_users'])){
	
}else{
	echo("
	<form action='". $_SERVER['PHP_SELF'] ."' method='GET'>
		<input type='text' name='tbTitle' id='tbTitle' placeholder='Whats your question? Be specific.'/><br/> 
		<div id='dodatak'>
			<textarea name='taPost' id='taPost' rows='6' cols='98.5'></textarea>
			<input type='text' name='tbTags' id='tbTags' placeholder='at least one tag such as (javascript, php), separated by coma, max 5 tags'/><br/>
			<input type='submit' name='btnPost' id='btnPost' value='Submit post'/>
			<input type='button' name='btnClose' id='btnClose' value='Close'/></br>
		</div>
	</form>	");			
}
?> 
	
	
	
	
	<?php
		$upit = "SELECT * FROM posts";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
		
		while($red = mysql_fetch_array($rezultat)){
			$title = $red['title'];
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
				$pomocna = "<a href='posts.php?title=$title'>$title</a>";				
			}
			
			
			
			echo ("<div class='sadrzaj_paket'>
			<div class='paket_levo'>
				<div class='paket_levo_glasovi'>
					<span class='paket_levo_glasovi_broj'>1</span>
					<span class='paket_levo_glasovi_tekst'>votes</span>
				</div>
				<div class='paket_levo_glasovi'>
					<span class='paket_levo_glasovi_broj'>2</span>
					<span class='paket_levo_glasovi_tekst'>answer</span>
				</div>
				<div class='paket_levo_glasovi'>
					<span class='paket_levo_glasovi_broj'>3</span>
					<span class='paket_levo_glasovi_tekst'>views</span>
				</div>
			</div>
			<div class='paket_desno'>
				<div class='paket_desno_naslov'>$pomocna</div>
				<div class='paket_desno_tagovi'>
					<span class='paket_desno_tagovi_tag'>$tags</span> 
				</div>
				<div class='paket_desno_opis'>
					<span class='paket_desno_opis_time'>asked ".$time." ago&nbsp;by</span>
					<span class='paket_desno_opis_user'>$username</span>
				</div>
			</div>
		</div> 
		<div class='cisti'></div>");
		}
		
	?>	 
	
</div>
<div id="desno">
	<?php
		include("widget.php");
	?>
</div>
