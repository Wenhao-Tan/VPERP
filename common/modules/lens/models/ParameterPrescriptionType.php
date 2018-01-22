<?php
namespace common\modules\lens\models;

use yii\db\ActiveRecord;

class ParameterPrescriptionType extends ActiveRecord
{
    public static function tableName()
    {
        return 'lens_param_prescription_type';
    }
}