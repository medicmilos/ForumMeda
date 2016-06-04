 <div id="sadrzaj"> 
	<div id='admin-nav'>
		<span class='admin-nav-cont'><a href='index.php?page=3'>Users</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=12'>Posts</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=15'>Comments</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=16'>Nested comments</a></span>
		<span class='admin-nav-cont'><a href=''>Polls</a></span>
	</div>
	
<?php    
		if(isset($_REQUEST['btnSaveUprofile'])){
			@$email2 = ($_REQUEST['taEditEmail']);
			@$pass2 = ($_REQUEST['taEditPass']);
			@$desc2 = ($_REQUEST['taEditDesc']);
			@$mod2 = ($_REQUEST['rbEditMod']);
			@$active2 = ($_REQUEST['rbEditActive']);
			
			$upit = "UPDATE users SET email = '".$email2."', password = '".$pass2."', description = '".$desc2."', user_mod = '".$mod2."', active = '".$active2."' WHERE id_users = '".$_REQUEST['id']."'";
				include("konekcija.php");
				$rezultat = mysql_query($upit, $konekcija);  
				mysql_close($konekcija); 
			//header("location:index.php?page=6&id=".$_SESSION['pom33'].""); 
		}




	$upit = "SELECT * FROM users WHERE id_users='".$_REQUEST['id']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
		
		 
		$pom = 0;
		echo("<form action='index.php?page=6' method='GET'>");
		
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
			
			$usermod1='';
			$usermod2='';
			$useractive1='';
			$useractive2='';
			if($active=='1'){
				$useractive1="checked";
			}else{
				$useractive2="checked";
			}
			if($usermod=='1'){
				$usermod1="checked";
			}else{
				$usermod2="checked";
			}
	echo("<input type='hidden' name='id' value='$iduser' />");
	
	
			$pom++;
			echo("
			
				<div id='user-content'>
					<img src='../images/members/$avatar' width='155' height='165' border='1'/><br/>
					<h3>$username<h3>
					
				</div><br/>
				
			<div id='user-content2'>
			<table border='1'>
			<input type='hidden' name='page' value='6' />
				<tr><td><b>Email:</b></td><td><span class='editmail'><input type='hidden' name='taEditEmail' value='$email' /><span class='email1'>$email</span></span></td></tr>
				<tr><td><b>Password:</b></td><td><span class='editpass'><input type='hidden' name='taEditPass' value='$password' /><span class='editpass1'>$password</span></span></td></tr>
				<tr><td><b>Description:</b></td><td><span class='editdesc'><input type='hidden' name='taEditDesc' value='$description' /><span class='editdesc1'>$description</span></span></td></tr>
				<tr><td><b>Role:</b></td><td><span class='editmod'><input type='hidden' name='taEditMod' value='$usermod' /><input type='radio' name='rbEditMod' value='1' $usermod1 /> Admin<br/><input type='radio' name='rbEditMod' value='2' $usermod2 /> User</span></td></tr>
				<tr><td><b>Active:</b></td><td><span class='editactive'><input type='hidden' name='taEditActive' value='$active' /><input type='radio' name='rbEditActive' value='1' $useractive1 /> Yes<br/><input type='radio' name='rbEditActive' value='0' $useractive2 /> No</span></td></tr>
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