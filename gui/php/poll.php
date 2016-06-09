<?php 
	
	if(isset($_GET['submit_poll'])){
		 
		$query = "SELECT id_votes FROM poll_votes WHERE ip_address='".$_SERVER["REMOTE_ADDR"]."'"; 
		include('konekcija.php');
		$result = mysql_query($query,$konekcija);
		mysql_close($konekcija);
	
		if(mysql_num_rows($result)){
			$query11 = "SELECT * FROM poll WHERE active='1'";
			include('konekcija.php');
			$result22 = mysql_query($query11, $konekcija);
			$r2 = mysql_fetch_array($result22);
			
			$query3 = "SELECT * FROM poll_answers WHERE id_poll='".$r2['id_poll']."'";
			$result3 = mysql_query($query3,$konekcija);
			mysql_close($konekcija);
			
			while($red = mysql_fetch_array($result3)){
				echo $red['answer']." : ".$red['votes']."<br/>";
			}
			
			echo "You already voted.";#vratiti rez glasanja
		}else{
			if($_GET['answers']!='0'){
				$query = "INSERT INTO poll_votes VALUES('','".$_GET['answers']."','".$_SERVER["REMOTE_ADDR"]."')";
				$query2 = "UPDATE poll_answers SET votes = votes + 1 WHERE id_answers='".$_GET['answers']."'";
				include('konekcija.php');
				$result = mysql_query($query,$konekcija);
				mysql_query($query2,$konekcija);
				mysql_close($konekcija); 
				
				echo "Thanks for vote."; 
			}else{ 
				echo "Select an answer!"; 
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
		
		$poll.="<form action='' method='GET' name='answerpoll'>";
		
		$poll.="<div>".$r1['question']."</div><div class='rbpoll'>";
		
		$i=1;
		while($r = mysql_fetch_array($result2)){ 
			$poll.="  
			<input type='radio'  name='rbPoll' id='".$i."'  value='".$r['id_answers']."' /> ".$r['answer']."<br/>
			";
			$i++;
		}
		$poll.="</div><div><input type='button' name='submit_poll' id='submit_poll'  value='Vote' onclick='poll_vote();'/></div>"; 
		$poll.="<input type='hidden' name='i' id='numbofradio' value='".$i."'/>";
		$poll.="</form>";
		echo $poll;
	}
?>