<div class="row">
                        <div class="col-md-9 right_border_about" id="scroll8">
                            <div class="about_block__title">Реквизиты</div>
                            <table class="about_block__table about_block__table_first">
                                <tbody>
                                
                                {foreach from=$about_rekvisites item=i}
                                <tr>
                                    <td>{$i.title}:</td>
                                    <td>{$i.text}</td>
                                </tr>
                                {/foreach}
                                
                            </tbody></table>
                            <div class="about_block__title">Банковские ревизиты</div>
                            <table class="about_block__table">
                                <tbody>
                                
                                {foreach from=$about_bank_rekvisites item=i}
                                <tr>
                                    <td>{$i.title}:</td>
                                    <td>{$i.text}</td>
                                </tr>
                                {/foreach}
                                
                            </tbody></table>
                        </div>
                        <div class="col-md-3">
                            <div class="about_block__title">Документы</div>
                            
                            
                            <div class="button_up"><span></span></div>
                            <div class="about_docs_container">
                            
                            <div class="docs_container">
                            {foreach from=$about_docs item=i}
                            <div class="about_block__doc">
                            	<a rel="group2" href="{$i.image|replace:'[dir]':'original'}">
                                <img src="{$i.image|replace:'[dir]':'original'}">
                                <span></span>
                                </a>
                                <div>{$i.title}</div>
                            </div>
                            {/foreach}
                            </div>  
                            
                            
                            </div>  
                            <div class="button_down"><span></span></div>
                            
                            
                        </div>
                    </div>