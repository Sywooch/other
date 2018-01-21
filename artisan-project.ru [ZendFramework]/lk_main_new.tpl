 {php}
// echo "<pre>";
// print_r($this->page->factories);
// echo "</pre>";
 {/php}
 
 
 
 
 <div class="mainPart zeroBox">
        <h1>Новая заявка</h1>
        <form action="" method="post" class="derses">
            <input type="hidden" id="rtype"  name="rtype" value="order">
            <ol id="adding" class="adding">    
            <li class="basement">
                <p class="heading">Подобрать:</p>
                <ul class="types">
                    <li class="inStock active">Товар &laquo;В наличии&raquo;</li>
                    <li class="onOrder">Товар &laquo;Под заказ&raquo;</li>
                </ul>
                <div class="itemsBox">
                    <div class="filter">
                        <ul class="ff">
                            <li>
                                <p>Фабрика</p>
                                <select name="" class="fabricio" id="fabricio">
                                    <option value="">Выберите</option>
									{php}
									 foreach($this->page->fabrics1 as $sd){
                                     
                                     
                                     	if($sd['title']==""){ continue; };
										if($sd['end']=='yes'){
                                        	echo '<option value="'.$sd['id'].'">'.$sd['title'].' %</option>';
                                        }else{
                                        	echo '<option value="'.$sd['id'].'">'.$sd['title'].'</option>';
										}
                                        
                                        }
									 {/php}
                                </select>
								  <select name="" class="fabricio66" id="fabricio66">
                                    <option value="">Выберите</option>
									{php}
									 //foreach($this->page->fabrics3 as $sd){
                                     foreach($this->page->factories as $sd){
                                     	if($sd['title']==""){ continue; };
										if($sd['end']=='yes'){
                                        	echo '<option value="'.$sd['id'].'">'.$sd['title'].' %</option>';
                                        }else{
                                        	echo '<option value="'.$sd['id'].'">'.$sd['title'].'</option>';
										}
                                        
										}
									 {/php}
                                </select>
                            </li>
                            <li>
                                <p>Коллекция</p>
                                <select name="" class="colllection" id="colllection">
                                    <option value="">Выберите</option>
                                </select>
                                <select name="" class="colllection2" id="colllection2">
                                    <option value="">Выберите</option>
                                </select>
                            </li>
                            <li>
                                <p>Артикул "Артисан"</p>
                                <input type="text" class="arts">
                                <input type="text" class="arts2">
                            </li>
                            <li>
                                <p>Наименование</p>
                                <input type="text" class="namma">
                                <input type="text" class="namma2">
                            </li>
                            <li class="f">
                                <a href="javascript:void(0)" class="searstr">Найти</a>
                            </li>
                        </ul>
                        <div class="showHidePicsParent">
                            <input type="checkbox" class="showHidePics"> <span>Не показывать картинки</span>
                            <div class="checkBoxTrue imit"></div>
                            <div class="checkBoxFalse imit"></div>
                        </div>
                        
                    </div>
                    <div class="itemsQueue" style="height:0px;">
                     
                       
                        
                    </div>
                    
                    <div class="underTheOrderList" style="height:0px;">
                          
                        
                    </div>
                    
                    <div class="buttons">
                        <a class="button prev addToTheListBtn" href="javascript:void(0)">Добавить в заявку</a>
                        <a class="button next abort" href="javascript:void(0)">Отменить</a>
                    </div>
                </div>
            </li>
        </ol>
             <div class="line com" >
			  <span class="comment">Юр. лицо</span>
               <div style="width:300px;display:inline-block;margin-left: 20px;"> <select name="legal_entity_id" class="fabricio222" id="fabricio222">
                                    <option value="">Выберите</option>
									{php}
									 foreach($this->page->dealer['legal_entities'] as $rek){
										echo '<option value="'.$rek['id'].'">'.$rek['legal_entity'].'</option>';
										}
									 {/php}
                                </select>
								</div>
            </div>
            <div class="line com" style="z-index:0;">
                <span class="comment">Коментарий</span>
                <textarea name="comments" id="" placeholder="Например, пожелания к упаковке, срочность заявки и т.д."></textarea>
            </div>
			<div style="display:none;" class="sawe"  discount="{php} echo $this->page->settings['discount'];{/php}" total_price="{php} echo $this->page->settings['total_price'];{/php}" account4extra_discount="{php} echo $this->page->settings['account4extra_discount'];{/php}" extra_discount="{php} echo $this->page->settings['extra_discount'];{/php}"></div>
            <p style="display:none;color: red;" class="postskidka">Цены на товар указаны с учетом скидки дня (<i>3</i>%)</p>
			<!--<p style="display:none;color: red;" class="skidkabolit">{php} echo $this->page->settings['extra_discount_text'];{/php}</p>-->
			<div class="sentForm">
                <p>
                    Общая стоимость товаров <span class="bill">0</span> руб, весом <span class="weight">0</span> кг
                </p>
                
                <p><span  class="text_pod_zakaz">
                    <span class="low">Цена позиций &laquo;под заказ&raquo; — расчетная и будет уточнена администраторами при подтверждении</span></span>
                </p>
                
                
                <input type="submit" name="order" class="onsubmits" value="Отправить">
            </div>
        </form>
        
    </div>
    
    
    
    
    
    

        
        
    