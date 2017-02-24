<?php
	session_start(); 
	if(isset($_REQUEST['message'])) echo $_REQUEST['message']; 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Meda - Forum</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
		<meta name="description" content="ForumMeda - The best IT forum"/>
		<meta name="keywords" content="Forum, meda, it, php, javascript, ForumMeda"/>
		<meta name="author" content="Milos Medic"/>
		<link rel="shortcut icon" href="images/icon.ico"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>  
		<link rel="stylesheet" type="text/css" href="css/class.css"/>   
		<link rel="stylesheet" type="text/css" href="css/lightbox.min.css"/>  
		<script type="text/javascript" src="script/jquery-2.2.4.min.js"></script>   
		
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script type="text/javascript" src="script/mainscript.js"></script>
		
 
</head>
	<body onLoad='ajaxprovera();'>
		<?php include_once("analyticstracking.php") ?>
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
					case "1": include("admin.php"); break; 
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
					case "12": include("manage_posts.php"); break; 
					case "13": include("manage_post.php"); break; 
					case "14": include("manage_comment.php"); break; 
					case "15": include("manage_comments.php"); break; 
					case "16": include("manage_nested_comments.php"); break; 
					case "17": include("manage_nested_comment.php"); break; 
					case "18": include("manage_polls.php"); break;
					case "19": include("manage_poll.php"); break; 
					case "20": include("useradd.php"); break; 
					default: include("content.php");break;
				}
			 
			?>
		</div>
        <?php
			include("footer.php");
		?>
	 <script type="text/javascript" src="script/lightbox-plus-jquery.min.js"></script>
	</body>
</html>