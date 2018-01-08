{if $repeated}
    Ваша претензия уже отправлена
{elseif $success}
    Ваша претензия отправлена, скоро её рассмотрят и дадут ответ. <a href="/complaints/archive">Список претензий</a>
{else}
<h3>Отправка претензии</h3>
<!--<div>Уважаемые дилеры!</div><br>-->
<div>Здесь Вы можете оформить и отправить обращение к директору!</div>
<div></div><br>
{form name='add_complaint'}
    <table>
    {foreach from=$forms_elements.add_complaint item=comp}
        <tr>
            <td width="400px" style="vertical-align: top;">{label name=$comp.name}{if $comp.req}<span style="color: red">* {if $errors[$comp.name]}{$errors[$comp.name]}{/if}</span>{/if}</td>
            <td width="800px">{input name=$comp.name}</td>
        </tr>
    {/foreach}
        <tr>
            <td></td>
            <td><input type="submit" value="Отправить претензию"></td>
        </tr>
    </table>
{closeformgroup}
</form>
{/if}
