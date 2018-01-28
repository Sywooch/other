<?$PlayerID = rand();?>
<style type="text/css">
#alx-photoplayer1mod_<?=$PlayerID?> .block_show_cont_alx-photoplayer1mod
{
        width:<?=$arParams["BIGPICX"]?>px;
        height:<?=$arParams["BIGPICY"]+ $arParams["PREVPICY"]+10?>px;
        padding: <?=$arParams["ALLY"]?>px <?=$arParams["ALLX"]?>px;

}
#alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod
{
        width:<?=$arParams["BIGPICX"]?>px;
        padding:0px <?=$arParams["ALLX"]?>px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .slide_items_block_alx-photoplayer1mod_<?=$PlayerID?>
{
        width:<?=$arParams["BIGPICX"]?>px !important;
        height:<?=$arParams["BIGPICY"]?>px !important;
        margin: 0px auto 9px auto !important;
        padding: 0px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .discribe_block_alx-photoplayer1mod_<?=$PlayerID?>
{
        width:<?=$arParams["BIGPICX"]?>px !important;
        top: -<?=$arParams["DISCR_HEIGHT"]?>px;
        height:<?=$arParams["DISCR_HEIGHT"]?>px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .discribe_block_alx-photoplayer1mod_<?=$PlayerID?> .discribe_bg_alx-photoplayer1mod
{
         height:<?=$arParams["DISCR_HEIGHT"]?>px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .discribe_block_alx-photoplayer1mod_<?=$PlayerID?> .discribe_text_alx-photoplayer1mod
{
         line-height:<?=$arParams["DISCR_TEXT_SIZE"] + 3?>px;
         font-size:<?=$arParams["DISCR_TEXT_SIZE"]?>px;
         padding: <?=round($arParams["DISCR_HEIGHT"]/10)?>px <?=round($arParams["DISCR_HEIGHT"]/10)?>px 0px <?=round($arParams["DISCR_HEIGHT"]/10)?>px;
         height:<?=$arParams["DISCR_HEIGHT"] - 1 - 2*round($arParams["DISCR_HEIGHT"]/10)?>px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .discribe_block_alx-photoplayer1mod_<?=$PlayerID?> .discribe_text_alx-photoplayer1mod .title_alx-photoplayer1mod
{
         font-size:<?=$arParams["DISCR_TITLE_SIZE"]?>px;
         line-height:<?=$arParams["DISCR_TITLE_SIZE"] + 2?>px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .block_show_cont_alx-photoplayer1mod
{
        margin: 0px;
        background:transparent;
        text-align:center;
}
#alx-photoplayer1mod_<?=$PlayerID?> .block_show_cont_alx-photoplayer1mod ul.slide-items
{
        list-style:none !important;
        margin:0px 0px;
        padding:0px;
        position:relative;
        z-index:10;
        text-align:left;

}
#alx-photoplayer1mod_<?=$PlayerID?> .block_show_cont_alx-photoplayer1mod ul li:before {
     content: ""!important;
}
#alx-photoplayer1mod_<?=$PlayerID?> .block_show_cont_alx-photoplayer1mod ul.slide-items li
{
        position:absolute;
        margin:0px;
        padding:0px;
        z-index:90;
        text-align:center;
        display:none;
        list-style:none !important;
}
#alx-photoplayer1mod_<?=$PlayerID?> .block_show_cont_alx-photoplayer1mod ul.slide-items .pic_item_alx-photoplayer1mod img
{
        border:1px solid #FFFFFF;
}
#alx-photoplayer1mod_<?=$PlayerID?> .block_content_list .discribe_text
{
        clear:both;
        display:block;
}
#alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod
{
        margin-top:9px;
        margin-bottom:9px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .stop_bg_alx-photoplayer1mod
{
         cursor:pointer;
         cursor:hand;
         display: none;
         width:44px;
         height:39px;
         float:left;
         margin-left:12px;
         background: transparent url(/bitrix/components/altasib/photoplayer1mod/templates/.default/images/buttons_grey_big.png) no-repeat 0px 0px;
}
*html #alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .stop_bg_alx-photoplayer1mod
{
        overflow:hidden;
        background:none;
        position:relative;
        z-index:1000;
        margin-left:6px;
        zoom:1;

}
*html #alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .stop_bg_alx-photoplayer1mod img
{
        filter: progid:DXImageTransform.Microsoft.AlphaImageLoader (src='/bitrix/components/altasib/photoplayer1mod/templates/.default/images/buttons_grey_big.png', sizingMethod='scale');
        background:none;
        width:195px;
        height:38px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .play_bg_alx-photoplayer1mod
{
         cursor:pointer;
         cursor:hand;
         width:44px;
         height:39px;
         float:left;
         margin-left:12px;
         background: transparent url(/bitrix/components/altasib/photoplayer1mod/templates/.default/images/buttons_grey_big.png) no-repeat -50px 0px;
}
*html #alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .play_bg_alx-photoplayer1mod
{
        overflow:hidden;
        background:none;
        zoom:1;
                 margin-left:6px;
}
*html #alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .play_bg_alx-photoplayer1mod img
{
        filter: progid:DXImageTransform.Microsoft.AlphaImageLoader (src='/bitrix/components/altasib/photoplayer1mod/templates/.default/images/buttons_grey_big.png', sizingMethod='scale');
        background:none;
        width:195px;
        margin-left:-50px;
        height:38px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .jcarousel-prev1_alx-photoplayer1mod
{
         cursor:pointer;
         cursor:hand;
         width:44px;
         height:39px;
         float:left;
         margin-left:10px;
         background: transparent url(/bitrix/components/altasib/photoplayer1mod/templates/.default/images/buttons_grey_big.png) no-repeat -100px 0px;
}
*html #alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .jcarousel-prev1_alx-photoplayer1mod
{
        overflow:hidden;
        background:none;
         margin-left:5px;
}
*html #alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .jcarousel-prev1_alx-photoplayer1mod img
{
        filter: progid:DXImageTransform.Microsoft.AlphaImageLoader (src='/bitrix/components/altasib/photoplayer1mod/templates/.default/images/buttons_grey_big.png', sizingMethod='scale');
        background:none;
        width:195px;
        margin-left:-100px;
        height:38px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .jcarousel-next1_alx-photoplayer1mod
{
         cursor:pointer;
         cursor:hand;
         width:44px;
         height:39px;
         float:left;
         margin-left:10px;
         background: transparent url(/bitrix/components/altasib/photoplayer1mod/templates/.default/images/buttons_grey_big.png) no-repeat -150px 0px;
}
*html #alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .jcarousel-next1_alx-photoplayer1mod
{
        overflow:hidden;
display:inline !important;
         margin-left:5px;
        background:none;
}
*html #alx-photoplayer1mod_<?=$PlayerID?> .nav_blocks_alx-photoplayer1mod .jcarousel-next1_alx-photoplayer1mod img
{
        filter: progid:DXImageTransform.Microsoft.AlphaImageLoader (src='/bitrix/components/altasib/photoplayer1mod/templates/.default/images/buttons_grey_big.png', sizingMethod='scale');
        background:none;
        width:195px;
        margin-left:-150px;
        height:38px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .jcarousel-skin-tango_alx-photoplayer1mod .jcarousel-direction-rtl
{
        direction: rtl;
}
#alx-photoplayer1mod_<?=$PlayerID?> .jcarousel-clip
{
}
#alx-photoplayer1mod_<?=$PlayerID?> .jcarousel-container
{
        text-align:center;
        margin: 0px auto;
}
#alx-photoplayer1mod_<?=$PlayerID?> .jcarousel-skin-tango_alx-photoplayer1mod .jcarousel-item a.jcarousel-item-pict_alx-photoplayer1mod
{
        background-color:#383838 !important;
        background-repeat:no-repeat !important;
        background-position:center center !important;
        border:1px solid #F5F5F5 !important;
}
#alx-photoplayer1mod_<?=$PlayerID?> .jcarousel-skin-tango_alx-photoplayer1mod .jcarousel-item a.jcarousel-item-pict_alx-photoplayer1mod:hover
{

        cursor: pointer;
        filter:progid:DXImageTransform.Microsoft.Alpha(opacity=100);
        -moz-opacity: 1.0;
        -khtml-opacity: 1.0;
        opacity: 1.0;
}
#alx-photoplayer1mod_<?=$PlayerID?> .jcarousel-skin-tango_alx-photoplayer1mod .jcarousel-item a.page_nav_selected
{
        filter:progid:DXImageTransform.Microsoft.Alpha(opacity=100);
        -moz-opacity: 1.0;
        -khtml-opacity: 1.0;
        opacity: 1.0;

}
#alx-photoplayer1mod_<?=$PlayerID?> .jcarousel-skin-tango_alx-photoplayer1mod a:focus
{
        outline:none;
}
#alx-photoplayer1mod_<?=$PlayerID?> .jcarousel-skin-tango_alx-photoplayer1mod .jcarousel-item-horizontal
{
        margin-left: 0;
}
#alx-photoplayer1mod_<?=$PlayerID?> .jcarousel-skin-tango_alx-photoplayer1mod .jcarousel-direction-rtl .jcarousel-item-horizontal
{
        margin-left: 10px;
        margin-right: 0;
}
#alx-photoplayer1mod_<?=$PlayerID?> .jcarousel-skin-tango_alx-photoplayer1mod .jcarousel-item-placeholder
{
        background: #fff;
        color: #000;
}
#alx-photoplayer1mod_<?=$PlayerID?> .block_show_cont_alx-photoplayer1mod .clear_block
{
        padding: 0px;
        margin: 0px;
        height:1px;
        clear:both;
        overflow:hidden;
}
#alx-photoplayer1mod_<?=$PlayerID?> .no_pic_load
{
        position:absolute;
        z-index:20;
        display:block;
}
#alx-photoplayer1mod_<?=$PlayerID?> #mycarousel_<?=$PlayerID?>
{
    background:url(/bitrix/components/altasib/photoplayer1mod/templates/.default/images/spacer.gif) 0px 0px;
    z-index:100;
    margin:0px auto;
    /*left:1px;*/
    text-align:left;
    position:relative;
}
#alx-photoplayer1mod_<?=$PlayerID?> .sel_item_block_alx-photoplayer1mod
{
        position:absolute;
        z-index:4;
        margin-top:-13px;
        left: 0px;
        top: 0px;
        text-align:center;
        padding-right:2px;
        padding-bottom:1px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .sel_item_block_bg_alx-photoplayer1mod
{
        background:url(/bitrix/components/altasib/photoplayer1mod/templates/.default/images/sel_item_bg.png) 0px 0px no-repeat;
        height:14px;
        width:19px;
        position:relative;
        z-index:2;
        overflow:hidden;
        margin: 0px auto;
}
*html #alx-photoplayer1mod_<?=$PlayerID?> .sel_item_block_bg_alx-photoplayer1mod
{
        filter: progid:DXImageTransform.Microsoft.AlphaImageLoader (src='/bitrix/components/altasib/photoplayer1mod/templates/.default/images/sel_item_bg.png', sizingMethod='scale');
        background:none;
}
#alx-photoplayer1mod_<?=$PlayerID?> .border_sel_alx-photoplayer1mod
{
        border:1px solid #F5F5F5;
        position:relative;
        z-index:1;
        margin-top:-2px;
}
#alx-photoplayer1mod_<?=$PlayerID?> .border_sel_alx-photoplayer1mod div
{
        border:1px solid #F5F5F5;
}
#alx-photoplayer1mod_<?=$PlayerID?> .discribe_block_alx-photoplayer1mod_<?=$PlayerID?>
{
        position:absolute;
        z-index:100;
        left: 0px;
        top: -87px;
        height:87px;
        display: none;
}
#alx-photoplayer1mod_<?=$PlayerID?> .discribe_block_alx-photoplayer1mod_<?=$PlayerID?> .discribe_bg_alx-photoplayer1mod
{
        background:#000000;
        filter:progid:DXImageTransform.Microsoft.Alpha(opacity=40);
        -moz-opacity: 0.4;
        -khtml-opacity: 0.4;
        opacity: 0.4;
        position:absolute;
        z-index:1;
         width:100%;
}
#alx-photoplayer1mod_<?=$PlayerID?> .discribe_block_alx-photoplayer1mod_<?=$PlayerID?> .discribe_text_alx-photoplayer1mod
{
        color:#ffffff;
        position:relative;
        text-align:left;
        overflow:hidden;
        z-index:2;
}
#alx-photoplayer1mod_<?=$PlayerID?> .discribe_block_alx-photoplayer1mod_<?=$PlayerID?> .discribe_text_alx-photoplayer1mod .title_alx-photoplayer1mod
{
        font-weight:bold;
        margin-bottom:7px;
}
</style>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?//p($arResult);?>



<div id="alx-photoplayer1mod_<?=$PlayerID?>" style="background-color:transparent !important; width:800px !important; ">

<?$wrap = $arResult["WRAP"];?> 
<?if($arResult["ITEMS"]):?>
    <?$count_el = count($arResult["ITEMS"]);
        $num_visible = $arParams["BIGPICX"] / ($arParams["PREVPICX"] + $arParams["INTERVAL"]);
        $num_vis_half = (integer)($num_visible / 2);?>

	<div class="center_pic_content block_show_cont_alx-photoplayer1mod" style="background-color:transparent !important; width:800px !important; padding:0 !important;">
		<div align="center" class="slide_items_block_alx-photoplayer1mod_<?=$PlayerID?>" style="dispay:none; width:800px !important;">
			<ul id="container_<?=$PlayerID?>" class="slide-items" style="width:800px !important; background-color:transparent !important; ">
                        <?for($i=0; (($i<$num_vis_half)&&($wrap == null)); $i++):?>
				<li style=" width:800px !important;">
                                     <span class="pic_item_ alx-photoplayer1mod"><?echo CFile::ShowImage("/bitrix/components/altasib/photoplayer1mod/templates/.default/images/spacer.gif", $arParams["BIGPICX"], $arParams["BIGPICY"], 'border="0" style=""', "", false);?></span>
                            </li>
                        <?endfor;?>
                        <?foreach($arResult["ITEMS"] as $arElement):?>
				<li style="width:800px !important; background-color:transparent !important;">
                                        <<?if ($arParams["SHOW_FANCYBOX"] == "Y"):?>a href="<?=$arElement["ORIGINAL_PICT"][$arResult["SOURCE"]]?>"<?else:?>span<?endif;?> class="pic_item_alx-photoplayer1mod">
                                        <?if(isset($arElement["P"]["DETAIL_SRC"])):?>
                                            <img src="<?=$arElement["P"]["DETAIL_SRC"]?>" <?=$arElement["P"]["DETAIL_SRC_SIZE"]?> border="0" style="">
                                        <?else:?>
                                            <?echo CFile::ShowImage($arElement[$arElement["PICT"]], $arParams["BIGPICX"], $arParams["BIGPICY"], 'border="0" style=""', "", false);?>
                                        <?endif;?>
                                        </<?if ($arParams["SHOW_FANCYBOX"] == "Y"):?>a<?else:?>span<?endif;?>>
					<div class="discribe_block_alx-photoplayer1mod_<?=$PlayerID?>" style="width:800px !important;">
                                                <div class="discribe_bg_alx-photoplayer1mod">&nbsp;</div>
                                                <div class="discribe_text_alx-photoplayer1mod">
                                                        <div class="title_alx-photoplayer1mod"><?=$arElement["NAME"];?></div>
                                                        <?=$arElement[$arElement["TEXT"]]?>
                                                </div>
                                        </div>
                                </li>
                        <?endforeach?>
                        <?for($i=0; (($i<$num_vis_half)&&($wrap == null)); $i++):?>
				<li style="width:800px !important; ">
                                    <span class="pic_item_alx-photoplayer1mod"><?echo CFile::ShowImage("/bitrix/components/altasib/photoplayer1mod/templates/.default/images/spacer.gif", $arParams["BIGPICX"], $arParams["BIGPICY"], 'border="0" style=""', "", false);?></span>
                            </li>
                        <?endfor;?>
                </ul> 
        </div>
      <noindex>
        <div id="link_<?=$PlayerID?>"  onmousewheel="MouseScroll_<?=$PlayerID?>(event);return false;" >
               <div id="mycarousel_front_<?=$PlayerID?>" class="jcarousel-front"></div>
                <div id="mycarousel_<?=$PlayerID?>" class="jcarousel-skin-tango_alx-photoplayer1mod"  style="display:none">
                   <div class="sel_item_block_alx-photoplayer1mod" style="width:<?=$arParams["PREVPICX"]+4?>px; margin-left:<?=($arParams["PREVPICX"]+2)*$num_vis_half+$arParams["INTERVAL"]*$num_vis_half -1?>px">
                        <div class="sel_item_block_bg_alx-photoplayer1mod">&nbsp;</div>
                        <div class="border_sel_alx-photoplayer1mod">
                                <div style="width:<?=$arParams["PREVPICX"]?>px; height:<?=$arParams["PREVPICY"]?>px; overflow:hidden;">&nbsp;</div>
                        </div>
                        </div>
                    <ul>
                        <?if (!empty($arResult["ITEMS"])):?>
                            <?for($i=0; (($i<$num_vis_half)&&($wrap == null)); $i++):?>
                                <li><div class="jcarousel-item-pict_alx-photoplayer1mod a_hov_m" id="a_<?=$PlayerID?>_<?=$i?>" style="background-image:url('/bitrix/components/altasib/photoplayer1mod/templates/.default/images/spacer.gif');width:<?=$arParams["PREVPICX"]?>px; height:<?=$arParams["PREVPICY"]?>px; overflow:hidden; display: block"></div></li>
                            <?endfor;?>
                            <?for($i=0; $i<$count_el; $i++):?>
                                <li><a href="#" class="jcarousel-item-pict_alx-photoplayer1mod a_hov_m" id="a_<?=$PlayerID?>_<?=$i+$num_vis_half?>" style="background-image:url(<?=$arResult["ITEMS"]["$i"]["P"]["SRC"]?>);width:<?=$arParams["PREVPICX"]?>px; height:<?=$arParams["PREVPICY"]?>px; overflow:hidden; display: block"></a></li>
                            <?endfor;?>
                            <?for($i=0; (($i<$num_vis_half)&&($wrap == null)); $i++):?>
                                <li><div class="jcarousel-item-pict_alx-photoplayer1mod a_hov_m" id="a_<?=$PlayerID?>_<?=$i+$num_vis_half+$count_el?>" style="background-image:url('/bitrix/components/altasib/photoplayer1mod/templates/.default/images/spacer.gif');width:<?=$arParams["PREVPICX"]?>px; height:<?=$arParams["PREVPICY"]?>px; overflow:hidden; display: block"></div></li>
                            <?endfor;?>
                        <?endif;?>
                    </ul>
                </div>
        </div>
         </noindex>
		
        </div>
		
		   
        <div class="nav_blocks_alx-photoplayer1mod" id="nav_blocks_<?=$PlayerID?>" style="visibility: hidden;">
                <table cellpadding="0" cellspacing="0" border="0" align="center">
                     <tr>
                        <?if($arParams["SHOW_BUTTONS"] == 'Y'):?>
                            <td>
                                <div style="width:170px;">
                                    <div id="jcar_prev1_<?=$PlayerID?>" class="jcarousel-prev1_alx-photoplayer1mod"><img src="/bitrix/components/altasib/photoplayer1mod/templates/.default/images/spacer.gif" alt="<" /></div>
                                    <?if($arParams["SHOW_AUTO"] == 'Y'):?>
                                          <div class="stop_bg_alx-photoplayer1mod" id="jcar_stop_<?=$PlayerID?>"><img src="/bitrix/components/altasib/photoplayer1mod/templates/.default/images/spacer.gif" alt="" /></div>
                                          <div class="play_bg_alx-photoplayer1mod" id="jcar_start_<?=$PlayerID?>"><img src="/bitrix/components/altasib/photoplayer1mod/templates/.default/images/spacer.gif" alt="" /></div>
                                    <?endif;?>
                                    <div id="jcar_next1_<?=$PlayerID?>" class="jcarousel-next1_alx-photoplayer1mod"><img src="/bitrix/components/altasib/photoplayer1mod/templates/.default/images/spacer.gif" alt=">" /></div>
                                </div>
                            </td>
                        <?else:?>
                            <td>
                                <div style="width:170px;">
                                    <div id="jcar_prev1_<?=$PlayerID?>"></div>
                                    <div id="jcar_next1_<?=$PlayerID?>"></div>
                                </div>
                            </td>
                        <?endif;?>
                     </tr>
                </table>
		</div>

    <script type="text/javascript">
        height_all = <?=$arParams["BIGPICY"]?>;
        width_all = <?=$arParams["BIGPICX"]?>;

        function slide_onClick_<?=$PlayerID?>(ind)
        {
                window.jsAdvRoll_<?=$PlayerID?>.options.id = ind;
                window.jsAdvRoll_<?=$PlayerID?>.showElement();
                k = ind;
                if (jQuery('#mycarousel_<?=$PlayerID?>').data('jcarousel'))
                    jQuery('#mycarousel_<?=$PlayerID?>').data('jcarousel').stopAuto();
                link_sel_<?=$PlayerID?>(ind);
        };
        function link_sel_<?=$PlayerID?>(el)
        {
            if (el==='')
                 el = window.jsAdvRoll_<?=$PlayerID?>.options.id;
            else
                 el = $('#link_<?=$PlayerID?> a.jcarousel-item-pict_alx-photoplayer1mod:eq('+el+')');

            $('#link_<?=$PlayerID?> a.jcarousel-item-pict_alx-photoplayer1mod').removeClass('page_nav_selected');
            $(el).addClass("page_nav_selected");
        };
        $(document).ready(function() {
                var flag_mousedown = false;
                var flag_mousemove = false;
                var start_x = 0;
                var timer = null;
                $('#mycarousel_<?=$PlayerID?>').css('display', 'block');
                $('.slide_items_block_alx-photoplayer1mod').css('display', 'block');
                $('#nav_blocks_<?=$PlayerID?>').css('visibility', 'visible');

                $('.discribe_block_alx-photoplayer1mod_<?=$PlayerID?>').delay(1500).fadeIn(1500);

                $('#block_content_list').fadeIn(1000,
                   function () {
                           $('#nav_blocks_<?=$PlayerID?>').fadeIn(1000);
                         });
                $('#mycarousel_<?=$PlayerID?>').mousedown(function(e){
                    flag_mousedown = true;
                    $('#mycarousel_<?=$PlayerID?> a').removeClass("a_hov_m");
                    start_x = e.pageX;
                    return false;
                });
                $('#mycarousel_<?=$PlayerID?>').mousemove(function(e){
                    if(flag_mousedown)
                    {
                        if (<?=$arParams["SPEED"];?> < 300)
                            jQuery('#mycarousel_<?=$PlayerID?>').data('jcarousel').options.animation = <?=$arParams["SPEED"];?>;
                        else
                            jQuery('#mycarousel_<?=$PlayerID?>').data('jcarousel').options.animation = 300;
                        $('#jcar_start_<?=$PlayerID?>').css('display', 'block');
                        $('#jcar_stop_<?=$PlayerID?>').css('display', 'none');
                        window.jsAdvRoll_<?=$PlayerID?>.stop_auto();
                        if(e.pageX > parseInt(start_x)+10)
                        {
                                flag_mousemove = true;
                                start_x = e.pageX;
                                $('#jcar_prev1_<?=$PlayerID?>').click();
                        }
                        else if(e.pageX < parseInt(start_x)-10)
                             {
                                    flag_mousemove = true;
                                    start_x = e.pageX;
                                    $('#jcar_next1_<?=$PlayerID?>').click();
                             }
                        jQuery('#mycarousel_<?=$PlayerID?>').data('jcarousel').options.animation = <?=$arParams["SPEED"];?>;
                    }
                    return false;
                });

                $('#mycarousel_<?=$PlayerID?>').mouseup(function(e){
                    flag_mousedown = false;
                    $('#mycarousel_<?=$PlayerID?> a').addClass("a_hov_m");
                    return false;
                });
                $('#mycarousel_<?=$PlayerID?>').mouseleave(function(){
                    flag_mousedown = false;
                    $('#mycarousel_<?=$PlayerID?> a').addClass("a_hov_m");
                    return false;
                });

                var elem = document.getElementById ("link_<?=$PlayerID?>");
                if (elem.addEventListener)
                    elem.addEventListener ("DOMMouseScroll", MouseScroll_<?=$PlayerID?>, false);

                var k = <?=$num_vis_half?>;
                //var JCALXAdvRoll_<?=$PlayerID?> = JCALXAdvRoll;
                window.jsAdvRoll_<?=$PlayerID?> = new JCALXAdvRoll("<?=$PlayerID?>", {
                    "animationtype":    "<?=$arParams['ANIMATION_TYPE']?>",
                    "speed":            <?=$arParams["SPEED"]?>,
                    "id":           0,
                    "max_height":   height_all,
                    "max_width":    width_all,
                    "auto":         true
                });
                window.jsAdvRoll_<?=$PlayerID?>.init();
                $('#jcar_stop_<?=$PlayerID?>').click(function () {
                     $('#jcar_start_<?=$PlayerID?>').css('display', 'block');
                     $('#jcar_stop_<?=$PlayerID?>').css('display', 'none');
                     window.jsAdvRoll_<?=$PlayerID?>.stop_auto();
                });
                $('#jcar_start_<?=$PlayerID?>').click(function () {
                     window.jsAdvRoll_<?=$PlayerID?>.start_auto(<?=$arParams["TIMEOUT"]?>, <?=$count_el?>);
                     $('#jcar_start_<?=$PlayerID?>').css('display', 'none');
                     $('#jcar_stop_<?=$PlayerID?>').css('display', 'block');
                });
                $('#jcar_prev1_<?=$PlayerID?>').click(function () {
                    if (!jQuery("#mycarousel_<?=$PlayerID?>").data("jcarousel").animating)
                    {
                        $("#jcar_start_<?=$PlayerID?>").css("display", "block");
                        $("#jcar_stop_<?=$PlayerID?>").css("display", "none");
                        window.jsAdvRoll_<?=$PlayerID?>.stop_auto();
                        if ("<?=$wrap?>" == "circular")
                            if (k == 0)
                                k = <?=$count_el?>-1;
                            else
                                k = k - 1;
                        else
                            if (k > <?=$num_vis_half?>)
                                k = k - 1;
                        jQuery("#mycarousel_<?=$PlayerID?>").data("jcarousel").buttonPrev.click();
                        slide_onClick_<?=$PlayerID?>(k);
                    }
                    return false;
                });
                $("#jcar_next1_<?=$PlayerID?>").click(function () {
                    if (!jQuery("#mycarousel_<?=$PlayerID?>").data("jcarousel").animating)
                    {
                        if (window.jsAdvRoll_<?=$PlayerID?>.options.auto)
                        {
                            $("#jcar_start_<?=$PlayerID?>").css("display", "block");
                            $("#jcar_stop_<?=$PlayerID?>").css("display", "none");
                            window.jsAdvRoll_<?=$PlayerID?>.stop_auto();
                        }
                        else
                            window.jsAdvRoll_<?=$PlayerID?>.options.auto = true;
                        if ("<?=$wrap?>" == "circular")
                            if (k == <?=$count_el?>-1)
                                k = 0;
                            else
                                k = k + 1;
                        else
                            if (k < <?=$count_el?>+<?=$num_vis_half?>-1)
                                k = k + 1;
                        jQuery("#mycarousel_<?=$PlayerID?>").data("jcarousel").buttonNext.click();
                        slide_onClick_<?=$PlayerID?>(k);
                    }
                    return false;
                });

                $("#link_<?=$PlayerID?> a.jcarousel-item-pict_alx-photoplayer1mod").click(function(e)
                {
                    if (!flag_mousemove)
                    {
                        var ind = $(e.target).parent().attr("jcarouselindex")-1;
                        if ("<?=$wrap;?>" == "circular")
                        {
                            var ind_cnt = ((Math.abs(ind)  - (Math.abs(ind) % <?=$count_el?>)) / <?=$count_el?>);
                            var num_el = ind < 0 ? (ind_cnt+1)*<?=$count_el?> + ind : ind - ind_cnt*<?=$count_el?>;
                        }
                        else
                        {
                            var ind_cnt = ((Math.abs(ind)  - (Math.abs(ind) % <?=$count_el+$num_vis_half?>)) / <?=$count_el+$num_vis_half?>);
                            var num_el = ind < 0 ? (ind_cnt+1)*<?=$count_el+$num_vis_half?> + ind : ind - ind_cnt*<?=$count_el+$num_vis_half?>;
                        }
                        if ((num_el == <?=$count_el?>) && ("<?=$wrap;?>" == "circular"))
                            num_el = 0;
                        if (((num_el >= <?=$num_vis_half?>) && (num_el < <?=$count_el+$num_vis_half?>)) || ("<?=$wrap;?>" == "circular"))
                        {
                            $("#jcar_start_<?=$PlayerID?>").css("display", "block");
                            $("#jcar_stop_<?=$PlayerID?>").css("display", "none");
                            window.jsAdvRoll_<?=$PlayerID?>.stop_auto();
                            k = num_el;
                            jQuery("#mycarousel_<?=$PlayerID?>").data("jcarousel").scroll(ind-<?=$num_vis_half?>+1);
                            slide_onClick_<?=$PlayerID?>(k);
                        }
                    }
                    flag_mousemove = false;
                    return false;
                })

                jQuery("#mycarousel_<?=$PlayerID?>").jcarousel({
                                scroll     : 1,
                                animation  : <?=$arParams["SPEED"];?>,
                                start      : 1,
                                wrap      : "<?=$wrap;?>",
                                containerWidth : <?=$arParams["BIGPICX"]?>,
                                containerHeight : <?=$arParams["PREVPICY"]+2;?>,
                                containerPadding : 0,
                                clipWidth : <?=$arParams["BIGPICX"]?>,
                                clipHeight : <?=$arParams["PREVPICY"]+3;?>,   //add any
                                itemWidth : <?=$arParams["PREVPICX"]+2;?>,
                                itemHEight : <?=$arParams["PREVPICY"]+2;?>,
                                interval : <?=$arParams["INTERVAL"];?>,
                                scroll_buttons : false
                });

                slide_onClick_<?=$PlayerID?>(k);

                <?if(($arParams["SHOW_AUTO"] == 'Y') && ($arParams["AUTOSTART"] == 'Y')):?>
                    $("#jcar_start_<?=$PlayerID?>").click();
                <?endif;?>
                $("a.pic_item_alx-photoplayer1mod").fancybox(
                {
                        "padding" : 10,
                        "imageScale" : true,
                        "zoomOpacity" : true,
                        "zoomSpeedIn" : 0,
                        "zoomSpeedOut" : 0,
                        "zoomSpeedChange" : 0,
                        "frameWidth" : 700,
                        "frameHeight" : 600,
                        "overlayShow" : true,
                        "overlayOpacity" : 0.8,
                        "hideOnContentClick" :true,
                        "centerOnScroll" : false
                });
        });

        function MouseScroll_<?=$PlayerID?>(event)
        {
            var rolled = 0;
            if (event.wheelDelta === undefined)
            {
                rolled = -1 * event.detail;
                event.preventDefault();
            }
            else
            {
                rolled = event.wheelDelta;
            }
            $("#jcar_start_<?=$PlayerID?>").css("display", "block");
            $("#jcar_stop_<?=$PlayerID?>").css("display", "none");
            window.jsAdvRoll_<?=$PlayerID?>.stop_auto();
            if (<?=$arParams["SPEED"];?> < 300)
                jQuery("#mycarousel_<?=$PlayerID?>").data("jcarousel").options.animation = <?=$arParams["SPEED"];?>;
            else
                jQuery("#mycarousel_<?=$PlayerID?>").data("jcarousel").options.animation = 300;
            if(rolled > 0)
                $("#jcar_next1_<?=$PlayerID?>").click();
            else
                $("#jcar_prev1_<?=$PlayerID?>").click();
            jQuery("#mycarousel_<?=$PlayerID?>").data("jcarousel").options.animation = <?=$arParams["SPEED"];?>;
            return false;
        };

   </script>

   
<?endif?>

</div>

