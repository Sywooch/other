
<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">

        <? if(preg_match('/^pricing\/currency/i', $uri)): ?>
            <li class="active"><a href="pricing/currency">Валюта</a></li>
        <? else: ?>
            <li><a href="pricing/currency">Валюта</a></li>
        <? endif; ?>

        <? if(preg_match('/^pricing\/cost/i', $uri)): ?>
            <li class="active"><a href="pricing/cost">Стоимость</a></li>
        <? else: ?>
            <li><a href="pricing/cost">Стоимость</a></li>
        <? endif; ?>

        <? if(preg_match('/^pricing\/discount/i', $uri)): ?>
            <li class="active"><a href="pricing/discount">Скидки</a></li>
        <? else: ?>
            <li><a href="pricing/discount">Скидки</a></li>
        <? endif; ?>

        <? if(preg_match('/^pricing\/banker/i', $uri)): ?>
            <li class="active"><a href="pricing/banker">Модуль «Банкир»</a></li>
        <? else: ?>
            <li><a href="pricing/banker">Модуль «Банкир»</a></li>
        <? endif; ?>


    </ul>

</div><!-- /ot-sub-nav -->




