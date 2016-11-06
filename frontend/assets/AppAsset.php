<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'theme/assets/bootstrap/css/bootstrap.min.css',
        'theme/assets/css/style.css',
        'theme/assets/css/owl.carousel.css',
        'theme/assets/css/owl.theme.css'
    ];
    public $js = [
        //'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
        //'theme/assets/bootstrap/js/bootstrap.min.js',
        'theme/assets/js/owl.carousel.min.js',
        'theme/assets/js/jquery.matchHeight-min.js',
        'theme/assets/js/hideMaxListItem.js',
        'theme/assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js',
        'theme/assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js',
        'js/libs/jquery.blockUI.js',
        'theme/assets/js/script.js',
        'js/main/script.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
