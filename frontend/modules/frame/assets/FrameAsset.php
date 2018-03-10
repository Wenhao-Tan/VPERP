<?php
namespace frontend\modules\frame\assets;


use yii\web\AssetBundle;

class FrameAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/frame/web';

    public $js = [
        'js/frame.js',
    ];

    public $jsOptions = [
        // 'position' => View::POS_END,
    ];

    public $depends = [
        'frontend\assets\AppAsset',
        'common\assets\CommonAsset',
    ];
}