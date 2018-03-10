<?php

namespace common\modules\staff\assets;

use yii\web\AssetBundle;

class StaffAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/staff/web';

    public $css = [
        'salary.css',
    ];

    public $js = [
        'staff.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}