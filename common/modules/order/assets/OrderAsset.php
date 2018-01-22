<?php
namespace common\modules\order\assets;

use yii\web\AssetBundle;

class OrderAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/order/web';

    public $css = [
        'css/order.css',
    ];

    public $js = [
        'js/order.js',
        'js/detail.js',
        'js/invoice.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];
}