<?php
namespace common\modules\lens\assets;


use yii\web\AssetBundle;
use yii\web\View;

class LensAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/lens/web';

    public $js = [
        'js/prescription.js',
    ];

    public $jsOptions = [
        'position' => View::POS_END,
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\widgets\PjaxAsset',
    ];
}