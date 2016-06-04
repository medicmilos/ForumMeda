<?php
	if($_SESSION['user_mod']=='1'){ 
			echo("
			
				<div id='sadrzaj'>

					<div id='admin-nav1'>
						<h2>Admin panel<h2>
						<span class='admin-nav-cont1'><a href='index.php?page=3'>Users</a></span>
						<span class='admin-nav-cont1'><a href='index.php?page=12'>Posts</a></span>
						<span class='admin-nav-cont1'><a href=''>Comments</a></span>
						<span class='admin-nav-cont1'><a href=''>Nested comments</a></span>
						<span class='admin-nav-cont1'><a href=''>Polls</a></span> 
						
					</div>

				</div>
				<div id='desno'>
					<?php
						include('widget.php');
					?>
				</div> 
			"); 
		}
	  
?>




