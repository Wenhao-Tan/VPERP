<?php
namespace common\modules\lens\models;


use yii\db\ActiveRecord;

class ParameterMaterial extends ActiveRecord
{
    public static function tableName()
    {
        return 'lens_param_material';
    }
}