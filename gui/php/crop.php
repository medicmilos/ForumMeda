<?php
	$img_name = $_REQUEST["img_name"];
	$crop_start_x = $_REQUEST["crop_start_x"]; 
	$crop_start_y = $_REQUEST["crop_start_y"]; 
	$crop_tool_width = $_REQUEST["crop_tool_width"];
	$crop_tool_height = $_REQUEST["crop_tool_height"]; 

	$dst_x = 0;
	$dst_y = 0;
	$src_x = $crop_start_x;
	$src_y = $crop_start_y;
	$dst_w = $crop_tool_width;
	$dst_h = $crop_tool_height;
	$src_w = $src_x + $dst_w;
	$src_h = $src_y + $dst_h;

	$ext = end((explode(".", $img_name)));
	
	$url = "";
	$dir2 = "../images/members/";
	$files2 = scandir($dir2);
	$count = count($files2);
	
	if($ext == "jpg"){
		for($i=0; $i<$count; $i++){ 
			$url = "../images/members/dir/".rand(0,10000)."cropped.jpg"; 
		}
	
		$dst_image = imagecreatetruecolor($dst_w, $dst_h);
		$src_image = imagecreatefromjpeg("../images/members/$img_name");
		imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_image, $url);
		
	}else if($ext == "png"){  
		for($i=0; $i<$count; $i++){ 
			$url = "../images/members/dir/".rand(0,10000)."cropped.jpg"; 
		}
		
		$dst_image = imagecreatetruecolor($dst_w, $dst_h);
		$src_image = imagecreatefrompng("../images/members/$img_name");
		imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
		imagepng($dst_image, $url);
		
	}else if($ext == "gif"){
		for($i=0; $i<$count; $i++){ 
			$url = "../images/members/dir/".rand(0,10000)."cropped.jpg"; 
		}
		
		$dst_image = imagecreatetruecolor($dst_w, $dst_h);
		$src_image = imagecreatefromgif("../images/members/$img_name");
		imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
		imagegif($dst_image, $url);
		
	}
 
?>