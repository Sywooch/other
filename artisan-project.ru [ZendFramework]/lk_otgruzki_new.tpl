{php}
session_start();
{/php}
    <div class="mainPart zeroBox">
    {php} if(isset($_GET['send'])){ {/php}
    
    <h2 class="message" style="color:green; font-weight:bold;">{php} echo $_GET['send']; {/php}</h2>
	
    {php} } {/php}

        <h1>Новая заявка на отгрузку</h1>
        <div class="shippingList">
            <span><a href="#" style="text-decoration:none; border-bottom-width:0px;">Счета для отгрузки:</a></span>
            <a id="sendt" href="javascript:void(0)" class="details">Детали отгрузки</a>
        </div>
        
        <div class="queue step1">
           {foreach from=$shipments.data item=req name=req}
            {if $req.goods_count == 0} {php} continue; {/php} {/if}
			<div class="bill tmp5">
                <input type="checkbox" id="" class="">
                
                <label for="">
                    <div class="shippingInfo tmp01">
                        <p>Счет <span class="number">{$req.account_number}</span> <span class="status">{$req.status_title_dealer}</span></p>
                        <p class="billInfo">{$req.goods_sum|round:1} руб, {$req.goods_weight|round:2} кг, {$req.goods_count} позиций</p>
                    </div>
                </label>
                <div class="checkBoxTrue imit"></div>
                <div class="checkBoxFalse imit"></div>
            </div>
			{/foreach}
            <div class="buttons">
                <!--<a class="button prev" href="javascript:void(0)">Назад</a>-->
                <a class="button next firstBtn" href="javascript:void(0)">Далее</a>
            </div>
        </div>
        {php}$i=2;{/php}
		 <form  method="POST">
         
   {foreach from=$shipments.data item=req name=req}
   		{if $req.account_number ==""} {php} continue; {/php} {/if}
		<div class="secondShipping {$req.account_number}" id="">
        
            <div class="queue step{php}echo $i{/php} alert">
            
            {php} $alert=0; {/php}
            {foreach from=$req.goods.data item=req2 name=req2}
            	{if $req2.good_count > $req2.ostatok}
                	{php} $alert=1; {/php}
                {/if}
            {/foreach}
            
            {php} if($alert==1){ {/php}
            	<h1>В счете имеются позиции с частичным наличием</h1>
            	<div class="radioBox">
                    <input type="radio" name="partAll_{$req.account_number}" id="all" value="1" checked><p>Весь счет, кроме отсутствующих позиций</p>
                    <input type="radio" name="partAll_{$req.account_number}" id="part" value="0"><p>Частичная отгрузка</p>
                </div>
            {php} } {/php}
            
              {foreach from=$req.goods.data item=req2 name=req2}
              	{if $req2.good_title == ""} {php} continue; {/php} {/if}
              		<!--<input type="checkbox" id="" name="reqs[{$req.id}][]" value="{$req2.good_id}" class="" checked="checked">-->
					<div class="bill {if $req2.good_count > $req2.ostatok}i_alert{/if}">
                    <!--<input type="checkbox" id="" name="reqs[1111][]" value="2222" class="" checked>-->
						<input type="checkbox" id="" name="reqs[{$req.id}][]" value="{$req2.good_id}" class="" 
                        {php} if($alert==1){ {/php} checked="checked" {php} } //checked="checked"  {/php}> 
                        <!--  checked="checked" -->
                        
						<label for="">
							<div class="shippingInfo tmp02 {if $req2.good_count > $req2.ostatok} warning_red {/if}">
                            	<!---{$req2.good_count}- -{$req2.ostatok}--> 
								<!--<p>Плитка, 31*60</p>-->
								<span class="number itemName">{$req2.good_title}</span>
								<span class="shippingStatus">{$req2.good_art}</span>
								<div class="inputs">
									<div class="meters block">
										<input class="fileStyle" name="count[]" type="number" min="0" max="{$req2.good_count}" onchange="isright(this);" onkeypress="isright2(this);" {if $req2.unit_title=="м2"}step="0.0001"{/if} value="{$req2.good_count}" disabled><span class="type">{$req2.unit_title}{if $req2.unit_title==""}м2{/if}</span>
										<p>из <span class="remain">{$req2.good_count/1}</span></p>
									</div>
									<div class="wraps block">
										<input class="fileStyle" name="count_pack[]" type="number" min="0" max="{$req2.good_count_pack}" onkeypress="isright2(this);" onchange="isright(this);" value="{$req2.good_count_pack}" autocomplete="off" data="{$req2.count_pack}" disabled><span class="type">уп</span>
										<p>из <span class="remain">{$req2.good_count_pack/1}</span></p>
									</div>
									<div class="sum block">
										<input class="fileStyle" name="count_unit[]" value="{$req2.good_count_unit}" min="0" max="{$req2.good_count_unit}" onkeypress="isright2(this);" onchange="isright(this);" type="number" autocomplete="off" data="{$req2.count_unit}" disabled><span class="type">пл</span>
									</div>
								</div>
                                
                                {if $req2.good_count > $req2.ostatok}
                                <p class="warning">В наличии по счету <span>{$req2.good_count}</span> шт, остаток <span>{$req2.ostatok}</span> шт. {if $req2.postavka != ""}(поставка {$req2.postavka}){/if}</p>
                                {/if}
                                
                                
							</div>
						</label>
                        {if $req2.good_count > $req2.ostatok}<div class="checkBoxWarning"></div>{/if}
                        {php} if($alert==1){ {/php}<div class="checkBoxWarning"></div>{php} } {/php}
						<div class="checkBoxTrue imit {if $req2.good_count > $req2.ostatok}i_alert{/if} {php} if($alert==1){ {/php}i_alert{php} } {/php}"
                        {if $req2.good_count > $req2.ostatok}style="display:block;"{/if}
                        {php} if($alert==1){ {/php}style="display:block;"{php} } {/php}
                        ></div>
						<div class="checkBoxFalse imit {if $req2.good_count > $req2.ostatok}i_alert{/if} {php} if($alert==1){ {/php}i_alert{php} } {/php}"
                        {if $req2.good_count > $req2.ostatok}style="display:none;"{/if}
                        {php} if($alert==1){ {/php}style="display:none;"{php} } {/php}
                        ></div>
						
                    </div>
					{/foreach}
                
                <div class="buttons">
                    <a class="button prev secondBtn" href="javascript:void(0)">Назад</a>
                    <a class="button next secondBtn" href="javascript:void(0)">Далее</a>
                </div>
            </div>
	</div>
	{php}$i++;{/php}
        {/foreach}
		<input type="hidden" id="partially" name="partially" value="0"/>
	<div class="secondShipping sendt" id="">	
		<div class="queue dsdsds">    
               
                     <div class="line">
                        <div class="box">
                            <span>Вид отгрузки <font style="color:red;">*</font></span>
                            <select name="type_id" id="type_id">
                                <option value="">Выберите</option>
								{foreach from=$type1 item=ww name=ww}
									<option value="{$ww.id}">{$ww.title}</option>
								{/foreach}
                            </select><br>
                            <span>Подготовка <font style="color:red;">*</font></span>
                            <select name="prep_id" id="">
                                <option value="">Выберите</option>
                                {foreach from=$prep1 item=rr name=rr}
									<option value="{$rr.id}">{$rr.title}</option>
								{/foreach}
                            </select><br>
                           <span>Транспортная <br> компания</span>
                           <!--<div class="transport_company_dis"></div>-->
                           <div class="transport_company_container">
                           <div class="dis"></div>
                            <select name="transport_company_id" id="" class="last">
                                <option value="">Выберите</option>
                                {foreach from=$transport_companies item=rr name=rr}
									<option value="{$rr.days}" data-v="{$rr.days}">{$rr.title}</option>
                                {/foreach}
                            </select><br>
                            </div>
                        </div>
                        <div class="box">
                            <p class="date" id="shipment-f" data-shiptime="14">Желаемая дата <br> отгрузки <font style="color:red;">*</font></p>
                            <div class="datepicker22"></div>
							<input type="hidden" name="sdate" value=""  id="shipment_form_sdate" class="zf_date"/>
                            <div class="block_date"><p>Имеются отгрузки:</p></div>
                            
                            <div style="clear:both;"></div>
                            
                            <div class="note1"><div></div><span>Дни бесплатной отгрузки</span></div>
                            <div class="note2"><div></div><span>Дни платной отгрузки</span></div>
                            
                            
                            
                        </div>
                    </div>
                     <span class="comment">Коментарий</span>
                    <textarea name="comment" id="" cols="" rows="" placeholder="Текст сообщения"></textarea>
                    
                    
                    <p style="font-size:12px;"><font style="color:red;">*</font> - обязательные поля</p>
                    
                    <input type="text" id="company" name="company" value="test" style="display:none;"/>
                    <input type="text" id="mixed" name="mixed" value="0" style="display:none;"/>
                    
                    <div class="buttons">
                        <a class="button secondBtn prev" href="javascript:void(0)">Назад</a>
                        <!--<a class="button next" href="javascript:void(0)">Далее</a>-->
                        <input type="submit" value="Отправить">
                        <p>
                            Что бы отправить заявку укажите: вид отгрузки, подготовку,<br>
                            ТК при необходимости, желаемую дату отгрузки (доставки)
                        </p>
                    </div>
                </form>
            </div>
		</div>
		
		
    </div>
  