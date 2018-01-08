<div class="mainPart zeroBox">


{if strpos($smarty.server.REQUEST_URI, 'shipment/archive?edit') !== false}
<h1>Редактирование заявки на отгрузку</h1>

<div class="otgruzkiPage otgruzkiSecond">

	<div class="secondShipping sendt" id="" style="display:block;">	
		<div class="queue dsdsds">    
               
                     <div class="line">
                        <div class="box">
                            <span>Вид отгрузки</span>
                            {php}
                            //$_GET['edit'];
                           
                            {/php}
                            <select name="type_id" id="type_id">
                                <option value="">Выберите</option>
								{foreach from=$type1 item=ww name=ww}
									<option value="{$ww.id}" {if $type_id==$ww.id} selected {/if}>{$ww.title}</option>
								{/foreach}
                            </select><br>
                            <span>Подготовка</span>
                            <select name="prep_id" id="">
                                <option value="">Выберите</option>
                                {foreach from=$prep1 item=rr name=rr}
									<option value="{$rr.id}" {if $prep_id==$rr.id} selected {/if}>{$rr.title}</option>
								{/foreach}
                            </select><br>
                           <span>Транспортная <br> компания</span>
                            <select name="transport_company_id" id="" class="last">
                                <option value="">Выберите</option>
                                {php} $i=0; {/php}
                                {foreach from=$transport_companies item=rr name=rr}
                                
									<option value="{$rr.days}" data-v="{$rr.days}"  {php} if($this->_tpl_vars['transport_companies'][$i]['title']==$this->_tpl_vars['company']){  echo " data-id='selected' "; }; {/php}>{$rr.title}</option>
                                    {php} $i++; {/php}
                                {/foreach}
                            </select><br>
                            
                        </div>
                        <div class="box">
                            <p class="date" id="shipment-f" data-shiptime="14">Желаемая дата <br> отгрузки</p>
                            <div class="datepicker22"></div>
							<input type="hidden" name="sdate" value="{$sdate|replace:'-':'.'}"  id="shipment_form_sdate" class="zf_date"/>
                            <div class="block_date"><p>Имеются отгрузки:</p></div>
                        </div>
                    </div>
                     <span class="comment">Коментарий</span>
                    <textarea name="comment" id="" cols="" rows="" placeholder="Текст сообщения">{$comment}</textarea>
                    <input type="text" id="company" name="company" value='{$company}' style="display:none;"/>
                    <div class="buttons">
                        <a class="button secondBtn prev" href="javascript:void(0)">Назад</a>
                        <!--<a class="button next" href="javascript:void(0)">Далее</a>-->
                        <input type="submit" value="Отправить" onclick="edit_ship({$ship_id});">
                        
                    </div>
</div>

