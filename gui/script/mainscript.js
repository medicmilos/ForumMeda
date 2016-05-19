$(document).ready(function(){
	
/*---------------------------SUBMIT POST---------------------------------------------------------*/
	$("#dodatak").hide();
	$("#tbTitle").click(function(){ 
		$("#dodatak").slideDown();
	});
	$("#btnClose").click(function(){ 
		$("#dodatak").toggle(function(){
			$( this ).find('div').slideUp();
		});
	});
/*---------------------------komentarisanje posta---------------------------------------------------------*/
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
/*---------------------------desni meni sa profile i logout---------------------------------------------------------*/	
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
/*---------------------------deskripcija korisnika koja se pojavljuje kad on zeli da je edituje----------------------*/	 
	$('#description .edit').click(function(){
	$(this).parent().html("<textarea id='taEditProfile' name='taEditProfile' class='form-control'>"+$(this).text()+"</textarea><input type='submit' class='save' value='Save' name='btnSaveDesc'>");
	});	 
/*---------------------------blok koji se pojavljuje kada korisnik zeli da komentarise komentar----------------- ------------*/ 
	$(".reply").on( "click",function (e) {
		e.preventDefault();	
		$(this).parent().html("<textarea name='nested' class='nested-comment' placeholder='write a comment...' rows='3' ></textarea><input type='submit' name='nested-reply' value='reply' id='btnReplyNested'/> ");  
	});  
/*---------------------------NESTO NOVO----------------------*/	 
	
	
	
	
	setTimeout(function() {$(".info, .success, .error").fadeOut(300);}, 3000); // <-- time in milliseconds
	
	
	
});
 
 
 
 
