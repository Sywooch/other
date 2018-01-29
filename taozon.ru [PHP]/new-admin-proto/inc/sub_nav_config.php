
<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">

        <? if(preg_match('/^config\/build/i', $uri)): ?>
            <li class="active"><a href="config/build">Конструкция сайта</a></li>
        <? else: ?>
            <li><a href="config/build">Конструкция сайта</a></li>
        <? endif; ?>

        <? if(preg_match('/^config\/orders/i', $uri)): ?>
            <li class="active"><a href="config/orders/general">Заказы</a></li>
        <? else: ?>
            <li><a href="config/orders/general">Заказы</a></li>
        <? endif; ?>

        <? if(preg_match('/^config\/delivery/i', $uri)): ?>
            <li class="active"><a href="config/delivery/internal">Доставка</a></li>
        <? else: ?>
            <li><a href="config/delivery/internal">Доставка</a></li>
        <? endif; ?>

        <? if(preg_match('/^config\/lang/i', $uri)): ?>
            <li class="active"><a href="config/lang/multi">Языки</a></li>
        <? else: ?>
            <li><a href="config/lang/multi">Языки</a></li>
        <? endif; ?>

        <? if(preg_match('/^config\/system/i', $uri)): ?>
            <li class="active"><a href="config/system/general">Система</a></li>
        <? else: ?>
            <li><a href="config/system/general">Система</a></li>
        <? endif; ?>

    </ul>

</div><!-- /ot-sub-nav -->




