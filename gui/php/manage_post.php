 <div id="sadrzaj"> 
	<div id='admin-nav'>
		<span class='admin-nav-cont'><a href='index.php?page=3'>Users</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=12'>Posts</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=15'>Comments</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=16'>Nested comments</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=18'>Polls</a></span>
	</div>
	
<?php    
		if(isset($_REQUEST['btnSaveUprofile'])){
			@$title = ($_REQUEST['taEditEmail']);
			@$desc = ($_REQUEST['taEditDesc']);
			@$tags = ($_REQUEST['taEditPass']); 
			
			$upit = "UPDATE posts SET title = '".$title."', description = '".$desc."', tags = '".$tags."' WHERE id_posts = '".$_REQUEST['id']."'";
				include("konekcija.php");
				$rezultat = mysql_query($upit, $konekcija);  
				mysql_close($konekcija); 
			//header("location:index.php?page=6&id=".$_SESSION['pom33'].""); 
		}




	$upit = "SELECT * FROM posts WHERE id_posts='".$_REQUEST['id']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
		
		 
		$pom = 0;
		echo("<form action='index.php?page=14' method='GET'>");
		
		$iduser = '';
		while($red = mysql_fetch_array($rezultat)){  
			$idpost = $red['id_posts']; 
			$title = $red['title']; 
			$description = $red['description'];
			$username = $red['username'];
			$votes = $red['votes'];
			$views = $red['views'];
			$tags = $red['tags'];
			
			 
	echo("<input type='hidden' name='id' value='$idpost' />");
	
	
			$pom++;
			echo("
			
				<div id='user-content'> 
					<h3>$title<h3>
					
				</div><br/>
				
			<div id='user-content2' class='posts-content'>
				<table border='1'>
					<input type='hidden' name='page' value='13' />
					<tr><td><b>Title:</b></td><td><span class='editmail'><input type='hidden' name='taEditEmail' value='$title' /><span class='email1'>$title</span></span></td></tr>
					<tr><td><b>Tags:</b></td><td><span class='editpass'><input type='hidden' name='taEditPass' value='$tags' /><span class='editpass1'>$tags</span></span></td></tr>
					<tr><td><b>Description:</b></td><td><span class='editdesc'><input type='hidden' name='taEditDesc' value='$description' /><span class='editdesc1'>$description</span></span></td></tr> 
					<tr><td class='save22' colspan='2'><b>  <input type='submit' class='save2' value='Update' name='btnSaveUprofile'>  </b></td></tr>
				</table>
			</div> 	
				
				
			"); 
		}
		
		 echo("</form>");
		
		
		
		
		
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