<?
#
#  ������ docs
#


# ����������� ����� � ����� ����� ������
$docs_form['form_fields'] = <<<EOF
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_naznach">�� ������ �������� ������?</span> </td>
		<td width="5">&nbsp;</td>
		<td>			
			<select id="naznach" name="naznach" style="width:300px;">
				<option value=""></option>
				{catalog_list}
			</select>
		</td>
</tr>
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_predoplata">�����, ����� (��� ������):</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="predoplata" name="predoplata" value=""></td></tr>
		
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right">��� �������: </td>
		<td width="5">&nbsp;</td>
		<td>
			<input type=radio name="type" value="pochta" checked>������ ������ ������<br>
			<input type=radio name="type" value="bank">������ ����� ����
		</td>
</tr>
<tr>
		<td colspan=3><br><i>��� ���� ����������� ��� ����������</i><br><input type="button" value="�������� �������" onClick="onFormOrderSubmit()"></td>
</tr>
</table>
EOF;


?>
