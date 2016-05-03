<?php
	include("login.php");
?>
<div id="header">
	
	<?php 
	
	
		$upit = "SELECT * FROM users WHERE username = '".@$_SESSION['username']."'";
		include("konekcija.php");
		$rezultat = mysql_query($upit, $konekcija);  
		mysql_close($konekcija);
		//header("Location: $_SERVER[PHP_SELF]");
		
		 
		$maliavatar2 = '';
		$slika = ''; 
		while($red = mysql_fetch_array($rezultat)){
			$slika .= $red['image']; 
			
		}  
		
		if($slika == ''){ 
			$maliavatar2 = "<img src='../images/members/default.png' width='55px' height='55px' alt='default_img' id='firstavatar'>";   
		}else{ 
			$maliavatar2 = "<img src='../images/members/$slika' width='55px' height='55px' alt='default_img' id='firstavatar' >";
		} 
		
		
		
		
		
		
		if(!isset($_SESSION['id_users'])){
			echo ("<div id='container'>
			<span id='logo'><h1><a href='index.php'>ForumMeda</a></h1></span>
			<span id='login'>
				<form action='". $_SERVER['PHP_SELF'] ."' method='GET' id='loginforma' name='loginforma'>
					<input type='text' id='tbUsername' name='tbUsername' placeholder=' username'/> 
					<input type='password' id='tbPassword' name='tbPassword' placeholder=' password'/> 
					<input type='submit' id='btnLogin' name='btnLogin' value='Login'/> 
				</form>
				<form action='register.php' method='POST' id='registerforma' name='registerforma'> 
					<input type='submit' id='btnRegister' name=btnRegister' value='Register'/> 
				</form>
			</span>
		</div>");
		}else{
			echo ("<div id='container'>
			<span id='logo'><h1><a href='index.php'>ForumMeda</a></h1></span>
			<span id='login' class='loginclas'>  
					<div id='nav'>
					$maliavatar2
						<ul id='menu'> 
							<li><a href='javascript:void(0);'>".$_SESSION['username']." <img src='../images/strelica.png'></a>
								<ul>
									<li><a href='member.php' title='stark'><img src='../images/user.png'><br/>Profile</a></li>
									<li><a href='logout.php' title='stark'><img src='../images/logout.png'><br/>Logout</a></li>
								</ul>
							</li> 
						</ul>
					</div>
					 
				 
		</div>");
			
		} 

	?> 
	
</div>


