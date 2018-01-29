<div class="grid_16">
<? if(count($processlog)) {?>
<table>
    <thead>
        <tr>
            <th><?=LangAdmin::get('date')?>, <?=LangAdmin::get('time')?></th>
            <th><?=LangAdmin::get('status')?>/<?=LangAdmin::get('payment')?></th>
            <th><?=LangAdmin::get('comment_operator')?> / <?=LangAdmin::get('amount')?>, <?=LangAdmin::get('direction')?></th>
            <th><?=LangAdmin::get('name_of_operator')?> / <?=LangAdmin::get('name_the_author_of_action')?></th>
            <th><?=LangAdmin::get('expected_effect_of_the_buyer')?></th>
        </tr>
    </thead>

    <tbody>
        <? if (is_array($processlog)) foreach($processlog as $process) { ?>
        <tr>
            <td><? echo $process['logdate'].' '. $process['logtime']; ?></td>
            <td><strong><?=LangAdmin::get('field')?>:</strong> <? echo ' '.$process['fieldname']; ?><br/>
                <? echo $process['prevvalue']. ' --> '. $process['newvalue']; ?>
            </td>
            <td></td>
            <td><?=(string)$process['operatorname'];?>/<?=(string)$process['custname'];?></td>
            <td></td>
        </tr>
        <? } ?>
    </tbody>
</table>
<? } else { ?>
    <br/><strong><?=LangAdmin::get('operations_on_the_order_found')?>!</strong><br/>
<? } ?>
</div>
 <br clear="all"/>
