function log_in() {
var login = $('#login').val();
var password = $('#password').val();
var params = "login=" + login + "&password=" + password;
$.ajax({
type: "POST",
url: "ajax/login.php",
data: params,
beforeSend: function(){
document.getElementById('btn_').innerHTML = "<img src='tpl/img/load.gif'/>";
document.getElementById('result').innerHTML = "";
},
success: function(data){
if (data=='1') {
window.location.href = "index.php?a=banner"
} else {
$('#result').html(data).fadeIn("slow");
document.getElementById('btn_').innerHTML = '<a href="javascript:void(0)" onclick="log_in()" class="a_b">ВОЙТИ</a>';
}}});}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function myedit() {

var pass = $('#pass1').val();
var pass1 = $('#pass12').val();
var cena = $('#cena').val();
var email = $('#email').val();
var fio = $('#fio').val();
var dom = $('#dom').val();
params = { pass:pass,pass1:pass1,email:email,fio:fio,dom:dom,cena:cena};


	
$.ajax({
type: "POST",
url: "ajax/configuration.php",
data: params,
beforeSend: function(){
document.getElementById('sajax').innerHTML = "<img src='tpl/img/load.gif'/>";
document.getElementById('res17812').innerHTML = "";
},
success: function(data){
//	alert(data);
$('#res17812').html(data).fadeIn("slow");
document.getElementById('sajax').innerHTML = '<input class="button" onclick="myedit()" type="button" value="Сохранить"/>';
}})




}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function delete_special(n){
	
params = { id:n };

$.ajax({
type: "POST",
url: "ajax/delete_special.php",
data: params,
success: function(data){
	
alert(data);
location.reload();

}})	
	
}


function add_special(n){
	
params = { id:n };

$.ajax({
type: "POST",
url: "ajax/add_special.php",
data: params,
success: function(data){
	
alert(data);
location.reload();

}})		
	
}

















function check_all_news(){
var frm = document.all2;
for (var i=0;i<frm.elements.length;i++) {
var elmnt = frm.elements[i];
if (elmnt.type=='checkbox') {
if(frm.all.checked == true){ elmnt.checked=false; }
else{ elmnt.checked=true;
document.getElementById('delButton').disabled = false;
document.getElementById('delButton').style.background = 'url("tpl/img/but.png") no-repeat';
}
}}
if(frm.all.checked == true){ frm.all.checked = false;
document.getElementById('delButton').disabled = true;
document.getElementById('delButton').style.background = 'url("tpl/img/but_n.png") no-repeat';
 }
else{ frm.all.checked = true; }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

function check_all_news_button(){
var a = document.getElementsByTagName('input');
var t=0;
var k=0;
var rft=0;
for (var i = 0; i < a.length; i++) {
if (a[i].name == 'box' && a[i].type == 'checkbox') {
if(a[i].checked==true){
t=1;k++;}
rft++;
}}
if (t=='1') {
document.getElementById('delButton').disabled = false;
document.getElementById('delButton').style.background = 'url("tpl/img/but.png") no-repeat';
}else {
document.getElementById('delButton').disabled = true;
document.getElementById('delButton').style.background = 'url("tpl/img/but_n.png") no-repeat';
}
if (k==rft) {
document.getElementById('all').checked = true;
} else {
document.getElementById('all').checked = false;
}}

////////////////////////////////////////////////////////////////////////////////////////////////////////////

function perehod(kl) {
var perehod = $('#move').val();
var dfr=kl+perehod;
window.location.href = dfr;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function delete_news(id){
var params = "id=" + id+"&p=delete";
$.ajax({
type: "POST",
url: "ajax/news.php",
data: params,
beforeSend: function(){
document.getElementById('loader'+id).innerHTML = "<img src='tpl/img/loader2.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('loader'+id).innerHTML = '<a href="javascript:void(0)" onclick="delete_news(\''+id+'\')"><img src="tpl/img/delete.png"/></a>';
}}})}

/////////////////////////////////////////////////////////////////////////////

function delete_news_all() {
var a = document.getElementsByTagName('input');
var data='';
for (var i = 0; i < a.length; i++) {
if (a[i].name == 'box' && a[i].type == 'checkbox') {
if(a[i].checked==true){
data = data  + a[i].value+ ',';}}}
var drop=data.replace(/,*$/,"");
var params = "id=" + drop+"&all=1&p=delete";
$.ajax({
type: "POST",
url: "ajax/news.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf45').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('dsfdsf45').innerHTML = '<input class="button" id="delButton" type="button" onclick="delete_news_all()" value="Удалить"/>';
}}})}

