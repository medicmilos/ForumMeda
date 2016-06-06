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
	$(this).parent().html("<input type='hidden' name='page' value='4' /><textarea id='taEditProfile' name='taEditProfile' class='form-control'>"+$(this).text()+"</textarea><input type='submit' class='save' value='Save' name='btnSaveDesc'>");
	});	  
/*---------------------------editovanje usera u admin panelu----------------------*/	 
$('.editmail .email1').click(function(){
	$(this).parent().html(" <textarea id='taEditEmail' name='taEditEmail' class='form-control'>"+$(this).text()+"</textarea>");
	});	 
$('.editpass .editpass1').click(function(){
	$(this).parent().html("  <textarea id='taEditPass' name='taEditPass' class='form-control'>"+$(this).text()+"</textarea>");
	});		
$('.editdesc .editdesc1').click(function(){
	$(this).parent().html(" <textarea id='taEditDesc' name='taEditDesc' class='form-control'>"+$(this).text()+"</textarea> ");
	});		
  
/*---------------------------blok koji se pojavljuje kada korisnik zeli da komentarise komentar----------------- ------------*/ 
	$(".reply").on( "click",function (e) {
		e.preventDefault();	
		$(this).parent().html("<textarea name='nested' class='nested-comment' id='nestedcomment' placeholder='write a comment...' rows='3' ></textarea><input type='submit' name='nested-reply' value='reply' id='btnReplyNested'/> ");  
	});  
/*---------------------------HEADER INFO----------------------*/
 
	setTimeout(function(){ 
		$(".info, .success, .error").slideUp(500);
	}, 3000);
/*---------------------------editovanje usera u admin panelu----------------------*/	 
$('.editmail .email1').click(function(){
	$(this).parent().html(" <textarea id='taEditEmail' name='taEditEmail' class='form-control'>"+$(this).text()+"</textarea>");
	});	 
$('.editpass .editpass1').click(function(){
	$(this).parent().html("  <textarea id='taEditPass' name='taEditPass' class='form-control'>"+$(this).text()+"</textarea>");
	});		
$('.editdesc .editdesc1').click(function(){
	$(this).parent().html(" <textarea id='taEditDesc' name='taEditDesc' class='form-control'>"+$(this).text()+"</textarea> ");
	});	
/*---------------------------NESTO NOVO----------------------*/	 
  
		
		
		
		
		

 
 $('.filterrb').change(function(){
  //$('#filter_page_view').val($(this).val());
  submit_filter();
 });	
		
 
	 
});



	function submit_filter(){
 document.getElementById("filterforma").submit();
}

//provera submitovanja posta na index-u
function provera1(){
	
	var title = document.getElementById("tbTitle").value;
	var post = document.getElementById("taPost").value;
	var tags = document.getElementById("tbTags").value;  
	
	var reg_title=/^[\w\s\/\.\_\d]{4,}$/;
	var reg_post=/^[\w\s\/\.\_\d]{4,}$/;
	var reg_tags=/^[\w\s\/\.\,\_\d]{4,}$/;
	
	var greske=0; 
	
	if(!reg_title.test(title)){   
		tbTitle.className ="crvenoo"; 
		greske++;
	}else{  
		document.getElementById("tbTitle").style.borderColor = "#e6e6e6 !important";  
	}
	if(!reg_post.test(post)){ 
		taPost.className ="crvenoo"; 
		greske++;
	}else{ 
		document.getElementById("taPost").style.borderColor = "#e6e6e6 !important";
	}
	if(!reg_tags.test(tags)){ 
		tbTags.className ="crvenoo"; 
		greske++;
	}else{ 
		document.getElementById("tbTags").style.borderColor = "#e6e6e6 !important";
	}
	if(greske==0){
		return true;
	}else{
		return false;
	}
}

