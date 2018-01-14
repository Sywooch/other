<?
#
#  модуль docs
#


# недостающая часть к форме ввода данных
$docs_form['form_fields'] = <<<EOF
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_naznach">По какому каталогу оплата?</span> </td>
		<td width="5">&nbsp;</td>
		<td>			
			<select id="naznach" name="naznach" style="width:300px;">
				<option value=""></option>
				{catalog_list}
			</select>
		</td>
</tr>
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_predoplata">Сумма, рубли (без копеек):</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="predoplata" name="predoplata" value=""></td></tr>
		
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right">Тип платёжки: </td>
		<td width="5">&nbsp;</td>
		<td>
			<input type=radio name="type" value="pochta" checked>Оплата почтой России<br>
			<input type=radio name="type" value="bank">Оплата через банк
		</td>
</tr>
<tr>
		<td colspan=3><br><i>Все поля обязательны для заполнения</i><br><input type="button" value="Получить платёжку" onClick="onFormOrderSubmit()"></td>
</tr>
</table>
EOF;


?>
