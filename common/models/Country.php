<?php
namespace common\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Country extends ActiveRecord
{
    public static function getCountries()
    {
        $countries = ArrayHelper::map(Country::find()->all(), 'country_code', 'country_name');

        return $countries;
    }
}