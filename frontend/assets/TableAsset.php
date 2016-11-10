<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class TableAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'theme/assets/js/footable.js?v=2-0-1',
        'theme/assets/js/footable.filter.js?v=2-0-1',
    ];

}