///////////////////////////////////////////////////////////////////////////////////////////////

function add_news(){
var title = $('#title').val();
var text = CKEDITOR.instances["content1"].getData();
var krat = $('#content2').val();
var id_e = $('#id_e').val();
var datep = $('#datetime').val();
var datep1 = $('#datetimepo').val();
var file = $('#sin').val();
var org = $('#org').val();
var place = $('#place').val();
var owner = $('#owner').val();
var put = $('#put').val();
var cena = $('#cena').val();
if ($('#flag_b').prop("checked")){var flag_b = 1;} else {var flag_b = 0;}; 
if ($('#flag_v').prop("checked")){var flag_v = 1;} else {var flag_v = 0;}; 

var params = { p :'add',title:title,text:text,id_e:id_e,krat:krat,datep:datep,file:file,org:org,place:place,owner:owner,datep1:datep1,flag_v:flag_v,flag_b:flag_b,put:put,cena:cena};
$.ajax({
type: "POST",
url: "ajax/news.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf45').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
$('#res1781251').html(data).fadeIn("slow");
if (data!=='<script>window.location.href = "index.php?a=news"</script>') {
document.getElementById('dsfdsf45').innerHTML = '<input class="button" type="button" onclick="add_news()" value="Сохранить"/>';
}}})}

function del_foto(){
var id_e = $('#id_e').val();


var params = {id_e:id_e};
$.ajax({
type: "POST",
url: "ajax/fotodel.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf55').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
if (data=='del') {
document.getElementById('dsfdsf55').innerHTML = '';
}}})};

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function check_all_news1(){
var frm = document.all2;
for (var i=0;i<frm.elements.length;i++) {
var elmnt = frm.elements[i];
if (elmnt.type=='checkbox') {
if(frm.all.checked == true){ elmnt.checked=false; }
else{ elmnt.checked=true;
document.getElementById('delButton').disabled = false;
document.getElementById('delButton').style.background = 'url("tpl/img/but.png") no-repeat';
document.getElementById('moderButton').disabled = false;
document.getElementById('moderButton').style.background = 'url("tpl/img/but.png") no-repeat';
}
}}
if(frm.all.checked == true){ frm.all.checked = false;
document.getElementById('delButton').disabled = true;
document.getElementById('delButton').style.background = 'url("tpl/img/but_n.png") no-repeat';
document.getElementById('moderButton').disabled = true;
document.getElementById('moderButton').style.background = 'url("tpl/img/but_n.png") no-repeat';
 }
else{ frm.all.checked = true; }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

function check_all_news_button1(){
var a = document.getElementsByTagName('input');
var t=0;
var k=0;
var rft=0;
for (var i = 0; i < a.length; i++) {
if (a[i].name == 'box' && a[i].type == 'checkbox') {
if(a[i].checked==true){
t=1;k++;}
rft++;
}}
if (t=='1') {
document.getElementById('delButton').disabled = false;
document.getElementById('delButton').style.background = 'url("tpl/img/but.png") no-repeat';
document.getElementById('moderButton').disabled = false;
document.getElementById('moderButton').style.background = 'url("tpl/img/but.png") no-repeat';
}else {
document.getElementById('delButton').disabled = true;
document.getElementById('delButton').style.background = 'url("tpl/img/but_n.png") no-repeat';
document.getElementById('moderButton').disabled = true;
document.getElementById('moderButton').style.background = 'url("tpl/img/but_n.png") no-repeat';
}
if (k==rft) {
document.getElementById('all').checked = true;
} else {
document.getElementById('all').checked = false;
}}

//////////////////////////////////////////////////////////////////////////////////

function info() {
var pass = $('#pass1').val();
var pass1 = $('#pass12').val();
var email = $('#email_u').val();
var payeer = $('#payeer').val();
var perfect = $('#perfect').val();
var id_u = $('#id_u').val();
params = { pass:pass,pass1:pass1,email:email,payeer:payeer,perfect:perfect,id_u:id_u};

$.ajax({
type: "POST",
url: "ajax/info_user.php",
data: params,
beforeSend: function(){
document.getElementById('sajax').innerHTML = "<img src='tpl/img/load.gif'/>";
document.getElementById('res17812').innerHTML = "";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
document.getElementById('sajax').innerHTML = '<input class="button" onclick="info()" type="button" value="Сохранить"/>';
}})}
////////////////////////////////////////////////

function delete_place(id){
var params = "id=" + id+"&p=delete";
$.ajax({
type: "POST",
url: "ajax/place.php",
data: params,
beforeSend: function(){
document.getElementById('loader'+id).innerHTML = "<img src='tpl/img/loader2.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('loader'+id).innerHTML = '<a href="javascript:void(0)" onclick="delete_place(\''+id+'\')"><img src="tpl/img/delete.png"/></a>';
}}})}

/////////////////////////////////////////////////////////////////////////////

function delete_place_all() {
var a = document.getElementsByTagName('input');
var data='';
for (var i = 0; i < a.length; i++) {
if (a[i].name == 'box' && a[i].type == 'checkbox') {
if(a[i].checked==true){
data = data  + a[i].value+ ',';}}}
var drop=data.replace(/,*$/,"");
var params = "id=" + drop+"&all=1&p=delete";
$.ajax({
type: "POST",
url: "ajax/place.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf45').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('dsfdsf45').innerHTML = '<input class="button" id="delButton" type="button" onclick="delete_place_all()" value="Удалить"/>';
}}})}

