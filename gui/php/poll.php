<?php
	//echo("RADI");
	
	if(isset($_GET['submit_poll'])){
		 
		$query = "SELECT id_votes FROM poll_votes WHERE ip_address='".$_SERVER["REMOTE_ADDR"]."'";
		include('konekcija.php');
		$result = mysql_query($query,$konekcija);
		mysql_close($konekcija);
	
		if(!mysql_num_rows($result)){
		echo"vec ste glasali";#vratiti rez glasanja
		}else{
			if(isset($_GET['answers'])){ 
				$query = "INSERT INTO poll_votes VALUES('','".$_GET['answers']."','".$_SERVER["REMOTE_ADDR"]."')";
				include('konekcija.php');
				$result = mysql_query($query,$konekcija);
				mysql_close($konekcija);
			
				echo"hvala za glas :P"; 
			}else{
				//niste cekirali radio battn
				echo"super"; 
			}
		} 
	}else{
		$poll = '';
		$query = "SELECT * FROM poll WHERE active='1'";
		include('konekcija.php');
		$result = mysql_query($query, $konekcija);
		$r1 = mysql_fetch_array($result);
		
		$query2 = "SELECT * FROM poll_answers WHERE id_poll='".$r1['id_poll']."'";
		$result2 = mysql_query($query2,$konekcija);
		mysql_close($konekcija);
		
		$poll.="<form action='' method='GET' name='answerpoll'>
					
				";
		
		$poll.="<div>".$r1['question']."</div>";
		
		$i=1;
		while($r = mysql_fetch_array($result2)){ 
			$poll.="  
			<input type='radio' name='rbPoll' id='".$i."'  value='".$r['id_answers']."' />".$r['answer']."<br/>
			";
			$i++;
		}
		$poll.="<div><input type='button' name='submit_poll'  value='Submit answer' onclick='poll_vote();'/></div>"; 
		$poll.="<input type='hidden' name='i' id='numbofradio' value='".$i."'/>";
		$poll.="</form>";
		echo $poll;
	}
?>