<?php
defined('_JEXEC') or die('Restricted access');
?>

<form action="" method="post" class="post-form">

    <legend>Опубликовать новость</legend>

    <?php

    if (!empty($this->messages)) {

        echo '<p class="messages">';

        echo implode('<br />', $this->messages);

        echo '</p>';

    }

    if (!empty($this->errors)) {

        echo '<p class="errors">';

        echo implode('<br />', $this->errors);

        echo '</p>';

    }

    if (isset($this->messages['success'])) {

        ?>



    <?php } else { ?>

        <ul>

            <li>

                <label for="title">Название *</label><input type="text" name="title"

                                                            value="<?php echo $this->fieldTitle; ?>"/></li>

            <li>

                <label for="text">Текст новости *</label>

                <textarea name="text" id="text" cols="30" rows="10"><?php echo $this->fieldText; ?></textarea>

            </li>

            <li>

                <img style="display: block;float: left;" alt="Защитный код"

                     src="<?php echo $this->captchaSrc; ?>">

                <input type="text" placeholder="Защитный код" style="width: 120px;margin: 10px 0 0 10px;"

                       name="captcha" value="">

                <input type="submit" style="margin: 10px -13px 0 0;" value="Опубликовать" name="feedback-submit">

            </li>

        </ul>

    <?php } ?>

</form>