//provera contact forme
function check2(){
	
	var username = document.getElementById("tbYName").value;
	var email = document.getElementById("tbYmail").value; 
	var phone = document.getElementById("tbYPhone").value;
	var subject = document.getElementById("tbYSubject").value;
	var message = document.getElementById("tbYMessage").value;
	
	var nameS = document.getElementById("nameS");
	var mailS = document.getElementById("mailS");
	var phoneS = document.getElementById("phoneS");
	var subjectS = document.getElementById("subjectS");
	var messageS = document.getElementById("mesageS");
	
	var reg_user=/^[\w\s\/\.\_\d]{4,}$/;
	var reg_email=/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/;
	var reg_phone=/^[\w\s\/\.\_\d]{4,}$/;
	
	var greske=0; 
	
	if(!reg_user.test(username)){
		nameS.innerHTML="Please enter valid name";
		nameS.className ="greskeR";
		document.getElementById("tbYName").style.borderBottom ="1px solid #a94442";
		greske++;
	}else{
		nameS.innerHTML=""; 
		document.getElementById("tbYName").style.borderBottom ="1px solid #7b7b7b";
	}
	if(!reg_email.test(email)){
		mailS.innerHTML="Please enter valid email";
		mailS.className ="greskeR";
		document.getElementById("tbYmail").style.borderBottom = "1px solid #a94442";
		greske++;
	}else{
		mailS.innerHTML="";
		document.getElementById("tbYmail").style.borderBottom ="1px solid #7b7b7b";
	}
	if(!reg_phone.test(phone)){
		phoneS.innerHTML="Please enter valid phone";
		phoneS.className ="greskeR";
		document.getElementById("tbYPhone").style.borderBottom = "1px solid #a94442";
		greske++;
	}else{
		phoneS.innerHTML="";
		document.getElementById("tbYPhone").style.borderBottom = "1px solid #7b7b7b";
	}
	
	
	if(subject==""){
		subjectS.innerHTML="Please fill this field";
		subjectS.className ="greskeR"; 
		document.getElementById("tbYSubject").style.borderBottom = "1px solid #a94442";
		greske++;
	} else{
		subjectS.innerHTML="";
		document.getElementById("tbYSubject").style.borderBottom = "1px solid #7b7b7b";
	}
	if(message==""){
		messageS.innerHTML="Please fill this field";
		messageS.className ="greskeR"; 
		document.getElementById("tbYMessage").style.borderBottom = "1px solid #a94442";
		greske++;
	} else{
		messageS.innerHTML="";
		document.getElementById("tbYMessage").style.borderBottom = "1px solid #7b7b7b";
	}
	 
	
	if(greske==0){
		return true;
	}else{
		return false;
	}
} 
	function fild1() {
			var username = document.getElementById("tbYName").value;
			var reg_user=/^[\w\s\/\.\_\d]{4,}$/;  
			if(!reg_user.test(username)){
				nameS.innerHTML="Please enter valid name";
				nameS.className ="greskeR";
				document.getElementById("tbYName").style.borderBottom ="1px solid #a94442"; 
			}else{
				nameS.innerHTML=""; 
				document.getElementById("tbYName").style.borderBottom ="1px solid #7b7b7b";
			}
	} 
	function fild2() {
			var email = document.getElementById("tbYmail").value; 
			var reg_email=/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/;
			if(!reg_email.test(email)){
				mailS.innerHTML="Please enter valid email";
				mailS.className ="greskeR";
				document.getElementById("tbYmail").style.borderBottom = "1px solid #a94442"; 
			}else{
				mailS.innerHTML="";
				document.getElementById("tbYmail").style.borderBottom ="1px solid #7b7b7b";
			}
	} 
	function fild3() {
			var phone = document.getElementById("tbYPhone").value;
			var reg_phone=/^[\w\s\/\.\_\d]{4,}$/;
			if(!reg_phone.test(phone)){
				phoneS.innerHTML="Please enter valid phone";
				phoneS.className ="greskeR";
				document.getElementById("tbYPhone").style.borderBottom = "1px solid #a94442"; 
			}else{
				phoneS.innerHTML="";
				document.getElementById("tbYPhone").style.borderBottom = "1px solid #7b7b7b";
			}
	} 
	function fild4() {  
			var subject = document.getElementById("tbYSubject").value; 
			if(subject==""){
				subjectS.innerHTML="Please fill this field";
				subjectS.className ="greskeR"; 
				document.getElementById("tbYSubject").style.borderBottom = "1px solid #a94442"; 
			} else{
				subjectS.innerHTML="";
				document.getElementById("tbYSubject").style.borderBottom = "1px solid #7b7b7b";
			}
	} 
	function fild5() {  
	var message = document.getElementById("tbYMessage").value;
			var messageS = document.getElementById("mesageS");
			if(message==""){
				messageS.innerHTML="Please fill this field";
				messageS.className ="greskeR"; 
				document.getElementById("tbYMessage").style.borderBottom = "1px solid #a94442"; 
			} else{
				messageS.innerHTML="";
				document.getElementById("tbYMessage").style.borderBottom = "1px solid #7b7b7b";
			}
	}

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
function reg1() {
		var username = document.getElementById("tbUsername2").value;
		var userS = document.getElementById("userS");
		var reg_user=/^[\w\s\/\.\_\d]{4,}$/;
		if(!reg_user.test(username)){
			userS.innerHTML="Username must be at least 4 characters";
			userS.className ="greskeR2";
			document.getElementById("tbUsername2").style.border = "1px solid #a94442"; 
		}else{
			userS.innerHTML=""; 
			document.getElementById("tbUsername2").style.border = "none";
		}
} 
function reg2() { 
		var email = document.getElementById("tbEmail2").value;
		var emailS = document.getElementById("emailS");
		var reg_email=/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/;
		if(!reg_email.test(email)){
			emailS.innerHTML="Please enter valid email";
			emailS.className ="greskeR2";
			document.getElementById("tbEmail2").style.border = "1px solid #a94442"; 
		}else{
			emailS.innerHTML="";
			document.getElementById("tbEmail2").style.border = "none";
		}
} 
function reg3() {
		var pass = document.getElementById("tbPassword2").value;
		var passS = document.getElementById("passS");
		var reg_pass=/^[\w\s\/\.\_\d]{4,}$/;
		if(!reg_pass.test(pass)) {
			passS.innerHTML="Password must be at least 4 characters";
			passS.className ="greskeR2";
			document.getElementById("tbPassword2").style.border = "1px solid #a94442"; 
		}else{
			passS.innerHTML="";
			document.getElementById("tbPassword2").style.border = "none";
		}
} 
function reg4() {  
		var pass = document.getElementById("tbPassword2").value;
		var repass = document.getElementById("tbPassword22").value;
		var passS2 = document.getElementById("passS2");
		var reg_pass=/^[\w\s\/\.\_\d]{4,}$/;
	if(reg_pass.test(repass) && pass==repass){
		passS2.innerHTML="";
		document.getElementById("tbPassword22").style.border = "none";
	}else{
		passS2.innerHTML="Passwords must match ";
		passS2.className ="greskeR2";
		document.getElementById("tbPassword22").style.border = "1px solid #a94442"; 
	}
} 
//provera submitovanja komenara na post
function provera2(){ 
	var comment = document.getElementById("taComment").value;  
	var reg_taComment=/^[\w\s\/\.\_\d]{4,}$/;
	var greske=0; 
	
	if(!reg_taComment.test(comment)){   
		taComment.className ="crvenoo"; 
		greske++;
	}else{ 
		document.getElementById("taComment").style.borderColor = "#a94442"; 
	}
	
	if(greske==0){
		return true;
	}else{
		return false;
	}
}
//provera submitovanja nested-komenara na post
function provera3(){ 
	var ncomment = document.getElementById("nestedcomment").value;  
	var reg_nComment=/^[\w\s\/\.\_\d]{4,}$/;
	var greske=0; 
	
	if(!reg_nComment.test(ncomment)){   
		nestedcomment.className +=" crvenoo"; 
		greske++;
	}else{ 
		document.getElementById("nestedcomment").style.borderColor = "#a94442"; 
	}
	
	if(greske==0){
		return true;
	}else{
		return false;
	}
}

 
////////////////////////////AJAX ANKETA//////////////
var http;
function ajaxprovera(){ 
	if(window.XMLHttpRequest){
		http=new XMLHttpRequest();
	}else{
		http=new ActiveXObject("Microsoft.XMLHTTP");
	}
	http.open("GET","poll.php",true);
	http.send();
	http.onreadystatechange = write_poll; 
}
function write_poll(){
	if(http.readyState==4){
		document.getElementById("statistika2").innerHTML=http.responseText;
	}
	
}
function poll_vote(){
	if(window.XMLHttpRequest){
		http=new XMLHttpRequest();
	}else{
		http=new ActiveXObject("Microsoft.XMLHTTP");
	}
	http.open("GET","poll.php?submit_poll=obj&answers="+getanswer(),true);
	http.send();
	http.onreadystatechange = write_poll; 
	
	
}
function getanswer(){
	
	var n= parseInt(document.getElementById("numbofradio").value);
	var check=0;
	
	for(var i=1;i<n;i++){ 
		if(document.getElementById(""+i).checked){
			check = document.getElementById(""+i).value; 
		}
		
	}
	return check;
}







	
	
