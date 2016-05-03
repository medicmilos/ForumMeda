$(document).ready(function(){
	
/*---------------------------SUBMIT POST---------------------------------------------------------*/
	$("#dodatak").hide();
	$("#tbTitle").focus(function(){ 
		$("#dodatak").toggle(function(){
			$(this).find('div').slideDown();
		});
	});
	$("#btnClose").click(function(){ 
		$("#dodatak").toggle(function(){
			$( this ).find('div').slideUp();
		});
	});
/*---------------------------NESTO NOVO---------------------------------------------------------*/
 	$("#dodatak2").hide();
	$("#tbKlik").focus(function(){ 
		$("#tbKlik").hide();
		$("#dodatak2").slideDown();
		$("#taComment").focus();
	});
	$("#btnClose").click(function(){ 
		
		$("#dodatak2").slideUp();
		$("#tbKlik").show();
	});
/*---------------------------NESTO NOVO---------------------------------------------------------*/	
 $('#menu li ul').css({
		display: "none",
		left: "auto"
	});
	$("#menu li").click(function(){ 
		$("#menu li ul").toggle(function(){
			$( this ).find('ul').slideDown();
		},function(){
			$( this ).find('ul').slideUp();
		});
	});

	
	 
	
	$('#description .edit').click(function(){
	
	$(this).parent().html("<textarea id='taEditProfile' name='taEditProfile' class='form-control'>"+$(this).text()+"</textarea><input type='submit' class='save' value='Save' name='btnSaveDesc'>");
  
	});	 
 
 
	
	
	
	
	
	
});
 
 
 
 
