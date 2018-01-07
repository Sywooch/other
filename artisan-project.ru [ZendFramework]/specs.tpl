{if $spec_banners}
<div class="specs">
    <h2>Специальные предложения</h2>
    <div class="block">
        {foreach from=$spec_banners item=ban name=spec}
        <a href="{$ban.url}" title="{$ban.title|htmlspecialchars_decode|strip_tags}"{if $smarty.foreach.spec.iteration%3 == 0} class="right_one"{/if}>
            <img src="{$ban.image|replace:'[dir]':'small'}" alt="{$ban.title|htmlspecialchars_decode|strip_tags}">
        </a>
        {/foreach}
    </div>
</div>
{/if}