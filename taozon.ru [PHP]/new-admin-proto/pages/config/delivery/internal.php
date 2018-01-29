
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/delivery/internal">Доставка</a> <span class="divider">›</span></li>
    <li class="active">Внутренняя</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_config.php'); ?>

<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">

    <ul class="nav nav-pills">
        <li class="active"><a href="config/delivery/internal">Внутренняя</a></li>
        <li><a href="config/delivery/kinds">Внешняя</a></li>
        <li><a href="config/delivery/tariffs">Тарифы по странам</a></li>
    </ul>

</div><!-- /ot-sub-sub-nav -->


<h1>Внутренняя</h1>

<div class="well">

    <div class="row-fluid offset-bottom1">

        <div class="span3">

            <p><strong>Способы доставки</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title=""></i></p>

            <ol class="unstyled ot_sortable_list ot_sortable">
                <li><span class="badge"><i class="icon-move" title="Перетащить"></i> Express <i class="icon-remove" title="Удалить"></i></span></li>
                <li><span class="badge"><i class="icon-move" title="Перетащить"></i> Post <i class="icon-remove" title="Удалить"></i></span></li>
                <li><span class="badge badge-success"><i class="icon-move" title="Перетащить"></i> EMS <i class="icon-remove" title="Удалить"></i></span></li>
            </ol>
        </div>

        <div class="span4">
            <p><strong>Добавить доставку</strong></p>
            <div>
                <select class="input-large span8 select_searched_list" data-placeholder="Все доставки выбраны" disabled="disabled">
                        <option></option>
<!--                    <option value="Express">Express</option>-->
<!--                    <option value="Post">Post</option>-->
<!--                    <option value="EMS">EMS</option>-->
                </select>

                <button class="btn btn-small btn-primary offset-left1 disabled" title="Добавить дополнительный язык" autocomplete="off"><i class="icon-plus"></i></button>
            </div>
        </div>

        <div class="span5">

            <p><strong>Регион доставки</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Выберите расположение вашего склада" title="" data-original-title=""></i></p>

            <p><a href="#" class="blink">Выбрать регион</a></p>

       </div>
    </div>

    <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>


</div>

<!-- alternative variant -->
<!--<div class="well">


    <div class="row-fluid offset-bottom1">

        <div class="span3">

            <p><strong>Активные доставки</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title=""></i></p>

            <ol class="vertical unstyled ot_sortable_list ot_sort_n_drop">
                <li><span class="badge badge-info"><i class="icon-move" title="Перетащить"></i> Express <i class="icon-remove" title="Удалить"></i></span></li>
                <li><span class="badge badge-info"><i class="icon-move" title="Перетащить"></i> Post <i class="icon-remove" title="Удалить"></i></span></li>
            </ol>

        </div>

        <div class="span3">
            <p><strong>Виды доставок</strong></p>
            <ol class="vertical unstyled ot_sortable_list ot_sort_n_drop">
                <li><span class="badge badge-success"><i class="icon-move" title="Перетащить"></i> EMS <i class="icon-remove" title="Удалить"></i></span></li>
            </ol>

        </div>

        <div class="span3">
            <p><strong>Регион доставки</strong></p>
            <select class="input-large select_searched_list">
                <optgroup label="Alaskan/Hawaiian Time Zone">
                    <option value="AK">Alaska</option>
                    <option value="HI">Hawaii</option>
                </optgroup>
                <optgroup label="Pacific Time Zone">
                    <option value="CA">California</option>
                    <option value="NV">Nevada</option>
                    <option value="OR">Oregon</option>
                    <option value="WA">Washington</option>
                </optgroup>
                <optgroup label="Mountain Time Zone">
                    <option value="AZ">Arizona</option>
                    <option value="CO">Colorado</option>
                    <option value="ID">Idaho</option>
                    <option value="MT">Montana</option><option value="NE">Nebraska</option>
                    <option value="NM">New Mexico</option>
                    <option value="ND">North Dakota</option>
                    <option value="UT">Utah</option>
                    <option value="WY">Wyoming</option>
                </optgroup>
                <optgroup label="Central Time Zone">
                    <option value="AL">Alabama</option>
                    <option value="AR">Arkansas</option>
                    <option value="IL">Illinois</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="OK">Oklahoma</option>
                    <option value="SD">South Dakota</option>
                    <option value="TX">Texas</option>
                    <option value="TN">Tennessee</option>
                    <option value="WI">Wisconsin</option>
                </optgroup>
                <optgroup label="Eastern Time Zone">
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="IN">Indiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="NH">New Hampshire</option><option value="NJ">New Jersey</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="OH">Ohio</option>
                    <option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option>
                    <option value="VT">Vermont</option><option value="VA">Virginia</option>
                    <option value="WV">West Virginia</option>
                </optgroup>

            </select>
        </div>

    </div>



    <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>


</div>-->
