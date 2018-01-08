<div class="banners">
    <div class="main_banner" id="main_banner">
        {foreach from=$dealers_top_banners item=ban}
        <a href="{$ban.url}" title="{$ban.title|htmlspecialchars_decode|strip_tags}">
            <img src="{$ban.image|replace:'[dir]':'big'}" alt="{$ban.title|htmlspecialchars_decode|strip_tags}">
            {if $ban.title || $ban.descr}
            <div class="sign">
                <div class="title_outer">
                    <div class="title">{$ban.title|htmlspecialchars_decode}</div>
                </div>
                <div class="descr">{$ban.descr|htmlspecialchars_decode}</div>
            </div>
            {/if}
        </a>
        {/foreach}
    </div>
    {if $top_banners|@count > 1}
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