{$result}
{if $error}
<div class="error">{$error}</div>
{/if}
{if !empty($process.data) and empty($result)}
<table class="process_table">

{foreach from=$process.fields key=fn item=fd name=process}
{if !(
		in_array($fn, array('payment_method_id', 'payment_method_title', 'doc_number', 'doc_date'))
		and ( empty($process.data.$fn) or $process.data.$fn == '0000-00-00' )
)}
	<tr{if $smarty.foreach.process.iteration%2==0} style='background-color:#dadada;'{/if}>
		<th align="left">
	{if !in_array($fn, array('good_id', 'status', 'unit_title', 'legal_entity_id'))}
			{$fd.title}
	{/if}
		</th>
		<td>
	{if $fd.type == 'datetime'}
		{if $process.data.$fn == '0000-00-00 00:00:00'}
			—
		{else}
			{$process.data.$fn|date_format:'%d.%m.%Y %H:%M'}
		{/if}
	{elseif $fn == 'cid'}
		{if !empty($corrs)}
			{foreach item=cor key=cor_id from=$corrs name=cors}
			    <a href="{$root_url}{$ctrlName}/show/id/{$cor.id}/"
			    	target="_blank"
			    	{if $cor.status == 'processed'}style="color: red;"{/if}
			    	title="{$process.fields.status.values[$cor.status]}"
			    >#{$cor.id}</a>
				{if !$smarty.foreach.cors.last}→{/if}
			{/foreach}
		{else}
			—
		{/if}
	{elseif in_array($fn, array('good_id', 'unit_title', 'legal_entity_id'))}
	{elseif $fd.type == 'date'}
		{if $process.data.$fn == '0000-00-00'}
			—
		{else}
			{$process.data.$fn|date_format:'%d.%m.%Y'}
		{/if}
	{elseif !empty($fd.values)}
		{assign value=$process.data.$fn var=t}
		{$fd.values.$t}
	{elseif in_array($fn, array('goods_weight'))}
		{$process.data.$fn|round:2}
    {elseif $fn == 'status_title_operator'}
        {$process.data.status_title_operator}
	{elseif $fn == 'goods_sum'}
		{if $dealers_categories[$process.data.dealer_category_id].have_discount == 'yes'}
    		{assign var=summ value=0}
			{foreach from=$goods.data item=dd}
			{if $dd.good_non_liquid}
				{assign var=non_liquid value=1}
			{/if}
    		{math equation = 's+round(y*round(x*((100-d)/100),2),2)' s=$summ x=$dd.good_price y=$dd.good_count d=$process.data.discount assign=summ format='%.2f'}
			{/foreach}
            {$summ}
        {else}
			{$process.data.$fn|round:2}
        {/if}
	{elseif $process.data.$fn == ''}
			—
	{else}
			{$process.data.$fn}
	{/if}
		</td>
	</tr>
{/if}
{/foreach}
	<tr>
		<td colspan="2" {if ($smarty.foreach.process.iteration+1)%2==0} style='background-color:#dadada;'{/if}>
{foreach from=$goods.data item=dd2}
	{if $dd2.good_non_liquid}
		{assign var=non_liquid value=1}
	{/if}
{/foreach}
{if $non_liquid}
			В заказе имеется товар, который в распродаже.<br>
			На количество из складского остатка гарантирована указанная цена.<br>
			При поставке на заказ — цена расчетная.<br><br>
{/if}
		</td>
	</tr>
	<tr align="left">
		<th colspan="2">Позиции:</th>
	</tr>
	
	<tr>
		<td colspan="2">
			<table>
				<tr>
{foreach from=$goods.fields key=fn item=fd}
					<th>{if in_array($fn, array('good_id', 'unit_title'))}{else}{$fd.title}{/if}</th>
{/foreach}
				</tr>
{foreach from=$goods.data item=d}
				<tr>
	{foreach from=$goods.fields key=fn item=fd}
					<td>
		{if $fn == 'good_count'}
						<span class="{if ($d.remains[1].stock - $d.good_count) >=0 }yes{elseif ($d.total_count - $d.good_count) >=0 }road{else}no{/if}">{$d.$fn|round:4} {$d.unit_title}</span>
		{elseif $fn == 'good_price'}
			{if $dealers_categories[$process.data.dealer_category_id].have_discount == 'yes'}
						{math equation = 'x-x*(y/100)' x = $d.$fn|default:0 y = $process.data.discount format='%.2f'}
			{else}
						{$d.$fn|round:2}
			{/if}
		{elseif $fn == 'good_non_liquid'}
			{if $d.$fn}
				{assign var=non_liquid value=1}
				<img src="/public/site/img/nlqd.png" alt="Товар в распродаже" title="Товар в распродаже">
			{else}
				—
			{/if}
		{elseif  empty($d.$fn)}
			—
		{elseif in_array($fn, array('good_id', 'unit_title', 'legal_entity_id'))}
		{elseif $fn == 'remains'}
			{foreach item=r from=$d.$fn}
					    <span class="stock">{$r.stock|default:'—'}</span>/<span class="reserve">{$r.reserve|default:'—'}</span>
					    <span class="delivery_date">{if $r.delivery_date != '0000-00-00'}({$r.delivery_date}){/if}</span>
					</td><td>
			{/foreach}
		{else}
						{$d.$fn}
		{/if}</td>
	{/foreach}
				</tr>
{/foreach}
			</table>
		</td>
	</tr>
</table>
<div id="process-form">
<form action="" method="post">
	<div id="account_number_div">
        {if $process.data.status != 'declined'}
		<label for="account_number">Номер счета:</label>
		<input type="text" name="account_number" class="text" id="account_number">
        {/if}
	</div>
	<div style="margin: 10px 0px;"><a href="{$root_url}{$ctrlName}/process2db/id/{$process.data.id}/" class="button process2db" >Передать в Базу Данных</a></div>
	<label for="comments_operator">Комментарий:</label>
	<textarea name="comments_operator" class="text" id="comments_operator" cols="40" rows="7"></textarea><br><br>
    {if $process.data.status == 'declined'}
    <input type="submit" name="processed_decl" value="Обработать" class="button">
    {else}
    <input type="hidden" name="zakaz" id="zakaz" value="{php} if($this->_tpl_vars['process']['data']['rtype']=='reservation'){ echo '1'; }else{ echo '0'; } {/php}"/>
	<input type="submit" name="processed" value="Обработать" class="button">
	<input type="submit" name="rejected" value="Отклонить" class="button">
    {/if}
</form>
</div>
{elseif empty($result)}
	Заявка не найдена.
{/if}