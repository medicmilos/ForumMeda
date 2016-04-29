<?php
	include("login.php");
?>
<div id="header">
	
	<?php

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
					<ul id='menu'> 
						<li><a href='javascript:void(0);'>".$_SESSION['username']." <img src='../images/strelica.png'></a>
							<ul>
								<li><a href='#' title='stark'><img src='../images/user.png'><br/>Profile</a></li>
								<li><a href='logout.php' title='stark'><img src='../images/logout.png'><br/>Logout</a></li>
							</ul>
						</li> 
					</ul>
				</div>
				 
			 
	</div>");
		
	} 

	?> 
	
</div>