/*


 function enter(event){
	if(event.keyCode == 44|| event.which == 44){
		var pom= "";
		pom=document.getElementById("tbTags").value;
		document.getElementById("tbTags").value="";
 
		var stari = document.getElementById("p");
		var dodatak = "<span class='tag' id='tagid'>"+pom+"<span class='xmark' onclick='brisanje(this);'></span><input type='hidden' name='ovo[]' value='"+pom+"'/></span>";
		var novi = document.createElement("span");
		novi.innerHTML = dodatak;
		stari.insertBefore(novi,null);
		
		
	} 
}

function brisanje(e){ 
	e.parentNode.style.display = 'none';
}  */
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

*/





/*
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
		var cc = l.toLowerCase();
		var ccc = document.getElementById("tbTags").value.toLowerCase();
		ccc= ccc.substring(0, ccc.length - 1);
		if(cc.indexOf(ccc)!=-1){
			//if(m!=-1){
				var pom= "";
				pom=document.getElementById("tbTags").value;
				document.getElementById("tbTags").value="";
				document.getElementById("p").innerHTML +="<span class='tag show'>"+l+"<span class='xmark' onclick='del(this);'></span><input type='hidden' name='ovo[]' value='"+pom+"'/></span>";l='';
			//}
		}else{
			document.getElementById("tbTags").value="";
		}  
	} 


	temp=document.getElementById("tbTags").value;
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
			if(k==0){
				l=tagovi[i];k++;
			}
		}
	}
}

function del(a){
	a.parentNode.style.display = "none";
	//bloku hidden staviti value na -1 
	//pre preuzimanja hidden infoa pitati da li je taj value -1 i onda ga ne poslati (primiti)
}*/