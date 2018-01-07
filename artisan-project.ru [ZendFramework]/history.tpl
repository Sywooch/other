<h1>Личный кабинет</h1>
<div style="padding-top: 20px; color: red; text-align: center;">
    Уважаемые дилеры!<br>Обращаем ваше внимание, что с 01.09.2012г. у нас намечена переоценка группы товаров фабрик Aparici и Venis.
</div>
<div class="inner_cont personal">
{loadview name=profile/menu}
    <div class="personal_table">
    {if $communication}
        <h3>История переписки{if $complaint_title.title}: {$complaint_title.title}{/if}</h3>
        <div>
            {foreach from=$communication item=comm name=communication}
                <div>
                    {if $comm.is_answer == 'no'}
                        Вопрос
                        {elseif $comm.is_answer == 'yes'}
                        Ответ
                    {/if}
                    {if $comm.commdate}({$comm.commdate|date_format:'%d.%m.%Y %H:%M'}){/if}
                </div>
                <div style="padding-left: 200px;">
                    {$comm.text|nl2br}
                </div>
                <div style="padding-left: 200px;"> {*{if !$smarty.foreach.communication.last} padding-bottom: 10px; border-bottom: 1px solid #47BDD4;{/if}*}
                    <!--{if $comm.file}</br>Прикрепленный файл: <a href="http://{$site_name}/complaints/download?file_name={$comm.file}">{$comm.file_name}</a>{/if}  -->
                    {if $comm.files}Прикрепленные файлы:{/if}
                    {foreach from=$comm.files item=file name=files}
                         <br/><a href="http://{$site_name}/complaints/download?file_name={$file.file}">{$file.file_name}</a>
                    {/foreach}
                </div>
                {if !$smarty.foreach.communication.last}
                <div style="padding-left: 200px;{if !$smarty.foreach.communication.last} padding-bottom: 15px; border-bottom: 1px solid #47BDD4;{/if}"></div>
                <div style="padding-left: 200px;{if !$smarty.foreach.communication.last} padding-top: 15px;{/if}"></div>
                {/if}
            {/foreach}
        </div>
    {else}
    В данной переписке нет ни одного сообщения
    {/if}
    </br>

    <div class="blue_frame">
        <h3>Добавление вопроса</h3>
    {form name='add_communication'}
        <table>
        {foreach from=$forms_elements.add_communication item=comm}
            <tr>
                <td width="240px" style="vertical-align: top;">{label name=$comm.name}{if $comm.req}<span style="color: red">* {if $errors[$comm.name]}{$errors[$comm.name]}{/if}</span>{/if}</td>
                <td width="600px">{input name=$comm.name}</td>
            </tr>
        {/foreach}
            <tr>
                <td></td>
                <td><input type="submit" value="Добавить сообщение"></td>
            </tr>
        </table>
    {closeformgroup}
        </form>
    </div>
</div>
</div>