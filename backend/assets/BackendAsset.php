<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2018/3/11
 * Time: 7:35
 */

namespace backend\assets;


use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $depends = [
        'common\assets\ComomonAsset',
    ];
}