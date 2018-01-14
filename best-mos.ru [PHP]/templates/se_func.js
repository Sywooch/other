$(document).ready(function(){

function navigationTreeView(elem)
{
//  alert("2");
elem.treeview({
animated: "normal", 
unique: true
});
}


// ---- TREE -----
document.getElementById("ex2").style.display = 'block';
document.getElementById("ex3").style.display = 'block'; 

navigationTreeView($("#navigation"));
navigationTreeView($("#navigation_archive"));
/*
// ---- TREE -----
$("#navigation").treeview({
animated: "normal", 
unique: true
});

// ---- TREE -----
$("#navigation_archive").treeview({
animated: "normal", 
unique: true
});
*/

// ---- TREE -----
document.getElementById("ex2").style.display = '';
document.getElementById("ex3").style.display = ''; 

$("div.tobasket").click(function () {
  $(this).effect("transfer", { to: "div.basket_ico" }, 2000);
});


	
function getGroupItems(opts) {
	jQuery.each(imageList, function(i, val) {
        opts.itemArray.push(val);
    });
}
   
if (document.getElementById('custom'))
{
	$("#custom").fancybox({
	    itemLoadCallback: getGroupItems
	});
}


// назначаем на отправку форму новый обработчик - отправка без перезагрузки страницы
if (document.getElementById('cartform'))
if ($("#cartform"))
{
	$('#cartform').ajaxForm({target:'#basket'});
}




});