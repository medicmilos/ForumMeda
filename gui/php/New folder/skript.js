$(document).ready(
	function(){
		
		var img_full_div_top = $(".image-full-div").position().top;
		var img_full_div_left = $(".image-full-div").position().left;
		
		$("#crop-tool").css("top", img_full_div_top + 50).css("left", img_full_div_left + 50)
		
		$("#crop-tool").resizable();
		$("#crop-tool").draggable({containment:"parent"});
		
		$("#crop-button").click(
			function(){
				
				var img_full_div_top = parseInt($(".image-full-div").position().top);
				var img_full_div_left = parseInt($(".image-full-div").position().left);
				var crop_tool_top = parseInt($("#crop-tool").position().top);
				var crop_tool_left = parseInt($("#crop-tool").position().left);
				
				img_full_div_top.toFixed();
				img_full_div_left.toFixed();
				crop_tool_top.toFixed();
				crop_tool_left.toFixed();
				
				var crop_start_x = crop_tool_left - img_full_div_left;
				var crop_start_y = crop_tool_top - img_full_div_top;
				
				var crop_tool_width = parseInt($("#crop-tool").width());
				var crop_tool_height = parseInt($("#crop-tool").height());
				
				crop_tool_width.toFixed();
				crop_tool_height.toFixed();
				
				var img_name = $("#crop-button").attr("img_name");
				
				$.post("crop.php", {img_name: img_name, crop_start_x: crop_start_x, crop_start_y: crop_start_y, crop_tool_width: crop_tool_width, crop_tool_height: crop_tool_height}, function(data){
					
					 
					
				})
				
				 
			}
			
		);
	}
);