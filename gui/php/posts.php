<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Meda - Forum</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
		<meta name="author" content=""/>
		<link rel="shortcut icon" href=""/>
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
	
		if(isset($_REQUEST['title'])){
			$naslov = $_REQUEST['title'];	
		} 
		$upit = "SELECT * FROM posts where title = '".$naslov."'";
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
						<a href='' id='voted' >&starf;</a>
					</div> 
					<div class='paket_desno_description'>$description</div>
					<div>Your answer: </div><br/><br/>
					<form action='#' method='GET'>
						<input type='text' name='tbKlik' id='tbKlik' placeholder='Click here to start your discussion.'/><br/> <br/>
						<div id='dodatak2'>
							<textarea name='taPost' id='taPost' rows='6' cols='98.5'></textarea><br/><br/>
							<input type='submit' name='btnPost' id='btnPost' value='Reply'/>
							<input type='button' name='btnClose' id='btnClose' value='Close'/></br>
						</div>
					</form>
				</div>
				 
				 
				
				
			 
		
		<div class='cisti'></div>"); 
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