<div class="cisti"></div>
<div id="footer">
    <div id="gore">
        <div id="gore2">
			<div id="dole3">
				<a href="index.php?page=0"><h3>ForumMeda</h3><br/><br/>
				<p>Feel free to ask anything.</p></a>
			</div>
			
			<div id="meni_footer">
				<ul>
			<?php
			
				$upit = "SELECT * FROM menu WHERE menu_place='2'";
					include("konekcija.php");
					$rezultat = mysql_query($upit, $konekcija);  
					mysql_close($konekcija);
					
					while($red = mysql_fetch_array($rezultat)){  
						$name = $red['name'];
						$link = $red['link'];
						
						echo ("<li><a href='$link'>$name</a></li>&nbsp;");
					}
					
			?>			 
				</ul>
			</div>
        </div>
    </div>
   
    <div id="dole">
        <div id="dole2">
        <p>Copyright 2016 &copy; <a href="#">ForumMeda</a>. All rights reserved.</p>
        
        <div id="mreze">
            <a href="https://www.facebook.com/" target="_blank"><img src="images/socialn/facebook.png"/></a>
            <a href="https://twitter.com/" target="_blank"><img src="images/socialn/twitter.png"/></a>
            <a href="https://www.reddit.com/" target="_blank"><img src="images/socialn/reddit.png"/></a>
            <a href="https://www.youtube.com/" target="_blank"><img src="images/socialn/youtube.png"/></a>
            <a href="https://www.flickr.com/" target="_blank"><img src="images/socialn/flickr.png"/></a>
        </div>
        </div>
    </div>
</div>
