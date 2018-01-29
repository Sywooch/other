
<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">

        <? if(preg_match('/^users\/customers/i', $uri)): ?>
            <li class="active"><a href="users/customers">Покупатели</a></li>
        <? else: ?>
            <li><a href="users/customers">Покупатели</a></li>
        <? endif; ?>

        <? if(preg_match('/^users\/administrators/i', $uri)): ?>
            <li class="active"><a href="users/administrators">Администраторы</a></li>
        <? else: ?>
            <li><a href="users/administrators">Администраторы</a></li>
        <? endif; ?>

        <? if(preg_match('/^users\/roles/i', $uri)): ?>
            <li class="active"><a href="users/roles">Роли</a></li>
        <? else: ?>
            <li><a href="users/roles">Роли</a></li>
        <? endif; ?>

    </ul>

</div><!-- /ot-sub-nav -->




