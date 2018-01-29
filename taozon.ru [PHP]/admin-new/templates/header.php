<? OTBase::import('system.lib.Assets'); ?>
<? OTBase::import('system.lib.Assets'); ?>
<? OTBase::import('system.lib.helpers.IDN'); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>☼ Административный интерфейс платформы Opentao</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Административный интерфейс платформы Opentao">
    <meta name="viewport" content="width=device-width">

    <!-- Fremavorks -->
    <link rel="stylesheet" href="css/vendor/bootstrap.min.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/bootstrap-responsive.min.css?<?=CFG_ADMIN_VERSION;?>">

    <!-- Plugins -->
    <link rel="stylesheet" href="css/vendor/dataTables-bootstrap.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/tabdrop.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/font-awesome.min.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/bootstrap-editable.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/select2.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/jquery.treeview.css?<?=CFG_ADMIN_VERSION;?>">

    <link rel="stylesheet" href="css/vendor/jquery.pnotify.css?<?=CFG_ADMIN_VERSION;?>">

    <link rel="stylesheet" href="css/vendor/bootstrap-lightbox.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/bootstrap-fileupload.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/bootstrap-select.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/bootstrap-image-gallery.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/bootstrap-dropdown-ext.css?<?=CFG_ADMIN_VERSION;?>">

    <link rel="stylesheet" href="css/vendor/jasny-bootstrap.min.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/vendor/fuelux.css?<?=CFG_ADMIN_VERSION;?>" />
    <!-- Uploader -->
    <link rel="stylesheet" href="css/vendor/jquery.fileupload-ui.css?<?=CFG_ADMIN_VERSION;?>">


    <!-- Themes -->
    <link rel="stylesheet" href="css/vendor/vendor-themes.css?<?=CFG_ADMIN_VERSION;?>">

    <link rel="stylesheet" href="css/vendor/fuelux.css?<?=CFG_ADMIN_VERSION;?>" />

    <!-- OT application -->
    <link rel="stylesheet" href="css/ot/ot-custom.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/ot/ot-app.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/ot/ot-pages.css?<?=CFG_ADMIN_VERSION;?>">
    <link rel="stylesheet" href="css/ot/ot-responsive.css?<?=CFG_ADMIN_VERSION;?>">

    <!-- improve preloading plugin -->
    <link rel="stylesheet" href="css/vendor/ladda.min.css?<?=CFG_ADMIN_VERSION;?>">


    <? foreach (Assets::getStyles() as $style) { ?>
        <link rel="stylesheet" href="<?=$style . '?' . CFG_ADMIN_VERSION;?>">
    <? } ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js?<?=CFG_ADMIN_VERSION;?>"><\/script>')</script>

    <script src="/js/libs/jquery/jquery.cookie.js?<?=CFG_ADMIN_VERSION;?>"></script>
    <script src="/js/libs/jquery/jquery.ba-bbq.js?<?=CFG_ADMIN_VERSION;?>"></script>

    <!-- treeview js -->
    <script src="js/vendor/jquery.treeview.js?<?=CFG_ADMIN_VERSION;?>"></script>
    <script src="js/vendor/jquery.treeview.edit.js?<?=CFG_ADMIN_VERSION;?>"></script>
    <script src="js/vendor/jquery.treeview.async.js?<?=CFG_ADMIN_VERSION;?>"></script>

    <!-- backbone js -->
    <script src="js/vendor/underscore.js?<?=CFG_ADMIN_VERSION;?>"></script>
    <script src="js/vendor/backbone.js?<?=CFG_ADMIN_VERSION;?>"></script>

    <!-- Translations -->
    <script src="<?=$PageUrl->getTranslationsUrl();?>"></script>
</head>
<body>

