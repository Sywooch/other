<?
include ("header.php");

?>
<div class="main"><div class="canvas clrfix">

	<? if(in_array('Seo2', General::$enabledFeatures)){
	$url = 'item?';
} else {
	$url = 'index.php?p=item&';
} ?>
	<? if ($status) { ?>
    <h1> <?=LangAdmin::get('reviews')?> </h1>
    <p>
    </p>
    <table>
        <tr>
            <th>ID</th>
            <th><?=LangAdmin::get('comment_buyer_to_the_product')?></th>
			<th><?=LangAdmin::get('creation_time')?></th>
			<th><?=LangAdmin::get('created_by')?></th>
			<th><?=LangAdmin::get('actions')?></th>
		</tr>
        <? if(is_array($comments)) foreach($comments as $comment) { ?>
            <tr>
            <td><?=$comment['review_id']?></td>
				<td><?=$comment['text']?></td>
				<td><?=$comment['created']?></td>
				<td><?=$comment['name']?></td>
				<td>
            	<a href="../<?=$url?>id=<?=$comment['item_id']?>" target="_blank"><?=LangAdmin::get('go')?></a>&nbsp;&nbsp;&nbsp;
				<a  onclick="return confirm('<?=LangAdmin::get('want_to_accept_comment')?>?\r\n&quot;<?=$comment['text']?>&quot;');" href="?cmd=reviews&do=accept&id=<?=$comment['review_id']?>"><?=LangAdmin::get('accept')?></a>&nbsp;&nbsp;&nbsp;
				<a onclick="return confirm('<?=LangAdmin::get('want_to_delete_comment')?>?\r\n&quot;<?=$comment['text']?>&quot;');" href="?cmd=reviews&do=del&id=<?=$comment['review_id']?>"><?=LangAdmin::get('remove')?></a>&nbsp;&nbsp;&nbsp;
            &nbsp;</td>
            </tr>
        <? } ?>
    </table>
<!--    <input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all" value="--><?//=LangAdmin::get('add_news')?><!--" onclick="location.href='?cmd=news&do=add'"/>-->
	<!-- .pager -->
	<?if ($count!=0):?>
	<div class="bgr-panel">
		<? $curpage=floor($from/$perpage)+1 ?>
		<? $maxpage=ceil($count/$perpage) ?>
		<? if ($maxpage>1 && !($curpage>=$maxpage)) { ?>
		<a href="<?=$pageurl?>&from=<?=$from+$perpage?>" class="btn flr"><span><?=Lang::get('next_page')?></span></a>
		<? }  elseif($curpage > $maxpage) { ?>
		<? }?>

		<ul class="flin pager clrfix">
			<? if ($curpage>3) { ?>
			<li><a href="<?=$pageurl?>&from=0">1</a></li>
			<? } ?>
			<? if ($curpage>4) { ?>
			<li>...</li>
			<? } ?>
			<? for ($i=max(1, $curpage-2);$i<=min($maxpage, $curpage+2);$i++) { ?>
			<? if ($curpage == $i) { ?>
				<li class="active"><a href="<?=$pageurl?>&from=<?=(($i-1)*$perpage)?>"><?=$i?></a></li>
				<? }else{ ?>
				<li><a href="<?=$pageurl?>&from=<?=(($i-1)*$perpage)?>"><?=$i?></a></li>
				<? } ?>
			<? } ?>
			<? if ($curpage<$maxpage-3) { ?>
			<li><span>...</span></li>
			<? } ?>
			<? if ($curpage<$maxpage-2) { ?>
			<li><a href="<?=$pageurl?>&from=<?=(($maxpage-1)*$perpage)?>"><?=$maxpage?></a></li>
			<? } ?>
		</ul>
	</div>
	<?endif;?>
	<!-- /.pager -->

	<? } else { ?>
    <p><?=LangAdmin::get('error_connecting_to_database')?>.</p>
    <p><?=LangAdmin::get('check_configcustom_for_correct_db_accesses')?>.</p>
    <p><?=LangAdmin::get('example')?>:</p>
    <pre>
    define('DB_HOST', 'localhost');
    define('DB_USER', 'opentao');
    define('DB_PASS', '*******');
    define('DB_BASE', 'opentao');
    </pre>
<? } ?>
    
</div></div>

<?
include ("footer.php");
?>

