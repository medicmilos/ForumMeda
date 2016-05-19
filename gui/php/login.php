<?php
	@session_start();
 
    if(isset($_REQUEST['btnLogin'])) { 
        $username = strip_tags($_REQUEST['tbUsername']);
        $password = strip_tags($_REQUEST['tbPassword']);
 
        $username = stripslashes($username);
        $password = stripslashes($password);
    
        //$username = mysql_real_escape_string($konekcija, $username);
        //$password = mysql_real_escape_string($konekcija, $password);
 
        //$password = md5($password);
		if(!($username == '' || $password == '')){
		$upit = "SELECT * FROM users WHERE username='$username' LIMIT 1";
			include("konekcija.php");	
				$rezultat = mysql_query($upit, $konekcija);
			mysql_close($konekcija); 

			$id = '';
			$db_password = '';
			while($red = mysql_fetch_array($rezultat)){
				$id = $red['id_users'];
				$db_password = $red['password'];	
			}
			if($password == $db_password) {
					$_SESSION['username'] = $username;
					$_SESSION['id_users'] = $id;
					header("location:index.php?message= <div class='success'> Welcome back ".$_SESSION['username']."!</div>");
			} else { 
				header("location:index.php?message= <div class='error'> Login failed!</div>");
			}
		}else{
			header("location:index.php?message= <div class='error'> Login failed!</div>");
		}
	}
?>

 