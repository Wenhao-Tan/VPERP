<?php
namespace frontend\modules\order\assets;

use yii\web\AssetBundle;
use yii\web\View;

class OrderAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/order/web';

    public $css = [
        'css/order.css',
    ];

    public $js = [
        'js/order.js',
        'js/detail.js',
        'js/invoice.js',
    ];

    public $jsOptions = [
        'position' => View::POS_END,
    ];

    public $depends = [
        'frontend\assets\AppAsset',
    ];
}