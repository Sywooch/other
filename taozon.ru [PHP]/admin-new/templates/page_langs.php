
<?
$languages = array(
    array('lang_code' => 'ru'),
    array('lang_code' => 'en'),
);
?>

<? //$activeLang = Session::getActiveAdminLang(); ?>
<? foreach ($languages as $lang) { ?>
    <? if($lang['lang_code'] == $activeLang){ ?>
        <?=$lang['lang_code']?>
    <? } ?>
<? } ?>


<!-- admin interface language -->

<a tabindex="-1" href="#" title="<?=LangAdmin::get('Language_select_for_admin')?>"><?=LangAdmin::get('Language_select')?></a>

<ul class="dropdown-menu">
    <? foreach ($languages as $lang) { ?>
        <li>
            <a data-value="<?=$lang['lang_code']?>" href="<?=$PageUrl->SetAdminLangUrl($lang['lang_code'])?>">
                <?=$lang['lang_code']?>
            </a>
        </li>
    <? } ?>
</ul>

<!-- /admin interface language -->
