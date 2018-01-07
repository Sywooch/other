{php}
if($this->page->content22!=""){
echo "<div class='mainPart zeroBox'><div class='inner_content_box'>";
{/php}
{if strpos($smarty.server.REQUEST_URI, 'requests/prise')  != false }
<div style="min-height:400px;">
{/if}

{if strpos($smarty.server.REQUEST_URI, 'requests/prise')  != false }
{php}
if(($this->page->content22['title'] != "") && isset($this->page->content22['title'])){

echo "<h1>".$this->page->content22['title']."  </h1><br>";

}else{
echo "<h1>Прайс-лист</h1><br>";

}
if($this->page->price_list[file]==""){
echo"<h1 class='price_list'><span style='font-size:25px;'>Прайс-лист не назначен</span></h1>";
}else{


echo "<h1 class='price_list'><a href='".$this->page->price_list[file]."' class='pdf_link'><i>Прайс-лист</i> от <span>".$this->page->price_list['date_price']."</span></a></h1><br>";
}
{/php}


{else}
{php}
echo "<h1>".$this->page->content22['title']."</h1><br>";
{/php}
{/if}

{php}
echo $this->page->content22['content'];

{/php}
{if strpos($smarty.server.REQUEST_URI, 'requests/prise')  != false }
{php}
echo "<br><h1 class='price_list'><a href='".$this->page->info_last[file]."' class='pdf_link'><i>Информация по последней переоценке</i></a></h1><br>";
{/php}
</div>
{/if}
{php}

echo "</div></div>";
}else{
{/php}
{$content}
{php}
}
{/php}