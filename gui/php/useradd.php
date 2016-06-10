<div id="sadrzaj"> 
	<div id='admin-nav'>
		<span class='admin-nav-cont'><a href='index.php?page=3'>Users</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=12'>Posts</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=15'>Comments</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=16'>Nested comments</a></span>
		<span class='admin-nav-cont'><a href='index.php?page=18'>Polls</a></span>
	</div>
	
<?php

$rezultat1='';
if(isset($_REQUEST['btnSaveUprofile'])) {
		$username = trim($_REQUEST['tbUserAdd']); 
		$password = trim($_REQUEST['tbPassAdd']); 
		$email = trim($_REQUEST['tbMailAdd']);
		$gender = trim($_REQUEST['rbGenderAdd']); 
		$role = trim($_REQUEST['rbRoleAdd']); 
		$active = trim($_REQUEST['rbActiveAdd']); 
		
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
		if(empty($gender)){
			 $g++;
		} 
		if(empty($role)){
			 $g++;
		} 
		if(empty($active)){
			 $g++;
		}  
		
		if($g==0){ 
		$password = md5($password); 
			$upit = "INSERT INTO users (id_users, username, password, email, gender, user_mod, active) VALUES (NULL, '".$username."', '".$password."', '".$email."', '".$gender."', '".$role."', '".$active."')";
				include("konekcija.php");
				$rezultat = mysql_query($upit, $konekcija);  
				mysql_close($konekcija);
				
				if($rezultat){ 
					$rezultat1="User added."; 
				}else {
					$rezultat1="Failed to add user."; 
				}
		}else{  
		}
		 
		
	}
 

	echo ("<div class='userad'><form><table border=1  width='50%'><input type='hidden' name='page' value='20' />");
	
	echo ("
	
		<tr><td>Username: </td><td><input type='text' class=''   name='tbUserAdd'/></td></tr>
		<tr><td>Password: </td><td><input type='text' class=''   name='tbPassAdd'/></td></tr>
		<tr><td>Email: </td><td><input type='text' class=''   name='tbMailAdd'/></td></tr>
		<tr><td>Gender: </td><td><input type='radio' name='rbGenderAdd' value='M' /> Male <br/><input type='radio' name='rbGenderAdd' value='F' /> Female</td></tr>
		<tr><td>Role: </td><td><input type='radio' name='rbRoleAdd' value='2' /> User <br/><input type='radio' name='rbRoleAdd' value='1' /> Admin</td></tr>
		<tr><td>Active: </td><td><input type='radio' name='rbActiveAdd' value='1' /> Yes <br/><input type='radio' name='rbActiveAdd' value='0' /> No</td></tr>
		<tr><td colspan=2><input type='submit' class='save2' value='Add user' name='btnSaveUprofile'></td></tr>
	 
	");
	 
	
	echo ("</table></form><b>$rezultat1</b></div>");
?>

	</div> 
	<div id="desno">
	<?php
		include("widget.php");
	?>
</div>