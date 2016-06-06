<?php
	$tags= "meda, djura, perica, mikica";



	$tags = explode(',', $tags);
 
		foreach($tags as $r){ 
			echo trim($r);
		}
?>