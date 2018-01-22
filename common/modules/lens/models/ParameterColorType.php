<?php
namespace common\modules\lens\models;


use yii\db\ActiveRecord;

class ParameterColorType extends ActiveRecord
{
    public static function tableName()
    {
        return 'lens_param_color_type';
    }
}