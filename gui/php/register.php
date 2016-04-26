<?php  
	if(isset($_REQUEST['btnRegister2'])) {
		$email = trim($_REQUEST['tbEmail2']); 
		$username = trim($_REQUEST['tbUsername2']); 
		$password = trim($_REQUEST['tbPassword2']);
		$remail = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"; 
		$rusername = "/^[A-z0-9_.]{3,40}$/"; 
		$rpassword = "/^[A-z0-9_.]{3,40}$/";
		$greske = array(); 
		
		if(!preg_match($remail, $email)){
			$greske[] = "Enter valid email address.";
		}
		if(!preg_match($rusername, $username)){
			$greske[] = "Username can contain only letters, numbers and _. ."; 
		} 
		if(!preg_match($rpassword, $password)){
			$greske[] = " Password can contain only letters, numbers and _. ."; 
		} 
		if(empty($greske)){ 
			$password = sha1($password); 
			$upit = "SELECT * FROM users WHERE email='".$email."' OR username = '".$username."' ";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);
			mysql_close($konekcija);
			if(mysql_num_rows($rezultat) == 0){
				$upit = "INSERT INTO users (id_users, username, password, email, user_mod, active) VALUES (NULL, '".$username."', '".$password."', '".$email."', '2', '0')";
				include("konekcija.php");
				$rezultat = mysql_query($upit, $konekcija);  
				mysql_close($konekcija);
				
				if(!$rezultat){ 
					header("location:register.php?message=Error: " . mysql_error()); 
				}else { 
					$to = $email;
					$subject = 'Registration'; 
					$message = '127.0.0.1/git/meda-forum/gui/php/confirm.php?username='.$username.'&code='.$password.'';
					if (mail($to, $subject, $message)) { 
						header("location:register.php?message= <div id='erori'>Confirm your email adress!.</div>"); 
					}else { 
						header("location:register.php?message= <div id='erori'Registration failed!</div>"); 
					}
				} 
			}else {
				header("location:register.php?message=<div id='erori'>User with that email or username is registered, <br/>try with another email or username!</div>");
			}
		}else{
			foreach($greske as $value){
				$pom_greska .="<div id='erori'>".$value."</div><br/>";
				header("location:register.php?message=$pom_greska");
				//header("location:register.php?message= <div id='erori'>".$value."</div><br/>");
			} 
		}
	}
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
						 <div id='registerpage'>
				<h2>Register: </h2><br/>
				<header><?php if(isset($_REQUEST['message'])) echo $_REQUEST['message']; ?></header><br/>
					<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='GET'>
						<input type='text' name='tbEmail2' id='tbEmail2' placeholder='email'/><br/><br/>
						<input type='text' name='tbUsername2' id='tbUsername2' placeholder='username'/><br/><br/>
						<input type='password' name='tbPassword2' id='tbPassword2' placeholder='password'/><br/><br/>
						<input type='submit' name='btnRegister2' id='btnRegister2' value='Register'/><br/><br/>
					</form>
				</div>
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