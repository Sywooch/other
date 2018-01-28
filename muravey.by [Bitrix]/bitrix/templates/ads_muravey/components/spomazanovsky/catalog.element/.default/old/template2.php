<div>
	<?php
	require '/home/user1167996/www/muravey.by/bitrix/templates/ads_muravey/core/db.php';
	
	$sql__00as1 = $db->prepare("
									SELECT
											*
									FROM
											`b_user`
									WHERE
											`b_user`.`ID` = :__login_user;
							");
	$__login_user = $USER->GetID();
	$sql__00as1->bindParam(':__login_user', $__login_user, PDO::PARAM_STR);
	$sql__00as1->execute();
	$sql__00as1->setFetchMode(PDO::FETCH_ASSOC);
	$row__00as1 = $sql__00as1->fetch();
	
	$sql__00as2 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element`
									WHERE
											`b_iblock_element`.`CREATED_BY` = :__login_user;
							");
	$__login_user = $USER->GetID();
	$sql__00as2->bindParam(':__login_user', $__login_user, PDO::PARAM_STR);
	$sql__00as2->execute();
	$sql__00as2->setFetchMode(PDO::FETCH_ASSOC);
	$row__00as2 = $sql__00as2->fetch();
	
	$sql__11a = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_section_element`
									WHERE
											`b_iblock_section_element`.`IBLOCK_ELEMENT_ID` = :__id_element
									ORDER BY
											`b_iblock_section_element`.`IBLOCK_ELEMENT_ID`
									ASC
							");
	$__id_element = $arResult['ID'];
	$sql__11a->bindParam(':__id_element', $__id_element, PDO::PARAM_STR);
	$sql__11a->setFetchMode(PDO::FETCH_ASSOC);
	$sql__11a->execute();
	$row__11a = $sql__11a->fetch();
	?>
    <div class="category-p">
		<img src="<?=$arResult['SECTIONS'][$row__11a['IBLOCK_SECTION_ID']]['DETAIL_PICTURE']?>" alt=""/>
        <a href="<?=$arResult['SECTIONS'][$row__11a['IBLOCK_SECTION_ID']]['SECTION_PAGE_URL']?>"><?=$arResult['SECTIONS'][$row__11a['IBLOCK_SECTION_ID']]['NAME']?></a>
    </div>
    <div class="name-number-p">
        <div class="name-p">
			<?=$arResult['NAME']?>
		</div>
        <div class="number-p">
			<?=$arResult['ID']?>
		</div>
    </div>
	<?php
	if($USER->GetID() === $row__00as2['CREATED_BY'] && $row__00as1['NAME'] === $arResult['CLIENT_INFO']['NAME'])
	{
		?>
		<div class="remove_article">
			<a href="/index.php?edit_ads=<?=$arResult['ID']?>">Редактировать</a>
		</div>
		<?php
	}
	?>
    <div class="clear">
    </div>
</div>
<div style="margin-bottom: 30px;">
    <div class="carrier-p">
        <div>
            <div class="author-name-p">
                <div class="author-p">Заказчик</div>
                <div class="name-p"><?=$arResult['CLIENT_INFO']['NAME']?></div>
            </div>
            <?if ($arResult['CLIENT_INFO']['ORDERS_ACTIVE'] > 0):?>
            <div class="active-order-p">Активные заказы <span><?=$arResult['CLIENT_INFO']['ORDERS_ACTIVE']?></span></div>
            <?endif?>
            
        </div>
        <div class="clear">
        </div>
        <div>
            <div class="torgi-p">
                <div class="torgi-hod-p">Торги</div>
                <div class="status-p"><?=$arResult['ACTIVE'] == 'Y' ? "Активны" : "Завершены"?></div>
            </div>
            <div class="create-p">
                <div class="create-tag-p">Создан:</div>
                <div class="create-date-p"><?=$arResult['DATE_CREATE']?></div>
            </div>
            <div class="views-p">
                <p>Просмотров: <?=$arResult['SHOW_COUNTER']?></p>
                <?/*<p>За сегодня: 17</p>*/?>
            </div>
            <div class="clear">
            </div>
        </div>
        <div class="description-info-p">
            <div class="bg-white">
                <div class="tag-desc-p">Описание</div>
                <div class="desc-p"><?=$arResult['DETAIL_TEXT']?></div>
                <div class="clear"></div>
            </div>
            
            <?if (!empty($arResult['DISPLAY_PROPERTIES']['CAPACITY']['VALUE']) || !empty($arResult['DISPLAY_PROPERTIES']['WEIGHT']['VALUE'])):?>
            <div class="bg-white">
                <div class="tag-desc-p">Вес / Объем</div>
                <div class="desc-p">
                    <span class="m3"><?=!empty($arResult['DISPLAY_PROPERTIES']['CAPACITY']['VALUE']) ? $arResult['DISPLAY_PROPERTIES']['CAPACITY']['VALUE'] : "—"?> м3</span>
                    <span class="kg"><?=!empty($arResult['DISPLAY_PROPERTIES']['WEIGHT']['VALUE']) ? $arResult['DISPLAY_PROPERTIES']['WEIGHT']['VALUE'] : "—"?> кг</span>
                </div>
                <div class="clear"></div>
            </div>
            <?endif?>
            
            <div class="bg-white">
                <div class="tag-desc-p">Дата перевозки</div>
                <div class="desc-p"><?=!empty($arResult['DISPLAY_PROPERTIES']['ORDER_DATE_DATE']['VALUE']) ? $arResult['DISPLAY_PROPERTIES']['ORDER_DATE_DATE']['VALUE'] : "—"?></div>
                <div class="clear"></div>
            </div>
            <div class="bg-white">
                <div class="tag-desc-p">Время перевозки</div>
                <div class="desc-p"><?=!empty($arResult['DISPLAY_PROPERTIES']['ORDER_DATE_TIME']['VALUE']) ? $arResult['DISPLAY_PROPERTIES']['ORDER_DATE_TIME']['VALUE'] : "—"?></div>
                <div class="clear"></div>
            </div>
            <!--
            <div class="bg-white">
                <div class="tag-desc-p">Макс. цена</div>
                <div class="desc-p">400 000 руб.</div>
                <div class="clear"></div>
            </div>
            <div class="bg-white">
                <div class="tag-desc-p">Окончание торгов</div>
                <div class="desc-p">15 Апрель 2014</div>
                <div class="clear"></div>
            </div>
            -->
        </div>
    </div>
    <div class="way-map-p">
        <div class="way-a-p">A</div>
        <div class="way-a-d-p">
            <p style="font-size: 18px;"><?=$arResult['DISPLAY_PROPERTIES']['FROM_CITY']['VALUE']?></p>
            
            <?if (!empty($arResult['DISPLAY_PROPERTIES']['FROM_REGION']['VALUE'])):?>
            <p style="font-size: 16px;"><?=$arResult['DISPLAY_PROPERTIES']['FROM_REGION']['VALUE']?></p>
            <?endif?>
            
            <?if (!empty($arResult['DISPLAY_PROPERTIES']['FROM_ADDRESS']['VALUE'])):?>
            <p style="font-size: 14px;"><?=$arResult['DISPLAY_PROPERTIES']['FROM_ADDRESS']['VALUE']?></p>
            <?endif?>
        </div>
        <div class="way-km-p"><?=!empty($arResult['DISPLAY_PROPERTIES']['DISTANCE']['VALUE']) ? $arResult['DISPLAY_PROPERTIES']['DISTANCE']['VALUE'] : "—"?> км</div>
        <div class="way-b-p">B</div>
        <div class="way-b-d-p">
            <p style="font-size: 18px;"><?=$arResult['DISPLAY_PROPERTIES']['TO_CITY']['VALUE']?></p>
            
            <?if (!empty($arResult['DISPLAY_PROPERTIES']['TO_REGION']['VALUE'])):?>
            <p style="font-size: 16px;"><?=$arResult['DISPLAY_PROPERTIES']['TO_REGION']['VALUE']?></p>
            <?endif?>
            
            <?if (!empty($arResult['DISPLAY_PROPERTIES']['TO_ADDRESS']['VALUE'])):?>
            <p style="font-size: 14px;"><?=$arResult['DISPLAY_PROPERTIES']['TO_ADDRESS']['VALUE']?></p>
            <?endif?>
        </div>
        <div class="clear">
        </div>
        <div id="map-p" class="map-p" style="width: 618px;  height: 335px"></div>
    </div>
    <div class="clear">
    </div>
</div>

<?if (in_array($arParams['USER_TYPE_GROUPS']['TYPE_TRANSPORTERS'], $arParams['USER_GROUPS']) && $arResult['ACTIVE'] == 'Y'):?>
<div>
    <div class="stavka-title">
        Сделать предложение заказчику
        <form action="#" method="POST" id="registration" style="margin-top: 10px; margin-bottom: 0px;">
            <p>
                <input type="text" name="stavka" id="stavka" placeholder="Сумма">
                <input type="submit" data-element_id="<?=$arResult['ID']?>" data-owner_id="<?=$arResult['DISPLAY_PROPERTIES']['CLIENT_USER_ID']['VALUE']?>" data-owner_email="<?=$arResult['DISPLAY_PROPERTIES']['CONTACTS_EMAIL']['VALUE']?>" data-user_id="<?=$USER->GetID()?>" class="button" value="Отправить ставку">
            </p>
            <p id="stavka_komission">Комиссионные отчисления составят: <span id="stavka_komission_value">0</span> руб.</p>
        </form>
    </div>
</div>
<?endif?>

<?
//pred(array($arResult['BETS_INFO']));
if (!empty($arResult['BETS_INFO']) && $arResult['ACTIVE'] == 'Y'):?>
<div>
    <div class="rate-title">Ставки</div>
    <div class="rate-p">
        <table>
            <tr>
                <th style="width: 143px;">Ставка</th>
                <th style="width: 298px;">Исполнитель</th>
                <th style="width: 148px;">Услуги</th>
                <th style="width: 120px;">Дата</th>
                <?
                if (in_array($arParams['USER_TYPE_GROUPS']['TYPE_TRANSPORTERS'], $arParams['USER_GROUPS'])):?>
                <th style="width: 113px;">Отмена заказа</th>
                <?elseif (in_array($arParams['USER_TYPE_GROUPS']['TYPE_CUSTOMERS'], $arParams['USER_GROUPS'])):?>
                <th style="width: 113px;">Принять ставку</th>
                <?endif?>
            </tr>
            <?
            foreach ($arResult['BETS_INFO']['BETS'] as $index => $arBet):
            if ($index > 4 && empty($_REQUEST['show_all']))
                continue;
            ?>
            <tr>
                <td><?=number_format($arBet['PROPERTY_BET_SUMM_VALUE'], 0, "", " ");?> р.</td>
                <td class="ispol">
                    <a href="/carrier/carrier-info/?id=<?=$arBet['PROPERTY_USER_ID_VALUE']?>">
                        <?if (!empty($arResult['BETS_INFO']['CARRIERS'][$arBet['PROPERTY_USER_ID_VALUE']]['AVATAR']['src'])):?>
                        <img src="<?=$arResult['BETS_INFO']['CARRIERS'][$arBet['PROPERTY_USER_ID_VALUE']]['AVATAR']['src']?>" alt=""/><?=$arResult['BETS_INFO']['CARRIERS'][$arBet['PROPERTY_USER_ID_VALUE']]['WORK_COMPANY']?>
                        <?else:?>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/bublik.png" alt=""/><?=$arResult['BETS_INFO']['CARRIERS'][$arBet['PROPERTY_USER_ID_VALUE']]['WORK_COMPANY']?>
                        <?endif?>
                    </a>
                    <div class="rate-star">
                    <?
                    $rating = $arResult['BETS_INFO']['CARRIERS'][$arBet['PROPERTY_USER_ID_VALUE']]['RATING'];
                    echo str_repeat('<img src="'.SITE_TEMPLATE_PATH.'/img/star-a.png" />', (intval($rating)));
                    if ($rating < 5)
                        echo str_repeat('<img src="'.SITE_TEMPLATE_PATH.'/img/star.png" />', (round(5 - intval($rating))));
                    ?>
                    </div>
                </td>
                <td>Перевозка</td>
                <td><?=$arBet['CREATED_DATE']?></td>
                <?if ($USER->IsAuthorized()):?>
                <td style="vertical-align: middle;">
                    <?
                    // Если текущий пользователь - ПЕРЕВОЗЧИК
                    if (in_array($arParams['USER_TYPE_GROUPS']['TYPE_TRANSPORTERS'], $arParams['USER_GROUPS'])):?>
                        <?if ($arBet['PROPERTY_USER_ID_VALUE'] == $arParams['USER_ID']):?>
                            <?
                            if (
                                empty($arResult['PROPERTIES']['CARRIER_USER_ID']['VALUE']) 
                                || $arResult['PROPERTIES']['CARRIER_USER_ID']['VALUE'] != $arParams['USER_ID']
                                || $arResult['PROPERTIES']['CARRIER_USER_ACCEPTED_BET']['VALUE'] != $arBet['ID']
                            ):?>
                            <a href="<?=$APPLICATION->GetCurPageParam("bet_id=".$arBet['ID']."&action=cancel_bet", array('bet_id', 'action'), false)?>" class="button-p" onclick="return confirm('Вы подтверждаете отмену ставки?')">Отменить</a>
                            <?elseif ($arResult['PROPERTIES']['CARRIER_USER_ID']['VALUE'] == $arParams['USER_ID']):?>                                                                                     
                            <a href="<?=$APPLICATION->GetCurPageParam("bet_id=".$arBet['ID']."&action=carrier_accept_bet&add_id=".$arResult['ID'], array('bet_id', 'action'), false)?>" class="button-p" onclick="return confirm('Вы подтверждаете перевозку по данному заказу?')">Подтвердить</a>
                            <?endif?>
                        <?else:?>
                        —
                        <?endif?>
                    <?
                    // Если текущий пользователь - КЛИЕНТ
                    elseif (
                        in_array($arParams['USER_TYPE_GROUPS']['TYPE_CUSTOMERS'], $arParams['USER_GROUPS']) 
                        && $arResult['DISPLAY_PROPERTIES']['CLIENT_USER_ID']['VALUE'] == $arParams['USER_ID']
                    ):
                        if (
                            $arBet['PROPERTY_USER_ID_VALUE'] != $arResult['PROPERTIES']['CARRIER_USER_ID']['VALUE']
                            || $arResult['PROPERTIES']['CARRIER_USER_ACCEPTED_BET']['VALUE'] != $arBet['ID']
                        ):
                        ?>
                        <a href="<?=$APPLICATION->GetCurPageParam("bet_id=".$arBet['ID']."&bet_owner=".$arBet['PROPERTY_USER_ID_VALUE']."&action=accept_bet&add_id=".$arResult['ID'], array('bet_id', 'action'), false)?>" class="button-p" onclick="return confirm('Вы подтверждаете выбор этой ставки?')">Принять</a>
                        <?else:?>
                        <a href="<?=$APPLICATION->GetCurPageParam("bet_id=".$arBet['ID']."&bet_owner=".$arBet['PROPERTY_USER_ID_VALUE']."&action=cancel_carrier&add_id=".$arResult['ID'], array('bet_id', 'action'), false)?>" class="button-p" onclick="return confirm('Вы подтверждаете отказ от выбора данного перевозчика?')">Отказаться</a>
                        <?endif?>
                    <?else:?>
                    <?endif?>
                </td>
                <?endif?>
            </tr>
            <?endforeach?>
        </table>
        <div class="predlj">
			<?php
			/*
			if(isset($_GET['true']) === true)
			{
				// это будет идти обработчик, который будет проверять, на то показать юзеру данное поле или нет,я имею ввиду коммент
				// сейчас нужно определить это пользователь который авторизирован, он владелец этого материала... затем нужно после определить это исполнитель
				$sql_00com = $db->prepare("
											SELECT
													*
											FROM
													`b_comments`
											JOIN
													`b_user`
											ON
													`b_user`.`` = `b_comments`.`USER_ID`
											JOIN
													``
											ON
													``.`` = `b_comments`.``
											WHERE
													`b_comments`.`USER_ID` = :__user_id_comments
											AND
													`b_comments`.`PAGE_ID` = :__get
										");
				$arBet['PROPERTY_USER_ID_VALUE'] /// исполнитель - его ид
				$_ = $arResult['ID']; // заказчик, по этому имени нужно вытащить ид
				$sql_00com->bindParam(':__user_id_comments', $__user_id_comments, PDO::PARAM_STR);
				$sql_00com->bindParam(':__get', $__get, PDO::PARAM_STR);
				$sql_00com->execute();
				$sql_00com->setFetchMode(PDO::FETCH_ASSOC);
				$row__00com = $sql_00com->fetch();
			}
			*/
			// вывод комментариев
			$sql_00com = $db->prepare("
										SELECT
												*
										FROM
												`b_comments`
										JOIN
												`b_user`
										ON
												`b_comments`.`USER_ID` = `b_user`.`ID`
										WHERE
												`b_comments`.`PAGE_ID` = :__page_id_html_comments
									");
			$__page_id_html_comments = $arResult['ID'];
			$sql_00com->bindParam(':__page_id_html_comments', $__page_id_html_comments, PDO::PARAM_STR);
			$sql_00com->setFetchMode(PDO::FETCH_ASSOC);
			$sql_00com->execute();
			?>
			<h3>Комментарии</h3>
			<style>
				.comments_container li button
				{
					background: #77aa3f;
					border:1px solid #77aa3f;
					border-radius: 4px;
					color: #fff;
					display: inline-block;
					height: 27px;
					font-size: 12px;
					line-height: 27px;
					margin-bottom:10px;
					padding: 0 10px;
				}
				.comments_container li button:hover
				{
					text-decoration:underline;
				}
				.message_components
				{
					background-color:#fff;
					font-size:16px;
					margin-bottom:20px;
					padding:10px;
					width:1145px;
				}
				div.comments_row a.delete_comments
				{
					font-size:12px;
					position:absolute;
					right:0;
				}
				div.comments_row li
				{
					position:relative;
				}
				.date_comments
				{
					color:#a0a0a0;
				}
			</style>
			<?php
			if(!$USER->IsAuthorized())
			{
				?>
				<p class="message_components">Только авторизированные пользователи могут читать сообщения</p>
				<?php
			}
			else
			{
				while($row__00com = $sql_00com->fetch())
				{
					?>
					<div class="comments_container_for_users id-<?=$row__00com['ID']?>">
						<div class="comments_row">
							<ul>
								<li>
									<a href="/carrier/carrier-info/?id=<?=$row__00com['ID']?>"><?=$row__00com['WORK_COMPANY']?></a>
									<span class="date_comments"><?=$row__00com['DATE']?></span>
								</li>
								<li>
									<p><?=$row__00com['TEXT']?></p>
								</li>
							</ul>
						</div>
					</div>
					<?php
				}
				
				if(isset($_POST['submit_comments']) === true)
				{
					$sql_00add_comment = $db->prepare("
														INSERT INTO `b_comments`(
																	`TEXT`,
																	`USER_ID`,
																	`PAGE_ID`,
																	`DATE`
															  )
														VALUES(
																	:__text_postcomments,
																	:__user_id_comments,
																	:__get_id,
																	:__date_comments
															  )
													");
					$__text_postcomments = $_POST['comments'];
					$__user_id_comments = $_POST['user_id_login'];
					$__get_id = $_POST['address_link'];
					$__date_comments = date("m.d.y H:i");
					$sql_00add_comment->bindParam(':__text_postcomments', $__text_postcomments, PDO::PARAM_STR);
					$sql_00add_comment->bindParam(':__user_id_comments', $__user_id_comments, PDO::PARAM_STR);
					$sql_00add_comment->bindParam(':__get_id', $__get_id, PDO::PARAM_STR);
					$sql_00add_comment->bindParam(':__date_comments', $__date_comments, PDO::PARAM_STR);
					$sql_00add_comment->execute();
					?>
					<script >window.location.replace("/catalog/" + <?=$_POST['address_link']?> + ".html"); </script>
					<?php
				}
				?>
				<form method="post">
					<ul class="comments_container">
						<li class="first_li_comm">Ваш комментарий:<br />
							<textarea class="comments" name="comments"></textarea>
							<input type="hidden" name="address_link" value="<?=$arResult['ID']?>">
							<input type="hidden" name="user_id_login" value="<?=$USER->GetID()?>">
						</li>
						<li>
							<button type="submit" name="submit_comments">Отправить комментарий</button>
						</li>
					</ul>
				</form>
			<?php
			}
			// данное поле должны видеть только лишь залогининные, а для этого нужно создать условие нужное
			// конец условия
			/*
			if()
			{
				// страница пользователя, будет определяться по иду, в верху страницы а так же нужно определить человека, который заказал тоже по иду... и на этой основе уже определить показать юзеру данный коммент
				?>
				<div class="comments">
					
				</div>
				<?php
			}
			*/
			?>
            <p>Все предложения окончательные - без доплат.</p>
            <p>Если перевозчик потребует больше, свяжитесь со службой поддержки или укажите это в отзыве.</p>
        </div>
        <?if (empty($_REQUEST['show_all']) && count($arResult['BETS_INFO']['BETS']) > 5):?>
        <div style="margin: 0 66px 0 0; text-align: right;">
            <a style="text-decoration: underline;" href="<?=$APPLICATION->GetCurPageParam("show_all=Y", array(), false)?>">Показать все ставки</a>
        </div>
        <?endif?>
        <div class="clear">
        </div>
    </div>
    <?
    /*
    <div class="time-p">
        <div class="tag-desc-time-p">
            <div class="tag-time-p">
                Осталось
            </div>
            <div class="desc-time-p">
                — (неизвестно)
            </div>
            <div class="clear">
            </div>
        </div>
        <!--
        <div class="tag-desc-time-p">
            <div class="tag-time-p">
                Макс. цена
            </div>
            <div class="desc-time-p">
                400 000 руб.
            </div>
            <div class="clear">
            </div>
        </div>
        <div class="link-p">
            <a href="#">Как связаться с перевозчиком</a>
        </div>
        -->
    </div>
    */
    ?>
    <div class="clear">
    </div>
</div>
<?endif?>
<script type="text/javascript">
$(document).ready(function()
{
    $('#stavka').live('keyup', function()
    {
        curVal = parseInt($(this).val());
        curVal_komission = Math.floor((curVal * 9) / 100);
        
        if (curVal > 0)
        {
            $(this).closest('form').find('#stavka_komission_value').text(curVal_komission);
        }    
        else
        {
            $(this).closest('form').find('#stavka_komission_value').text('0');
        }
    });
    
    $('#registration input[type=submit]').click(function(e)
    {
        e.preventDefault();
        
        if ($('#stavka').val().length == 0)
        {
            alert('Укажите сумму ставки');
            return false;    
        }
        
        $.ajax(
        {
            url: "/ajax/ajax_bet_add.php",
            type: "POST",
            data: {
                AJAX_CALL : 'Y',
                ELEMENT_ID : $(this).data('element_id'),
                ADD_HREF : '<?=$APPLICATION->GetCurPage(false)?>',
                BET_SUMM : $('#stavka').val(),
                USER_ID : $(this).data('user_id'),
                OWNER_EMAIL : $(this).data('owner_email'),
                OWNER_ID : $(this).data('owner_id')
            },
            dataType: "json"
        })
        .done(function(json) 
        {
            if (json.STATUS == 'OK')
            {
                $('.stavka-title').text('Спасибо, ваша ставка принята. Номер ставки: ' + json.BET_ID)
                setTimeout(function()
                {
                    location.reload();
                }, 2000);
            }
            else if (json.STATUS == 'BAD')
            {
                if (json.STATUS_EXT == 'MONEY')
                {
                    if (confirm('Недостаточно средств для осуществления ставки.\nХотите пополнить счет?'))
                    {
                        location.assign('http://<?=SITE_SERVER_NAME?>/personal/carrier/account/');
                    }
                }
                else
                    alert(json.MESSAGE);
            }
                
        });
    
        return false; 
    });
    
    ymaps.ready(function () 
    {
        window.myMap = new ymaps.Map("map-p", 
        {
            center: [ymaps.geolocation.latitude, ymaps.geolocation.longitude],
            zoom: 10,
            behaviors: ["scrollZoom", "drag"]
        }); 
        
        var objects = [
            new ymaps.Placemark([<?=$arResult['DISPLAY_PROPERTIES']['FROM_COORDS']['VALUE']?>], {iconContent: "А"}),
            new ymaps.Placemark([<?=$arResult['DISPLAY_PROPERTIES']['TO_COORDS']['VALUE']?>], {iconContent: "B"})
        ];
        
        ymaps.geoQuery(objects).applyBoundsToMap(window.myMap, {checkZoomRange: true}).addToMap(window.myMap);
        
        points = [];
        points.push([<?=$arResult['DISPLAY_PROPERTIES']['FROM_COORDS']['VALUE']?>]);
        points.push([<?=$arResult['DISPLAY_PROPERTIES']['TO_COORDS']['VALUE']?>]);
        
        ymaps.route(points, {
            // Опции маршрутизатора
            // автоматически позиционировать карту
            mapStateAutoApply: true 
        }).then(function (router) {
            route = router;
            myMap.geoObjects.add(route);
        }, 
        function (error) { alert("Возникла ошибка: " + error.message);}
        );
    });
    
    function calcRoute() {        
        for(var i = 0, l = markers.length; i < l; i++) {
                point[i] = markers[i].geometry.getCoordinates();
            }
 
                    
        }
});
</script>