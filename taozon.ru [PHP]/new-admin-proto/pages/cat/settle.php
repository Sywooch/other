
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li class="active">Пристрой</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>

<h1>Пристрой</h1>

<!-- filters-->
<div class="row-fluid">

    <div class="span7">

        <div class="well well-small offset-bottom3">

            <form class="form-horizontal ot_form">

                <div class="control-group">
                    <label class="control-label bold" for="">Пользователь</label>
                    <div class="controls">
                        <input type="text" class="input-medium" data-provide="typeahead" id="ot_user_login_filter" title="Введите первые символы">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label bold text-right">Статусы</label>
                    <div class="controls">
                        <label class="checkbox inline"><input type="checkbox" checked="checked">На модерации</label>
                        <label class="checkbox inline"><input type="checkbox">Отклонены</label>
                        <label class="checkbox inline"><input type="checkbox">Утверждены</label>
                    </div>
                </div>

                <div class="controls">
                    <button type="button" class="btn btn-tiny btn_preloader btn-primary" data-loading-text="Применить" autocomplete="off">Применить</button>
                    <button type="button" class="btn btn-tiny pull-right">Сбросить фильтры</button>
                </div>

            </form>

        </div>

    </div>

</div><!-- /filters-->

<!-- group actions, per page items -->
<div class="row-fluid">

    <div class="span10">

        <div class="btn-group">
            <button class="btn btn-tiny" title="Утвердить выбранные товары"><span class="text-success"><i class="icon-ok"></i> Утвердить</span></button>
            <button class="btn btn-tiny offset-left05" title="Отклонить выбранные товары"><span class="text-error"><i class="icon-ban-circle"></i> Отклонить</span></button>
        </div>

        <button class="btn btn-tiny offset-left2 ot_show_settle_item_dicline_window" title="Снять выбранные товары с продажи"><i class="icon-remove"></i> Снять с продажи</button>
    </div>

    <div class="span2 text-right">
        <select class="input-mini" id="perpage">
            <option value="10">10</option>
            <option value="25" selected="selected">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="all">Все</option>
        </select>
    </div>

</div><!-- /group actions, per page items -->

