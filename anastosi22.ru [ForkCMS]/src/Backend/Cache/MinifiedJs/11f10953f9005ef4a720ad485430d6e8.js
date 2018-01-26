
jsBackend.users=
{
	init:function()
{
jsBackend.users.nick()},
	nick:function()
{
$nickname=$('#nickname');
$name=$('#name');
$surname=$('#surname');
		if($nickname.length>0&&$name.length>0&&$surname.length>0)
{
var change=true;
			if($nickname.val()!=jsBackend.users.calculateNick()){change=false;}
			$name.on('keyup',function(){if(change){$nickname.val(jsBackend.users.calculateNick());}});
$surname.on('keyup',function(){if(change){$nickname.val(jsBackend.users.calculateNick());}});
			$nickname.on('keyup',function(){change=false;})}
},
	calculateNick:function()
{
$nickname=$('#nickname');
$name=$('#name');
$surname=$('#surname');
var maxLength=parseInt($nickname.attr('maxlength'));
if(maxLength==0)maxLength=255;
return utils.string.trim(utils.string.trim($name.val())+' '+utils.string.trim($surname.val())).substring(0,maxLength)}
}
$(jsBackend.users.init);