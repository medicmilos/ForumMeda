<?php
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
		
			if(isset($_REQUEST['submit'])){
				move_uploaded_file($_FILES['avatar']['temp_name'],"../images/members/".$_FILES['avatar']['name']);
				
				
				
			}


			$upit = "SELECT * FROM users";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
			//header("Location: $_SERVER[PHP_SELF]");
			
			$maliavatar = '';
			while($red = mysql_fetch_array($rezultat)){
			$slika = $red['image'];
			
			if($slika == ''){
				$maliavatar = "<img src='../images/members/default.png' width='145px' height='155px' alt='default_img' >";
			}
			
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
							<span class='btn btn-default btn-block btn-file'>
								Set avatar
								<form action='' method='GET' enctype='multipart/form-data'>
									<input type='file' name='avatar'  class='form-control input-lg' id='uploadProfile' /> 
									<input type='submit' name='submit'  /> 
									
								</form>
							</span>
						</div>
						<div id='sadrzaj_membersingore'>
						
						</div>
						<div id='sadrzaj_membersindole'>
							
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