///////////////////////////////////////////////////////////////////////////////////////////////

function add_place(){
var title = $('#title').val();
var ad = $('#dfer45').val();
var id_e = $('#id_e').val();
var params = { p :'add',title:title,id_e:id_e,ad:ad};
$.ajax({
type: "POST",
url: "ajax/place.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf45').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
$('#res1781251').html(data).fadeIn("slow");
if (data!=='<script>window.location.href = "index.php?a=place"</script>') {
document.getElementById('dsfdsf45').innerHTML = '<input class="button" type="button" onclick="add_place()" value="Сохранить"/>';
}}})}
////////////////////////////////

function delete_org(id){
var params = "id=" + id+"&p=delete";
$.ajax({
type: "POST",
url: "ajax/org.php",
data: params,
beforeSend: function(){
document.getElementById('loader'+id).innerHTML = "<img src='tpl/img/loader2.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('loader'+id).innerHTML = '<a href="javascript:void(0)" onclick="delete_org(\''+id+'\')"><img src="tpl/img/delete.png"/></a>';
}}})}

/////////////////////////////////////////////////////////////////////////////

function delete_org_all() {
var a = document.getElementsByTagName('input');
var data='';
for (var i = 0; i < a.length; i++) {
if (a[i].name == 'box' && a[i].type == 'checkbox') {
if(a[i].checked==true){
data = data  + a[i].value+ ',';}}}
var drop=data.replace(/,*$/,"");
var params = "id=" + drop+"&all=1&p=delete";
$.ajax({
type: "POST",
url: "ajax/org.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf45').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('dsfdsf45').innerHTML = '<input class="button" id="delButton" type="button" onclick="delete_org_all()" value="Удалить"/>';
}}})}

///////////////////////////////////////////////////////////////////////////////////////////////

function add_org(){
var title = $('#title').val();
var id_e = $('#id_e').val();
var ad = $('#dfer45').val();
var params = { p :'add',title:title,id_e:id_e,ad:ad};
$.ajax({
type: "POST",
url: "ajax/org.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf45').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
$('#res1781251').html(data).fadeIn("slow");
if (data!=='<script>window.location.href = "index.php?a=org"</script>') {
document.getElementById('dsfdsf45').innerHTML = '<input class="button" type="button" onclick="add_org()" value="Сохранить"/>';
}}})}

