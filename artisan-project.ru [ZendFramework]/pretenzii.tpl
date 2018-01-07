<div id="message" style="display: none; text-align: center;">
	<div class="dssfas"></div>
</div>
<h2>Претензии</h2>
{php}
if(isset($_GET['message'])){

echo'<h3>'.$_GET['message'].'</h3>';

}
{/php}
<div class="personal_table checking">
{if count($archive)>0}
<table>
<tr style="border-bottom:1px solid #142f66;">
<th>ID<th>
	<th>Дата поступления претензии<th>
	<th>Дилер<th>
	<th>Причина обращения<th>
	<th>Заголовок<th>
	
	<th>Статус ответа<th>
	<th><th>
</tr>
<!--/processing/requests/show/id/{$fd.requet_id}/-->
{foreach from=$archive item=fd key=fn}
<tr>
<td><span style="cursor:pointer;" onClick="show_modal({$fd.id})">#{$fd.id}</span><td>
	<td>{$fd.compldate}<td>
	<td>{$fd.dealer}<td>
	<td>{$fd.reason}<td>
	<td>{$fd.title}<td>
	
	<td>{$fd.status}<td>
	<td><div class="messasxe" idsd="{$fd.id}"  onClick="show_modal({$fd.id})"></div><td>
</tr>




{/foreach}
</table>


<div class="modal modal_pretenzii simplemodal-container content personal_table" id="modal_pretenzii" style="display:none;">
<a class="modalCloseImg simplemodal-close" title="Close">X</a>
<div tabindex="-1" class="simplemodal-wrap" style="height: 100%; outline: 0px; width: 100%; overflow: visible;"><div id="message" style="text-align: center;" class="simplemodal-data">
	<div class="dssfas">
    
    
    </div>
    
    
    <!--form-->
    <div class="rc10" style="margin-bottom:20px;">
    <h3>Добавление ответа</h3>
    <form accept-charset="utf-8" enctype="multipart/form-data" name="add_communication" action="/processing/" id="add_communication_form" method="post" target="">
        <table>
                    <tbody><tr>
                <td width="240px" style="vertical-align: top;"><label for="add_communication_text">Текст</label><br><span style="color: red">* </span></td>
                <td width="800px" style="text-align:left;"><div class="input" style="padding-right: 6px;"><textarea name="text" id="add_communication_text" style="width: 500px; height: 100px;"></textarea></div><br></td>
            </tr>
                    <tr>
                <td width="240px" style="vertical-align: top;"><label for="add_communication_files">Файлы</label><br></td>
                <td width="800px" style="text-align:left;"><div class="input" style="padding-right: 6px;"><input class="fileStyle show" type="file" name="files[]" multiple id="add_communication_files"></div><br></td>
            </tr>
                    <tr>
                <td></td>
                <td  style="text-align:left;"><input type="submit" value="Добавить сообщение"></td>
            </tr><!-- onclick="AjaxFormRequest()"-->
        </tbody></table>
    <input type="hidden" name="complaint_id" id="complaint_id" value=""/>
    </form>
</div>
<!--form-->  
  
    
</div></div>


</div>




{else}
Притензий нет.
{/if}
{loadview name='paging'}

</div>