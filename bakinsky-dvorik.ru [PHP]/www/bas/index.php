<?php
 $catalog='bas';
if(!file_exists("$catalog/admin/admin1.php"))exit("Не надо этот файл открывать!");

?>
<div id="st"><img src=<?php echo $catalog ?>/admin/img/bas.png border=0 alt="bas" align=middle>Корзина<br>пуста</div>
<script type="text/javascript" src="/bas/jquery.cookie.js"></script>
<script type="text/javascript">

$(document).ready(function(){	
	var basketString = $.cookie('bas');

	if (typeof(basketString) != "undefined" && basketString !== null) {
		var basketArray = basketString.split('|');
		var basketCount = basketArray.length;
	}
	
	if (basketCount > 0) {
		$('#st').html("<img src=<?php echo $catalog ?>/admin/img/bas.png alt=корзина border=0 align=middle>&nbsp;<a href=javascript:win();>Товаров<br>в корзине "+basketCount+"</a>");
	}
});

function rel() {
	if (navigator.appName=='Microsoft Internet Explorer' || navigator.appName=='Opera') {
		window.history.go(0);
	} else {
		window.location.reload();
	}
}

function win() {
	window.open('/<?php echo $catalog ?>/form.php?op=1','','width=750,height=450,status=no,toolbar=no,menubar=no,scrollbars=yes')
}

function c(id) {
	var basketString = $.cookie('bas');

	if (typeof(basketString) != "undefined" && basketString !== null) {
		var basketArray = basketString.split('|');
		var basketCount = basketArray.length;
	}
	
	if (basketCount > 0) {
		basketString = basketString + '|' + id;
		basketArray = basketString.split('|');
		basketCount = basketArray.length;
		$.cookie('bas', basketString, { expires: 1, path: '/' });		
		$('#st').html("<img src=/<?php echo $catalog ?>/admin/img/bas.png alt=корзина border=0 align=middle>&nbsp;<a href=javascript:win();>Товаров<br>в корзине "+basketCount+"</a>");
	} else {
		basketString = id;
		$.cookie('bas', basketString, { expires: 1, path: '/' });
		$('#st').html("<img src=/<?php echo $catalog ?>/admin/img/bas.png alt=корзина border=0 align=middle>&nbsp;<a href=javascript:win();>Товаров<br>в корзине 1</a>");
	}
}

</script>