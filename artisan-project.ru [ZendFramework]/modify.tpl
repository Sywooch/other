{if $top_content}
{if $render_top_content}{loadview name=$top_content}{else}{$top_content}{/if}

<br /><br />
{/if}

{if $errors}
{loadview name="page/errors"}
{/if}

{form name='modify'}
{*if $suppl}<div style="text-align: right;">{$suppl}</a></div><br />{/if*}
{if !isset($nobuttons)}
{loadview name="page/buttons"}
<br /><br />
{/if}
<table id="editfields" class="tmp1">


{php}
//echo "<pre>";
//print_r($this->page->forms_elements);
//echo "</pre>";
{/php}



{foreach from=$forms_elements.modify item=element}
<tr{if $element.type eq 'placeholder' && $element.id} id="table_{$element.id}"{if $element.hide} style="display: none;"{/if}{/if}>
<td style="width:25%;" class="tmp5">
    {if $element.req}* {/if}{label name=$element.name}{php}
    if($this->page->element['title']=="Заголовок слайда"){
    	echo "(20 симв.)";
    }else if($this->page->element['title']=="Описание слайда"){
    	echo "(150 симв.)";
    }else if(($this->page->element['title']=="Путь к картинке") && (strpos($_SERVER['REQUEST_URI'], 'modify_main_slider')  != false)){
    	echo "(рекомендуемые размеры: 600X400)";
    }
    {/php}
</td>
<td>
	{php} 
    if(count($this->page->element['values'])>10){ 
    {/php}
	<div style="max-height:300px; overflow:auto; margin-bottom:20px; width:300px;">
    {php}
    }
    {/php}


	{if $actionTitle=="Редактирование слайда" and $element.name=='title'}
    {input name=$element.name style="width:100%" maxlength="20"}
	{else}
    {input name=$element.name}
	{/if}
    
    
    {php} 
    if(count($this->page->element['values'])>10){ 
    {/php}
	</div>
    {php}
    }
    {/php}

</td>
</tr>
{/foreach}

{closeformgroup}
{if $actionTitle=="Редактирование дилера"}
	<tr>
		<td style="width:25%;" class="onion">Скрытые фабрики</td>
		<td><a class="fancybox fancybox.iframe" href="/iframe.php?id={$request.id}">Скрыть</a></td>
	</tr>

{/if}
{if $actionTitle=="Редактирование коллекции"}
	<tr>
		<td style="width:25%;" class="onion">Связные объекты</td>
		<td><a class="fancybox fancybox.iframe" href="/fr_fabrick.php?id={$request.id}">Привязать</a></td>
	</tr>

{/if}
</table>
{$more}

{php}
//получить идентификатор транспорной компании
//$this->page->request['id'];
$tmp = zf::$db->query("SELECT * FROM ad_transport_companies  WHERE id='".$this->page->request['id']."' ");
$days=$tmp[0]['days'];
$days=trim($days);

$days_m=explode(" ",$days);

{/php}



{if $actionTitle=="Редактирование транспортной компании" or $actionTitle=="Добавление транспортной компании"}
<div id="types" style="padding-right: 6px; padding-left:50px; margin-top:-20px; 
margin-left:570px;">

<input id="modify_day_1" type="checkbox" name="types[]" class="zf_radio" value="1" style="width: auto;" 
{php} if(in_array(1,$days_m)){ echo" checked "; } {/php}>
<label for="modify_day_1"> — Понедельник</label><br>

<input id="modify_day_2" type="checkbox" name="types[]" class="zf_radio" value="2" style="width: auto;" 
{php} if(in_array(2,$days_m)){ echo" checked "; } {/php}>
<label for="modify_day_2"> — Вторник</label><br>

<input id="modify_day_3" type="checkbox" name="types[]" class="zf_radio" value="3" style="width: auto;" 
{php} if(in_array(3,$days_m)){ echo" checked "; } {/php}>
<label for="modify_day_3"> — Среда</label><br>

<input id="modify_day_4" type="checkbox" name="types[]" class="zf_radio" value="4" style="width: auto;" 
{php} if(in_array(4,$days_m)){ echo" checked "; } {/php}>
<label for="modify_day_4"> — Четверг</label><br>

<input id="modify_day_5" type="checkbox" name="types[]" class="zf_radio" value="5" style="width: auto;" 
{php} if(in_array(5,$days_m)){ echo" checked "; } {/php}>
<label for="modify_day_5"> — Пятница</label><br>

<input id="modify_day_6" type="checkbox" name="types[]" class="zf_radio" value="6" style="width: auto;" 
{php} if(in_array(6,$days_m)){ echo" checked "; } {/php}>
<label for="modify_day_6"> — Суббота</label><br>

</div>






{/if}





<br /><br />
{loadview name=$buttons_view_name|default:'page/buttons'}
</form>
