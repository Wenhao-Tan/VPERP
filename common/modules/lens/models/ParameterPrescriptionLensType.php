<?php
namespace common\modules\lens\models;


use yii\db\ActiveRecord;

class ParameterPrescriptionLensType extends ActiveRecord
{
    public static function tableName()
    {
        return 'lens_param_prescription_lens_type';
    }
}