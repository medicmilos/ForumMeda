<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	 
		<link rel="stylesheet" type="text/css" href="css2.css"/>    
		<script type="text/javascript" src="../script/jquery-1.12.3.min.js"></script>  
		<script type="text/javascript" src="skript.js"></script> 
		
</head>
	<body>
		 
		 
		 
		 <?php 
	$dir = "../images/members/";
	$files = scandir($dir);
	
	
	$count = count($files);
	
	for($i=2; $i<$count; $i++){
		?>
		<a href="crop-tool.php?img=<?php echo $files[$i]; ?>"><div class="image-box"><img src="../images/members/<?php echo $files[$i]; ?>"/></div></a>
		<?php
	}
?>
	<div class="clear"></div>		 
		 
		 
		 
		 
		 
		 
	</body>
</html>