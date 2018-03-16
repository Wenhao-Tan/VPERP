<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2018/2/11
 * Time: 7:36
 */

namespace frontend\modules\order\assets;


use yii\web\AssetBundle;
use yii\web\View;

class CreateAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/order/web';

    public $js = [
        'js/create.js',
    ];

    public $jsOptions = [
        'position' => View::POS_END,
    ];

    public $depends = [
        'frontend\assets\AppAsset',
    ];
}