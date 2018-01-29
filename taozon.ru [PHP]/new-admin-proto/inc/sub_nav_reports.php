
<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">

        <? if(preg_match('/^reports\/service-stat/i', $uri)): ?>
            <li class="active"><a href="reports/service-stat">Сервисная статистика</a></li>
        <? else: ?>
            <li><a href="reports/service-stat">Сервисная статистика</a></li>
        <? endif; ?>

        <? if(preg_match('/^reports\/billing/i', $uri)): ?>
            <li class="active"><a href="reports/billing">Биллинг</a></li>
        <? else: ?>
            <li><a href="reports/billing">Биллинг</a></li>
        <? endif; ?>

    </ul>

</div><!-- /ot-sub-nav -->




