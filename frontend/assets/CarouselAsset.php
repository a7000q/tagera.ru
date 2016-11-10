<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CarouselAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'theme/assets/js/owl.carousel.min.js',
        'theme/assets/js/script.js'
    ];

    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
