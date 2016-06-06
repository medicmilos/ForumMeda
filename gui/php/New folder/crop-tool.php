<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	 
		<link rel="stylesheet" type="text/css" href="css2.css"/>    
		<script type="text/javascript" src="../script/jquery-1.12.3.min.js"></script> 
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
		<script type="text/javascript" src="skript.js"></script> 
		
</head>
	<body>
		 
		 
		 
		<?php 
			$img = $_REQUEST['img'];
			
			
		?>
	 	 
		<div class="image-full-div">
			<img src="../images/members/<?php echo $img; ?>"/>
			<div id="crop-tool"></div>
			<button id="crop-button" img_name="<?php echo $img; ?>">CROP IMAGE</button>
		</div>
		 
		 
		 
		 
		 
	</body>
</html>