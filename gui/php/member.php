<?php
	 session_start();
	/*if(empty($_FILES['avatar']['temp_name']) == false){
		$file_ext = end(explode('.', $_FILES['avatar']['name']));
		if(in_array(strtolower($file_ext),array('jpg'. 'jpeg','png','gif')) == false){
			echo ( 'Your avatar must be an image.');
		}
	}


	if(file_exists($_FILES['avatar'])){
		$src_size = getimagesize($_FILES['avatar']);
		
		
		
		
		
			$upit = "INSERT INTO users (image) VALUES ('".$title."')";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
			header("Location: $_SERVER[PHP_SELF]");
		}*/
		
			if(isset($_POST['submit'])){
				move_uploaded_file($_FILES['file']['tmp_name'],"../images/members/".$_FILES['file']['name']);
				$upit2 = "UPDATE users SET image = '".$_FILES['file']['name']."' WHERE username = '".$_SESSION['username']."'";
				include("konekcija.php");
				$rezultat = mysql_query($upit2, $konekcija);  
				mysql_close($konekcija);
			}


			$upit = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
			//header("Location: $_SERVER[PHP_SELF]");
			
			$username = '';
			$time = '';
			$maliavatar = '';
			$slika = ''; 
			while($red = mysql_fetch_array($rezultat)){
				$slika .= $red['image'];  
				$time = $red['time']; 
				
			}
		
			
			$time = strtotime($time);
			$time = date('M d, Y', $time);
			
			
			
			if($slika == ''){ 
				$maliavatar = "<img src='../images/members/default.png' width='145px' height='155px' alt='default_img' >";   
			}else{ 
				$maliavatar = "<img src='../images/members/$slika' width='145px' height='155px' alt='default_img' >";
			}
			

?>


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
		<?php
		
			
			
			
			
			
			
			
			
			echo ("<div id='sadrzaj'>
				<div id='sadrzaj_members'> 
					<div id='sadrzaj_membersin'>
						<div id='sadrzaj_members_avatar'>
						$maliavatar
							<span  >
								Set avatar
								<form action='' method='POST' enctype='multipart/form-data'>
									<input type='file' name='file'><br/>
									<input type='submit' name='submit' value='Submit'> 
								</form>
							</span>
						</div>
						<div id='sadrzaj_membersingore'>
						<p id='firstchildp'>".$_SESSION['username']."</p>
						<p id='secondchildp'>@".$_SESSION['username']." joined $time</p>
						</div>
						<div id='sadrzaj_membersindole'>
							<div id='description'>
								<p class='edit'>This user did not update his description yet.</p>
								<span class='tagline'>Click on description to edit it.</span>
							</div>
						</div>
					</div>
					<div id='sadrzaj_membersin2'>
						<p>&#9888; 0 topics created.</p>
					</div>
				</div>
			</div>
			");
			?>
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