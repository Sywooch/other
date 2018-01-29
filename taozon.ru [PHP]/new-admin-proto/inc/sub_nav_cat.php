
<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">

        <? if(preg_match('/^cat\/categories/i', $uri)): ?>
            <li class="active"><a href="cat/categories">Категории</a></li>
        <? else: ?>
            <li><a href="cat/categories">Категории</a></li>
        <? endif; ?>

        <? if(preg_match('/^cat\/selections/i', $uri)): ?>
            <li class="active"><a href="cat/selections/brands">Подборки</a></li>
        <? else: ?>
            <li><a href="cat/selections/brands">Подборки</a></li>
        <? endif; ?>

        <? if(preg_match('/^cat\/reviews/i', $uri)): ?>
            <li class="active"><a href="cat/reviews">Отзывы о товарах</a></li>
        <? else: ?>
            <li><a href="cat/reviews">Отзывы о товарах</a></li>
        <? endif; ?>

        <? if(preg_match('/^cat\/brands/i', $uri)): ?>
            <li class="active"><a href="cat/brands">Бренды</a></li>
        <? else: ?>
            <li><a href="cat/brands">Бренды</a></li>
        <? endif; ?>

        <? if(preg_match('/^cat\/restrictions/i', $uri)): ?>
            <li class="active"><a href="cat/restrictions/goods">Ограничения</a></li>
        <? else: ?>
            <li><a href="cat/restrictions/goods">Ограничения</a></li>
        <? endif; ?>

        <? if(preg_match('/^cat\/settle/i', $uri)): ?>
            <li class="active"><a href="cat/settle">Пристрой</a></li>
        <? else: ?>
            <li><a href="cat/settle">Пристрой</a></li>
        <? endif; ?>

        <? if(preg_match('/^cat\/warehouse/i', $uri)): ?>
            <li class="active"><a href="cat/warehouse/categories">Товары на складе</a></li>
        <? else: ?>
            <li><a href="cat/warehouse/categories">Товары на складе</a></li>
        <? endif; ?>

    </ul>

</div>