/////////////////////

function delete_razdel(id){
var params = "id=" + id+"&p=delete";
$.ajax({
type: "POST",
url: "ajax/razdel.php",
data: params,
beforeSend: function(){
document.getElementById('loader'+id).innerHTML = "<img src='tpl/img/loader2.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('loader'+id).innerHTML = '<a href="javascript:void(0)" onclick="delete_razdel(\''+id+'\')"><img src="tpl/img/delete.png"/></a>';
}}})}

/////////////////////////////////////////////////////////////////////////////

function delete_razdel_all() {
var a = document.getElementsByTagName('input');
var data='';
for (var i = 0; i < a.length; i++) {
if (a[i].name == 'box' && a[i].type == 'checkbox') {
if(a[i].checked==true){
data = data  + a[i].value+ ',';}}}
var drop=data.replace(/,*$/,"");
var params = "id=" + drop+"&all=1&p=delete";
$.ajax({
type: "POST",
url: "ajax/razdel.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf45').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('dsfdsf45').innerHTML = '<input class="button" id="delButton" type="button" onclick="delete_razdel_all()" value="Удалить"/>';
}}})}

///////////////////////////////////////////////////////////////////////////////////////////////

function add_razdel(){
var title = $('#title').val();
var adddd = $('#org').val();
var id_e = $('#id_e').val();
var params = { p :'add',title:title,id_e:id_e,adddd:adddd};
$.ajax({
type: "POST",
url: "ajax/razdel.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf45').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
$('#res1781251').html(data).fadeIn("slow");
if (data!=='<script>window.location.href = "index.php?a=razdel"</script>') {
document.getElementById('dsfdsf45').innerHTML = '<input class="button" type="button" onclick="add_razdel()" value="Сохранить"/>';
}}})}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function info() {
var pass = $('#pass1').val();
var pass1 = $('#pass12').val();
var email = $('#email_u').val();
var name = $('#login_u').val();
var number = $('#number').val();
var id_u = $('#id_u').val();
params = { pass:pass,pass1:pass1,email:email,id_u:id_u,name:name,number:number};

$.ajax({
type: "POST",
url: "ajax/info_user.php",
data: params,
beforeSend: function(){
document.getElementById('sajax').innerHTML = "<img src='tpl/img/load.gif'/>";
document.getElementById('res17812').innerHTML = "";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
document.getElementById('sajax').innerHTML = '<input class="button" onclick="info()" type="button" value="Сохранить"/>';
}})}

////////////////////////////////

function delete_order(id){
var params = "id=" + id+"&p=delete";
$.ajax({
type: "POST",
url: "ajax/order.php",
data: params,
beforeSend: function(){
document.getElementById('loader'+id).innerHTML = "<img src='tpl/img/loader2.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('loader'+id).innerHTML = '<a href="javascript:void(0)" onclick="delete_order(\''+id+'\')"><img src="tpl/img/delete.png"/></a>';
}}})}

/////////////////////////////////////////////////////////////////////////////

function delete_order_all() {
var a = document.getElementsByTagName('input');
var data='';
for (var i = 0; i < a.length; i++) {
if (a[i].name == 'box' && a[i].type == 'checkbox') {
if(a[i].checked==true){
data = data  + a[i].value+ ',';}}}
var drop=data.replace(/,*$/,"");
var params = "id=" + drop+"&all=1&p=delete";
$.ajax({
type: "POST",
url: "ajax/order.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf45').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('dsfdsf45').innerHTML = '<input class="button" id="delButton" type="button" onclick="delete_order_all()" value="Удалить"/>';
}}})}

///////////////////////////////////////////////////////////////////////////////////////////////

function add_org(){
var title = $('#title').val();
var id_e = $('#id_e').val();
var ad = $('#dfer45').val();
var params = { p :'add',title:title,id_e:id_e,ad:ad};
$.ajax({
type: "POST",
url: "ajax/org.php",
data: params,
beforeSend: function(){
document.getElementById('dsfdsf45').innerHTML = "<img src='tpl/img/load.gif'/>";
},
success: function(data){
$('#res1781251').html(data).fadeIn("slow");
if (data!=='<script>window.location.href = "index.php?a=org"</script>') {
document.getElementById('dsfdsf45').innerHTML = '<input class="button" type="button" onclick="add_org()" value="Сохранить"/>';
}}})}

