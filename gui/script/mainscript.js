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
	
});


 