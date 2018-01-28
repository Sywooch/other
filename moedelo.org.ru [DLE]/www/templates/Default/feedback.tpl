<!-- <meta content="text/html; charset=windows-1251" http-equiv="content-type" /> -->
	<div class="atb">
		<div class="atitle"><h1>Обратная связь</h1></div>
		<div class="pre-at atext2">
			
		<table class="tableform">
		[not-logged]
			<tr>
				<td class="label">
					Ваше имя:<span class="impot">*</span>
				</td>
				<td><input type="text" maxlength="35" name="name" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">
					Ваш E-Mail:<span class="impot">*</span>
				</td>
				<td><input type="text" maxlength="35" name="email" class="f_input" /></td>
			</tr>
		[/not-logged]
			<tr>
				<td class="label" style="display:none">
					Кому:<span class="impot">*</span>
				</td>
				<td style="display:none">{recipient}</td>
			</tr>
			<tr>
				<td class="label">
					Тема:<span class="impot">*</span>
				</td>
				<td><input type="text" maxlength="45" name="subject" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">
					Сообщение:
				</td>
				<td><textarea name="message" style="width: 350px; height: 160px" class="f_textarea" /></textarea></td>
			</tr>
			[sec_code]<tr>
				<td class="label">
					Введите код:<span class="impot">*</span>
				</td>
				<td>
					<div>{code}</div>
					<div><input type="text" maxlength="45" name="sec_code" style="width:115px" class="f_input" /></div>
				</td>
			</tr>[/sec_code]
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
		
		<input name="send_btn" type="submit" class="bbcodes" style="margin:3px 0 0 3px;" value="Отправить" />
			
		</div>
	</div>