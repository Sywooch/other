<?php
defined('_JEXEC') or die('Restricted access'); ?>
 
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
    <fieldset class="adminform">
        <legend><?php echo JText::_( 'COM_ERROR404_DETAILS' ); ?></legend>
        <table class="admintable">
        <tr>
            <td width="100" align="right" class="key">
                <label for="chaine">
                    <?php echo JText::_( 'COM_ERROR404_MOT_CLE' ); ?>:
                </label>
            </td>
            <td>
                <input class="text_area" type="text" name="chaine" id="chaine" size="40" maxlength="250" value="<?php echo $this->error->chaine;?>" />
            </td>
        </tr>
        <tr>
            <td width="100" align="right" class="key">
                <label for="chaine">
                    <?php echo JText::_( 'COM_ERROR404_TYPE' ); ?>:
                </label>
            </td>
            <td>
                <input class="text_area" type="text" name="type" id="type" size="2" maxlength="1" value="<?php echo $this->error->type;?>" />
            </td>
        </tr>
    </table>
    </fieldset>
</div>
 
<div class="clr"></div>
 
<input type="hidden" name="option" value="com_error404" />
<input type="hidden" name="id_error404" value="<?php echo $this->error->id_error404; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="error404" />
</form>