<!-- goods list -->
<table class="table ot_pristroy_moderation">

    <thead>
        <tr>
            <th><input type="checkbox"></th>
            <th>Пользователь</th>
            <th>Товар</th>
            <th>Кол-во</th>
            <th>Цена, $</th>
            <th>Статус</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td><input type="checkbox"></td>
            <td><a href="users/customers/user-profile" title="Профиль пользователя">qwe-qwe</a></td>
            <td>
                <div class="media">

                    <div class="goods_pics" data-toggle="modal-gallery" data-target="#modal-gallery">

                        <a href="img/pic/goods/goods5.jpg" class="thumbnail thumbnail-mini" title="Увеличить фотографию" data-gallery="gallery">
                            <img src="img/pic/goods/goods5.jpg" alt="Пуэрчег средней полосы Тяньшаня">
                        </a>

                        <a href="img/pic/goods/goods3.jpg" class="thumbnail thumbnail-mini" title="Увеличить фотографию" data-gallery="gallery"><img src="img/pic/goods/goods3.jpg" alt="Пуэрчег средней полосы Тяньшаня"></a>

                        <a href="img/pic/goods/goods6.jpg" class="thumbnail thumbnail-mini" title="Увеличить фотографию" data-gallery="gallery"><img src="img/pic/goods/goods6.jpg" alt="Пуэрчег средней полосы Тяньшаня"></a>

                        <p class="all_numbers" title="Всего фотографий"><i class="icon-picture"></i> 3</p>

                    </div>

                    <div class="media-body">

                        <div class="row-fluid">

                            <div class="span9">
                                <h5 class="media-heading">
                                    <a href="#" title="Страница товара на сайте">Пуэрчег средней полосы Тяньшаня</a>
                                    (<a class="blink ot_show_settle_descr_window" href="#">Описание товара</a>)
                                </h5>
                                <strong class="text-error">Причина предыдущего отклонения</strong>
                                <form class="form-horizontal ot_form" action="">
                                    <textarea cols="10" rows="1" class="span10 ot_autosized_textarea" placeholder="Причина (обязательна при отклонении)">Изображение не соответствует описанию товара. Пользователь зарегистрирован два дня назад — доверия нет.</textarea>
                                    <button class="btn btn-tiny" title="Отклонить товар"><i class="icon-ban-circle"></i></button>
                                </form>
                            </div>

                            <div class="span3 text-right">
                                <button class="btn btn-tiny" title="Утвердить товар"><i class="icon-ok"></i></button>
                                <a href="cat/settle/crud" class="btn btn-tiny" title="Редактировать товар"><i class="icon-pencil"></i></a>
                                <button class="btn btn-tiny ot_show_settle_item_dicline_window" title="Снять товар с продажи"><i class="icon-remove"></i></button>
                            </div>

                        </div>

                    </div>

                </div><!-- /.media -->
            </td>
            <td>1</td>
            <td>2312.2</td>
            <td><span class="label weight-normal">На модерации</span></td>
        </tr>

        <tr>
            <td><input type="checkbox"></td>
            <td><a href="users/customers/user-profile" title="Профиль пользователя">123asdad123</a></td>
            <td>
                <div class="media">

                    <div class="goods_pics" data-toggle="modal-gallery" data-target="#modal-gallery">

                        <a href="img/pic/goods/goods4.jpg" class="thumbnail thumbnail-mini" data-gallery="gallery" title="Увеличить фотографию">
                            <img src="img/pic/goods/goods4.jpg" alt="Настоящий испанец породистых кровей">
                        </a>

                        <a href="img/pic/goods/goods1.jpg" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods1.jpg" alt=""></a>

                        <p class="all_numbers" title="Всего фотографий"><i class="icon-picture"></i> 2</p>

                    </div>


                    <div class="media-body">

                        <div class="row-fluid">

                            <div class="span9">
                                <h5 class="media-heading"><a href="#" title="Страница товара на сайте">Настоящий испанец породистых кровей</a>
                                    (<a class="blink ot_show_settle_descr_window" href="#">Описание товара</a>)</h5>
                                <form class="form-horizontal ot_form" action="">
                                    <textarea cols="1" rows="1" class="span10 ot_autosized_textarea" placeholder="Причина (обязательна при отклонении)"></textarea>
                                    <button class="btn btn-tiny disabled" title="Отклонить товар"><i class="ot-preloader-micro"></i></button>
                                </form>

                            </div>

                            <div class="span3 text-right">
                                <button class="btn btn-tiny disabled" title="Утвердить товар"><i class="ot-preloader-micro"></i></button>
                                <a href="cat/settle/crud" class="btn btn-tiny" title="Редактировать товар"><i class="icon-pencil"></i></a>
                                <button class="btn btn-tiny ot_show_settle_item_dicline_window" title="Снять товар с продажи"><i class="icon-remove"></i></button>
                            </div>

                        </div>



                    </div><!-- /.media body -->

                </div><!-- /.media -->
            </td>
            <td>1</td>
            <td>788.8</td>
            <td><span class="label weight-normal">На модерации</span></td>
        </tr>

        <tr class="selected_item">
            <td><input type="checkbox" checked="checked"></td>
            <td><a href="users/customers/user-profile" title="Профиль пользователя">GSP</a></td>
            <td>
                <div class="media">

                    <div class="goods_pics" data-toggle="modal-gallery" data-target="#modal-gallery">
                        <a href="img/pic/goods/goods2.jpg" class="thumbnail thumbnail-mini" title="Увеличить фотографию" data-gallery="gallery">
                            <img src="img/pic/goods/goods2.jpg" alt="Мандула обыкновенная">
                        </a>
                    </div>

                    <div class="media-body">

                            <div class="row-fluid">

                                <div class="span9">
                                    <h5 class="media-heading"><a href="#" title="Страница товара на сайте">Мандула обыкновенная</a>
                                        (<a class="blink ot_show_settle_descr_window" href="#">Описание товара</a>)</h5>
                                    <form class="form-horizontal ot_form" action="">
                                        <textarea cols="10" rows="1" class="span10 ot_autosized_textarea" placeholder="Причина (обязательна при отклонении)"></textarea>
                                        <button class="btn btn-tiny" title="Отклонить товар"><i class="icon-ban-circle"></i></button>
                                    </form>
                                </div>

                                <div class="span3 text-right">
                                    <button class="btn btn-tiny" title="Утвердить товар"><i class="icon-ok"></i></button>
                                    <a href="cat/settle/crud" class="btn btn-tiny" title="Редактировать товар"><i class="icon-pencil"></i></a>
                                    <button class="btn btn-tiny ot_show_settle_item_dicline_window" title="Снять товар с продажи"><i class="icon-remove"></i></button>
                                </div>

                            </div>

                    </div>
                </div>
            </td>
            <td>1</td>
            <td>788.8</td>
            <td><span class="label weight-normal">На модерации</span></td>
        </tr>

        <tr>
                <td><input type="checkbox"></td>
                <td><a href="users/customers/user-profile" title="Профиль пользователя">Дэн Сяо-Пин</a></td>
                <td>
                    <div class="media">
                        <div class="goods_pics" data-toggle="modal-gallery" data-target="#modal-gallery">
                            <a href="img/pic/goods/goods6.jpg" class="thumbnail thumbnail-mini" title="Увеличить фотографию" data-gallery="gallery">
                                <img src="img/pic/goods/goods6.jpg" alt="Abibas Nanostar (grey felt edition)">
                            </a>
                        </div>

                        <div class="media-body">

                                <div class="row-fluid">

                                    <div class="span9">
                                        <h5 class="media-heading"><a href="#" title="Страница товара на сайте">Abibas Nanostar (grey felt edition) Взрывать стиль adidas клевер ползучий 4 threadings цветной пленки мужские и женские панель ебать копать обувь Q20624/Q20625/Q20626/G63778</a>
                                            (<a class="blink ot_show_settle_descr_window" href="#">Описание товара</a>)</h5>
                                        <div class="well well-small offset-bottom0">
                                            <strong class="text-error">Причина отклонения:</strong> <span class="font-12">Изображение не соответствует описанию товара. Пользователь зарегистрирован два дня назад — доверия нет.</span>
                                            <!--<textarea cols="10" rows="1" class="span10 ot_autosized_textarea" placeholder="Причина (обязательна при отклонении)">Изображение не соответствует описанию товара. Пользователь зарегистрирован два дня назад — доверия нет.</textarea>-->

                                            <!--<button class="btn btn-tiny disabled" title="Отклонить товар"><i class="icon-ban-circle"></i></button>-->
                                        </div>

                                    </div>

                                    <div class="span3 text-right">
                                        <button class="btn btn-tiny" title="Утвердить товар"><i class="icon-ok"></i></button>
                                        <a href="cat/settle/crud" class="btn btn-tiny" title="Редактировать товар"><i class="icon-pencil"></i></a>
                                        <button class="btn btn-tiny ot_show_settle_item_dicline_window" title="Снять товар с продажи"><i class="icon-remove"></i></button>
                                    </div>

                                </div>


                        </div>
                    </div>
                </td>
                <td>1</td>
                <td>1556.5</td>
                <td><span class="label label-important weight-normal">Отклонён</span></td>
            </tr>

        <tr>
                <td><input type="checkbox"></td>
                <td><a href="users/customers/user-profile" title="Профиль пользователя">test</a></td>
                <td>
                    <div class="media">
                        <div class="goods_pics">
                            <div class="thumbnail thumbnail-mini">
                                <div class="thumbnail-placeholder" title="Изображение отсутствует"><i class="icon-picture"></i></div>
                            </div>
                        </div>

                        <div class="media-body">

                                <div class="row-fluid">

                                    <div class="span9">
                                        <h5 class="media-heading"><a href="#" title="Страница товара на сайте">Американец западн-типа Swalee- увядший цветок Обводит стул для того чтобы обвести стул для отдыха Софа для отдыха Дуб стула книги стула обводит стул</a>
                                            (<a class="blink ot_show_settle_descr_window" href="#">Описание товара</a>)</h5>
                                        <form class="form-horizontal ot_form" action="">
                                            <textarea cols="10" rows="1" class="span10 ot_autosized_textarea" placeholder="Причина (обязательна при отклонении)"></textarea>
                                            <button class="btn btn-tiny" title="Отклонить товар"><i class="icon-ban-circle"></i></button>
                                        </form>

                                    </div>

                                    <div class="span3 text-right">
