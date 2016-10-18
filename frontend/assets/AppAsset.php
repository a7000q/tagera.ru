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
        'theme/assets/bootstrap/css/bootstrap.min.css',
        'theme/assets/css/style.css',
        'theme/assets/css/owl.carousel.css',
        'theme/assets/css/owl.theme.css'
    ];
    public $js = [
        //'https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js',
        'theme/assets/bootstrap/js/bootstrap.min.js',
        'theme/assets/js/owl.carousel.min.js',
        'theme/assets/js/jquery.matchHeight-min.js',
        'theme/assets/js/hideMaxListItem.js',
        'theme/assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js',
        'theme/assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js',
        'theme/assets/js/script.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
