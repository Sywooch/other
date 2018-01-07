<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="b-faq js-faq">
    <div class="b-faq__list">
        <? if (!empty($arResult["ITEMS"])) { ?>

            <?
            $i = 0;
            foreach ($arResult["ITEMS"] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="b-faq__item <? if ($i == 0) {
                    echo "_opened";
                } ?>">
                    <div class="b-faq__item-title">
                        <span><?= $arItem["NAME"] ?></span>
                    </div>
                    <div class="b-faq__item-answer">
                        <?= $arItem["DETAIL_TEXT"] ?>
                    </div>
                </div>

                <? $i++; ?>
            <? } ?>

        <? } ?>
    </div>
</div>


