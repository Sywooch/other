<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'http://bootstrap-ru.com/assets/css/bootstrap-responsive.css',
    ];
    public $js = [
		'http://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js',
		'http://cdnjs.cloudflare.com/ajax/libs/angular-ui-utils/0.1.1/angular-ui-utils.min.js',
		'assets/js/script.js',
		'https://www.google.com/jsapi',
		'https://www.gstatic.com/charts/loader.js',
		//'assets/js/jquery.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
