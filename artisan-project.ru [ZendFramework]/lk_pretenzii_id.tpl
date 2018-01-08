<link rel="stylesheet" href="/public/site1/lk/styles/pretenzii.css">
   



   
   <div class="mainPart zeroBox ">
        <h1>Претензия № {php} echo $this->page->request['id']; {/php}<a class="docs_back" href="/complaints/archive" style="color:#3c3f45; text-decoration:underline;">НАЗАД</a></h1>
        <div class="mainWrap">
            <div class="chat">
                
                
                
                {foreach from=$communication item=comm name=communication}
                <div class="line">
                    <div class="message {if $comm.is_answer == 'no'}ask{else}answer{/if}">
                        <div class="text">
                            <p>
                                {$comm.text|nl2br}
                            </p>
                            <div class="imgWrap">
                            	
                            	{php} $i=0; {/php}
                            	{foreach from=$comm.files item=file name=files}
                         		{php} if(getimagesize($_SERVER['DOCUMENT_ROOT'].$this->page->comm['files'][0]['file'])){ {/php}
                    			<img src="{$file.file}" alt="{$file.file_name}" style="cursor:pointer;">
                                {php} }else{ {/php}
                                <a href="{$file.file}">{$file.file_name}</a>
                                {php} } {/php}
                                {/foreach}
                                
                            </div>
                        </div>
                        <span class="date">{$comm.commdate|date_format:'%d.%m.%Y %H:%M'}</span>
                    </div>
                </div>
                {/foreach}
                
                
                
                <!--
                <div class="line">
                    <div class="message answer">
                        <div class="text">
                            <p>
                                Экстракт элеутерококка, синоним к слову уповай, погода агадир марокко, 
        несущая способность свай, все фильмы стивена сигала, домашняя засолка сала давыдова автопартнер, туберкулезный диспансер, системы мокрого фасада
        диплом москва москва диплом, пансионат союз газпром, как образуется торнадо как сделать кувырок-подскок, восток уаз владивосток
                            </p>
                        </div>
                        <span class="date">29 января 2016</span>
                    </div>
                </div>
                <div class="line">
                    <div class="message ask">
                        <div class="text">
                            <p>
                                Горящие путёвки волгоград, текст сказки волк и семеро козлят воронины все серии подряд, салон для новобрачных салават
                            </p>
                            <div class="imgWrap">
                                <img src="/public/site1/lk/images/commentImg1.png" alt="Pic">
                                <img src="/public/site1/lk/images/commentImg2.png" alt="Pic">
                            </div>
                        </div>
                        <span class="date">29 января 2016</span>
                    </div>
                </div>
                -->
                
                
                
            </div>
            
            
                
            
            
            <form accept-charset="utf-8" enctype="multipart/form-data" name="add_communication" 
             id="add_communication_form" method="post" action="" class="complaint">
                <textarea name="text" id="add_communication_text" placeholder="Текст сообщения"></textarea>
                <div class="files_list"></div>
                <input type="hidden" value="" id="deleted_files" name="deleted_files"/>
                <div class="button_containers">
                	<input class="fileStyle show" id="file__1" type="file" name="files[]" multiple data-id="1">
                    <input class="fileStyle hide" id="file__2" type="file" name="files[]" multiple data-id="2">
                    <input class="fileStyle hide" id="file__3" type="file" name="files[]" multiple data-id="3">
                    <input class="fileStyle hide" id="file__4" type="file" name="files[]" multiple data-id="4">
                    <input class="fileStyle hide" id="file__5" type="file" name="files[]" multiple data-id="5">
                    <input class="fileStyle hide" id="file__6" type="file" name="files[]" multiple data-id="6">
                    <input class="fileStyle hide" id="file__7" type="file" name="files[]" multiple data-id="7">
                    <input class="fileStyle hide" id="file__8" type="file" name="files[]" multiple data-id="8">
                    <input class="fileStyle hide" id="file__9" type="file" name="files[]" multiple data-id="9">
                    <input class="fileStyle hide" id="file__10" type="file" name="files[]" multiple data-id="10">
                    <input class="fileStyle hide" id="file__11" type="file" name="files[]" multiple data-id="11">
                    <input class="fileStyle hide" id="file__12" type="file" name="files[]" multiple data-id="12">
                    <input class="fileStyle hide" id="file__13" type="file" name="files[]" multiple data-id="13">
                    <input class="fileStyle hide" id="file__14" type="file" name="files[]" multiple data-id="14">
                    <input class="fileStyle hide" id="file__15" type="file" name="files[]" multiple data-id="15">
                    <input class="fileStyle hide" id="file__16" type="file" name="files[]" multiple data-id="16">
                    <input class="fileStyle hide" id="file__17" type="file" name="files[]" multiple data-id="17">
                    <input class="fileStyle hide" id="file__18" type="file" name="files[]" multiple data-id="18">
                    <input class="fileStyle hide" id="file__19" type="file" name="files[]" multiple data-id="19">
                    <input class="fileStyle hide" id="file__20" type="file" name="files[]" multiple data-id="20">
                    <input class="fileStyle hide" id="file__21" type="file" name="files[]" multiple data-id="21">
                    
                </div>
                
                <!--<input type="file" name="files[]"> -->
                <!--<input class="images_input" type="file" name="files[]" id="add_communication_files"> 
                <input class="images_input" type="file" name="files[]" id="add_communication_files"> 
                <input class="images_input" type="file" name="files[]" id="add_communication_files"> 
                <input class="images_input" type="file" name="files[]" id="add_communication_files"> -->
                
                <div class="line last">
                    <input type="submit" value="Отправить">
                </div>
            </form>
            
            
            
            
           
         <!--   
          
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
       -->     
            
            
            
            
            
            
            
            
            
        </div>
    </div>
    
    
    