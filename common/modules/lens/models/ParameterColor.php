<?php
namespace common\modules\lens\models;


use yii\db\ActiveRecord;

class ParameterColor extends ActiveRecord
{
    public static function tableName()
    {
        return 'lens_param_color';
    }
}