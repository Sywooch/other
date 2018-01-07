<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$socialClass = '';
?>

<div class="b-form__row-input _lined">
    <div class="b-form__socials">
        <? foreach ($arParams["~AUTH_SERVICES"] as $service): ?>
            <? switch ($service["NAME"]) {
                case 'Twitter':
                    $socialClass = '_tw';
                    break;
                case 'Facebook':
                    $socialClass = '_fb';
                    break;
                case 'VKontakte':
                    $socialClass = '_vk';
                    break;
                case 'ВКонтакте':
                    $socialClass = '_vk';
                    break;
                default:
                    $socialClass = $service["NAME"];
                    break;
            } ?>
            <? if ($service["NAME"]) ?>
                <a  class="b-form__socials-item <?= $socialClass ?>"
                    title="<?= htmlspecialcharsbx($service["NAME"]) ?>"
                    href="javascript:void(0)"
                    onclick="<?=$service['ONCLICK']?>">
            </a>
        <? endforeach ?>
    </div>
</div>