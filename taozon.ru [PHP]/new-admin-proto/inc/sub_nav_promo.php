
<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">

        <? if(preg_match('/^promo\/seo/i', $uri)): ?>
            <li class="active"><a href="promo/seo">Поисковая оптимизация</a></li>
        <? else: ?>
            <li><a href="promo/seo">Поисковая оптимизация</a></li>
        <? endif; ?>

        <? if(preg_match('/^promo\/social/i', $uri)): ?>
            <li class="active"><a href="promo/social">Социальные сети</a></li>
        <? else: ?>
            <li><a href="promo/social">Социальные сети</a></li>
        <? endif; ?>

        <? if(preg_match('/^promo\/referals/i', $uri)): ?>
            <li class="active"><a href="promo/referals">Реферальные программы</a></li>
        <? else: ?>
            <li><a href="promo/referals">Реферальные программы</a></li>
        <? endif; ?>

        <? if(preg_match('/^promo\/mailing/i', $uri)): ?>
            <li class="active"><a href="promo/mailing/list">Рассылки</a></li>
        <? else: ?>
            <li><a href="promo/mailing/list">Рассылки</a></li>
        <? endif; ?>

    </ul>

</div>