//////////////////////////////////////////////////////////////////////////////////

function edit_order() {
var sum = $('#summm').val();
var new_m = $('#dfgerrt455').val();
var idf = $('#dfgerrt4557').val();
params = { sum:sum,new_m:new_m,idf:idf};

$.ajax({
type: "POST",
url: "ajax/edit_order.php",
data: params,
beforeSend: function(){
document.getElementById('sajax').innerHTML = "<img src='tpl/img/load.gif'/>";
document.getElementById('res17812').innerHTML = "";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
document.getElementById('sajax').innerHTML = '<input class="button" onclick="edit_order()" type="button" value="Сохранить"/>';
}})}

////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////

function delete_foto(id_tovar,url) {

params = { id_tovar:id_tovar,url:url};

$.ajax({
type: "POST",
url: "ajax/delete_foto.php",
data: params,
beforeSend: function(){
//document.getElementById('sajax').innerHTML = "<img src='tpl/img/load.gif'/>";
//document.getElementById('res17812').innerHTML = "";
},
success: function(data){


 location.reload();



}})}

////////////////////////////////

function tovat_add() {
//var msg   = $('#formx').serialize();

//var fd = new FormData();    
//msg.append( 'file', input.files[0] );

/*
$.ajax({
type: "POST",
url: "ajax/tovat_add.php",
data: msg,
beforeSend: function(){
document.getElementById('addjax').innerHTML = "<img src='tpl/img/load.gif'/>";
document.getElementById('res12').innerHTML = "";
},
success: function(data){
$('#res12').html(data).fadeIn("slow");
document.getElementById('addjax').innerHTML = '<input class="button" onclick="tovat_add()" type="button" value="Добавить"/>';
}})
*/
document.getElementById('addjax').innerHTML = "<img src='tpl/img/load.gif'/>";
document.getElementById('res12').innerHTML = "";

var form = document.forms.formx;
 
            var formData = new FormData(form); 
			//alert(formData);
 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/adm/ajax/tovat_add.php");
 
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if(xhr.status == 200) {
                        data = xhr.responseText;
                        if(data == "true") {
                            //$(".sending").replaceWith("<p>Принято!<p>");
							$('#res12').html(data).fadeIn("slow");
							document.getElementById('addjax').innerHTML = '<input class="button" onclick="tovat_add()" type="button" value="Добавить"/>';
                        } else {
							//alert("Ошибка!");
                            $('#res12').html(data).fadeIn("slow");
							document.getElementById('addjax').innerHTML = '<input class="button" onclick="tovat_add()" type="button" value="Добавить"/>';
                        }
                    }
                }
            };

            xhr.send(formData);






}

////////////////////////////////


////////////////////////////////

function tovat_add2() {

document.getElementById('addjax2').innerHTML = "<img src='tpl/img/load.gif'/>";
document.getElementById('res12_2').innerHTML = "";

var form = document.forms.formx2;
 
            var formData = new FormData(form); 
			//alert(formData);
 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/action/import.php");
 
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if(xhr.status == 200) {
                        data = xhr.responseText;
                        if(data == "true") {
                            //$(".sending").replaceWith("<p>Принято!<p>");
							//$('#res12_2').html(data).fadeIn("slow");
							document.getElementById('addjax2').innerHTML = '<input class="button" onclick="tovat_add2()" type="button" value="Добавить"/>';
                        	if(data==""){
								alert("Импорт успешно завершён."+data);	
							}else{
								alert(data);
							}
						} else {
							//alert("Ошибка!");
                           // $('#res12_2').html(data).fadeIn("slow");
							document.getElementById('addjax2').innerHTML = '<input class="button" onclick="tovat_add2()" type="button" value="Добавить"/>';
                        	if(data==""){
								alert("Импорт успешно завершён."+data);	
							}else{
								alert(data);
							}
						}
                    }
                }
            };

            xhr.send(formData);






}