<!--                                        <button class="btn btn-tiny" title="Утвердить товар"><i class="icon-ok"></i></button>-->
                                        <a href="cat/settle/crud" class="btn btn-tiny" title="Редактировать товар"><i class="icon-pencil"></i></a>
                                        <button class="btn btn-tiny ot_show_settle_item_dicline_window" title="Снять товар с продажи"><i class="icon-remove"></i></button>
                                    </div>

                                </div>

                        </div>
                    </div>
                <td>1</td>
                <td>1135.8</td>
                <td><span class="label label-success weight-normal">Утверждён</span></td>
            </tr>

        <tr>
            <td><input type="checkbox"></td>
            <td><a href="users/customers/user-profile" title="Профиль пользователя">test</a></td>
            <td>
                <div class="media">
                    <div class="goods_pics" data-toggle="modal-gallery" data-target="#modal-gallery">
                        <a href="img/pic/goods/goods7.jpg" class="thumbnail thumbnail-mini" title="Увеличить фотографию" data-gallery="gallery">
                            <img src="img/pic/goods/goods7.jpg" alt="Abibas Nanostar (grey felt edition)">
                        </a>
                    </div>

                    <div class="media-body">

                        <div class="row-fluid">

                            <div class="span9">
                                <h5 class="media-heading"><a href="#" title="Страница товара на сайте">Boss Metal Core</a>
                                    (<a class="blink ot_show_settle_descr_window" href="#">Описание товара</a>)</h5>
                                <form class="form-horizontal ot_form" action="">
                                    <textarea cols="10" rows="1" class="span10 ot_autosized_textarea" placeholder="Причина (обязательна при отклонении)"></textarea>
                                    <button class="btn btn-tiny" title="Отклонить товар"><i class="icon-ban-circle"></i></button>
                                </form>

                            </div>

                            <div class="span3 text-right">
                                <!--                                        <button class="btn btn-tiny" title="Утвердить товар"><i class="icon-ok"></i></button>-->
                                <a href="cat/settle/crud" class="btn btn-tiny" title="Редактировать товар"><i class="icon-pencil"></i></a>
                                <button class="btn btn-tiny ot_show_settle_item_dicline_window" title="Снять товар с продажи"><i class="icon-remove"></i></button>
                            </div>

                        </div>

                    </div>
                </div>
            <td>1</td>
            <td>1135.8</td>
            <td><span class="label label-success weight-normal">Утверждён</span></td>        </tr>

    </tbody>