{else}


        <h1>Отгрузки</h1>
        <a class="order buttonOrange" href="/shipment">Создать заявку на отгрузку</a>
        <div class="queue">
            
            {php} $i=0; {/php}
            {foreach from=$shipments.data item=req name=req}
            {if $req.goods_count == 0} {php} continue; {/php} {/if}
            <div class="bill tmp0 oneClaim" {php} if($i>=10){ echo' style="display:none;" '; } {/php}>
                <p>Счет <span class="number">{$req.account_number}</span> <span class="status">{$req.status_title_dealer} 
                {if $req.status_title_dealer=="Частичная отгрузка"}
                	<span class="date">{$req.shipment_date|date_format:"%d.%m.%Y"}</span>
                    <span class="shippingApp">заявка на отгрузку № {$req.shipment_number}</span>
                {/if}
                </span></p>
                <p class="billInfo tmp1">{$req.goods_sum|round:1} руб, {$req.goods_weight|round:2} кг, {$req.goods_count} позиций</p>
                
                
                {if count($req.docs) != 0}
                <div class="docs">
                    <a class="pdf" href="javascript:void(0)">Документы</a>
                    
                    <div class="docPopUp" style=" min-width:200px;">
                    
                    {foreach from=$req.docs item=i}
                    
                        <p><a href="/requests/download/?link=/public/userfiles/bills/{$i.bill_id}.jpg">Накладная {$i.desc}</a> 
                        <span>от {$i.date}</span></p>
                       
                    
                    {/foreach}
                    
                        <div class="closeButton"></div>
                    </div>
                    
                </div>
                {/if}
                
                
                
                
            </div>
            {php} $i++; {/php}
            {/foreach}
            <div class="moreBtns">
   				<a class="more" href="javascript:void(0)" data-number="11" onclick="requests_more2();">Еще 10</a>
			</div>
            <!--
            <div class="bill">
                <p>Счет <span class="number">30004</span> <span class="status">оплачен</span></p>
                <p class="billInfo">658 648 руб, 451 кг, 47 позиций</p>
            </div>
            <div class="bill">
                <p>Счет <span class="number">30058</span> <span class="status">оплачен</span></p>
                <p class="billInfo">55 648 руб, 451 кг, 8 позиций</p>
            </div>
            <div class="bill">
                <p>
                    Счет <span class="number">30149</span> 
                    <span class="status">оплачен</span> 
                    <span class="shippingApp">заявка на отгрузку № 145</span>
                </p>
                <p class="billInfo">55 648 руб, 451 кг, 8 позиций</p>
            </div>
            <div class="bill">
                <p>
                    Счет <span class="number">30149</span> 
                    <span class="status">оплачен</span> 
                    <span class="shippingApp">заявка на отгрузку № 145</span>
                </p>
                <p class="billInfo">57 259 руб, 451 кг, 9 позиций</p>
            </div>
            <div class="bill">
                <p>
                    Счет <span class="number">30004</span> 
                    <span class="status">оплачен</span> 
                    <span class="shippingApp">заявка на отгрузку № 258</span>
                </p>
                <p class="billInfo">658 648 руб, 451 кг, 47 позиций</p>
            </div>
            <div class="bill">
                <p>
                    Счет <span class="number">30058</span> 
                    <span class="status">оплачен</span> 
                    <span class="shippingApp">заявка на отгрузку № 258</span>
                </p>
                <p class="billInfo">55 648 руб, 451 кг, 8 позиций</p>
            </div>
            <div class="bill">
                <p>
                    Счет <span class="number">30058</span> 
                    <span class="status">оплачен</span> 
                    <span class="shippingStatus">частично отгружен</span>
                    <span class="date">10.12.1015</span>
                    <span class="shippingApp">заявка на отгрузку № 258</span>
                </p>
                <p class="billInfo">55 648 руб, 451 кг, 8 позиций</p>
                <div class="docs">
                    <a class="pdf" href="javascript:void(0)">Документы</a>
                    <div class="docPopUp">
                        <p><a href="javascript:void(0)">Накладная № 3546</a> <span>от 26.12.2016</span></p>
                        <p><a href="javascript:void(0)">УПД № 713</a> <span>от 29.12.2015</span></p>
                        <p>
                            <a href="javascript:void(0)">
                                Транспортная<br>
                                накладная №АП2515
                            </a> <span>от 10.10.2016</span>
                        </p>
                        <div class="closeButton"></div>
                    </div>
                </div>
            </div>
            <div class="bill">
                <p>
                    Счет <span class="number">30058</span> 
                    <span class="status">оплачен</span> 
                    <span class="shippingStatus">частично отгружен</span>
                    <span class="date">10.12.1015</span>
                    <span class="date">28.12.1015</span>
                </p>
                <p class="billInfo">55 648 руб, 451 кг, 8 позиций</p>
                <div class="docs">
                    <a class="pdf" href="javascript:void(0)">Документы</a>
                    <div class="docPopUp">
                        <p><a href="javascript:void(0)">Накладная № 3546</a> <span>от 26.12.2016</span></p>
                        <p><a href="javascript:void(0)">УПД № 713</a> <span>от 29.12.2015</span></p>
                        <p>
                            <a href="javascript:void(0)">
                                Транспортная<br>
                                накладная №АП2515
                            </a> <span>от 10.10.2016</span>
                        </p>
                        <div class="closeButton"></div>
                    </div>
                </div>
            </div>-->
            
            
            
        </div>
        
        
        <!--
        <div class="shipped">
            <div class="bill">
                <p>Счет <span class="number">30149</span> <span class="date">10.12.1015</span></p>
                <p class="billInfo">57 259 руб, 451 кг, 9 позиций</p>
                <div class="docs">
                    <a class="pdf" href="javascript:void(0)">Документы</a>
                    <div class="docPopUp">
                        <p><a href="javascript:void(0)">Накладная № 3546</a> <span>от 26.12.2016</span></p>
                        <p><a href="javascript:void(0)">УПД № 713</a> <span>от 29.12.2015</span></p>
                        <p>
                            <a href="javascript:void(0)">
                                Транспортная<br>
                                накладная №АП2515
                            </a> <span>от 10.10.2016</span>
                        </p>
                        <div class="closeButton"></div>
                    </div>
                </div>
            </div>
            <div class="bill">
                <p>Счет <span class="number">30149</span> <span class="date">10.12.1015</span> <span class="date">28.12.1015</span></p>
                <p class="billInfo">57 259 руб, 451 кг, 9 позиций</p>
                <div class="docs">
                    <a class="pdf" href="javascript:void(0)">Документы</a>
                    <div class="docPopUp">
                        <p><a href="javascript:void(0)">Накладная № 3546</a> <span>от 26.12.2016</span></p>
                        <p><a href="javascript:void(0)">УПД № 713</a> <span>от 29.12.2015</span></p>
                        <p>
                            <a href="javascript:void(0)">
                                Транспортная<br>
                                накладная №АП2515
                            </a> <span>от 10.10.2016</span>
                        </p>
                        <div class="closeButton"></div>
                    </div>
                </div>
            </div>
        </div>
        -->
        
        
        
        
        
        
        
        
        
        <div class="shipped">
            
            {php}
            $cnt=0;
            {/php}
            
            {foreach from=$sended item=req name=req}
        
            <div class="bill">
                <p>Счет <span class="number">{$req.account_number}</span> <span class="date">{$req.sdate|date_format:"%d.%m.%Y"}</span>
                
                {php}
                
               // echo "<pre>";
               // print_r($this->_tpl_vars['sended'][$cnt]['id']);
               // echo "</pre>";
                //echo $this->_tpl_vars['sended'][$cnt]['sdate']."<br>";
                
                $today=date("Y-m-d");
                //echo $today;
                
                $dis=$this->_tpl_vars['sended'][$cnt]['sdate']-$today;
                //echo $dis."==";
                
                $date1 = new DateTime($this->_tpl_vars['sended'][$cnt]['sdate']);
				$date2 = new DateTime($today);
				$interval = $date1->diff($date2);
                if($interval->d > 1){
                {/php}
                <a class="button editInfo" href="/shipment/archive?otkaz={php} echo $this->_tpl_vars['sended'][$cnt]['id']; {/php}" style="margin-left:30px;">Отказаться</a>
                {php}
                }else if($interval->d == 1){
                //проверить , чтобы текущее время было до 17:00
                $t_time=date("H:i");
                	if(strtotime($t_time) <= strtotime("17:00")){
                {/php}
                <a class="button editInfo" href="/shipment/archive?otkaz={php} echo $this->_tpl_vars['sended'][$cnt]['id']; {/php}" style="margin-left:30px;">Отказаться</a>
                {php}
                	}
                }
                {/php}
                
                <a class="button editInfo" href="/shipment/archive?edit={php} echo $this->_tpl_vars['sended'][$cnt]['id']; {/php}">Изменить</a>
                
                </p>
                
                {php} $cnt++; {/php}
                
                <p class="billInfo tmp2">{$req.goods_sum|round:1} руб, {$req.goods_weight|round:2} кг, {$req.goods_count} позиций</p>
                {if count($req.docs) != 0}
                <div class="docs">
                    <a class="pdf" href="javascript:void(0)">Документы</a>
                    
                    <div class="docPopUp" style=" min-width:200px;">
                    
                    {foreach from=$req.docs item=i}
                    
                        <p><a href="/requests/download/?link=/public/userfiles/bills/{$i.bill_id}.jpg">Накладная {$i.desc}</a> 
                        <span>от {$i.date}</span></p>
                       
                    
                    {/foreach}
                    
                        <div class="closeButton"></div>
                    </div>
                    
                </div>
                {/if}
            </div>
            
            {/foreach}
            
            
            
        </div>
        
        
        
       
        
        
        
        <div class="oldestShipped">
            <p>Более ранние отгрузки в «<a href="/requests/archive/">Заявках</a>»</p>
        </div>
        
        
        
{/if}        
        
        
        
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   