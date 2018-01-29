
<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">

        <? if(preg_match('/^support\/orders/i', $uri)): ?>
            <li class="active"><a href="support/orders">По заказам</a></li>
        <? else: ?>
            <li><a href="support/orders">По заказам</a></li>
        <? endif; ?>

        <? if(preg_match('/^support\/general/i', $uri)): ?>
            <li class="active"><a href="support/general">Общие вопросы</a></li>
        <? else: ?>
            <li><a href="support/general">Общие вопросы</a></li>
        <? endif; ?>

    </ul>

</div><!-- /ot-sub-nav -->




