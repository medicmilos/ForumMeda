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
			@$username = ($_REQUEST['taEditEmail']);
			@$comment = ($_REQUEST['taEditPass']); 
			
			$upit = "UPDATE comments SET username = '".$username."', comment = '".$comment."'  WHERE id_comments = '".$_REQUEST['id']."'";
				include("konekcija.php");
				$rezultat = mysql_query($upit, $konekcija);  
				mysql_close($konekcija); 
			//header("location:index.php?page=6&id=".$_SESSION['pom33'].""); 
		}




	$upit = "SELECT * FROM comments WHERE id_comments='".$_REQUEST['id']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
		
		 
		$pom = 0;
		echo("<form action='index.php?page=14' method='GET'>");
		
		$iduser = '';
		while($red = mysql_fetch_array($rezultat)){  
			$idcomment = $red['id_comments']; 
			$username = $red['username']; 
			$comment = $red['comment']; 
			
			 
	echo("<input type='hidden' name='id' value='$idcomment' />");
	
	
			$pom++;
			echo("
			
			<div id='user-content2' class='posts-content posts-content22'>
				<table border='1'>
					<input type='hidden' name='page' value='14' />
					<tr><td><b>Username:</b></td><td><span class='editmail'><input type='hidden' name='taEditEmail' value='$username' /><span class='email1'>$username</span></span></td></tr>
					<tr><td><b>Comment:</b></td><td><span class='editpass'><input type='hidden' name='taEditPass' value='$comment' /><span class='editpass1'>$comment</span></span></td></tr> 
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