////////////////////////////////


////////////////////////////////

function tovat_add3() {

document.getElementById('addjax3').innerHTML = "<img src='tpl/img/load.gif'/>";
document.getElementById('res12_2').innerHTML = "";


var select1=$("#formx3 select").val();




	var form = document.forms.formx3;
 
            var formData = new FormData(form); 
			//alert(formData);
 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/action/import2.php");
 
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if(xhr.status == 200) {
                        data = xhr.responseText;
                        if(data == "true") {
                            //$(".sending").replaceWith("<p>Принято!<p>");
							//$('#res12_2').html(data).fadeIn("slow");
							document.getElementById('addjax3').innerHTML = '<input class="button" onclick="tovat_add3()" type="button" value="Загрузить"/>';
                        	if(data==""){
								alert("Импорт успешно завершён."+data);	
							}else{
								alert(data);
							}
						} else {
							//alert("Ошибка!");
                           // $('#res12_2').html(data).fadeIn("slow");
							document.getElementById('addjax3').innerHTML = '<input class="button" onclick="tovat_add3()" type="button" value="Загрузить"/>';
                        	if(data==""){
								alert("Импорт успешно завершён."+data);	
							}else{
								alert(data);
							}
						}
                    }
                }
            };

            xhr.send(formData);






}

////////////////////////////////



////////////////////////////////

function tovat_add4() {

document.getElementById('addjax4').innerHTML = "<img src='tpl/img/load.gif'/>";
document.getElementById('res12_2').innerHTML = "";

var form = document.forms.formx3;
 
            var formData = new FormData(form); 
			//alert(formData);
 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/action/autoimport_insert.php");
 
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if(xhr.status == 200) {
                        data = xhr.responseText;
                        if(data == "true") {
                            //$(".sending").replaceWith("<p>Принято!<p>");
							//$('#res12_2').html(data).fadeIn("slow");
							document.getElementById('addjax4').innerHTML = '<input class="button" onclick="tovat_add4()" type="button" value="Включить автоимпорт"/>';
                        	
							if(data==""){
								alert("Автоимпорт успешно включён. Товары из xml-файла будут импортироваться раз в сутки."+data);	
							}else{
								alert(data);
							}
							
							
						} else {
							//alert("Ошибка!");
                           // $('#res12_2').html(data).fadeIn("slow");
							document.getElementById('addjax4').innerHTML = '<input class="button" onclick="tovat_add4()" type="button" value="Включить автоимпорт"/>';
                        	if(data==""){
								alert("Автоимпорт успешно включён. Товары из xml-файла будут импортироваться раз в сутки."+data);	
							}else{
								alert(data);
							}
						}
                    }
                }
            };

            xhr.send(formData);






}

////////////////////////////////


function delete_za(id){
var params = "id=" + id+"&p=delete";
$.ajax({
type: "POST",
url: "ajax/za.php",
data: params,
beforeSend: function(){
document.getElementById('loader'+id).innerHTML = "<img src='tpl/img/loader2.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('loader'+id).innerHTML = '<a href="javascript:void(0)" style="font-size:10px;" onclick="delete_za(\''+id+'\')">Удалить жалобу и фото</a>';
}}})}

/////////////////////////////////////////////////////////////////////////////


///////////////////

function delete_zab(id){
var params = "id=" + id+"&p=deleter";
$.ajax({
type: "POST",
url: "ajax/za.php",
data: params,
beforeSend: function(){
document.getElementById('loader1'+id).innerHTML = "<img src='tpl/img/loader2.gif'/>";
},
success: function(data){
$('#res17812').html(data).fadeIn("slow");
if (data=='<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>') {
document.getElementById('loader'+id).innerHTML = '<a href="javascript:void(0)" style="font-size:10px;" onclick="delete_zab(\''+id+'\')">Удалить только жалобу</a>';
}}})}


function insert_file_input(){
	var html=$(".files1").html();
	html=html+'<input name="userfile[]" type="file" /><br />';
	$(".files1").html(html);
}


function insert_file_input2(){
	var html=$(".files2").html();
	html=html+'<input name="userfile[]" type="file" /><br />';
	$(".files2").html(html);
}



