{if $through_banners}
<div class="through_banner">
        <a href="{$through_banners.url}" title="{$through_banners.title|htmlspecialchars_decode|strip_tags}">
            <img src="{$through_banners.image|replace:'[dir]':'original'}" alt="{$through_banners.title|htmlspecialchars_decode|strip_tags}">
        </a>
</div>
{/if}