 
			<div id='sadrzaj'>
				
				<?php
					$naslov = '';
					if(isset($_REQUEST['title'])){
						$naslov = $_REQUEST['title'];	
					}  
					$idposta = '';
					if(isset($_REQUEST['idposta'])){
						$idposta = $_REQUEST['idposta'];	
					} 
					if(isset($_REQUEST['idposta'])) { 
						$_SESSION['pomocniid333']=$_REQUEST['idposta'];
							 
					}
//START citanje komentara na post, iz baze	
	//START upis komentara sa posta u bazu
					if(isset($_REQUEST['btnReply'])) {  
						$urlpom = $_SESSION['pomocniurl'];
						$upit = "INSERT INTO comments (id_posts, username, comment) VALUES ('".$_SESSION['pomocniid333']."', '".$_SESSION['username']."', '".$_REQUEST['taComment']."')";
								include("konekcija.php");
								$rezultat = mysql_query($upit, $konekcija); 
								mysql_close($konekcija); 
					}else{
	//START brojanje pregleda
						$upit4 = "UPDATE posts SET views=views+1 WHERE id_posts= '".$_SESSION['pomocniid333']."'";
							include("konekcija.php"); 
							$comments = mysql_query($upit4, $konekcija);
							mysql_close($konekcija); 
					}
//END brojanje pregleda	

					
					$upit222 = "SELECT  c.username  username, c.comment  comment, c.time  time, c.id_comments id_comments FROM comments c  INNER JOIN posts p ON c.id_posts=p.id_posts WHERE c.id_posts= '".$_SESSION['pomocniid333']."'";
						include("konekcija.php");
						$rezultat32 = mysql_query($upit222, $konekcija);  
						mysql_close($konekcija);

						$promenljiva = '';
						$userizbaze = '';
						$komentarizbaze = '';
						$time2 = '';
						$idkomentara = '';
					while($red12 = mysql_fetch_array($rezultat32)){
						 
						$userizbaze = $red12['username'];
						$komentarizbaze = $red12['comment'];
						$time2 = $red12['time']; 
						$idkomentara = $red12['id_comments']; 
//START upis u bazu ugnjezdenog komentara
					if(isset($_REQUEST['nested-reply'])){  
						$upit2 = "INSERT INTO nested_comments (id_comments, username, comment, id_posts) VALUES ('".$_REQUEST['idnested']."', '".$_SESSION['username']."', '".$_REQUEST['nested']."', '".$_SESSION['pomocniid333']."') ";
						include("konekcija.php");
						$rezultat2 = mysql_query($upit2, $konekcija);  
						mysql_close($konekcija);  
					} 
//END upis u bazu ugnjezdenog komentara

//START citanje ugnjezdenog komentara na komentar, iz baze 
						$upit33 = "SELECT * FROM nested_comments where id_comments=$idkomentara";
						include("konekcija.php");
						$rezultat23 = mysql_query($upit33, $konekcija);  
						mysql_close($konekcija);

						$nestusername = '';
						$nestcomment = '';
						$nesttime = '';
						$nested_iz_baze = ''; 
						
 
					while($red2 = mysql_fetch_array($rezultat23)){ 
						$nestusername = $red2['username'];
						$nestcomment = $red2['comment'];
						$nesttime = $red2['time'];
						$_SESSION['nestedidcomment'] = $idkomentara;
 
						
						$time3 = time() - strtotime($nesttime);
						 
						if ($time3<60) {
							if($time3 == 1){
								$time3 = round($time3)." sec";
							}else{
								$time3 = round($time3)." secs";
							}
						} else if ($time3<3600-1) {
							if(($time3>60) && ($time3<3600-1)){
								$time3 = round($time3 / 60)." mins";
							}else{
								$time3 = round($time3 / 60)." min";
							}
						} else if ($time3<86400) {
							$time3 = round($time3 / 60 / 60)." hours";
						}else if ($time3<604800) {
							$time3 = round($time3 / 60 / 60 / 60 +1)." days"; 
						}else if ($time3<31536000) {
							$time3 = round($time3 / 60 / 60 / 60 / 12 + 1)." months";
						}else{
							$time3 = round($time3 / 60 / 60 / 60 / 60 /60 + 1)." years";
						}
 
						$nested_iz_baze .= "<div id='nested-koments'>$nestcomment</div><div id='nested-info'>replied $time3 ago by <a href='index.php?page=4&usernamem=$nestusername'>$nestusername</a></div><br/>";
					}
					
					
//END citanje ugnjezdenog komentara	iz baze 


						$time2 = time() - strtotime($time2);
						 
						if ($time2<60) {
							if($time2 == 1){
								$time2 = round($time2)." sec";
							}else{
								$time2 = round($time2)." secs";
							}
						} else if ($time2<3600-1) {
							if(($time2>60) && ($time2<3600-1)){
								$time2 = round($time2 / 60)." mins";
							}else{
								$time2 = round($time2 / 60)." min";
							}
						} else if ($time2<86400) {
							$time2 = round($time2 / 60 / 60)." hours";
						}else if ($time2<604800) {
							$time2 = round($time2 / 60 / 60 / 60 +1)." days"; 
						}else if ($time2<31536000) {
							$time2 = round($time2 / 60 / 60 / 60 / 12 + 1)." months";
						}else{
							$time2 = round($time2 / 60 / 60 / 60 / 60 /60 + 1)." years";
						}
						
						@$promenljiva .= "<div id='komentari'>
											<span id='komentari_levi'></span> 
											<div id='komentari_komentar'>$komentarizbaze</div> <br/>
											<span id='komentari_edit'> </span>
											<span id='komentari_info'>answered $time2 ago by <a href='index.php?page=4&usernamem=$userizbaze'><span class='paket_desno_opis_user'>$userizbaze</span></a></span><br/><br/><br/>
											$nested_iz_baze
											<div id='komentari_komentarisi'>
												<form action='". $_SERVER['PHP_SELF'] ."' method='GET' onSubmit='return provera3();'>
													<input type='hidden' name='page' value='7' />	
													<div class='msjdcsna'>
														<a href='' class='reply'>Reply</a>
													</div>
													<input type='text' name='idnested' value='".$idkomentara."' hidden />   
												</form>
											</div>
										</div>";  	
					}
