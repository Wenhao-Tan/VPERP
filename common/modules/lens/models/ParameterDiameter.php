<?php
namespace common\modules\lens\models;

use yii\db\ActiveRecord;

class ParameterDiameter extends ActiveRecord
{
    public static function tableName()
    {
        return 'lens_param_diameter';
    }
}