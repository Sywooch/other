{if $paging.pages}
<div class="{$paging.css_class|default:'paging'}">


{sliding_pager
	url_append = $paging.url_append 
	separator  = $paging.separator
	curpage    = $paging.curr_page
	baseurl    = "page/"
	pagecount  = $paging.pages
	txt_first  = '<img src="/public/site/img/start.png">'       txt_prev = '<img src="/public/site/img/previous.png">'
	txt_next   = '<img src="/public/site/img/next.png">'        txt_last = '<img src="/public/site/img/finish.png">'
	txt_skip   = $paging.skip        linknum  = $paging.linkcount
}
</div><!--baseurl    = $paging.base_url-->
{/if}