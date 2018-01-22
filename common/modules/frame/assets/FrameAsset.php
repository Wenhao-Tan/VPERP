<?php
namespace common\modules\frame\assets;


use yii\web\AssetBundle;
use yii\web\View;

class FrameAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/frame/web';

    public $js = [
        'js/frame.js',
    ];

    public $jsOptions = [
        'position' => View::POS_END,
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\widgets\PjaxAsset',
    ];
}