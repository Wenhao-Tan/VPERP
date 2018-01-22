<?php
namespace common\modules\lens\models;

use yii\db\ActiveRecord;

class ParameterRefractiveIndex extends ActiveRecord
{
    public static function tableName()
    {
        return 'lens_param_refractive_index';
    }
}