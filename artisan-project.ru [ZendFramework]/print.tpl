<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>{$meta.title|default:$title}</title>
	<meta name="keywords" content="{$meta.keywords}">
	<meta name="description" content="{$meta.description}">
	<meta name="author" content="{$meta.author}">

<script src="/public/zf/js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript">

				window.print();

		</script>
{literal}
	<style type="text/css">
		html, body {margin:0;font-size:8pt;font-family:Arial, Helvetica, sans-serif;}
		body {padding:.6cm;}
		h1, h2, h3, h4 {font-weight:bold;margin:0;padding:0;}
		h2 {font-size:12pt;text-align:center;}
		h3 {font-size:8pt;}
		table {width:100%;font-family:"Times New Roman", Times, serif;font-size:10pt;border-collapse:collapse;}
		table td {padding:2pt 0;border:none;}
		th {text-align:left;font-weight:bold;font-family:Arial, Helvetica, sans-serif;padding:5pt;}
		table.bill td {padding:2pt 5pt;border:1px solid #000;}
		table.bill th, tr.foot td {border:2px solid #000;}
		.bold-text {font-weight:bold;}
		.first-td {width:3cm;}
		td.number {text-align:right;}
		tr.bordered {border-bottom:1px dashed #000;border-top:1px dashed #000;}
		div {page-break-inside:avoid;}
		.signatures {font-family:"Times New Roman", Times, serif;font-size:11pt;page-break-before:avoid;}
		.signatures tr.small {font-size:8pt;}
		.signatures .mp {text-align:center;vertical-align:middle;width:100pt;}
		.signatures .tabbed {padding-left:20pt;}
		.signatures .underlined {border-bottom:1px solid #000;}
		.ucfirst:first-letter {text-transform:uppercase;}
		p.ucfirst {display:inline-block;margin:0;padding:0;width:auto;}
	</style>
{/literal}

</head>
<body>



	<h2 style="width:100%; text-align:center; ">Зявка №{php} echo $this->_tpl_vars['request']['id']; {/php}</h2>
<br>
<br>
<br>
<!--
	<table>
        <tr>
            <td class="first-td">
            	Поставщик
            </td>
            <td colspan="4" class="bold-text">
				{$supplier.title}
            </td>
        </tr>
        <tr>
            <td>
            	ИНН
            </td>
            <td class="bold-text">
				{$supplier.inn}
            </td>
            <td>
            	КПП
            </td>
            <td colspan="2" class="bold-text">
				{$supplier.kpp}
            </td>
        </tr>
        <tr>
            <td>
            	Адрес
            </td>
            <td colspan="4" class="bold-text">
				{$supplier.legal_address}
            </td>
        </tr>
        <tr>
            <td>
            	Телефон
            </td>
            <td class="bold-text">
				{$supplier.phone}
            </td>
            <td>
            	БИК
            </td>
            <td class="bold-text">
				{$supplier.bik}
            </td>
            <td></td>
        </tr>
        <tr>
            <td>
            	Р/с
            </td>
            <td colspan="4" class="bold-text">
				{$supplier.current_account} в {$supplier.bank}
            </td>
        </tr>
        <tr>
            <td>
            	Кор/счет
            </td>
            <td colspan="3" class="bold-text">
				{$supplier.correspondent_account}
            </td>
            <td class="bold-text">
            	город Москва
            </td>
        </tr>
        <tr class="bordered">
            <td>
            	Отправитель
            </td>
            <td colspan="4" class="bold-text">
				{$supplier.title}
            </td>
        </tr>
    </table>
    <h2>СЧЕТ №{$archive.data.account_number}</h2>
    <table>
        <tr>
            <td class="first-td">
            	Дата
            </td>
            <td colspan="3" class="bold-text">
            	{$archive.data.mdate|date_format:'%e'}
                {if date('m', strtotime($archive.data.mdate)) == 1}
                	Января
                {elseif date('m', strtotime($archive.data.mdate)) == 2}
                	Февраля
                {elseif date('m', strtotime($archive.data.mdate)) == 3}
                	Марта
                {elseif date('m', strtotime($archive.data.mdate)) == 4}
                	Апреля
                {elseif date('m', strtotime($archive.data.mdate)) == 5}
                	Мая
                {elseif date('m', strtotime($archive.data.mdate)) == 6}
                	Июня
                {elseif date('m', strtotime($archive.data.mdate)) == 7}
                	Июля
                {elseif date('m', strtotime($archive.data.mdate)) == 8}
                	Августа
                {elseif date('m', strtotime($archive.data.mdate)) == 9}
                	Сентября
                {elseif date('m', strtotime($archive.data.mdate)) == 10}
                	Октября
                {elseif date('m', strtotime($archive.data.mdate)) == 11}
                	Ноября
                {elseif date('m', strtotime($archive.data.mdate)) == 12}
                	Декабря
                {/if}
            	{$archive.data.mdate|date_format:'%Y'}
            </td>
        </tr>
        <tr class="bordered">
            <td>
            	Плательщик
            </td>
            <td colspan="3" class="bold-text">
            	{if $dealer.legal_entities[$archive.data.legal_entity_id].legal_entity}{$dealer.legal_entities[$archive.data.legal_entity_id].legal_entity},{/if}
				{if $dealer.legal_entities[$archive.data.legal_entity_id].inn}ИНН {$dealer.legal_entities[$archive.data.legal_entity_id].inn},{/if}
				{if $dealer.legal_entities[$archive.data.legal_entity_id].legal_address}{$dealer.legal_entities[$archive.data.legal_entity_id].legal_address},{/if}
				{if $dealer.legal_entities[$archive.data.legal_entity_id].phone}тел. {$dealer.legal_entities[$archive.data.legal_entity_id].phone}{/if}&nbsp;
            </td>
        </tr>
        <tr>
            <td>
            	Р/с
            </td>
            <td colspan="3" class="bold-text">
				{$dealer.legal_entities[$archive.data.legal_entity_id].current_account}
            </td>
        </tr>
        <tr>
            <td>
            	Банк
            </td>
            <td colspan="3" class="bold-text">
				{$dealer.legal_entities[$archive.data.legal_entity_id].bank}
            </td>
        </tr>
        <tr>
            <td>
            	Корр/с
            </td>
            <td class="bold-text">
				{$dealer.legal_entities[$archive.data.legal_entity_id].correspondent_account|default:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'}
            </td>
            <td>
            	БИК
            </td>
            <td class="bold-text">
				{$dealer.legal_entities[$archive.data.legal_entity_id].bik|default:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'}
            </td>
        </tr>
        <tr class="bordered">
            <td>
            	Получатель
            </td>
            <td colspan="3" class="bold-text">
				{if $dealer.legal_entities[$archive.data.legal_entity_id].legal_entity}{$dealer.legal_entities[$archive.data.legal_entity_id].legal_entity},{/if}
				{$dealer.legal_entities[$archive.data.legal_entity_id].actual_address}
            </td>
        </tr>
        <tr>
            <td colspan="4">
            	Дата и способ отправки квит./накл.
            </td>
        </tr>
    </table>
    <span style="float:right;">страница 1</span>
    -->
    <br clear="all">
    
    {if $archive.data.extra_discount}<h2>{$settings.extra_discount_text}</h2>{/if}

    <table class="bill">
        <tr>
            <th>
            	№ п/п
            </th>
            <th>
            	Предмет счета
            </th>
            <th>
            	Ед. Изм.
            </th>
            <th>
            	Размер
            </th>
            <th>
            	Кол-во
            </th>
            <th style="white-space:nowrap;">
            	Цена, руб
            </th>
            <th style="white-space:nowrap;">
            	Сумма, руб
            </th>
        </tr>
        {assign var=total value=0}
        {foreach from=$goods.data item=good key=ajdi}
        <tr>
            <td>
            	{math equation="x+1" x=$ajdi}
            </td>
            <td>
                {if !$request.type}{$good.good_ftitle}{else}{$good.good_title}{/if}
            </td>
            <td>
            	{$good.unit_title}
            </td>
            <td class="number">
            	{$good.good_size}
            </td>
            <td class="number">
                {$good.good_count}
            </td>
            <td class="number">
            	{$good.good_price}
            </td>
            <td class="number">
            	{math equation="x*y" x=$good.good_count y=$good.good_price assign=total_good format='%.2f'}{$total_good}
                {math equation="t+tg" t=$total tg=$total_good assign=total}
            </td>
        </tr>
        {/foreach}
        <!--<tr class="foot">
            <td>
            </td>
            <th colspan="5">
            	НДС в том числе
            </th>
            <td class="number">
            	{math equation="x*18/118" x=$total format="%.2f"}
            </td>
        </tr>-->
        <tr class="foot">
            <td>
            </td>
            <th colspan="5">
            	Итого
            </th>
            <td class="number">
            	{$total}
            </td>
        </tr>
        <tr>
        	<td colspan="7" style="border:none; padding:10pt 0;">
        		Сумма прописью <p class="bold-text ucfirst">{$total|money2str_ru:1}</p>
            </td>
        </tr>
    </table>
    <!--
    Информация для потребителя:
    <ol>
        <li><div>В соответствии со ст.25 Закона «О защите прав потребителей», обмен товара на аналогичный производится в течение 14 дней с даты получения товара, если он не подошёл Покупателю по цвету, фактуре, размеру и комплектации. Обмен осуществляется при условии, что товар не был в употреблении, сохранён его товарный вид, потребительские свойства, заводская упаковка, при наличии счёта-заказа, кассового чека (платежного поручения), накладной и документа, удостоверяющего личность. Обмен плитки, керамогранита, натурального камня, мозаики, осуществляется целыми коробками, бордюров и декоров - поштучно.</div></li>
        <li><div>Товар надлежащего качества, уже поставленный Покупателю, который был оформлен под заказ по индивидуальным требованиям Покупателя, нарезка изделий из плитки и керамогранита - <span style="text-decoration:underline;">обмену и возврату не подлежат</span>.</div></li>
        <li><div>При отказе от Товара надлежащего качества, поставка которого осуществляется по индивидуальному заказу, т.е. Товара, имеющего индивидуально-определенные свойства который ещё не поставлен Покупателю – Продавец удерживает штраф в размере 30% от стоимости заказа.</div></li>
        <li><div>Комплектность и соответствие товара счёту-заказу проверяется Покупателем в момент передачи товара от Продавца к Покупателю. После подписания приёмно-сдаточных документов Покупатель не может предъявлять Продавцу претензии по количеству и комплектности товара.</div></li>
        <li><div>Плитка, керамогранит, натуральный камень, мозаика в разных партиях отличаются по тону и калибру, это обусловлено свойствами материала и технологией производства и не является недостатком товара. Плитка, керамогранит, натуральный камень, мозаика, изготовленные индустриальным способом имеют допуски, технические характеристики, нормативная величина которых указывается в каталогах и иных информационных документах. Трещины и технологические отверстия на тыльной стороне керамических и сантехнических изделий обусловлены технологией производства, не влияют на работоспособность изделия, не являются дефектом и не могут служить основанием для возврата или обмена товара. Сколы на керамической плитке с внутренней стороны не являются дефектом и не могут служить основанием для возврата или обмена товара. Дополнительная информация о товаре предоставляется по требованию Покупателя.</div></li>
        <li><div>Все претензии по керамической плитке и керамограниту принимаются Продавцом до её укладки.</div></li>
        <li><div>Продавец не несёт ответственности за расчет необходимого количества плитки и размеры помещений, предоставленные Покупателем.</div></li>
        <li><div>Для получения товара необходима доверенность или печать получателя для юридических лиц или кассовый чек и доверенность установленной Продавцом формы - для физических лиц.</div></li>
        <li><div>Покупатель может получить товар самовывозом со склада Продавца или заказав и оплатив его доставку. Доставка осуществляется до “подъезда”, разгрузка машины осуществляется силами Покупателя (получателя).</div></li>
        <li><div>Срок действия счёта – три банковских дня с момента выписки.</div></li>
        <li><div>При оплате безналичным расчётом в платёжном поручении ссылка на номер данного счёта обязательна.</div></li>
    </ol>
    <div class="signatures">
    <table class="signatures">
        <tr class="underlined">
            <td style="width:220pt;">
            	Генеральный директор
            </td>
            <td>
            </td>
            <td class="bold-text">
            	{$supplier.director_general}
            </td>
            <td rowspan="4" class="mp bold-text">
            	М.П.
            </td>
        </tr>
        <tr class="small">
            <td>
            </td>
            <td>
            	подпись  
            </td>
            <td class="tabbed">
            	расшифровка подписи
            </td>
        </tr>
        <tr class="underlined">
            <td>
            	Главный бухгалтер
            </td>
            <td>
            </td>
            <td class="bold-text">
            	{$supplier.chief_accountant}
            </td>
        </tr>
        <tr class="small">
            <td>
            </td>
            <td>
            	подпись  
            </td>
            <td class="tabbed">
            	расшифровка подписи
            </td>
        </tr>
    </table>
    </div>-->
</body>
</html>