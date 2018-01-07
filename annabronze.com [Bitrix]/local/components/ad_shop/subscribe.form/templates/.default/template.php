<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="b-subscribe _on-main">
    <div class="b-subscribe__title"><?= GetMessage('subscr_header'); ?></div>
    <form class="b-subscribe__form " method="post" id="subscribe-form">
        <?= bitrix_sessid_post() ?>
        <input type="text" name="email" class="b-form__input" placeholder="e-mail" data-value="email"/>
        <input type="hidden" value="<?=GetMessage('subscr_error')?>" name="default-error-text">
        <input type="hidden" value="<?=LANGUAGE_ID?>" name="language_id">
        <button type="submit" class="b-subscribe__btn btn _full"><?= GetMessage('subscr_form_button') ?></button>
        <div class="b-subscribe__form-errors"><?= GetMessage('subscr_error') ?></div>
        <div class="b-subscribe__form-success"><?= GetMessage('subscr_success') ?></div>

    </form>
</div>
