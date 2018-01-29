<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">
        <li <? if($PageUrl->GetAction() == 'default' && $PageUrl->GetCmd() == 'pricing'){ ?>class="active"<?} ?>><a href="<?=$PageUrl->AssignCmdAndDo('pricing', 'default')?>"><?=LangAdmin::get('Currency')?></a></li>
        <li <? if($PageUrl->GetAction() == 'cost'  && $PageUrl->GetCmd() == 'pricing'){ ?>class="active"<?} ?>><a href="<?=$PageUrl->AssignCmdAndDo('pricing', 'cost')?>"><?=LangAdmin::get('Costs')?></a></li>
        <li <? if($PageUrl->GetAction() == 'discount' && $PageUrl->GetCmd() == 'pricing'){ ?>class="active"<?} ?>><a href="<?=$PageUrl->AssignCmdAndDo('pricing', 'discount')?>"><?=LangAdmin::get('Discounts')?></a></li>
        <li <? if($PageUrl->GetAction() == 'banker' && $PageUrl->GetCmd() == 'pricing'){ ?>class="active"<?} ?>><a href="<?=$PageUrl->AssignCmdAndDo('pricing', 'banker')?>"><?=LangAdmin::get('Bankir')?></a></li>
    </ul>

</div>
