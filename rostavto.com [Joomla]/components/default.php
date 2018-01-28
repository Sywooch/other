<?php

defined('_JEXEC') or die('Restricted access');

?>





<style type="text/css">

    .post-form {
        display: block;
        margin: 0 35px 0 0;

    }

    .post-form legend {
        font-size: 22px;
    }
    .post-form input[type="text"] {
        width: 100%;
        margin: 0 auto;

    }
    .post-form input[type="submit"] {
        cursor: pointer;
    }

    .post-form textarea {

        border: 1px solid #999;

        height: 200px;

        width: 100%;

        padding: 5px;
        
        resize: vertical;

    }

    .post-form li {

        clear: both;

        list-style: none outside none !important;

        margin: 10px 0;

    }



    .post-form label {

        float: left;

        width: 200px;

    }



    .post-form p.messages {

        border: 1px dashed #999;

        border-radius: 5px;

        color: #333;

        font-size: 16px;

        font-weight: bold;

        margin: 10px 0;

        padding: 10px 20px;

    }



    .post-form p.errors {

        border: 1px dashed #ffbbb1;

        color: #d90000;

        font-size: 16px;

        font-weight: bold;

        margin: 10px 0 10px 20px;

        padding: 10px 20px;

    }



    .post-form .required {

        color: #d90000;

        font-weight: bold;

    }



    .post-form .error {

        color: #d90000;

    }



    .post-form input[type="text"] {

        border: 1px solid #999;

        font-size: 16px;

        padding: 3px 5px;

    }



    .post-form input[type="submit"] {

        background: none repeat scroll 0 0 #a74949;

        border: 1px solid #a74949;

        color: #fff;

        float: right;

        font-size: 16px;

        margin: 0 -13px 0 0;

        padding: 5px 35px;

    }

</style>



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