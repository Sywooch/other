<div class="b-layout__meta">
	<div class="b-layout__meta-logo"></div>
	<h1 class="b-layout__meta-title"><?$APPLICATION->ShowTitle('h1')?></h1>
</div>







<div class="b-layout__inner grid-container">
	<div class="grid-row col-1 col-xm-12 col-s-12"></div>
	<div class="b-layout__inner-column grid-row col-2 col-s-12">



		<?$APPLICATION->IncludeComponent("bitrix:menu", "inner_menu_vertical", array(
			"ROOT_MENU_TYPE" => "left",
			"MENU_CACHE_TYPE" => "A",
			"MENU_CACHE_TIME" => "33600",
			"MENU_CACHE_USE_GROUPS" => "N",
			"MENU_CACHE_GET_VARS" => "",
			"MAX_LEVEL" => "1",
			"CHILD_MENU_TYPE" => "left",
			"USE_EXT" => "N",
			"DELAY" => "N",
			"ALLOW_MULTI_SELECT" => "N" ),
			false, array( "ACTIVE_COMPONENT" => "Y" )
		);?>
		
	</div>
	<div class="b-layout__inner-content grid-row col-8 col-xm-9  col-s-12">


		<!---------content----------->



		<div class="b-layout__info-box"><!-- for content pages - content styles -->

			<div>