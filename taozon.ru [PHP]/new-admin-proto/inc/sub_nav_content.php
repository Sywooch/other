
<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">

        <? if(preg_match('/^content\/pages/i', $uri)): ?>
            <li class="active"><a href="content/pages">Страницы</a></li>
        <? else: ?>
            <li><a href="content/pages">Страницы</a></li>
        <? endif; ?>

        <? if(preg_match('/^content\/nav/i', $uri)): ?>
            <li class="active"><a href="content/nav">Навигация</a></li>
        <? else: ?>
            <li><a href="content/nav">Навигация</a></li>
        <? endif; ?>

        <? if(preg_match('/^content\/news/i', $uri)): ?>
            <li class="active"><a href="content/news">Новости</a></li>
        <? else: ?>
            <li><a href="content/news">Новости</a></li>
        <? endif; ?>

        <? if(preg_match('/^content\/banners/i', $uri)): ?>
            <li class="active"><a href="content/banners">Баннеры</a></li>
        <? else: ?>
            <li><a href="content/banners">Баннеры</a></li>
        <? endif; ?>

    </ul>

</div><!-- /ot-sub-nav -->




