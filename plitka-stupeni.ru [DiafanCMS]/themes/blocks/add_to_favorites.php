<div class="favorite-block">
<img src="/img/favorites-icon.png" />
<a  href="javascript:void(0)" title="ПЛИТКА & СТУПЕНИ" onclick="
var url=window.document.location;
var title=window.document.title;
function bookmark(a) {
a.href = url;
a.rel = 'sidebar';
a.title = title;
if(window.chrome){
	alert('Нажмите CTRL+D для добавления страницы в Избранное');
	return false;
}
return true;
}
bookmark(this);
window.external.AddFavorite(location.href,document.title); return false;" 
rel="sidebar">Добавить в избранное</a>
</div>