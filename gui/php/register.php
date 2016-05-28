<?php  
	if(isset($_REQUEST['btnRegister2'])) {
		$email = trim($_REQUEST['tbEmail2']); 
		$username = trim($_REQUEST['tbUsername2']); 
		$password = trim($_REQUEST['tbPassword2']);
		$password2 = trim($_REQUEST['tbPassword22']);
		$gender = $_REQUEST['rbGender'];
		
		$remail = "/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/"; 
		$rusername = "/^[\w\s\/\.\_\d]{4,}$/"; 
		$rpassword = "/^[\w\s\/\.\_\d]{4,}$/";
		$greske = array(); 
		 $g=0; 
		
		if(!preg_match($remail, $email)){
			 $g++;
		}
		if(!preg_match($rusername, $username)){
			 $g++;
		} 
		if(!preg_match($rpassword, $password)){
			 $g++;
		}
		if(!(preg_match($rpassword, $password2) && $password==$password2)){ 
			 $g++;
		} 
		if(empty($gender)){
			 $g++;
		}  
		
		
		
		
		
		
		if($g==0){ 
			$password = sha1($password); 
			$upit = "SELECT * FROM users WHERE email='".$email."' OR username = '".$username."' ";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);
			mysql_close($konekcija);
			if(mysql_num_rows($rezultat) == 0){
				$upit = "INSERT INTO users (id_users, username, password, email, gender, user_mod, active) VALUES (NULL, '".$username."', '".$password."', '".$email."', '".$gender."', NULL, NULL)";
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
						header("location:index.php?message= <div class='info'> Confirm your email adress!!</div>");
					}else { 
						header("location:register.php?message= <div id='erori'Registration failed!</div>"); 
					}
				} 
			}else {
				header("location:register.php?message=<div id='erori'>User with that email or username is registered, <br/>try with another email or username!</div>");
			}
		}else{
			 $greske[]="That email or username is in use";
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
		<script type="text/javascript" src="../script/jquery-1.12.3.min.js"></script> 
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
				<h2>Register now (it's free) </h2><br/>
				<header><?php if(isset($_REQUEST['message'])) echo $_REQUEST['message']; ?></header><br/>
					<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='GET' onSubmit='return check();'>
						<input type='text' name='tbUsername2' id='tbUsername2' placeholder='username'/><br/>
						<span id='userS' class='greskeR'></span><br/>
						<input type='text' name='tbEmail2' id='tbEmail2' placeholder='email'/><br/>
						<span id='emailS' class='greskeR'></span><br/>
						
						<input type='password' name='tbPassword2' id='tbPassword2' placeholder='password'/><br/>
						<span id='passS' class='greskeR'></span><br/>
						<input type='password' name='tbPassword22' id='tbPassword22' placeholder='re-password'/><br/>
						<span id='passS2' class='greskeR'></span><br/>
						<input type='radio' name='rbGender' id='rbGenderM' value='male' checked/> <label class='genders'>Male</label>&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='radio' name='rbGender' id='rbGenderR' value='female' /> <label class='genders'>Female</label><br/>
						<span id='genderS' class='greskeR'></span><br/>
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