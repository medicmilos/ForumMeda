<?php  
	if(isset($_REQUEST['btnRegister2'])) {
		$email = trim($_REQUEST['tbEmail2']); 
		$username = trim($_REQUEST['tbUsername2']); 
		$password = trim($_REQUEST['tbPassword2']);
		$password2 = trim($_REQUEST['tbPassword22']);
		$gender = $_REQUEST['rbGender'];
		
		$remail = "/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/"; 
		$rusername = "/^[\w\s\/\.\_\d]{4,20}$/"; 
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
			$password = md5($password); 
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
					header("location:index.php?page=2&message=Error: " . mysql_error()); 
				}else { 
					
					
					 
 
					$ver_code = "http://milos-medic.byethost16.com/php/index.php?page=8&username=".$username."&code=".$password."";
					//$ver_code = "http://127.0.0.1/git/meda-forum/gui/php/index.php?page=8&username='".$username."'&code='".$password."'";
					
					
					
					$to = $email;
					$subject = 'Verification link | ForumMeda'; 
					
					$message = "<html><body>"; 
					$message .= "<table ><tr><td></td><td width='600' style='display: block !important;max-width: 600px !important; margin: 0 auto !important;  clear: both !important; margin: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box;font-size: 14px;'><div><table style=' background-color: #fff;border: 1px solid #e9e9e9;border-radius: 3px;' width='100%' cellpadding='0' cellspacing='0'><tr><td style='padding: 20px;'><table width='100%' cellpadding='0' cellspacing='0'><tr><td style='padding: 0 0 20px;'>Please confirm your email address by clicking the link below.</td></tr><tr><td style='padding: 0 0 20px;'>We may need to send you information about our service and it is important that we have an accurate email address.</td></tr><tr><td style='padding: 0 0 20px;'><a href='".$ver_code."' style='text-decoration: none;color: #FFF; background-color: #348eda; border: solid #348eda; border-width: 10px 20px;line-height: 2em;  font-weight: bold;  text-align: center; cursor: pointer; display: inline-block; border-radius: 5px;text-transform: capitalize;'>Confirm email address</a></td></tr><tr><td style='padding: 0 0 20px;'>&mdash; The ForumMeda Team</td></tr></table></td></tr></table></div></td><td></td></tr></table>";
					$message .= "</body></html>";
					  
					$headers = "From: ForumMeda\r\n"; 
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			 
					if (mail($to, $subject, $message, $headers)) {   
						header("location:index.php?page=0&message= <div class='info'> Confirm your email adress!!</div>");
					}else { 
						header("location:index.php?page=2&message= <div id='erori'Registration failed!</div>"); 
					}
				} 
			}else {
				header("location:index.php?page=2&message=<div id='erori'>User with that email or username is registered, <br/>try with another email or username!</div>");
			}
		}else{
			 $greske[]="That email or username is in use";
		}
	}
?>
 
		 
			<div id="sadrzaj">
				<div id='registerpage'>
					<h2>Register now (it's free) </h2><br/>
					<header><?php if(isset($_REQUEST['message'])) echo $_REQUEST['message']; ?></header><br/>
					<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='GET' onSubmit='return check();'>
						<input type='hidden' name='page' value='2'/>
						<input type='text' name='tbUsername2' id='tbUsername2' placeholder='username' onBlur="reg1();" /><br/>
						<span id='userS' class='greskeR'></span><br/>
						<input type='text' name='tbEmail2' id='tbEmail2' placeholder='email' onBlur="reg2();" /><br/>
						<span id='emailS' class='greskeR'></span><br/> 
						<input type='password' name='tbPassword2' id='tbPassword2' placeholder='password' onBlur="reg3();" /><br/>
						<span id='passS' class='greskeR'></span><br/>
						<input type='password' name='tbPassword22' id='tbPassword22' placeholder='re-password' onBlur="reg4();" /><br/>
						<span id='passS2' class='greskeR'></span><br/>
						<input type='radio' name='rbGender' id='rbGenderM' value='male' checked/> <label class='genders'>Male</label>&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='radio' name='rbGender' id='rbGenderR' value='female' /> <label class='genders'>Female</label><br/>
						<span id='genderS' class='greskeR'></span><br/>
						<input type='submit' name='btnRegister2' id='btnRegister2' value='Register'/><br/><br/>
					</form>
				</div>
			</div>
			 
		  
          