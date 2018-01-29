<!-- site language -->
<div class="btn-group pull-right">
    <a class="btn dropdown-toggle offset-top05" data-toggle="dropdown" href="#" title="<?=LangAdmin::get('Language_select_for_edit')?>">

        <? $activeLang = false; ?>
        <? foreach($CMSLanguages as $lang){ ?>
            <? if($lang['lang_code'] == Session::get('active_lang_siteconfiguration')){ ?>
                <? $activeLang = $lang['lang_code']; ?>
                <?=$lang['lang_name']?>
            <? } ?>
        <? } ?>
        <? if(!$activeLang){ ?>
            <?=LangAdmin::get('All_languages_versions')?>
        <? } ?>

        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a data-value="" href="<?=$PageUrl->SetPageLangUrl('')?>">
                <?=LangAdmin::get('All_languages_versions')?>
            </a>
        </li>
        <? foreach($CMSLanguages as $lang){ ?>
            <li>
                <a data-value="<?=$lang['lang_code']?>" href="<?=$PageUrl->SetPageLangUrl($lang['lang_code'])?>">
                    <?=$lang['lang_name']?>
                </a>
            </li>
        <? } ?>
    </ul>
</div>
<!-- /site language -->
