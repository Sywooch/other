
<!-- upload photos window -->
<div class="modal hide fade ot_add_order_item_photos_window" tabindex="-1">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Добавить фотографии товара</h3>
    </div>

    <div class="modal-body">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#web-cam-photo" data-toggle="tab">C веб-камеры</a></li>
            <li><a href="#upload-photo" data-toggle="tab">Загрузить</a></li>
            <li><a href="#link-photo" data-toggle="tab">Ссылка</a></li>
        </ul>

        <div class="tab-content">

            <!-- web-cam-photo tab -->
            <div class="tab-pane active" id="web-cam-photo">

                <div class="offset-bottom05">
                    <img src="img/pic/cam-view.png" alt=""/>
                </div>

                <div class="text-center">
                    <button href="#" class="btn btn-primary"><i class="icon-camera"></i> Снять</button>

                    <button href="#" class="btn btn-primary">Загрузить</button>
                    <button href="#" class="btn offset-left1">Отменить</button>
                </div>
            </div>

            <!-- upload-photo tab-->
            <div class="tab-pane" id="upload-photo">

                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail thumbnail-mini">
                        <div class="thumbnail-placeholder"><i class="icon-picture"></i></div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail thumbnail-mini"></div>
                    <span class="btn btn-primary btn-file">
                        <span class="fileupload-new">Выбрать изображение</span>
                        <span class="fileupload-exists">Изменить</span>
                        <input type="file" />
                    </span>
                    <span class="btn btn-warning fileupload-exists" data-dismiss="fileupload">Удалить</span>
                </div>

                <i class="icon-plus color-blue"></i> <span class="blink offset-bottom05" title="Добавить еще одно изображение">Добавить еще</span>

            </div>

            <!-- link-photo tab -->
            <div class="tab-pane" id="link-photo">

                <input type="hidden" name="count" value="1" />

                <div class="control-group offset-bottom2" id="fields">

                    <input autocomplete="off" class="span9" id="field1" name="prof1" type="text" placeholder="Введите адрес изображения (URL)" /> <br>
                    <i class="icon-plus color-blue"></i> <span id="b1" onClick="addFormField()" class="blink offset-bottom05" type="button" title="Добавить еще одно поле">Добавить еще</span>

                </div>

                <script type="text/javascript">
                    var next = 1;
                    function addFormField(){
                        var addto = "#field" + next;
                        next = next + 1;
                        var newIn = '<br><input autocomplete="off" class="span9" id="field' + next + '" name="field' + next + '" type="text" placeholder="Введите адрес изображения (URL)">';
                        var newInput = $(newIn);
                        $(addto).after(newInput);
                        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
                        $("#count").val(next);
                    }
                </script>

                <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>

                <hr>

                <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>
                <p class="help-inline text-success"><i class="icon-ok"></i> Изображение успешно сохранено!</p>
                <hr>
                <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>
                <p class="help-inline text-error"><i class="icon-minus-sign"></i> Произошла ошибка при сохранении изображения. <br> <a href="#" class="blink ot_show_modal_dialog">Напишите</a> о проблеме в службу поддержки.</p>
            </div>

        </div>

    </div>

    <div class="modal-footer">
        <a href="#" class="btn pull-right" data-dismiss="modal">Закрыть</a>
    </div>

</div>

