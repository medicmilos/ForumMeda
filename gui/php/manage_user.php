


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
 
	
	
				<div id='admin-nav'><span class='admin-nav-cont'><a href='manage_users.php'>Users</a></span><span class='admin-nav-cont'><a href=''>Posts</a></span><span class='admin-nav-cont'><a href=''>Comments</a></span><span class='admin-nav-cont'><a href=''>Nested comments</a></span><span class='admin-nav-cont'><a href=''>Polls</a></span></div>
	
	 
		<?php    
		
			$upit = "SELECT * FROM users WHERE id_users='".$_SESSION['pom33']."'";
					include("konekcija.php");
					$rezultat = mysql_query($upit, $konekcija);  
					mysql_close($konekcija);
				
				 
				$pom = 0;
				echo("<form action='manage_user.php?id=".$_SESSION['pom33']."' method='GET'>");
				$iduser = '';
				while($red = mysql_fetch_array($rezultat)){  
					$iduser = $red['id_users'];
					$avatar = $red['image'];
					$username = $red['username'];
					$password = $red['password'];
					$email = $red['email'];
					$description = $red['description'];
					$usermod = $red['user_mod'];
					$active = $red['active'];
					if($active=='1'){
						$active="Yes";
					}else{
						$active="No";
					}
					if($usermod=='1'){
						$usermod="Admin";
					}else{
						$usermod="User";
					}
			
					$pom++;
					echo("
					
						<div id='user-content'>
							<img src='../images/members/$avatar' width='155' height='165' border='1'/><br/>
							<h3>$username<h3>
							
						</div><br/>
						
						<div id='user-content2'>
							<span><b>Email:</b> </span><span class='editmail'><span class='email1'>$email</span></span><br/>
							<span><b>Password:</b> </span><span>$password</span><br/>
							<span><b>Description:</b> </span><span>$description</span><br/>
							<span><b>Role:</b> </span><span>$usermod</span><br/>
							<span><b>Active:</b> </span><span>$active</span>
						</div>
					 
					"); 
				}
				 echo("</form>");
				
				
				
				if(isset($_REQUEST['btnSaveEmail'])){
					$email2 = ($_REQUEST['taEditEmail']);
					
					$upit = "UPDATE users SET email = '".$email2."' WHERE id_users = '".$iduser."'";
						include("konekcija.php");
						$rezultat = mysql_query($upit, $konekcija);  
						mysql_close($konekcija); 
					header("location:manage_user.php?id=".$_SESSION['pom33'].""); 
				}
				
				/*echo("<table border='1' width='100%'><form>");
				echo("<tr><td>ID</td><td>Avatar</td><td>Username</td><td>Password</td><td>Email</td><td>Description</td><td>Usermode</td><td>Active</td><td hidden>db_id</td><td>Manage</td><td>Delete</td></tr>");
				$pom = 0;
				while($red = mysql_fetch_array($rezultat)){  
					$iduser = $red['id_users'];
					$avatar = $red['image'];
					$username = $red['username'];
					$password = $red['password'];
					$email = $red['email'];
					$description = $red['description'];
					$usermod = $red['user_mod'];
					$active = $red['active'];
					$pom++;
					echo("<tr><td>$pom</td><td><img src='../images/members/$avatar' width='46' height='51'/></td><td width='46'>$username</td><td style='width: 50% important!;'>$password</td><td>$email</td><td>$description</td><td>$usermod</td><td>$active</td><td hidden>$iduser</td><td>change</td><td>delete</td></tr>"); 
				}
				echo("</table></form>");*/
				
		?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
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
 
			