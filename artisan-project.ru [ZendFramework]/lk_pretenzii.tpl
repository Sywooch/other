 <link rel="stylesheet" href="/public/site1/lk/styles/pretenzii.css">
 <div class="mainPart zeroBox">
        <h1>Архив писем</h1>
        <div class="mainWrap">
            <ul>
            
            	{foreach from=$complaints item=comp name=complaints}
                <li><!--{$comp.status}={$comp.status_view}-->
                    <a href="/complaints/history/id/{$comp.id}">Претензия № {$comp.id} <span class="status" style="color:#3c3f45;">{$comp.compldate|date_format:'%Y-%m-%d'}</span>  <span class="status 
                    {if $comp.status == 'closed'}closed{elseif $comp.status == 'answered'}answered{elseif $comp.status_view == 'not_readed' or $comp.status == 'not_answered' or $comp.status == 'new'}new{/if}">{if $comp.status == 'closed'}завершённая{elseif $comp.status == 'answered'}отвеченная{elseif $comp.status_view == 'not_readed' or $comp.status == 'not_answered' or $comp.status == 'new'}новая{/if}</span></a>
                </li>
                {/foreach}
                
                <!--
                <li>
                    <a href="/profile/pretenzii/id">Претензия № 1808 <span class="status answered">отвеченная</span></a>
                </li>
                <li>
                    <a href="/profile/pretenzii/id">Претензия № 1808 <span class="status answered">отвеченная</span></a>
                </li>
                <li>
                    <a href="/profile/pretenzii/id">Претензия № 1808 <span class="status answered">отвеченная</span></a>
                </li>
                <li>
                    <a href="/profile/pretenzii/id">Претензия № 4553 <span class="status closed">завершонная</span></a> 
                </li>-->
                
            </ul>
        </div>
    </div>