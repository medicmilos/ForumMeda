<?php  
	if(isset($_REQUEST['btnSubmit'])) {
		$name = trim($_REQUEST['tbYName']); 
		$mail = trim($_REQUEST['tbYmail']); 
		$phone = trim($_REQUEST['tbYPhone']);
		$subject = trim($_REQUEST['tbYSubject']); 
		
		$rname = "/^[A-Z]{1}[a-z]{2,28}$/";
		$rmail = "/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/"; 
		$rphone = "/^\d$/";
		
		$greske = array(); 
		 $g=0; 
		
		if(!preg_match($rname, $name)){
			 $g++;
		}
		if(!preg_match($rmail, $mail)){
			 $g++;
		} 
		if(!preg_match($rphone, $phone)){
			 $g++;
		} 
		if(empty($subject)){
			 $g++;
		}  
		if(empty($message)){
			 $g++;
		}  
		
		if($g==0){ 
			$to = "milos.medic.130.14@ict.edu.rs";
			$subject = 'Contact | ForumMeda'; 
			$message = "E-mail: ".$mail."\n Phone: ".$phone."\n Message: ".$message;  
					
			if (mail($to, $subject, $message)) {   
						header("location:index.php?page=9&message= <div class='info'> Thanks for contacting me!</div>");
					}else { 
						header("location:index.php?page=9&message= <div id='erori'Sending mail failed!</div>"); 
					} 
		}else{  
		}
		
		
		
		
		
		
	}
?>





<div id="sadrzaj">  
	 <div id="table">
		<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="GET" onSubmit='return check2();'>
			<input type="hidden" name="page" value="9" />
			<table width="620px" height="560px">
				<tr>
					<th colspan="2" id="th_form"><h3>CONTACT FORM</h3></th>
				</tr>
				<tr> 
					<td>
						<input type="text" name="tbYName" id="tbYName" class='tbps'  onBlur="fild1();" placeholder='Your Name'/> 
						<label id='nameS' class='greskeR'></label> 
					</td>
					<td>
						<input type="text"  class='tbps' name="tbYmail" id="tbYmail"  onBlur="fild2();" placeholder='Your E-mail'/>
						<label id='mailS' class='greskeR'></label>
					</td>
					<td>
						<input type="text" class='tbps'  name="tbYPhone" id="tbYPhone" onBlur="fild3();" placeholder='Your Phone'/>
						<label id='phoneS' class='greskeR'></label>
					</td>
				</tr> 
				 <tr> 
					<td colspan='3'>
						<input type="text" name="tbYSubject" id="tbYSubject"  onBlur="fild4();" placeholder='Subject' />
						<br/><span id='subjectS' class='greskeR'></span>
					</td>
				</tr>
				<tr> 
					<td colspan='3'>
						<textarea name="tbYMessage" id="tbYMessage" rows="2" onBlur="fild5();"  placeholder='Message' ></textarea>
						<br/><span id='mesageS' class='greskeR'></span>					
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Submit" name='btnSubmit' id="btnRegister2"  class="button11"/><br/>
						<input type="reset" value="Reset" id="reset" class="button1"/> 
					</td>
				</tr>
			</table>				
		</form>	
	</div>  
</div> 
<div id="desno">
	<?php
		//statistika sajta
	$upit1 = "SELECT COUNT(*) as ukupno FROM posts";
	$upit2 = "SELECT COUNT(*) as ukupno FROM users";
	$upit3 = "SELECT COUNT(*) as ukupno FROM comments";
		include("konekcija.php");
		$posts = mysql_query($upit1, $konekcija);
		$users = mysql_query($upit2, $konekcija);
		$comments = mysql_query($upit3, $konekcija);
		mysql_close($konekcija); 
	
	$pom1 = mysql_fetch_assoc($posts);
	$broj_postova = $pom1['ukupno'];
	
	$pom2 = mysql_fetch_assoc($users);
	$broj_usera = $pom2['ukupno'];
	
	$pom3 = mysql_fetch_assoc($comments);
	$broj_komentara = $pom3['ukupno'];

//anketa

	$idpoll = '';
	$question = '';
	$upit = "SELECT * FROM poll WHERE active='1'";
			include("konekcija.php");
			$rezulta3t = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
		
		while($red = mysql_fetch_array($rezulta3t)){ 
			$idpoll = $red['id_poll'];
			$question .= $red['question'];
		}
	
	 
	$answer = ''; 
	$newvote = '';
	$userip = '';
	$upit34 = "SELECT * FROM poll_answers WHERE id_poll='".$idpoll."' ";
			include("konekcija.php");
			$rezultat14 = mysql_query($upit34, $konekcija);  
			mysql_close($konekcija);
		
		while($red = mysql_fetch_array($rezultat14)){  
			$vote = $red['votes'];
			$idanswer = $red['id_answers'];
			$newvote = $vote + 1;
			$userip = $_SERVER['REMOTE_ADDR'];
			//$newipaddress = $newipaddress."$userip,";
			
			
			if(isset($_REQUEST['rbPoll'])){
				
				$voted = @$_REQUEST['rbPoll']; 
				 
					
				
				$upit38 = "UPDATE poll_answers SET votes = '".$newvote."' WHERE id_answers='".$voted."' ";
				include("konekcija.php");
					$rezultat = mysql_query($upit38, $konekcija); 
					mysql_close($konekcija);
				//, ip_adress='".$userip."'
				$upit399 = "INSERT INTO poll_votes (id_votes, id_answers, ip_adress) VALUES(NULL, '".$idanswer."','".$userip."') ";
				include("konekcija.php");
					$rezultat = mysql_query($upit399, $konekcija); 
					mysql_close($konekcija);
				   
			}
			 
			
			$answer .=  "<div class='radio'><label><input type='radio' name='rbPoll' class='poll' value='".$idanswer."' onchange='javascript:this.form.submit();'/> ".$red['answer']."</label></div>";
		}
	
	 
	echo (
		"<div id='desnocontent'>
			<p>STATISTICS</p>
			<div id='statistika'> 
				<div class='tridela' id='members'>
					<span class='brojevi' id='broj'>$broj_usera</span>
					<span class='spanovi' >MEMBERS</span>
				</div>
				<div class='tridela' id='posts'>
					<span class='brojevi' id='posts'>$broj_postova</span>
					<span class='spanovi'>POSTS</span>
				</div>
				<div class='tridela' id='comments'>
					<span class='brojevi' id='comments'>$broj_komentara</span>
					<span class='spanovi'>COMMENTS</span>
				</div>
			</div>
			
			<p>POLL</p>
			<div id='statistika'>  
				<h4>$question</h4><br/> 
				<div id='poll-vote'>
					<form action='". $_SERVER['PHP_SELF'] ."' method='POST'>
					<input type='hidden' name='page' value='0'/>
					$answer<br/> 
					</form>
				</div> 
			</div>
			
			
			 
			
		</div>
		 
		"
	);
	?>
</div>