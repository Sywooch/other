<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Квитанция штрафа");
$APPLICATION->SetPageProperty("keywords_inner", "Квитанция штрафа");
$APPLICATION->SetPageProperty("title", "Квитанция штрафа");
$APPLICATION->SetPageProperty("keywords", "Квитанция штрафа");
$APPLICATION->SetTitle("Квитанция штрафа");
?><h1 style="color: #464646; background-color: #ffffff;">Квитанция штрафа</h1>
<div class="content">
<table class="fee form" cellspacing="0" style="width:100%;">
<tbody>
<tr>
<td style="height: 65mm; background-color:transparent; width:100px;" align="center" valign="middle">
<table style="height: 100%;" cellspacing="0">
<tbody>
<tr>
<td class="left" style="vertical-align: top; letter-spacing: 0.2em;">Извещение</td>
</tr>
<tr>
<td class="left" style="vertical-align: bottom;">Кассир</td>
</tr>
</tbody>
</table>
</td>
<td style=" height: 65mm; padding: 0mm 4mm 0mm 3mm; border-left: black 1.5px solid; ">
<table cellspacing="0" align="center" style="width: 123mm; height: 100%">
<tbody>
<tr>
<td>
<table style="width: 100%;" cellspacing="0">
<tbody>
<tr>
<td class="small" style="text-align: right; vertical-align: middle;" colspan="2"><i>Форма № ПД-4сб (налог)</i></td>
</tr>
<tr>
<td class="text" style="text-align: right; width: 43%;">Статус плательщика </td>
<td class="blank" style="width: 7%;"> </td>
</tr></tbody>
</table></td>
</tr><tr><td>
<table cellspacing="0" width="100%"><tbody><tr>
<td class="string" style="width: 71%;">УФК по Ярославской области (УФМС России по Яр. Обл.) </td>
<td width="1%" class="text">  КПП </td><td width="20%" class="blank">760401001</td></tr><tr><td class="subscript">(наименование получателя платежа)</td></tr></tbody></table></td></tr><tr><td><table cellspacing="0" width="100%"><tbody><tr><td width="30%" class="blank">7604083179 </td><td width="2%" class="text"> </td><td width="35%" class="string"> </td><td width="2%" class="text"> </td><td width="31%" class="blank"><select id="okato" style="visibility:visible; top:0px;"><option value="78603000" title="Большесельский м.р.">78603000 Большесельский м.р.</option><option value="78606000" title="Борисоглебский м.р.">78606000 Борисоглебский м.р.</option><option value="78609000" title="Брейтовский м. р.">78609000 Брейтовский м. р.</option><option value="78612000" title="Гаврилов-Ямский м.р.">78612000 Гаврилов-Ямский м.р.</option><option value="78615000" title="Даниловский м.р.">78615000 Даниловский м.р.</option><option value="78618000" title="Любимский м.р.">78618000 Любимский м.р.</option><option value="78621000" title="Мышкинский м.р.">78621000 Мышкинский м.р.</option><option value="78623000" title="Некоузский м.р.">78623000 Некоузский м.р.</option><option value="78626000" title="Некрасовский м.р.">78626000 Некрасовский м.р.</option><option value="78629000" title="Первомайский м.р.">78629000 Первомайский м.р.</option><option value="78634000" title="Пошехонский м.р.">78634000 Пошехонский м.р.</option><option value="78637000" title="Ростовский м.р.">78637000 Ростовский м.р.</option><option value="78643000" title="Тутаевский м.р.">78643000 Тутаевский м.р.</option><option value="78646000" title="Угличский м.р.">78646000 Угличский м.р.</option><option value="78650000" title="Ярославский м.р.">78650000 Ярославский м.р.</option><option value="78701000" title="г. Ярославль">78701000 г. Ярославль</option><option value="78705000" title="г. Переславль-Залесский">78705000 г. Переславль-Залесский</option><option value="78715000" title="г. Рыбинск">78715000 г. Рыбинск</option></select></td></tr><tr><td class="subscript">ИНН налогового органа*</td><td class="subscript"> </td><td class="subscript">и его сокращенное наименование</td><td class="subscript"> </td><td class="subscript">(Код ОКТМО)</td></tr></tbody></table></td></tr><tr><td><table cellspacing="0" width="100%"><tbody><tr><td width="50%" class="blank">40101810700000010010</td><td width="3%" class="text" align="center">в</td><td class="string">ГРКЦ ГУ БР по Яр. обл. г. Ярославль</td></tr><tr><td class="subscript">(номер счета получателя платежа)</td><td class="subscript"> </td><td class="subscript">(наименование банка)</td></tr></tbody></table></td></tr><tr><td><table cellspacing="0" width="100%"><tbody><tr><td class="text">БИК: </td><td width="27%" class="blank">047888001</td><td class="text nowr" align="right"> Кор./сч.: </td><td width="60%" class="blank"> </td></tr></tbody></table></td></tr><tr><td><table cellspacing="0" width="100%"><tbody><tr><td class="string" width="54%"><span id="type">Средства от поступлений денежных взысканий (штрафов) за незаконное осуществление иностранным гражданином или лицом без гражданства трудовой деялельности в Российской Федерации</span><br><select id="fine" style="top:0; visibility:visible;"><option value="6">Ст. 18.10</option><option value="7">Ст. 18.11</option><option value="8">Ст. 18.12</option><option value="9">Ст. 18.15</option><option value="10">Ст. 18.16</option><option value="11">Ст. 18.17</option><option value="4">Ст. 18.8</option><option value="5">Ст. 18.9</option><option value="12">Ст. 19.27</option><option value="2">Ст. 19.3, 19.4, 19.5, 19.6, 19.7, п. 15 ст. 28.3</option><option value="1">Ст. 20.25, ст. 28.3</option><option value="3">ч. 1 ст. 19.15, ч. 2 ст. 19.15, ст. 19.16</option></select></td><td class="text" width="2%"> </td><td width="42%" class="blank" id="kbk">19211643000016000140</td></tr><tr><td class="subscript">(наименование платежа)</td><td class="subscript"> </td><td class="subscript">(код бюджетной классификации КБК)</td></tr></tbody></table></td></tr><tr><td><table cellspacing="0" width="100%"><tbody><tr><td class="text" width="1%">Плательщик (Ф.И.О) </td><td class="string" align="left"><input type="text" id="name" style="width: 90mm"></td></tr></tbody></table></td></tr><tr><td><table cellspacing="0" width="100%"><tbody><tr><td class="text" width="1%">Адрес плательщика: </td><td class="string" align="left"><input type="text" id="address" style="width: 90mm"></td></tr></tbody></table></td></tr><tr><td><table cellspacing="0" width="100%"><tbody><tr><td class="small">ИНН плательщика: </td><td width="36%" class="blank"> </td><td class="small nowr"> № л/с плательщика </td><td width="36%" class="blank"> </td></tr></tbody></table></td></tr><tr><td><table cellspacing="0" width="100%"><tbody><tr><td class="text" width="1%">Сумма: </td><td class="blank" width="20%"><input type="text" id="amount" style="width: 20mm"></td><td class="text" width="1%"> руб. </td><td class="blank" width="8%">00</td><td class="text" width="1%"> коп.</td><td class="text" width="10%"> </td><td class="text" width="1%">Статус: </td><td class="blank" width="10%"> </td><td class="text" width="20%"> </td></tr></tbody></table></td></tr><tr><td><table cellspacing="0" width="100%"><tbody><tr><td class="text" width="24%" style="padding-top: 1mm;"><b>Плательщик (подпись): </b></td><td class="string" width="30%"> </td><td class="text" width="4%">   Дата: </td><td class="blank" width="8%" id="day">27</td><td class="text" width="2%"> </td><td class="string" width="20%" id="month">мая</td><td class="text" width="3%"> 20 </td><td class="blank" width="5%" id="year">14</td><td class="text" width="3%"> г.</td></tr></tbody></table></td></tr><tr><td class="subscript" style="text-align: left;"><i>* или иной государственный орган исполнительной власти</i></td></tr></tbody></table></td></tr></tbody></table><form action="/action/fine.php" method="post" id="receipt"><input type="hidden" name="kbk" value="19211640000016024140"><input type="hidden" name="name" value="123"><input type="hidden" name="address" value="123"><input type="hidden" name="fine" value="Ст. 18.12"><input type="hidden" name="type" value="Средства от поступлений денежных взысканий (штрафов) за нарушение беженцем или вынужденным переселенцем правил пребывания (проживания) в Российской Федерации"><input type="hidden" name="amount" value="123"><input type="hidden" name="okato" value="78603000"><input type="submit" value="Сформировать квитанцию"></form></div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>