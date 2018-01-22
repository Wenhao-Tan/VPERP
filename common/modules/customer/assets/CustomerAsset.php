<?php
namespace common\modules\customer\assets;


use yii\web\AssetBundle;

class CustomerAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/customer/web';

    public $js = [
        'js/customer.js',
    ];

    public $css = [
        'css/customer.css',
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];
}