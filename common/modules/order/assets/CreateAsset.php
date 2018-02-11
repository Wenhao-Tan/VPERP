<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2018/2/11
 * Time: 7:36
 */

namespace common\modules\order\assets;


use yii\web\AssetBundle;

class CreateAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/order/web';

    public $js = [
        'js/create.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}