//END citanje komentara na post, iz baze					
					


//START post iz baze sa svim svojim detaljima
					$upit = "SELECT * FROM posts where id_posts = '".$_SESSION['pomocniid333']."'";
						include("konekcija.php");
						$rezultat = mysql_query($upit, $konekcija);  
						mysql_close($konekcija);
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
									&#10149;
								</div> 
								<div class='paket_desno_description'>$description 
								
								
								<span id='komentari_info' class='izmenaopisa'>asked by <a href='#'><span class='paket_desno_opis_user'>$username</span></a></span>
								</div>
								$promenljiva
								<div>Your answer: </div><br/><br/>
								<form action='". $_SERVER['PHP_SELF'] ."'  method='GET' onSubmit='return provera2();'> 
								<input type='hidden' name='page' value='7'/>
									<div id='dodatak2'>
										<textarea name='taComment' id='taComment' rows='6' cols='98.5'></textarea><br/><br/>
										<input type='submit' name='btnReply' id='btnReply' value='Reply'/>
										<input type='button' name='btnClose' id='btnClose' value='Close'/></br>
									</div> 
								</form>
								<input type='text' name='tbKlik' id='tbKlik' placeholder='Click here to start your discussion.'/><br/> <br/> 
							</div> 
					<div class='cisti'></div>");  
					} 
//END post iz baze sa svim svojim detaljima					
					

 
	
			
				?>	 		

</div> 
			<div id="desno">
	<?php
		include("widget.php");
	?>
</div>