<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h2>Выполненные заказы</h2>
<table class="clickable_row">
    <tr>
        <th style="border-radius: 6px 0 0 0; width: 310px;">Заголовок</th>
        <th style="width: 170px;">Откуда</th>
        <th style="width: 35px;">км</th>
        <th style="width: 170px;">Куда</th>
        <th style="width: 90px;">Перевозчик</th>
        <th style=" border-radius: 0 6px 0 0;">Отзыв</th>
    </tr>
    <?
    if (!empty($arResult['ITEMS']))
    {
        foreach ($arResult['ITEMS'] as $arItem)
        {
            ?>
            <tr>
                <td>
                    <div class="number-logo-s">
                        <div class="number-s"><?=$arItem['ID']?></div>
                        <div class="logo-s"><img src="<?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['PICTURE']?>" alt=""/></div>
                    </div>
                    <div class="title-category-s">
                        <div class="title-s"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
                        <div class="category-s"><?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']?></div>
                    </div>
                </td>
                <td>
                    <div class="from-from-obl-s">
                        <div class="from-s"><?=$arItem['DISPLAY_PROPERTIES']['FROM_CITY']['VALUE']?></div>
                        <?if (!empty($arItem['DISPLAY_PROPERTIES']['FROM_REGION']['VALUE'])):?>
                        <div class="from-obl-s">(<?=$arItem['DISPLAY_PROPERTIES']['FROM_REGION']['VALUE']?>)</div>
                        <?endif?>
                    </div>
                </td>
                <td><div class="km-s"><?=!empty($arItem['DISPLAY_PROPERTIES']['DISTANCE']['VALUE']) ? $arItem['DISPLAY_PROPERTIES']['DISTANCE']['VALUE'] : "—"?> км</div></td>
                <td>
                    <div class="to-to-obl-s">
                        <div class="to-s"><?=$arItem['DISPLAY_PROPERTIES']['TO_CITY']['VALUE']?></div>
                        <?if (!empty($arItem['DISPLAY_PROPERTIES']['TO_REGION']['VALUE'])):?>
                        <div class="to-obl-s">(<?=$arItem['DISPLAY_PROPERTIES']['TO_REGION']['VALUE']?>)</div>
                        <?endif?>
                    </div>
                </td> 
                <td><div class="carrier"><a href="#"><?=TruncateText($arItem['DISPLAY_PROPERTIES']['CARRIER_USER_ID']['CLIENT_INFO']['WORK_COMPANY'], 8)?></a></div></td>
                <td class="no_clickable_td">
                    <?
                    if (intval($arItem['DISPLAY_PROPERTIES']['IS_HAVE_REVIEW']['VALUE']) == 1):
                    ?>
                    <a class="leave-review">Отзыв принят</a>
                    <?else:?>
                    <a class="leave-review modalbox" href="#comment-feedback-<?=$arItem['ID']?>">Оставить отзыв </a>
                    <?endif?>
                </td>
            </tr>
            <?
        }
    }
    else
    {
        ?>
        <tr>
            <td colspan="6">На сайте нет выполненных заявок, принадлежащих вам...</td>
        </tr>
        <?
    }
    ?>
</table>

<?
if (!empty($arResult['ITEMS']))
{
    foreach ($arResult['ITEMS'] as $arItem)
    {
        if (intval($arItem['DISPLAY_PROPERTIES']['IS_HAVE_REVIEW']['VALUE']) == 1)
            continue;
        ?>
        <div class="comment-block" id="comment-feedback-<?=$arItem['ID']?>">
            <div class="comment-title">Оставить отзыв</div>
            <form action="<?=$APPLICATION->GetCurDir()?>" method="post" name="comment">
                <div class="rating-title">Оценить работу перевозчика</div>
                <div class="set-rate-star" data-star="<?=SITE_TEMPLATE_PATH?>/img/star.png" data-star_a="<?=SITE_TEMPLATE_PATH?>/img/star-a.png">
                    <img alt="" src="<?=SITE_TEMPLATE_PATH?>/img/star.png" title="Очень плохо!">
                    <img alt="" src="<?=SITE_TEMPLATE_PATH?>/img/star.png" title="Плохо">
                    <img alt="" src="<?=SITE_TEMPLATE_PATH?>/img/star.png" title="Средне">
                    <img alt="" src="<?=SITE_TEMPLATE_PATH?>/img/star.png" title="Хорошо">
                    <img alt="" src="<?=SITE_TEMPLATE_PATH?>/img/star.png" title="Отлично!">
                    <a class="rate_name" style="color: #77aa3f;"></a>
                    <input type="hidden" name="REVIEW_RATE" value="5" />
                </div>
                <br/>
                <div class="leave-review-title">Оставьте Ваш отзыв</div>
                <textarea name="PREVIEW_TEXT" id="description-comment" cols="30" rows="10"></textarea>
                <br/>
                <p style="text-align: center;"><input type="submit" name="NEW_REVIEW_FORM_SUBMIT" value="Оставить отзыв" class="send-comment"/></p>
                
                <input type="hidden" name="ORDER_ID" value="<?=$arItem['ID']?>">
                <input type="hidden" name="CUSTOMER_ID" value="<?=$USER->GetID()?>">
                <input type="hidden" name="CUSTOMER_LOGIN" value="<?=GetUserWorkCompany()?>">
                <input type="hidden" name="CARRIER_ID" value="<?=$arItem['DISPLAY_PROPERTIES']['CARRIER_USER_ID']['VALUE']?>">
            </form>
        </div>
        <?
    }
}
?>

<script type="text/javascript">
$(document).ready(function()
{
    $(".modalbox").fancybox();
    $(".set-rate-star img").click(function()
    {
        star = $(this).closest('div.set-rate-star').data('star');
        star_a = $(this).closest('div.set-rate-star').data('star_a');
        
        current = $(this).index();
        
        if ($(this).attr('src').indexOf('_a.png') > 0)
            $(this).attr('src', star);
        else
            $(this).attr('src', star_a);
        
        $(this).closest(".set-rate-star").find("img:lt("+current+")").attr('src', star_a);
        $(this).closest(".set-rate-star").find("img:gt("+current+")").attr('src', star);
        
        $(this).closest('.set-rate-star').find('input[name=REVIEW_RATE]').val($(this).closest(".set-rate-star").find("img:lt("+current+")").length + 1);
        
        $(this).closest('.set-rate-star').find('.rate_name').text($(this).attr('title'));
    })
});
</script>