</table><!-- /goods list -->

<!-- pager -->
<? include('inc/pager.php'); ?>


<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">

    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h3 class="modal-title"></h3>
    </div>

    <div class="modal-body"><div class="modal-image"></div></div>

    <div class="modal-footer">

        <div class="row-fluid">

            <div class="span6 text-left">
                <div class="btn-group">
                    <button class="btn btn-primary modal-prev" title="Предыдущее"><i class="icon-arrow-left icon-white"></i></button>
                    <button class="btn btn-primary modal-next" title="Следующее"><i class="icon-arrow-right icon-white"></i></button>
                </div>
            </div>

            <div class="span6 text-right">
                <button href="#" class="btn" data-dismiss="modal">Закрыть</button>
            </div>

        </div>

    </div>

</div><!-- /modal-gallery-->


<!-- item description window -->
<div class="modal hide fade ot_settle_descr_window">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Описание товара</h3>
    </div>

    <div class="modal-body">

        <div id="photos-inner"><table border="0" cellpadding="0" cellspacing="0" style="border-color: black;margin: 0.0px;color: #404040;border-spacing: 0.0px;" width="738">  <tbody><tr> <td colspan="3" style="border-color: black;"> <table border="0" cellpadding="0" cellspacing="0" style="border-color: black;margin: 0.0px;border-spacing: 0.0px;" width="738">  <tbody><tr> <td colspan="3" style="border-color: black;"> <img height="27" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T2Y6wiXlNaXXXXXXXX_!!263363138.jpg" width="740"> </td> </tr> <tr> <td height="274" style="border-color: black;" width="12"> <img align="middle" height="274" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T210krXepXXXXXXXXX_!!263363138.jpg" width="6"> </td> <td height="274" style="border-color: black;" width="720"> <table align="center" border="1" bordercolor="#999999" cellpadding="0" cellspacing="0" height="226" style="border-color: black;margin: 0.0px;border-spacing: 0.0px;" width="710">  <tbody><tr> <td colspan="3" height="30" style="border-color: black;"> <table align="center" border="1" bordercolor="#999999" cellpadding="0" cellspacing="0" height="226" style="border-color: black;margin: 0.0px;color: #000000;line-height: 18.0px;font-family: tahoma arial 宋体;font-size: 12.0px;border-collapse: collapse;border-spacing: 0.0px;" width="710">  <tbody><tr> <td colspan="3" height="30" style="border-color: black;"> <span style="font-family: microsoft yahei;">商品名称：双面穿冬季正品耐克Nike保暖男款加厚休闲羽绒服</span><br> </td> </tr> <tr> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">含绒量：75%</span><br> </td> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">货 号：444742-060</span><br> </td> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">性 别：男</span><br> </td> </tr> <tr> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">材 质：聚酯纤维 100%</span> </td> <td height="30" style="border-color: black;" width="236"> <p style="line-height: 1.4;"> <span style="font-family: microsoft yahei;">产 地：孟加拉共和国<span style="font-size: 8.0px;">（不同批次产品可能产地不同）</span></span> </p> </td> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">专柜原价：￥1199</span> </td> </tr> <tr> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">发货地：辽宁大连A1 &nbsp;广东广州A14 &nbsp;广东深圳A5 &nbsp;辽宁大连A15</span> </td> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">颜 色：<br> </span> </td> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">C &nbsp;H &nbsp;:</span> </td> </tr> <tr> <td colspan="3" height="100" style="border-color: black;"> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">注意事项：</span> </p> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">1.<span style="color: #404040;line-height: 19.0px;">本店销售商品均为专柜正品，接受各种渠道各种方式验货，并且支持7天无理由</span><span style="color: #404040;line-height: 19.0px;">退换，请您放</span><span style="color: #404040;line-height: 19.0px;">心试购！</span></span> </p> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">2.因拍摄过程中受闪光、角度等因素影响，照片与实物可能会有色差.各位买家购买的商品颜色均以实物为准。</span> </p> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">3.本店所有鞋类商品在尺码栏所标尺码为<font color="#ff0000"><b>EUR码</b><span style="color: #000000;">或者</span><b>FR码</b></font>，关于尺码的相关说明请看下方尺码表。</span> </p> </td> </tr>  </tbody></table> </td> </tr>  </tbody></table> </td> <td height="274" style="border-color: black;" width="8"> <img align="middle" height="274" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T210krXepXXXXXXXXX_!!263363138.jpg" width="6"> </td> </tr> <tr> <td colspan="3" height="19" style="border-color: black;"> <img height="6" src="http://img01.taobaocdn.com/imgextra/i1/263363138/T2cmArXXRXXXXXXXXX_!!263363138.jpg" width="738"> </td> </tr>  </tbody></table> <table align="left" border="0" width="738">  <tbody><tr> <td colspan="3"> <img height="27" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T2kasGXoRXXXXXXXXX_!!263363138.jpg" width="738"> </td> </tr> <tr> <td height="242" width="8"> <img height="243" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T2uZ7aXcxbXXXXXXXX_!!263363138.jpg" width="6"> </td> <td height="242" width="716"> <table align="center" bgcolor="#ffffff" border="2" bordercolor="#999999" cellspacing="1" width="713">  <tbody><tr> <td width="120"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">尺码/项目</span></span> </div> </div> </td> <td width="90"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">肩宽</span></span> </div> </div> </td> <td width="90"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">胸围</span></span> </div> </div> </td> <td width="90"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">袖长</span></span> </div> </div> </td> <td width="90"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">衣长</span></span> </div> </div> </td> <td width="194"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">备注</span></span> </div> </div> </td> </tr> <tr> <td width="120"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">XS</span></span> </div> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> <td width="194"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> </tr> <tr> <td width="120"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">S</span></span> </div> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">41</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">112</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">69</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> <td width="194"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> </tr> <tr> <td width="120"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">M</span></span> </div> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">43</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">116</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">70</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> <td width="194"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> </tr> <tr> <td width="120"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">L</span></span> </div> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">45</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">120</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">71</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> <td width="194"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> </tr> <tr> <td width="120"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">XL</span></span> </div> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">48</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">128</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">72</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> <td width="194"> <div align="center"> <span style="font-family: microsoft yahei;font-size: 11.81px;">0</span> </div> </td> </tr> <tr> <td height="25" width="120"> <div align="center"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">XXL</span></span> </div> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">50</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">134</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">73</span></span> </div> </td> <td width="90"> <div align="center"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">0</span></span> </div> </td> <td width="194"> <div align="center"> <span style="font-family: microsoft yahei;font-size: 11.81px;">0</span> </div> </td> </tr> <tr> <td colspan="6" height="57"> <div align="center"> <div align="center"> <p align="left"> <span style="font-size: 12.0px;"><span style="font-family: microsoft yahei;">注意事项：本平铺尺码表数据为仕稼运动工作人员手工测量，因个体商品差异和个人测量手法不同，可能导致您收到的商品与本表中数据存在一定误差，误差范围为1-3cm，请您理解。</span></span> </p> </div> </div> </td> </tr>  </tbody></table> </td> <td width="6"> <img height="243" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T2uZ7aXcxbXXXXXXXX_!!263363138.jpg" width="6"> </td> </tr> <tr> <td colspan="3" height="8"> <img height="6" src="http://img03.taobaocdn.com/imgextra/i3/263363138/T2.HUGXl0XXXXXXXXX_!!263363138.jpg" width="738"> </td> </tr>  </tbody></table> <p> <img align="absmiddle" src="http://img03.taobaocdn.com/imgextra/i3/263363138/T2d10sXplXXXXXXXXX_!!263363138.jpg"><img align="absmiddle" src="http://img01.taobaocdn.com/imgextra/i1/263363138/T2Ij0JXfdbXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;font-size: 14.0px;"><img align="absmiddle" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T2nD4GXXRbXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;font-size: 14.0px;"><img align="absmiddle" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T21P.TXolaXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;font-size: 14.0px;"><img align="absmiddle" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T2Iy4rXptXXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;font-size: 14.0px;"><img align="absmiddle" src="http://img03.taobaocdn.com/imgextra/i3/263363138/T2l94qXpNXXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;font-size: 14.0px;"> </p> </td> </tr>  </tbody></table> <p> <img align="middle" style="line-height: 1.5;font-size: 14.0px;"> </p> <table border="0" cellpadding="0" cellspacing="0" style="border-color: black;margin: 0.0px;color: #404040;border-spacing: 0.0px;" width="738">  <tbody><tr> <td colspan="3" style="border-color: black;"> <table border="0" cellpadding="0" cellspacing="0" style="border-color: black;margin: 0.0px;border-spacing: 0.0px;" width="738">  <tbody><tr> <td colspan="3" style="border-color: black;"> <img height="27" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T2Y6wiXlNaXXXXXXXX_!!263363138.jpg" width="740"> </td> </tr> <tr> <td height="274" style="border-color: black;" width="12"> <img align="middle" height="274" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T210krXepXXXXXXXXX_!!263363138.jpg" width="6"> </td> <td height="274" style="border-color: black;" width="720"> <table align="center" border="1" bordercolor="#999999" cellpadding="0" cellspacing="0" height="226" style="border-color: black;margin: 0.0px;border-spacing: 0.0px;" width="710">  <tbody><tr> <td colspan="3" height="30" style="border-color: black;"> <table align="center" border="1" bordercolor="#999999" cellpadding="0" cellspacing="0" height="226" style="border-color: black;margin: 0.0px;color: #000000;line-height: 18.0px;font-family: tahoma arial 宋体;font-size: 12.0px;border-collapse: collapse;border-spacing: 0.0px;" width="710">  <tbody><tr> <td colspan="3" height="30" style="border-color: black;"> <span style="font-family: microsoft yahei;">商品名称：双面穿冬季正品耐克Nike保暖男款加厚休闲羽绒服</span><br> </td> </tr> <tr> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">含绒量：75%</span><br> </td> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">货 号：444742-680</span><br> </td> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">性 别：男</span><br> </td> </tr> <tr> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">材 质：聚酯纤维 100%</span> </td> <td height="30" style="border-color: black;" width="236"> <p style="line-height: 1.4;"> <span style="font-family: microsoft yahei;">产 地：孟加拉共和国<span style="font-size: 8.0px;">（不同批次产品可能产地不同）</span></span> </p> </td> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">专柜原价：￥1199</span> </td> </tr> <tr> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">发货地：辽宁大连A1 &nbsp;</span><span style="font-family: microsoft yahei;">广东广州A14 &nbsp;广东深圳A5 辽宁大连AO&nbsp;</span><span style="font-family: microsoft yahei;">辽宁大连A15</span> </td> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">颜 色：<br> </span> </td> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">C &nbsp;H &nbsp;:</span> </td> </tr> <tr> <td colspan="3" height="100" style="border-color: black;"> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">注意事项：</span> </p> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">1.<span style="color: #404040;line-height: 19.0px;">本店销售商品均为专柜正品，接受各种渠道各种方式验货，并且支持7天无理由</span><span style="color: #404040;line-height: 19.0px;">退换，请您放</span><span style="color: #404040;line-height: 19.0px;">心试购！</span></span> </p> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">2.因拍摄过程中受闪光、角度等因素影响，照片与实物可能会有色差.各位买家购买的商品颜色均以实物为准。</span> </p> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">3.本店所有鞋类商品在尺码栏所标尺码为<font color="#ff0000"><b>EUR码</b><span style="color: #000000;">或者</span><b>FR码</b></font>，关于尺码的相关说明请看下方尺码表。</span> </p> </td> </tr>  </tbody></table> </td> </tr>  </tbody></table> </td> <td height="274" style="border-color: black;" width="8"> <img align="middle" height="274" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T210krXepXXXXXXXXX_!!263363138.jpg" width="6"> </td> </tr> <tr> <td colspan="3" height="19" style="border-color: black;"> <img height="6" src="http://img01.taobaocdn.com/imgextra/i1/263363138/T2cmArXXRXXXXXXXXX_!!263363138.jpg" width="738"> </td> </tr>  </tbody></table> <p> <img align="absmiddle" src="http://img03.taobaocdn.com/imgextra/i3/263363138/T275mCXp0aXXXXXXXX_!!263363138.png"><img align="absmiddle" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T2nfGHXptXXXXXXXXX_!!263363138.png" style="line-height: 1.5;"><img align="absmiddle" src="http://img01.taobaocdn.com/imgextra/i1/263363138/T2MlGCXt4aXXXXXXXX_!!263363138.png" style="line-height: 1.5;"><img align="absmiddle" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T2RjiGXxpXXXXXXXXX_!!263363138.png" style="line-height: 1.5;"><img align="absmiddle" src="http://img01.taobaocdn.com/imgextra/i1/263363138/T21N1HXrXXXXXXXXXX_!!263363138.png" style="line-height: 1.5;"> </p> <p> <img align="absmiddle" src="http://img03.taobaocdn.com/imgextra/i3/263363138/T23kJEXatbXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;font-size: 14.0px;"> </p> </td> </tr>  </tbody></table> <p> &nbsp; </p> <table border="0" cellpadding="0" cellspacing="0" style="border-color: black;margin: 0.0px;color: #404040;border-spacing: 0.0px;" width="738">  <tbody><tr> <td colspan="3" style="border-color: black;"> <table border="0" cellpadding="0" cellspacing="0" style="border-color: black;margin: 0.0px;border-spacing: 0.0px;" width="738">  <tbody><tr> <td colspan="3" style="border-color: black;"> <img height="27" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T2Y6wiXlNaXXXXXXXX_!!263363138.jpg" width="740"> </td> </tr> <tr> <td height="274" style="border-color: black;" width="12"> <img align="middle" height="274" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T210krXepXXXXXXXXX_!!263363138.jpg" width="6"> </td> <td height="274" style="border-color: black;" width="720"> <table align="center" border="1" bordercolor="#999999" cellpadding="0" cellspacing="0" height="226" style="border-color: black;margin: 0.0px;border-spacing: 0.0px;" width="710">  <tbody><tr> <td colspan="3" height="30" style="border-color: black;"> <table align="center" border="1" bordercolor="#999999" cellpadding="0" cellspacing="0" height="226" style="border-color: black;margin: 0.0px;color: #000000;line-height: 18.0px;font-family: tahoma arial 宋体;font-size: 12.0px;border-collapse: collapse;border-spacing: 0.0px;" width="710">  <tbody><tr> <td colspan="3" height="30" style="border-color: black;"> <span style="font-family: microsoft yahei;">商品名称：双面穿冬季正品耐克Nike保暖男款加厚休闲羽绒服</span><br> </td> </tr> <tr> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">商品系列：</span><br> </td> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">货 号：444742-611</span><br> </td> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">性 别：男</span><br> </td> </tr> <tr> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">材 质：</span> </td> <td height="30" style="border-color: black;" width="236"> <p style="line-height: 1.4;"> <span style="font-family: microsoft yahei;">产 地：<span style="font-size: 8.0px;">（不同批次产品可能产地不同）</span></span> </p> </td> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">专柜原价：￥1199</span> </td> </tr> <tr> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">发货地：辽宁大连A1 &nbsp;</span><span style="font-family: microsoft yahei;">广东广州A14 &nbsp;广东深圳A5 辽宁大连AO&nbsp;</span><span style="font-family: microsoft yahei;">辽宁大连A15</span> </td> <td bgcolor="#cccccc" height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">颜 色：<br> </span> </td> <td height="30" style="border-color: black;" width="236"> <span style="font-family: microsoft yahei;">C &nbsp;H &nbsp;:</span> </td> </tr> <tr> <td colspan="3" height="100" style="border-color: black;"> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">注意事项：</span> </p> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">1.<span style="color: #404040;line-height: 19.0px;">本店销售商品均为专柜正品，接受各种渠道各种方式验货，并且支持7天无理由</span><span style="color: #404040;line-height: 19.0px;">退换，请您放</span><span style="color: #404040;line-height: 19.0px;">心试购！</span></span> </p> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">2.因拍摄过程中受闪光、角度等因素影响，照片与实物可能会有色差.各位买家购买的商品颜色均以实物为准。</span> </p> <p style="line-height: 1.4;margin-top: 0.0px;margin-bottom: 0.0px;"> <span style="font-family: microsoft yahei;">3.本店所有鞋类商品在尺码栏所标尺码为<font color="#ff0000"><b>EUR码</b><span style="color: #000000;">或者</span><b>FR码</b></font>，关于尺码的相关说明请看下方尺码表。</span> </p> </td> </tr>  </tbody></table> </td> </tr>  </tbody></table> </td> <td height="274" style="border-color: black;" width="8"> <img align="middle" height="274" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T210krXepXXXXXXXXX_!!263363138.jpg" width="6"> </td> </tr> <tr> <td colspan="3" height="19" style="border-color: black;"> <img height="6" src="http://img01.taobaocdn.com/imgextra/i1/263363138/T2cmArXXRXXXXXXXXX_!!263363138.jpg" width="738"> </td> </tr>  </tbody></table> <p> <img align="absmiddle" src="http://img03.taobaocdn.com/imgextra/i3/263363138/T20f9DXDFXXXXXXXXX_!!263363138.png"><img align="absmiddle" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T2et1FXx8XXXXXXXXX_!!263363138.png" style="line-height: 1.5;"><img align="absmiddle" src="http://img01.taobaocdn.com/imgextra/i1/263363138/T2uxyIXptXXXXXXXXX_!!263363138.png" style="line-height: 1.5;"><img align="absmiddle" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T2ah5CXupaXXXXXXXX_!!263363138.png" style="line-height: 1.5;"><img align="absmiddle" src="http://img01.taobaocdn.com/imgextra/i1/263363138/T2Xs9HXulXXXXXXXXX_!!263363138.png" style="line-height: 1.5;"><img align="absMiddle" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T2Mb4xXoxNXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;"><img align="absMiddle" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T29l8KXa0dXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;"><img align="absMiddle" src="http://img03.taobaocdn.com/imgextra/i3/263363138/T2u01mXf8cXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;"><img align="absMiddle" src="http://img03.taobaocdn.com/imgextra/i3/263363138/T2p3zcXXBXXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;"><img align="absMiddle" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T2AyjbXftaXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;"> </p> </td> </tr>  </tbody></table> <p> <strong><span style="font-size: 18.0px;"><span style="font-family: microsoft yahei;">&nbsp;货号：444742-231 &nbsp; 发货地：辽宁大连A15</span></span></strong> </p> <p> <strong><span style="font-size: 18.0px;"><span style="font-family: microsoft yahei;"></span></span></strong><img align="absmiddle" src="http://img01.taobaocdn.com/imgextra/i1/263363138/T25Mn8XXpbXXXXXXXX_!!263363138.jpg"><img align="absmiddle" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T2aCZXXdRbXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;"><img align="absmiddle" src="http://img01.taobaocdn.com/imgextra/i1/263363138/T22UtSXsdXXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;"><img align="absmiddle" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T2s7n5XclbXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;"><img align="absmiddle" src="http://img02.taobaocdn.com/imgextra/i2/263363138/T27Xr6XcVbXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;"><img align="absmiddle" src="http://img04.taobaocdn.com/imgextra/i4/263363138/T2.uVWXr4XXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;"><img src="http://img02.taobaocdn.com/imgextra/i2/263363138/T2SJVaXXROXXXXXXXX_!!263363138.jpg" style="line-height: 1.5;color: #404040;margin: 0.0px;padding: 0.0px;float: none;"> </p></div>


    </div>

    <div class="modal-footer">
        <button type="button" class="btn pull-right" data-dismiss="modal">Закрыть</button>
    </div>

</div><!-- /item description window -->

<!-- item dicline sys dialog -->
<div class="modal modal-no-header hide fade ot_settle_item_dicline_window">

    <button type="button" class="close" data-dismiss="modal">×</button>

    <div class="modal-body">
        <p>Вы уверены что хотите снять с продажи выбраный товар?</p>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left btn_preloader" autocomplete="off" data-loading-text="Снять с продажи">Снять с продажи</button>
        <button type="button" class="btn pull-right" data-dismiss="modal">Отменить</button>
    </div>

</div><!-- /item dicline sys dialog -->