
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="promo/seo">Продвижение</a> <span class="divider">›</span></li>
    <li><a href="promo/referals">Реферальные программы</a> <span class="divider">›</span></li>
    <li class="active">Добавление новой категории</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_promo.php'); ?>


<h1>Добавление новой категории</h1>

<div class="well">

    <form method="post" action="pricing/discount" class="form-horizontal ot_form">
        <fieldset>

            <div class="control-group control-group-medium">
                <label class="control-label">Название <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                <div class="controls">
                    <input id="textinput" name="textinput" class="input-xlarge" type="text" required="required">
                </div>
            </div>

            <div class="control-group control-group-medium">
                <label class="control-label">Процент прибыли от рефереров <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Локальная подсказка"></i></label>
                <div class="controls">
                    <div class="input-append">
                        <input placeholder="0" class="input-mini" type="text">
                        <span class="add-on">%</span>
                    </div>
                </div>
            </div>

            <div class="control-group control-group-medium">
                <label class="control-label">Минимальная общая сумма заказов рефереров <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Локальная подсказка"></i></label>
                <div class="controls">
                    <div class="input-append">
                        <input placeholder="0" class="input-mini" type="text">
                        <span class="add-on">USD</span>
                    </div>
                </div>
            </div>

        </fieldset>


        <div class="control-group control-group-medium">
            <!-- buttons for prototype only -->
            <div class="controls">
                <a href="promo/referals" class="btn btn-primary btn_preloader" data-loading-text="Сохранить">Сохранить</a>
                <a href="promo/referals" class="btn offset-left1 btn_preloader" data-loading-text="Отменить">Отменить</a>
            </div>
            <!-- buttons for master application -->
            <!--<div class="controls">
                <button type="submit" class="btn btn-primary btn_preloader" data-loading-text="Сохранить">Сохранить</button>
                <button type="button" class="btn offset1 btn_preloader" data-loading-text="Отменить">Отменить</button>
            </div>-->
        </div>


    </form>

</div>




