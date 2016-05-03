<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Meda - Forum</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
		<meta name="author" content=""/>
		<link rel="shortcut icon" href="../images/icon.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css"/> 
		<script type="text/javascript" src="../script/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="../script/mainscript.js"></script>
</head>
	<body>
		<?php
			include("header.php");
		?>
		<?php
			include("menu.php");
		?>
		<div id='wrapper'>
			<div id='sadrzaj'>
	
	<?php
		$naslov = '';
		if(isset($_REQUEST['title'])){
			$naslov = $_REQUEST['title'];	
		} 
		$upit = "SELECT * FROM posts where title = '".$naslov."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
			
		$idposta = '';
			if(isset($_REQUEST['idposta'])){
				$idposta = $_REQUEST['idposta'];	
			}	
			$_SESSION['idpostakomentar'] = $idposta;
		
			
			
			// where id_posts = '".$idposta."'
		$upit2 = "SELECT * FROM comments";
			include("konekcija.php");
			$rezultat2 = mysql_query($upit2, $konekcija);  
			mysql_close($konekcija);	
			
			 
		while($red2 = mysql_fetch_array($rezultat2)){
			$idpostaizbaze = $red2['id_posts'];
			$userizbaze = $red2['username'];
			$komentarizbaze = $red2['comment'];
			$time2 = $red2['time']; 
			
			$time2 = time() - strtotime($time2);
			 
			if ($time2<60) {
				if($time2 == 1){
					$time2 = round($time2)." sec";
				}else{
					$time2 = round($time2)." secs";
				}
			} elseif ($time2<3600-1) {
				if(($time2>60) && ($time2<3600-1)){
					$time2 = round($time2 / 60)." mins";
				}else{
					$time2 = round($time2 / 60)." min";
				}
			} elseif ($time2<86400) {
				$time2 = round($time2 / 60 / 60)." hours";
			}elseif ($time2<604800) {
				$time2 = round($time2 / 60 / 60 / 60 +1)." days"; 
			}elseif ($time2<31536000) {
				$time2 = round($time2 / 60 / 60 / 60 / 12 + 1)." months";
			}else{
				$time2 = round($time2 / 60 / 60 / 60 / 60 /60 + 1)." years";
			}
			
			@$promenljiva .= "<div id='komentari'>
								<span id='komentari_levi'>&and;<br/>&or;</span> 
								<div id='komentari_komentar'>$komentarizbaze</div> <br/>
								<span id='komentari_edit'>edit</span>
								<span id='komentari_info'>answered $time2 ago by <a href='member.php'><span class='paket_desno_opis_user'>$userizbaze</span></a></span><br/><br/><br/>
								<div id='komentari_komentarisi'>add a comment</div>
							</div>";
		}
		
		while($red = mysql_fetch_array($rezultat)){
			$title = $red['title'];
			$description = $red['description'];
			$username = $red['username'];
			$tags = $red['tags']; 
			$time = $red['time'];  
			
			 
			echo ("
				<div>
					<div class='paket_desno_pnaslov'>$title</div>
					<div class='paket_desno_votes'>
						<a href='' id='voted' >&starf;</a>
					</div> 
					<div class='paket_desno_description'>$description</div>
					$promenljiva
					<div>Your answer: </div><br/><br/>
					<form action='". $_SESSION['lazarzmaj'] ."' method='GET'>
						<div id='dodatak2'>
							<textarea name='taComment' id='taComment' rows='6' cols='98.5'></textarea><br/><br/>
							<input type='submit' name='btnReply' id='btnReply' value='Reply'/>
							<input type='button' name='btnClose' id='btnClose' value='Close'/></br>
						</div>
						<input type='text' name='tbKlik' id='tbKlik' placeholder='Click here to start your discussion.'/><br/> <br/>
						
					</form>
				</div>
				 
				 
				
				
			 
		
		<div class='cisti'></div>");  
		} 
		 
		if(isset($_REQUEST['btnReply'])) { 
		 	 
			 
			$upit = "INSERT INTO comments (id_posts, username, comment) VALUES ('".$idposta."', '".$_SESSION['username']."', '".$_REQUEST['taComment']."')";
					include("konekcija.php");
					$rezultat = mysql_query($upit, $konekcija);  
					mysql_close($konekcija);
		}
		
	?>	 		

			</div>
			<div id='desno'>
				<?php
					include("widget.php");
				?>
			</div>
		</div>
        <?php
			include("footer.php");
		?> 
	</body>
</html>