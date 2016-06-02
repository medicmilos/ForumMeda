<?php
	session_start(); 
	if(isset($_REQUEST['message'])) echo $_REQUEST['message']; 
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
			<?php
				if(isset($_REQUEST['page'])){ 
					$page=$_REQUEST['page'];
				}else{
					$page=100;
				} 
				 
				switch($page){
					case "0": include("content.php");break;
					case "1": include("AFqAw3g0Xic7tng.php"); break; 
					case "2": include("register.php"); break; 
					case "3": include("manage_users.php"); break; 
					case "4": include("member.php"); break; 
					case "5": include("logout.php"); break; 
					case "6": include("manage_user.php"); break; 
					case "7": include("posts.php"); break; 
					case "8": include("confirm.php"); break; 
					case "9": include("contact.php"); break; 
					case "10": include("author.php"); break; 
					case "11": include("members_gallery.php"); break;
					case "12": include("admin.php"); break;
					default: include("content.php");
				}
			 
			?>
		</div>
        <?php
			include("footer.php");
		?>
	</body>
</html>