<?php
namespace frontend\modules\supplier\models;


use yii\db\ActiveRecord;

class Supplier extends ActiveRecord
{
    public static function getSuppliers()
    {
        return Supplier::find()->select(['name'])->indexBy('code')->column();
    }
}