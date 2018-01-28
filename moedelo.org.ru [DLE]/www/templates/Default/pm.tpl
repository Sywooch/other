<!-- <meta content="text/html; charset=windows-1251" http-equiv="content-type" /> -->

	<div class="atb">
		<div class="atitle"><h1>Личные сообщения[newpm]&raquo; отправить[/newpm][pmlist] &raquo; список[/pmlist]</h1></div>
		<div class="pre-at atext2">
			
		<div>[inbox]Входящие сообщения[/inbox] | [outbox]Отправленные сообщения[/outbox] | [new_pm]Отправить сообщение[/new_pm]</div>
			
		<div style="margin-top:12px">[pmlist]{pmlist}[/pmlist]</div>
			
		</div>
	</div>
	
[newpm]
	<div class="atb">
		<div class="atitle"><h1>Новое сообщение</h1></div>
		<div class="pre-at atext2">
	
		<table class="tableform">
			<tr>
				<td class="label">
					Кому:
				</td>
				<td><input type="text" name="name" value="{author}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">
					Тема:<span class="impot">*</span>
				</td>
				<td><input type="text" name="subj" value="{subj}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">
					Сообщение:<span class="impot">*</span>
				</td>
				<td class="editorcomm">
				{editor}<br />
				<div class="checkbox"><input type="checkbox" id="outboxcopy" name="outboxcopy" value="1" /> <label for="outboxcopy">Сохранить сообщение в папке "Отправленные"</label></div>
				</td>
			</tr>
			[sec_code]
			<tr>
				<td class="label">
					Код:<span class="impot">*</span>
				</td>
				<td>
					<div>{sec_code}</div>
					<div><input type="text" name="sec_code" id="sec_code" style="width:115px" class="f_input" /></div>
				</td>
			</tr>
			[/sec_code]
			[recaptcha]
			<tr>
				<td colspan="2"> 
					<div style="padding:6px 0 3px 0"><span class="impot">*</span> Введите два слова, показанных на изображении:</div>
				</td>
			</tr>
			<tr>
				<td colspan="2"> 
					<div class="s-recap">{recaptcha}</div>
				</td>
			</tr>
			[/recaptcha]
		</table>
			
		<input name="add" type="submit" class="bbcodes" value="Отправить" />
		<input name="add" type="button" class="bbcodes" value="Просмотр" onclick="dlePMPreview()" />
		
		</div>
	</div>
[/newpm]

[readpm]
	<div class="atb">
		<div class="atitle"><h1>{subj}</h1></div>
	
		<div class="pre-at"><table width="100%" border="0" cellpadding="7" cellspacing="0" class="atext2">
			<tr>
			  <td valign="top" class="atext2" style="line-height: 15px"><img src="{foto}" border="0" alt="" /><br />
			  {group-icon}<br /></td>
			  <td valign="top" class="atext" style="line-height:15px; padding-left:12px">{text}[signature]<br />
			  <br />
			  --------------------<br /><div class="leftb">{signature}</div>[/signature]</td>
			</tr>
		</table>
			<div style="padding:6px 0px"> </div>
			<div class="leftb">Отправил: <strong>{author}</strong> | {date} | [reply]ответить[/reply] | [del]удалить[/del]</div>
		</div>
	</div>
[/readpm]