<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SliderAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'theme/assets/plugins/bxslider/jquery.bxslider.css'
    ];
    public $js = [
        '/theme/assets/plugins/bxslider/jquery.bxslider.min.js',
        '/js/category/item.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}