function add_cat(cat){

	var result = prompt("Введите наименование категории:", "");


	if(result==""){
		alert("Ошибка! Вы не ввел наименование категории.");	
	}else{
		params = { cat:cat,name:result};
		$.ajax({
		type: "POST",
		url: "ajax/add_cat.php",
		data: params,
		success: function(data){
			alert(data);
			location.reload();
			
		}})
				
	}
	
		
}



function spoiler1(){
	
	var display=$(".spoiler1").css('display');
	if(display=="none"){
		$(".spoiler1").css('display','block');
		$(".spoiler_title1").html('Свернуть');
			
	}else{
		$(".spoiler1").css('display','none');
		$(".spoiler_title1").html('Развернуть');
	}
	
}

function spoiler2(){
	var display=$(".spoiler2").css('display');
	if(display=="none"){
		$(".spoiler2").css('display','block');
		$(".spoiler_title2").html('Свернуть');
			
	}else{
		$(".spoiler2").css('display','none');
		$(".spoiler_title2").html('Развернуть');
	}
	
	
}


function select_category1(n){

	$('.unit1 .category1 div').css('background-color','transparent');	
	$('.unit1 .category1 .cat_'+n+'').css('background-color','green');	
	$('.unit1 #cat1').val(n);
	var name=$('.unit1 .category1 .cat_'+n+'').html();
	$('.unit1 input[type="text"]').val(name); 
	
}


function select_category2(n){

	$('.unit1 .category2 div').css('background-color','transparent');	
	$('.unit1 .category2 .cat_'+n+'').css('background-color','green');	
	$('.unit1 #cat2').val(n);
	var name=$('.unit1 .category2 .cat_'+n+'').html();
	$('.unit1 input[type="text"]').val(name);
		
	
}



function unite_cat(){
	
	var cat1=$('.unit1 #cat1').val();
	var cat2=$('.unit1 #cat2').val();
	
	
	var check1=$('.unit1 #main1').prop("checked");
	var check2=$('.unit1 #main2').prop("checked");
	
	if(check1==true){
		var cat_main=cat1;
		var cat_del=cat2;
		
	}else if(check2==true){
		var cat_main=cat2;
		var cat_del=cat1;
		
	}else{
		alert("Ошибка! Не выбрана основная категория.");	
	}
	
	var name_cat=$('.unit1 input[type="text"]').val();
	
	//alert(name_cat);
	
	
	
	params = { cat_main:cat_main,cat_del:cat_del,name_cat:name_cat};
		$.ajax({
		type: "POST",
		url: "ajax/unite_cat.php",
		data: params,
		success: function(data){
			alert(data);
			location.reload();
			
		}})
	
	
	
	
}


function delete_cat(n){
	if (confirm("Вы  действительно хотите удалить категорию?")) {
		params = { id_cat:n};
		$.ajax({
		type: "POST",
		url: "ajax/delete_cat.php",
		data: params,
		success: function(data){
			alert(data);
			location.reload();
			
		}})
		
	}

	
	
	
}


function tovat_r(){
	
	
document.getElementById('addjax_r').innerHTML = "<img src='tpl/img/load.gif'/>";
//document.getElementById('res12').innerHTML = "";

var form = document.forms.formr;
 
            var formData = new FormData(form); 
			//alert(formData);
 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/adm/ajax/tovat_r.php");
 
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if(xhr.status == 200) {
                        data = xhr.responseText;
                        if(data == "true") {
                            //$(".sending").replaceWith("<p>Принято!<p>");
							//$('#res12').html(data).fadeIn("slow");
							document.getElementById('addjax_r').innerHTML = '<input class="button" onclick="tovat_r()" type="button" value="Применить"/>';
							alert(data);
                        } else {
							//alert("Ошибка!");
                            //$('#res12').html(data).fadeIn("slow");
							document.getElementById('addjax_r').innerHTML = '<input class="button" onclick="tovat_r()" type="button" value="Применить"/>';
							alert(data);
                        }
                    }
                }
            };

            xhr.send(formData);



	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}


