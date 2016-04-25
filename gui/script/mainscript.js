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
		$("#dodatak2").show();
	});
	 
	 
});
 