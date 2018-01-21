<h1>{$collection.factory_title} <span>{$collection.title}</span> <img src="{$country.flag|replace:'[dir]':'icon'}" alt="{$country.mtitle}" title="{$country.mtitle}"></h1>
<div class="inner_cont">
    <div class="collection_info">
        <div class="banners collection">
            <div class="main_banner" id="main_banner">
                {foreach from=$collection.images item=ban}
                    <a href="{$ban.image|replace:'[dir]':'original'}" rel="lightbox-gallery2" title="{$ban.title|htmlspecialchars_decode|strip_tags}">
                        <img src="{$ban.image|replace:'[dir]':'medium'}" alt="{$ban.title|htmlspecialchars_decode|strip_tags}">
                    </a>
                {/foreach}
            </div>
            {if $collection.images|@count > 1}
            <div class="banner_controls">
                <div id="prev">
                    <img src="/public/site/img/arrow_left.png" alt=""/>
                </div>
                <div id="next">
                    <img src="/public/site/img/arrow_right.png" alt=""/>
                </div>
            </div>
            <div class="tv_pager_outer">
                <div class="tv_pager"> </div>
            </div>
            {/if}
        </div>

        <div id="layout">
            {$layout}
			{if trim($collection.svyaz) != ''}{$collection.svyaz}{/if}
			{if $act_type != 'sale'}<span class="adds">* Рекомендованная розничная цена без учета «СКИДКА ДНЯ»</span>{/if}
        </div>
		
        {if trim(strip_tags($collection.descr)) != ''}
            <div id="layout_descr">
                <h2>Подробнее о коллекции</h2>
                <p>{$collection.descr}</p>
            </div>
        {/if}
    </div>
</div>