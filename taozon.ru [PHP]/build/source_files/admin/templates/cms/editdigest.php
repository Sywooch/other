<?
include ("templates/header.php");
?>
<script type='text/javascript' src='js/bpopup.js'></script>
<script type='text/javascript' src='js/digest.js'></script>
<link rel="stylesheet" href="css/digest.css" type="text/css" />

<div class="main"><div class="canvas clrfix editnews">
        <form action="" enctype="multipart/form-data" method="POST" class="addform"
              id="dialog-form" title="<?= LangAdmin::get('add') ?>">
            <div id="file-uploader"></div>
        </form>
        <?
        $cms = new CMS();
        if ($post['id'] === 'new') {
            ?>
            <h1><?= LangAdmin::get('add') ?></h1>
        <? } else { ?>
            <h1><?= LangAdmin::get('edit') ?> (ID: <?= @$post['id'] ?>)</h1>
        <? } ?>
        <form action="?cmd=digest&do=editsave" method="post" id="feditor">
            <input type="hidden" name="id" value="<?= @$post['id'] ?>">
            <input type="hidden" name="cms" value="1">
            <p><label><?= LangAdmin::get('title') ?>: <input type="edit" name="title" value="<?= @$post['title'] ?>"></label></p>
            <p><label><?= LangAdmin::get('image') ?>: <img src="<?= @$post['image'] ?>" id="news-img">  <input type="hidden" name="image" value="<?= @$post['image'] ?>"></label>           
            <input type="button" value="<?= LangAdmin::get('add_change_image') ?>" onclick="$('#dialog-form').dialog('open');" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"></p>
            <p>
                <label><?= LangAdmin::get('category') ?>:</label>
                <select name="category" id="category">
                    <option value="" ><?= LangAdmin::get('without_cat') ?></option>
                    <?
                    $my_cat = $cats;

                    foreach ($my_cat as $category) {
											$selected = "";
                       if (isset($post['categories']) && is_array($post['categories']) && in_array($category['cid'], $post['categories'])) {
                           $selected = 'selected="selected"';
                       }
                       ?>
                       <option value="<?= $category['cid'] ?>" <?= $selected ?>><?= $category['title'] ?></option>
                    <? } ?>
                </select>
                <input type="button" value="<?= LangAdmin::get('add_a_category') ?>" id="createAddCat">&nbsp;

            </p>
            <p>
                <a href="#" onclick="showPrompt()"><?= LangAdmin::get('insert_products') ?></a>
                <!--- <input type="hidden" name="goods" id="goods" alt="">
                <input type="button" id="insert_item" onclick="getItems(document.getElementById('goods').value)" value="<?= LangAdmin::get('get_goods') ?>"> -->
            <div id="msg"></div>
            </p>
            <p><label><?= LangAdmin::get('content') ?>:<br> <textarea name="content" id="edit_content"><? echo @$post['content'] ?></textarea></label></p>


            <p>
                <label>
                    <?= LangAdmin::get('language') ?>: 
                    <select name="lang" id="">
                        <?
                        foreach ($webui->Settings->Languages->NamedProperty as $v) {
                            $lang = (string) $v->Name;
                            $lang_desc = (string) $v->Description;

                            $selected = '';
                            if (@$post['lang_code'] == $lang) {
                                $selected = ' selected';
                            }
                            ?>
                            <option value="<?= $lang ?>"<?= $selected ?>><?= $lang_desc ?></option>
                            <?
                        }
                        ?>
                    </select>
                </label>
            </p>
            <p><input type="submit" value=" <?= LangAdmin::get('save') ?> " class="ui-button ui-widget ui-state-default ui-corner-all"></p>
        </form>
        <br clear="all">
    </div></div>
<div id="popup"><a class="bClose">X</a>
    <center><?= LangAdmin::get('add_a_category') ?></center>
		<form id="add_category" action="" method="post">
                <label><?= LangAdmin::get('category_title') ?>:</label>
                <input required="required" type="text" id="addcat_title" />
								<br/>
								<br/>
                <label><?= LangAdmin::get('category_desc') ?>:</label>
                <textarea id="addcat_desc" required="required"></textarea>
								<br/>
								<br/>
                <label><?= LangAdmin::get('language') ?>: </label>
                <select name="" id="addcat_lang">
                <?
                foreach ($webui->Settings->Languages->NamedProperty as $v) {
                    $lang = (string) $v->Name;
                    $lang_desc = (string) $v->Description;
                    $selected = '';
                    if (@$post['lang_code'] == $lang) {
                        $selected = ' selected';
                    }
                    ?>
                    <option value="<?= $lang ?>"<?= $selected ?>><?= $lang_desc ?></option>
                    <?
                }
                ?>
            </select>
<input type="hidden" name="addcategory" value="1" />
								<br/>
								<br/>
            <div align="center" id="addcat"></div>
		<input type="submit" value="<?=LangAdmin::get('add') ?>" onclick=" addCategory(); return false;"/>
</form>



</div>
<script type='text/javascript' src='js/digestadd.js'></script>


<?
include ("templates/footer.php");
?>
