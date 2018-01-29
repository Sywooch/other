<iframe id="myframe" src="http://e-mall.kz/taozon/work.php" align="center" scrolling="no" frameborder="0" marginheight="0" marginwidth="0" width="100%" height='700'></iframe>


<script language="JavaScript">
function init_frame() {
	var href = window.location.href.split('#');
        var2 = document.getElementById('myframe');
        var href1 = href[1];         
	if (href1 && var2.height<1000) {	   
	   var2.src = "http://e-mall.kz/taozon/work.php?"+href1;	
	   var2.height = 7000;
	}
}
init_frame();


function check_anchor() {
	var href = window.location.href.split('#');
        var href1 = href[1];
	var2 = document.getElementById('myframe');
	if (href1 && var2.height<1000) {
		 var2.height = 7000;
	}
}
setInterval('check_anchor();', 1000);


</script>
