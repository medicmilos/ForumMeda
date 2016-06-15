<?php
	session_start();   
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Meda - Forum</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
		<meta name="author" content=""/>
		<link rel="shortcut icon" href="images/icon.ico"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>  
		<link rel="stylesheet" type="text/css" href="css/class.css"/>      
</head>
	<body>
		<?php
			include("header.php");
		?>
		<?php
			include("menu.php");
		?>
		<div id="wrapper">
			 
			<div id="sadrzaj" class='unicorn'>

 	<img src='images/404_unicorn.jpg'/>
	
</div>
<div id="desno">
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