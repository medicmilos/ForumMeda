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
/*---------------------------HEADER INFO----------------------*/

	 
	 
	setTimeout(function(){ 
		$(".info, .success, .error").slideUp(500);
	}, 3000);
/*---------------------------NESTO NOVO----------------------*/	 
	


	/*$(".tag").click(function(){
			//$(this).parent().css( "background-color", "yellow" );
			 alert('KLIK');
	});*/
	
 //dom new element
 
 
 
 
 
  
  
  
  /* $(function () {
            var tagovi = [
              "ActionScript",
              "Asp",
              "BASIC",
              "C",
              "C++",
              "Clojure",
              "Haskell",
              "Java",
              "JavaScript",
              "Perl",
              "PHP",
              "Python",
              "Ruby",
              "Scala",
              "Scheme",
              "XML",
              "XSL",
              "Database",
              "SQL",
              "MySQL" 
            ];
            $("#tbTags").autocomplete({
                source: tagovi,
				
				change: function (event, ui) {
        if (ui.item == null || ui.item == undefined) {
            $("#tbTags").val("");
            $("#tbTags").attr("disabled", false);
        } else {
            $("#tbTags").attr("disabled", true);
        }
    }
				
				
				
            });
        }); */
		
	 
});



//provera registracije
function check(){
	
	var username = document.getElementById("tbUsername2").value;
	var email = document.getElementById("tbEmail2").value;
	var gender = document.getElementsByName("rbGender");
	var pass = document.getElementById("tbPassword2").value;
	var repass = document.getElementById("tbPassword22").value;
	
	var userS = document.getElementById("userS");
	var emailS = document.getElementById("emailS");
	var genderS = document.getElementById("genderS");
	var passS = document.getElementById("passS");
	var passS2 = document.getElementById("passS2");
	
	var reg_user=/^[\w\s\/\.\_\d]{4,}$/;
	var reg_email=/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/;
	var reg_pass=/^[\w\s\/\.\_\d]{4,}$/;
	
	var greske=0; 
	
	if(!reg_user.test(username)){
		userS.innerHTML="Username must be at least 4 characters";
		userS.className ="greskeR2";
		document.getElementById("tbUsername2").style.border = "1px solid #a94442";
		greske++;
	}else{
		userS.innerHTML=""; 
		document.getElementById("tbUsername2").style.border = "none";
	}
	if(!reg_email.test(email)){
		emailS.innerHTML="Please enter valid email";
		emailS.className ="greskeR2";
		document.getElementById("tbEmail2").style.border = "1px solid #a94442";
		greske++;
	}else{
		emailS.innerHTML="";
		document.getElementById("tbEmail2").style.border = "none";
	}
	
	var choosen=""; 
	for(var i=0;i<gender.length;i++){
		if(gender[i].checked){ 
		choosen=gender[i].value; break;
		}
	}
	if(choosen==""){
		genderS.innerHTML="Please select gender ";
		genderS.className ="greskeR2"; 
		greske++;
	} else{
		genderS.innerHTML="";
	}
	if(!reg_pass.test(pass)) {
		passS.innerHTML="Password must be at least 4 characters";
		passS.className ="greskeR2";
		document.getElementById("tbPassword2").style.border = "1px solid #a94442";
		greske++;
	}else{
		passS.innerHTML="";
		document.getElementById("tbPassword2").style.border = "none";
	}
	if(reg_pass.test(repass) && pass==repass){
		passS2.innerHTML="";
		document.getElementById("tbPassword22").style.border = "none";
	}else{
		passS2.innerHTML="Passwords must match ";
		passS2.className ="greskeR2";
		document.getElementById("tbPassword22").style.border = "1px solid #a94442";
		greske++;
	}
	
	if(greske==0){
		return true;
	}else{
		return false;
	}
} 





















/*function enter(event){
	if(event.keyCode == 32 || event.which == 32){
		var pom= "";
		pom=document.getElementById("tbTags").value;
		document.getElementById("tbTags").value="";
 
		var stari = document.getElementById("p");
		var dodatak = "<span class='tag' id='tagid'>"+pom+"<span class='xmark' onclick='brisanje(this);'></span><input type='hidden' name='ovo[]' value='"+pom+"'/></span>";
		var novi = document.createElement("span");
		novi.innerHTML = dodatak;
		stari.insertBefore(novi,null);
		
		
	} 
}*/
 /*
function enter(event){
	if(event.keyCode == 32|| event.which == 32){
		var pom= "";
		pom=document.getElementById("tbTags").value;
		document.getElementById("tbTags").value="";
		document.getElementById("p").innerHTML +="<span class='tag'>"+pom+"<span class='xmark' onclick='brisanje(this);'></span><input type='hidden' name='ovo[]' value='"+pom+"'/></span>";
		
		space();
	}
}
function space(){ 
	document.getElementById("tbTags").value="";
}



function brisanje(e){ 
	e.parentNode.style.display = 'none';
} */





var tagovi = [
              "ActionScript",
              "Asp",
              "BASIC",
              "C",
              "C++",
              "Clojure",
              "Haskell",
              "Java",
              "JavaScript",
              "Perl",
              "PHP",
              "Python",
              "Ruby",
              "Scala",
              "Scheme",
              "XML",
              "XSL",
              "Database",
              "SQL",
              "MySQL"
            ];
var temp= "";
var k=0;
var l='';
var m=-1;
function enter(event){
if(event.keyCode == 32 || event.which == 32){
  if(m!=-1){
    
  
var pom= "";
pom=document.getElementById("t").value;
document.getElementById("t").value="";
document.getElementById("p").innerHTML +="<span class='tag show'>"+l+"<span class='xmark' onclick='del(this);'></span><input type='hidden' name='ovo[]' value='"+pom+"'/></span>";l='';
  }
} 
temp=document.getElementById("t").value;
 document.getElementById("n").innerHTML="";
  
  //prvi tekst bez cifre , sta je kesirano za tag
  document.getElementById("n").innerHTML+=l+"<br/>";
  k=0;
  for(var i=0;i<tagovi.length;i++){
    //da li se u tagu nalazi temp
    var a = tagovi[i].toLowerCase();
    var b = temp.toLowerCase();
  //document.getElementById("p").innerHTML+= a.indexOf(b)+"<br/>";
    
    
    if(a.indexOf(b)!=-1){
     m=a.indexOf(b); document.getElementById("n").innerHTML+= tagovi[i]+" "+m+"<br/>";
      //pamti samo prvi tag
      if(k==0){l=tagovi[i];k++;}
    }
  }
}

function del(a){
  a.parentNode.style.display = "none";
  //bloku hidden staviti value na -1 
  //pre preuzimanja hidden infoa pitati da li je taj value -1 i onda ga ne poslati (primiti)
}