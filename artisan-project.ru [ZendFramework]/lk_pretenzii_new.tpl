    <div class="mainPart zeroBox">
        <div class="line claim">
            <h1>Отправка претензии</h1>
            <div class="mainWrap" style="min-height:400px;">
            
            <span style="margin-left:10px; margin-top:10px;">{php}
            if(strpos($this->_tpl_vars['content'],'form')===false){
            	echo ($this->_tpl_vars['content']);
            }
            {/php}</span>


{php}
if(strpos($this->_tpl_vars['content'],'form')!==false){
{/php}

            
            	{form name='add_complaint'}
                
                
                
                {foreach from=$forms_elements.add_complaint item=comp}
                
                <div class="line">
                    <p>{label name=$comp.name}{if $comp.req}<span style="color: red">* {if $errors[$comp.name]}{$errors[$comp.name]}{/if}</span>{/if}</p>
                    {input name=$comp.name}
                </div>
                
                
                {/foreach}
 
            	<input type="submit" value="Отправить претензию">
            {closeformgroup}
            </form>
            
{php}
}
{/php}            
            
<!--            
            
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
            
  -->          
            
            
            
            
            
            </div>
        </div>
    </div>
    
    
    
    
    
    
    
    
    <!--
    
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
{closeformgroup}-->
