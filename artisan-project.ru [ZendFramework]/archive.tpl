<h1>Личный кабинет</h1>
<div style="padding-top: 20px; color: red; text-align: center;">
<br>

</div>
<div class="inner_cont personal">
{loadview name=profile/menu}
    <div class="personal_table">
        {if $complaints}
            <div>Уважаемые дилеры!</div><br>
            <div>Пожалуйста, отправьте претензию директору!</div>
            <div></div><br>
        <table>
        <tr style="border-bottom:2px solid #47BDD4;">
            <td style="width:50px;">Номер претензии</td>
            <td style="width:50px;">Заголовок</td>
            <td style="width:100px;">Причина</td>
            <td style="width:40px;">Статус ответа</td>
            <td style="width:15px;"></td>
            <td style="width:50px;">Дата последнего ответа</td>
        </tr>
            {foreach from=$complaints item=comp name=complaints}
                <tr>
                    <td>{$comp.id}</td>
                    <td><a href="/complaints/history/id/{$comp.id}">{$comp.title}</a></td>
                    <td>{$comp.reason}</td>
                    <td>{if $comp.status == 'new'}<span style="color: red;">непрочтённая{elseif $comp.status == 'not_answered'}<span style="color: blue;">прочтённая, но не отвеченная{elseif $comp.status == 'answered'}<span style="color: green;">отвеченная{/if}</span></td>
                    <td style="text-align: left;"><a href="/complaints/history/id/{$comp.id}">{if $comp.status_view == 'readed'}<img src="/public/site/img/mail_open.png">{elseif $comp.status_view == 'not_readed'}<img src="/public/site/img/mail.png">{/if}</a></td>
                    <td>{$comp.last_answ_date|date_format:'%d.%m.%Y %H:%M'}</td>
                </tr>
            {/foreach}
        </table>
        {/if}
</div>
</div>