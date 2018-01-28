<!-- <meta content="text/html; charset=windows-1251" http-equiv="content-type" /> -->

		<div class="leftb-sh"><b>{title}</b></div>
		<div class="leftb">
		
			[votelist]<form method="post" name="vote" action=''>[/votelist]
			{list}
			
			[voteresult]<div><small>Всего проголосовало: {votes}</small></div>[/voteresult]

			[votelist]
				<input type="hidden" name="vote_action" value="vote" />
				<input type="hidden" name="vote_id" id="vote_id" value="{vote_id}" />
				<input class="at-but2" type="image" onclick="doVote('vote'); return false;" alt="ГОЛОСОВАТЬ" title="Голосовать" src="{THEME}/images/vote.gif" style="margin-top:9px;" >&nbsp;<input class="at-but" type="image" onclick="doVote('results'); return false;" alt="РЕЗУЛЬТАТЫ" title="Результаты" src="{THEME}/images/result.gif" style="margin-left:2px; margin-top:9px;">
			</form>
			[/votelist]
		
		</div>