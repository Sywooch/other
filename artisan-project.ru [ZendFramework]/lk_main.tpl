 
    <div class="mainPart zeroBox">
        <h1>Заявки</h1>
        <a class="order buttonOrange" href="/requests">Создать новую...</a>
		<form action="/requests/archive/" method="GET" class="fomadsd">
        <div class="filter">
            <ul>
                <li>
                <p>Статус</p>
				 <select name="status" data-placeholder="Все">
                        <option value="">Все</option>
                        <option value="new" {php}if($_GET['status']=="new"){echo "selected='selected'";}{/php}>В обработке</option>
                        <option value="reserved" {php}if($_GET['status']=="reserved"){echo "selected='selected'";}{/php}>Зарезервировано</option>
                        <option value="unreserved" {php}if($_GET['status']=="unreserved"){echo "selected='selected'";}{/php}>Резерв снят</option>
						 <option value="expired" {php}if($_GET['status']=="expired"){echo "selected='selected'";}{/php}>Истёк срок резерва</option>
                          <option value="declined" {php}if($_GET['status']=="declined"){echo "selected='selected'";}{/php}>Отказ от заказа</option>
                        <option value="partly_pay" {php}if($_GET['status']=="partly_pay"){echo "selected='selected'";}{/php}>Частичная оплата</option>
                        <option value="paid" {php}if($_GET['status']=="paid"){echo "selected='selected'";}{/php}>Оплачен</option>
						 <option value="shipment_prep" {php}if($_GET['status']=="shipment_prep"){echo "selected='selected'";}{/php}>Заявка на отгрузку</option>
                        <!--<option value="shipment_approved" {php}if($_GET['status']=="shipment_approved"){echo "selected='selected'";}{/php}>Отгрузка подтверждена</option>
                        <option value="shipment_decline" {php}if($_GET['status']=="shipment_decline"){echo "selected='selected'";}{/php}>Отгрузка подтверждена</option>-->
						 <option value="partly_shipped" {php}if($_GET['status']=="partly_shipped"){echo "selected='selected'";}{/php}>Частичная отгрузка</option>
                        <option value="processed" {php}if($_GET['status']=="processed"){echo "selected='selected'";}{/php}>Отгружен</option>
                       
						 <!--<option value="work" {php}if($_GET['status']=="work"){echo "selected='selected'";}{/php}>В работе</option>
                        <option value="rejected" {php}if($_GET['status']=="rejected"){echo "selected='selected'";}{/php}>Отклонена</option>-->
                        <option value="nalichie_raschitano" {php}if($_GET['status']=="nalichie_raschitano"){echo "selected='selected'";}{/php}> Наличие рассчитано</option>
                        <option value="cancel" {php}if($_GET['status']=="cancel"){echo "selected='selected'";}{/php}>Отменена</option>
						 <!--<option value="nal_rascitano_izmen" {php}if($_GET['status']=="nal_rascitano_izmen"){echo "selected='selected'";}{/php}>Наличие рассчитано с изменениями</option>
                        <option value="tovara_net" {php}if($_GET['status']=="tovara_net"){echo "selected='selected'";}{/php}>Товара нет в наличии</option>
                        <option value="schet_vystavlen" {php}if($_GET['status']=="schet_vystavlen"){echo "selected='selected'";}{/php}>Счёт выставлен</option>-->
                    </select>
                </li>
                <li>
                    <p>Номер заявки</p>
                    <input type="text" name="id" value="{php}if(isset($_GET['id']) && $_GET['id']!=""){echo $_GET['id'];}{/php}">
                </li>
                <li>
                    <p>Номер счета</p>
                    <input type="text" name="account_number"  value="{php}if(isset($_GET['account_number']) && $_GET['account_number']!=""){echo $_GET['account_number'];}{/php}">
                </li>
                <li>
                    <p>Дата создания</p>
                    <input type="text" class="datepicker" name="cdate"  value="{php}if(isset($_GET['cdate']) && $_GET['cdate']!=""){echo $_GET['cdate'];}{/php}">
                </li>
                <li class="lastButton">
                    <a href="javascript:void(0)" class="submitsd">Показать</a>
                </li>
            </ul>
			</form>
        </div>
      
        
        <div class="queueClaims">
            
            
            {php} $i=0; {/php}
            
            {foreach from=$archive.data item=req name=req}
            {php} //if($i==10){ break; } {/php}
            <div class="oneClaim"  {php} if($i>=10){ echo' style="display:none;" '; } {/php}>
                <p class="time">
                    <span class="date">{$req.cdate|date_format:"%d.%m.%Y"}</span>
                    в
                    <span class="hours">{$req.cdate|date_format:"%H:%M"}</span>
                    <span class="status {if $req.status == 'new'}inAction{/if}
                    {if $req.status == 'reserved'}reserve{/if}
                    {if $req.status == 'expired'}outOfTime{/if}
                    {if $req.status == 'processed'}done{/if}"
                     {if $req.status == 'paid'} style="color:#00ff00;" {/if}>
                    	{if $req.status == 'new'}
                            В обработке
                        {elseif $req.status == 'reserved'}
                            Зарезервировано
                        {elseif $req.status == 'unreserved'}
                            Резерв снят
                        {elseif $req.status == 'expired'}
                            Истёк срок резерва
                        {elseif $req.status == 'partly_pay'}
                            Частичная оплата
                        {elseif $req.status == 'paid'}
                            Оплачен
                        {elseif $req.status == 'shipment_prep'}
                            Заявка на отгрузку
                        {elseif $req.status == 'shipment_approved'}
                             
                        {elseif $req.status == 'shipment_decline'}
                             
                        {elseif $req.status == 'partly_shipped'}
                            Частичная отгрузка
                        {elseif $req.status == 'processed'}
                            Отгружен
                        {elseif $req.status == 'declined'}
                            Отказ от заказа
                        {elseif $req.status == 'work'}
                            
                        {elseif $req.status == 'rejected'}
                             
                        {elseif $req.status == 'nalichie_raschitano'}
                            Наличие рассчитано
                        {elseif $req.status == 'cancel'}
                            Отменена
                        {elseif $req.status == 'nal_rascitano_izmen'}
                             
                        {elseif $req.status == 'tovara_net'}
                            
                        {elseif $req.status == 'schet_vystavlen'}
                            
                        
                        {else}
                            
                        {/if}
                    </span>
                </p>
                <div class="identificator">
                    <span class="number" ids="{$req.id}">№ {$req.id}</span>
                    {if $req.account_number!=""}<a target="_blank" class="bill" 
                    href="/requests/print2/id/{$req.id}/" style="text-decoration:none;">Счет {$req.account_number}</a>{/if}
                    <span class="sum">{$req.goods_count}</span> {$req.goods_count_text}
                    {if $req.rtype == 'reservation'}
                    <span class="custom" style="padding-left:5px; padding-right:5px">под заказ</span>
                    {/if}
                    
                    
                    {if $req.status == 'new' or $req.status == 'reserved' or $req.status == 'partly_pay' or $req.status == 'paid' or $req.status == 'shipment_prep' or $req.status == 'nalichie_raschitano' }
                    <li class="lastButton">
                    <a href="/requests/archive?otkaz={$req.id}" class="submitsd">Отказаться</a>
                	</li>
                    {/if}
                    
                    
					<div class="claimPopUp reserved tmp2"></div>
                </div>
				
                <p class="payInfo">
                    <span class="price">{$req.goods_sum} руб.</span>
                    {$req.goods_weight|round:2} кг, оператор {$req.operator_name}
                </p>
                {if count($req.docs) != 0 and $req.status != 'paid' and $req.status != 'declined'}
                <div class="docs">
                    <a class="pdf" href="javascript:void(0)">Документы</a>
                    
                    <div class="docPopUp" style=" min-width:200px;"><!--min-height:100px;-->
                    
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
                <a class="more" href="javascript:void(0)" data-number="11" onclick="requests_more();">Еще 10</a>
            </div>
        </div>
    </div>
    
 