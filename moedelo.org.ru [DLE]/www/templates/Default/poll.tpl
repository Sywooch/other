<!-- <meta content="text/html; charset=windows-1251" http-equiv="content-type" /> -->

	<div class="atb">
		<div class="atitle"><h1>{question}</h1></div>
		<div class="pre-at atext2">
		{list}
		
		[voted]<div align="center">����� �������������: {votes}</div>[/voted]
		
		[not-voted]
		<div align="center">
			<input type="submit" onclick="doPoll('vote'); return false;" class="bbcodes" value="����������" >
			<input type="submit" onclick="doPoll('results'); return false;" class="bbcodes" value="����������" >
		</div>
		[/not-voted]
		
		</div>
	</div>