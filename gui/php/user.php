<?php
	if(isset($_REQUEST['usernamem'])){ 
			echo ("<div id='sadrzaj_members'> 
			<div id='sadrzaj_membersin'>
				<div id='sadrzaj_members_avatar'>
				$maliavatar 
				</div>
				<div id='sadrzaj_membersingore'>
				<p id='firstchildp'>".$_REQUEST['usernamem']."</p>
				<p id='secondchildp'>@".$_REQUEST['usernamem']." joined $time2</p>
				</div>
				<div id='sadrzaj_membersindole'>
					<div id='description2'> 
						<p class='edit'>$descript</p>   
					</div>
				</div>
			</div>
			<div id='sadrzaj_membersin2'>
				$broj_postova2
				$sadrzaj_postovi
			</div>
		</div>");  
	}else{
		echo ("<div id='sadrzaj_members'> 
			<div id='sadrzaj_membersin'>
				<div id='sadrzaj_members_avatar'>
				$maliavatar
					<span id='avatar_span'>
						<p>Change avatar</p>
						<form action='". $_SERVER['PHP_SELF'] ."?pomocnapom=meda' method='POST' enctype='multipart/form-data'>
							<input  id='forma_avatar' type='file' name='file'onchange='javascript:this.form.submit();'> 
						</form> 
					</span>
				</div>
				<div id='sadrzaj_membersingore'>
				<p id='firstchildp'>".$_SESSION['username']."</p>
				<p id='secondchildp'>@".$_SESSION['username']." joined $time2</p>
				</div>
				<div id='sadrzaj_membersindole'>
					<div id='description'>
						<form action='". $_SERVER['PHP_SELF'] ."' method='POST'>
							<p class='edit'>$descript</p> 
							<span class='tagline'>Click on description to edit it.</span>
						</form> 
					</div>
				</div>
			</div>
			<div id='sadrzaj_membersin2'>
				$broj_postova2
				$sadrzaj_postovi
			</div>
		</div>");  
	}

















?>