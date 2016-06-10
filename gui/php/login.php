<?php
	//@session_start();
 
    if(isset($_REQUEST['btnLogin'])) { 
        $username = strip_tags($_REQUEST['tbUsername']);
        $password = strip_tags($_REQUEST['tbPassword']);
 
        $username = stripslashes($username);
        $password = stripslashes($password);
    
        //$username = mysql_real_escape_string($konekcija, $username);
        //$password = mysql_real_escape_string($konekcija, $password);
 
        $password = md5($password);
		if(!($username == '' || $password == '')){
		$upit = "SELECT * FROM users WHERE username='$username' AND active=1 LIMIT 1";
			include("konekcija.php");	
			$rezultat = mysql_query($upit, $konekcija);
			mysql_close($konekcija); 

			$id = '';
			$db_password = '';
			while($red = mysql_fetch_array($rezultat)){
				$id = $red['id_users'];
				$db_password = $red['password'];	
				$db_username = $red['username'];	
				$db_role = $red['user_mod'];	
				$db_active = $red['active'];	
			}
			if(($username == $db_username) && $db_active=='0') {
					$_SESSION['username'] = $username;
					$_SESSION['id_users'] = $id;
					$_SESSION['user_mod'] = $db_role;
					header("location:index.php?page=0&message= <div class='info'> Please confirm your email adress!</div>");
			}else{
				if($password == $db_password) {
					$_SESSION['username'] = $username;
					$_SESSION['id_users'] = $id;
					$_SESSION['user_mod'] = $db_role;
					header("location:index.php?page=0&message= <div class='success'> Welcome back ".$_SESSION['username']."!</div>");
				} else { 
					header("location:index.php?page=0&message= <div class='error'> Login failed!</div>");
				}
			}
			
		}else{
			header("location:index.php?page=0&message= <div class='error'> Login failed!</div>");
		}
	}
?>

 