<!-- <meta content="text/html; charset=windows-1251" http-equiv="content-type" /> -->
	<div class="atb">
		<div class="atitle"><h1>Восстановить пароль</h1></div>
		<div class="pre-at atext2">
			
		<table class="tableform">
			<tr>
				<td class="label">
					Ваш логин или E-Mail на сайте:
				</td>
				<td><input class="f_input" type="text" name="lostname" /></td>
			</tr>
			[sec_code]<tr>
				<td class="label">
					Введите код<br />с картинки:<span class="impot">*</span>
				</td>
				<td>
					<div>{code}</div>
					<div><input class="f_input" style="width:115px" maxlength="45" name="sec_code" size="14" /></div>
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
		
		<input name="submit" type="submit" class="bbcodes" style="margin:3px 0 0 3px;" value="Отправить" />
			
		</div>
	</div>