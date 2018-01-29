
                <?
                    if (! empty($debugLog)) {
                        include TPL_ABSOLUTE_PATH . 'debug_log.php';
                    }
                ?>

            </div><!-- /.ot_content -->
        </div><!-- /.span10-->

    </div><!--/fluid-row-->

    <div id="underground"></div><!-- extra element for pushing footer -->

</section><!-- /#wrapper-->

<? require TPL_ABSOLUTE_PATH . 'global_modals.php'; ?>

<!-- global footer -->
<footer id="footer">
    <div class="row-fluid">

        <div class="span10 offset2">

            <a target="_blank" href="http://box.opentao.net/" class="ot_copyright"><i class="ot_logo"></i>Opentao.net</a>

        </div>

    </div>
</footer>

<a href="#top" rel="go_to_top" title="Наверх"><i class="icon-long-arrow-up"></i></a>

<!-- bootstrap -->
<script src="js/vendor/bootstrap.min.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- Polifills -->
<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- fixing elements to the top when scroling content -->
<script src="js/vendor/portamento.js?<?=CFG_ADMIN_VERSION;?>"></script>


<!-- fixing elements to the top when scroling content -->
<script src="js/vendor/waypoints.min.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/vendor/waypoints-sticky.min.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- datatables plugin — powerfull extention for tables -->
<script src="js/vendor/jquery.dataTables.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/vendor/dataTables-bootstrap.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/vendor/FixedHeader.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- Making long tabs into dropdown one -->
<script src="js/vendor/bootstrap-tabdrop.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- inline-editable fields -->
<script src="js/vendor/bootstrap-editable.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/vendor/moment.min.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- clickable tooltips -->
<script src="js/vendor/bootstrapx-clickover.js?<?=CFG_ADMIN_VERSION;?>"></script>

<script src="js/vendor/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js?<?=CFG_ADMIN_VERSION;?>"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/vendor/jQuery-File-Upload-master/js/jquery.iframe-transport.js?<?=CFG_ADMIN_VERSION;?>"></script>
<!-- The basic File Upload plugin -->
<script src="js/vendor/jQuery-File-Upload-master/js/jquery.fileupload.js?<?=CFG_ADMIN_VERSION;?>"></script>
<!-- The File Upload file processing plugin -->
<script src="js/vendor/jQuery-File-Upload-master/js/jquery.fileupload-fp.js?<?=CFG_ADMIN_VERSION;?>"></script>
<!-- The File Upload user interface plugin -->
<script src="js/vendor/jQuery-File-Upload-master/js/jquery.fileupload-ui.js?<?=CFG_ADMIN_VERSION;?>"></script>
<!-- The main application script -->
<script src="js/vendor/jQuery-File-Upload-master/js/main.js?<?=CFG_ADMIN_VERSION;?>"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="js/vendor/jQuery-File-Upload-master/js/cors/jquery.xdr-transport.js?<?=CFG_ADMIN_VERSION;?>"></script><![endif]-->

<!-- drug'n drop sortable  plugin -->
<script src="js/vendor/jquery-sortable.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!--  replacement for selects -->
<script src="js/vendor/select2.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/vendor/select2_locale_ru.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- datepicker -->
<script src="js/vendor/bootstrap-datepicker.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/vendor/bootstrap-datepicker.ru.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- lightbox -->
<script src="js/vendor/bootstrap-lightbox.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!--  files uploads -->
<script src="js/vendor/bootstrap-fileupload.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- new look of default selects -->
<script src="js/vendor/bootstrap-select.min.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- bootstrap-image-gallery -->
<script src="js/vendor/load-image.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/vendor/bootstrap-image-gallery.min.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- bootstrap-dropdown plugin -->
<script src="js/vendor/bootstrap-dropdown-ext.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- OT custom -->
<script src="js/plugins.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/ot-app.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/ot-common.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/ot-topmenu.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- js system notifications -->
<script src="js/vendor/jquery.pnotify.js?<?=CFG_ADMIN_VERSION;?>"></script>

<!-- improve preloading plugin -->
<script src="js/vendor/spin.min.js?<?=CFG_ADMIN_VERSION;?>"></script>
<script src="js/vendor/ladda.min.js?<?=CFG_ADMIN_VERSION;?>"></script>

<? ScriptIncluder::AddCustomScript('/js/vendor/jquery.alphanumeric.js'); ?>
<? ScriptIncluder::AddCustomScript('/js/vendor/jquery.livequery.min.js'); ?>
<? foreach(ScriptIncluder::GetCustomScripts() as $script){ ?>
    <script src="<?=$script . '?' . CFG_ADMIN_VERSION;?>"></script>
<? } ?>

<?=ErrorHandler::showRegisteredErrorsWithPNotify()?>

<script src="js/ot-inline.help.init.js?<?=CFG_ADMIN_VERSION;?>"></script>

    <?php if (Session::checkErrors()) { ?>
        <?php
        if (Session::getErrorCode() == 'SessionExpired') {
        ?>
            <script>
                window.location = '/admin-new/index.php?cmd=Login&do=logout';
            </script>
        <?php
        }
        ?>
        <script>
            $(function(){
                var ErrorMessage = "<?=preg_replace('#\s+#si', ' ', addslashes(Session::getErrorDescription()))?>";
                showError(ErrorMessage);
            });
        </script>
    <?php } ?>


    <?php if (Session::getMessage()) { ?>
        <script>
            $(function(){
                var infoMessage = "<?=htmlspecialchars(Session::getMessage());?>";
                if (infoMessage) {
                    showMessage(infoMessage);
                }
            });
        </script>
    <?php } ?>
    <?php if (Reports::hasUnPayedBills()) { ?>
        <script>
            $(function(){
                showStickyMessage('<?=LangAdmin::get('You_have_unpayd_bills')?> <br> <a href="<?=$PageUrl->AssignCmdAndDo('Reports', 'billing')?>"> <?=LangAdmin::get('Go_to')?></a>');
            });
        </script>
    <?php } ?>
</body>
</html>
