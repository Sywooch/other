<!-- <meta content="text/html; charset=windows-1251" http-equiv="content-type" /> -->
	<div class="atb">
		<div class="atitle"><h1 style="font-size:19px">Задать свой вопрос:</h1></div>
		<div class="pre-at atext2">
		
		<table class="tableform">
			[not-logged]
			<tr>
				<td class="label">
					Ваше имя:<span class="impot">*</span>
				</td>
				<td><input type="text" name="name" id="name" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">
					E-Mail:
				</td>
				<td><input type="text" name="mail" id="mail" class="f_input" /></td>
			</tr>
			[/not-logged]
			<tr>
				<td class="editorcomm" colspan="2">{editor}</td>
			</tr>
			[question]
			<tr>
				<td class="label">
					Вопрос:
				</td>
				<td>
					<div>{question}</div>
				</td>
			</tr>
			<tr>
				<td class="label">
					Ответ:<span class="impot">*</span>
				</td>
				<td>
					<div><input type="text" name="question_answer" id="question_answer" class="f_input" /></div>
				</td>
			</tr>
			[/question]
			[sec_code]
			<tr>
				<td class="label">
					Введите код: <span class="impot">*</span>
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
		
		<input name="submit" type="submit" class="bbcodes" style="margin:3px 0 0 3px;" value="[not-aviable=comments]Добавить[/not-aviable][aviable=comments]Изменить[/aviable]" />
		
		</div>
	</div>