<!-- global header -->
<header id="header" class="header fixed">

    <!-- topbar starts -->
    <div class="navbar ot_utility_nav">

        <div class="row-fluid">

            <div class="brand_wrap">
                <a target="_blank" class="brand" href="http://<?=IDN::decodeIDN($_SERVER['SERVER_NAME'])?>" title="Перейти на сайт"> <?=IDN::decodeIDN($_SERVER['SERVER_NAME'])?> </a>
            </div><!-- .brand_wrap -->

            <ul class="nav">

                <li>
                    <? if (RightsManager::isAvailableCmd('support')) { ?>
                    <!-- Support -->
                    <div class="btn-group">
                        <?php
                            $newOrderTickets = SupportRepositoryNew::getMessagesCountStatic(true, true);
                            $allOrderTickets = SupportRepositoryNew::getMessagesCountStatic(false, true);
                            $newOtherTickets = SupportRepositoryNew::getMessagesCountStatic(true, false);
                            $allOtherTickets = SupportRepositoryNew::getMessagesCountStatic(false, false);
                        ?>
                        <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="support">
                            <i class="icon-envelope-alt"></i><span class="hidden-phone"> <?=LangAdmin::get('Support')?></span>
                            <strong>
                                (<span class="text-success"><?=$newOrderTickets + $newOtherTickets?></span> /
                                <span class="text-error"><?=$allOrderTickets + $allOtherTickets?></span>)
                            </strong>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="?cmd=Support"><?=LangAdmin::get('Tickets_to_orders')?>
                                    (<span class="text-success"><?=$newOrderTickets?></span> /
                                    <span class="text-error"><?=$allOrderTickets?></span>)
                                </a>
                            </li>

                            <li>
                                <a href="?cmd=Support&do=other"><?=LangAdmin::get('General_tickets')?>
                                    (<span class="text-success"><?=$newOtherTickets?></span> /
                                    <span class="text-error"><?=$allOtherTickets?></span>)
                                </a>
                            </li>
                        </ul>
                    </div><!-- /Support -->
                    <? } ?>
                </li>

            </ul><!-- /.nav -->

            <ul class="nav pull-right topmenu">

                <li>
                    <!-- help -->
                    <div class="btn-group">
                        <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                            <i class="icon-question-sign"></i><span class="hidden-phone"> <?=LangAdmin::get('Help')?></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="http://docs.opentao.net/pages/viewpage.action?pageId=14155932" target="_blank"><?=LangAdmin::get('Faq')?></a></li>
                            <li><a href="http://docs.opentao.net/" target="_blank"><?=LangAdmin::get('Spravka')?></a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="http://support.opentao.net/" target="_blank">
                                    <?=LangAdmin::get('Contact_support')?>
                                    <i class="icon-external-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /help -->
                </li>

                <li>
                    <!-- settings dropdown -->
                    <div class="btn-group ot_globall_settings">
                        <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#"><i class="icon-cogs"></i> <span class="hidden-phone">Настройки</span> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu pull-left">
                                <? require TPL_ABSOLUTE_PATH . '/page_langs.php'; ?>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#" class="cacheClean"><?=LangAdmin::get('Reset_cache')?></a></li>
                        </ul>
                    </div>
                    <!-- settings dropdown ends -->
                </li>

                <li>
                    <!-- user dropdown -->
                    <div class="btn-group">
                        <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                            <i class="icon-user icon-white"></i><span class="hidden-phone">
                            <?
                                $role = RightsManager::getCurrentRole();
                                $roleName = ! empty($role) ? LangAdmin::get($role) : LangAdmin::get('Administrator');
                                echo $roleName;
                            ?>
                            </span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!--li><a href="#">Личный кабинет</a></li-->

                            <? if (RightsManager::isSuperAdmin()) { ?>
                                <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/admin/" target="_blank"><?=LangAdmin::get('admin_old')?></a></li>
                                <li class="divider"></li>
                            <? } ?>

                            <li><a href="index.php?cmd=login&do=logout">Выйти</a></li>
                        </ul>
                    </div>
                    <!-- user dropdown ends -->
                </li>

            </ul>

        </div><!-- /row-fluid -->

    </div><!--/.navbar .ot_utility_nav -->

</header><!-- /.header -->

<div id="hiddenElements" style="display:none">
    <div id="activeLanguages"><?=$activeLanguages?></div>
</div>


<!-- global content -->
<section id="wrapper">

    <div class="row-fluid">

        <!-- span side-left -->
        <div class="span2">

            <!--sidebar-->
            <aside class="side-left fixed">

                <!-- main navigation -->
                <nav>
                    <ul class="ot_main_nav">

                        <? include("inc/main_nav.php"); ?>

                    </ul>
                </nav><!-- /main navigation -->

            </aside><!--/sidebar -->

        </div><!-- span side-left -->


        <!-- span content -->
        <div class="span10">

            <!-- content -->
            <div class="ot_content">

                <!--[if lt IE 7]>
                <div class="alert alert-block">
                    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
                </div>
                <![endif]-->

                <noscript>
                    <div class="alert alert-block span10">
                        <h4 class="alert-heading">Warning!</h4>
                        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                    </div>
                </noscript>
