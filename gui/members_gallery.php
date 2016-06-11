<div id="sadrzaj">
<div id="galerija">  

	<?php
	 
		include("konekcija.php");
		$upit = "SELECT * FROM users";
		$rezultat = mysql_query($upit, $konekcija);
		mysql_close($konekcija);
		
		if(mysql_num_rows($rezultat) == 0){
			echo "We don't have users, so galley is empty!";
		}else{
			 
			echo "<div class='red_slika'>";
			while($red = mysql_fetch_array($rezultat)){
				$image = $red['image'];
				$username = $red['username'];
				
				if($image == ''){ 
					$image= "default.png";   
				}else{ 
					$image = $image;
				} 
				
				
				 
					echo "<div class='img2'>";
						echo "<a  class='example-image-link'  data-lightbox='example-set' data-title='$username' href='images/members/".$image."'>";
						echo "<img class='example-image' src='images/members/".$image."'/></a>";

						echo "<div class='descr2'>".$username."</div></div>";
				 
				
			}
			echo "<div class='cisti'></div></div>";
			 
			
			 
				
			 
			 
		}
	 
	?>

</div>
</div> 
<div id="desno">
	<?php
		include("widget.php");
	?>
</div>