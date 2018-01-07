


<?IncludeTemplateLangFile(__FILE__);?>
</div>

<? if((!CSite::InDir('/index.php') && !CSite::InDir('/en/index.php') ) && !preg_match('~^/catalog/.+?/.+?|en/catalog/.+?/.+?/~', $_SERVER['REQUEST_URI'])
	&& !preg_match('~^/en/catalog/.+?/.+?/~', $_SERVER['REQUEST_URI'])){ ?>
<? include($_SERVER["DOCUMENT_ROOT"].BX_DEFAULT_TEMPLATE_PATH."/footer_inner.php"); ?>
<? } ?>

<footer class="b-footer">
	<div class="b-footer__pattern"></div>

	<div class="b-footer__socials">
		<a href="https://www.facebook.com/AnnaFindings" class="b-footer__socials-item _fb"></a>
		<a href="https://vk.com/findings" class="b-footer__socials-item _vk"></a>
		<a href="http://www.pinterest.com/anna_bronze" class="b-footer__socials-item _pi"></a>
		<a href="http://instagram.com/annabronze" class="b-footer__socials-item _in"></a>
	</div>

	<div class="b-footer__meta">
		<div class="b-footer__phone"><?=GetMessage('FOOTER_PHONE')?></div>
		<div class="b-footer__callback">
			<a href="/contacts/?scroll=form" class="btn"><?=GetMessage('CALLBACK')?></a>
		</div>

		<div class="b-footer__paysystems">
			<div class="b-footer__paysystems-item _mc"></div>
			<div class="b-footer__paysystems-item _visa"></div>
			<div class="b-footer__paysystems-item _paypal"></div>
		</div>
	</div>

	<nav class="b-footer__menu">

		<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", array(
			"ROOT_MENU_TYPE" => "bottom",
			"MENU_CACHE_TYPE" => "A",
			"MENU_CACHE_TIME" => "36000",
			"MENU_CACHE_USE_GROUPS" => "N",
			"MENU_CACHE_GET_VARS" => array(
			),
			"MAX_LEVEL" => "1",
			"CHILD_MENU_TYPE" => "left",
			"USE_EXT" => "N",
			"DELAY" => "N",
			"ALLOW_MULTI_SELECT" => "N"
		),
			false
		);?>
		<a href="<?=SITE_DIR?>search/" class="b-footer__menu-item _search"></a>
	</nav>

	<div class="clear"></div>
	<div class="b-footer__bottom">
		<div class="b-footer__bottom-copyright"><?=date("Y");?> <?=GetMessage('COPY')?></div>
		<div class="b-footer__bottom-developer"><?=GetMessage('CREATED')?> - <a href="http://amado-id.ru" class="link"
																	target="_blank"><span>Amado</span></a></div>
	</div>
</footer>
</div>


<input type="hidden" id="fancybox-error" value="<?=GetMessage('FANCYBOX_ERROR_TEXT')?>"/>


</body>
</html>