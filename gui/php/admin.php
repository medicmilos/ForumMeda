


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
		<link rel="shortcut icon" href="../images/icon.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css"/>  
		<link rel="stylesheet" type="text/css" href="../css/class.css"/>  
		<script type="text/javascript" src="../script/jquery-1.12.3.min.js"></script> 
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script type="text/javascript" src="../script/mainscript.js"></script>
		
 
</head>
	<body>
		<?php
			include("header.php");
		?>
		<?php
			include("menu.php");
		?>
		<div id="wrapper">
			<div id="sadrzaj">

	<div id='admin-nav1'>
		<h2>Admin panel<h2>
		<span class='admin-nav-cont1'><a href='manage_users.php'>Users</a></span>
		<span class='admin-nav-cont1'><a href=''>Posts</a></span>
		<span class='admin-nav-cont1'><a href=''>Comments</a></span>
		<span class='admin-nav-cont1'><a href=''>Nested comments</a></span>
		<span class='admin-nav-cont1'><a href=''>Polls</a></span> 
		
	</div>

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