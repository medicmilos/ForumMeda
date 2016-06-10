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
			@$question = ($_REQUEST['taEditEmail']);
			@$comment = ($_REQUEST['taEditPass']); 
			
			$upit = "UPDATE poll SET question = '".$question."' WHERE id_poll = '".$_REQUEST['id']."'";
				include("konekcija.php");
				$rezultat = mysql_query($upit, $konekcija);  
				mysql_close($konekcija); 
			//header("location:index.php?page=6&id=".$_SESSION['pom33'].""); 
		}




	$upit = "SELECT * FROM poll WHERE id_poll='".$_REQUEST['id']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
		
		 
		$pom = 0;
		echo("<form action='index.php?page=19' method='GET'>");
		
		$iduser = '';
		$idcomment = ''; 
			$question = '';
		while($red = mysql_fetch_array($rezultat)){  
			$idcomment = $red['id_poll']; 
			$question = $red['question'];  
			
		}	 
		
		
		$stampa='';
		$upit22 = "SELECT pa.answer FROM poll p JOIN poll_answers pa ON p.id_poll=pa.id_poll WHERE pa.id_poll='".$_REQUEST['id']."'";
			include("konekcija.php");
			$rezultat33 = mysql_query($upit22, $konekcija);  
			mysql_close($konekcija);
		while($red2 = mysql_fetch_array($rezultat33)){   
			$answer = $red2['answer'];  
			
			
			$stampa .="<tr>
						<td><span class='editmail'><input type='hidden' name='taEditEmail' value='$answer' /><span class='email1'>$answer</span></span></td>
					</tr>
					";
		}
		
		
		
		
		
	echo("<input type='hidden' name='id' value='$idcomment' />");
	
	
			$pom++;
			echo("
			
			<div id='user-content2' class='posts-content posts-content22'>
				<table border='1'>
					<input type='hidden' name='page' value='19' />
					<tr><td><b>Question:</b></td><td><span class='editmail'><input type='hidden' name='taEditEmail' value='$question' /><span class='email1'>$question</span></span></td></tr>
					<tr>
						<td rowspan=4><b>Answers:</b></td> 
					</tr>
					$stampa
					<tr> </tr>
					<tr><td class='save22' colspan='2'><b>  <input type='submit' class='save2' value='Update' name='btnSaveUprofile'>  </b></td></tr>
				</table>
			</div> 	
				
				
			"); 
		
		
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