<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CommonAsset extends AssetBundle
{
    public $sourcePath = '@common/web';

    public $css = [
        'css/site.css',
        'css/custom.css',
        'css/colorbox.css',
        'css/font-awesome.css',
        'css/font-awesome.min.css',
    ];
    public $js = [
        'js/jquery.colorbox.js',
        'js/jquery.colorbox-min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy'=>true,
    ];
}
