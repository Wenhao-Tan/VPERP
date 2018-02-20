<?php
namespace common\modules\customer\models;


use yii\db\ActiveRecord;

class Address extends ActiveRecord
{
    public static $address;

    public function rules()
    {
        return [
            [['name', 'street_1', 'city', 'country'], 'required'],
            [['name', 'company', 'street_1', 'street_2',
                'city', 'state', 'zip_code', 'mobile_phone', 'other_phone'], 'trim'],
        ];
    }

    public static function generate()
    {
        return static::$address;
    }

    public static function format($invoice = false)
    {
        if ($invoice) {
            $formatted = [];

            $line_3 = '';
            foreach (static::$address as $key => $value) {
                if ($key == 'name' || $key == 'company' || $key == 'street_1' || $key == 'street_2' || $key == 'mobile_phone') {
                    array_push($formatted, $value);
                } elseif ($key == 'city' || $key =='state' || $key == 'zip_code') {
                    $line_3 .= $value . ', ';
                } else {
                    $line_3 .= $value;
                    array_push($formatted, $line_3);
                }
            }

            static::$address = implode('<br>', $formatted);
        } else {
            static::$address = implode(', ', static::$address);
        }

        return new static;
    }

    public static function get($id)
    {
        $model = Address::findOne($id);
        static::$address = [];

        if ($model) {
            static::$address['name'] = $model->name;
            static::$address['company'] = $model->company;
            static::$address['street_1'] = $model->street_1;
            static::$address['street_2'] = $model->street_2;
            static::$address['city'] = $model->city;
            static::$address['state'] = $model->state;
            static::$address['zip_code'] = $model->zip_code;
            static::$address['country'] = $model->country;
            static::$address['mobile_phone'] = $model->mobile_phone;

            static::$address = array_filter(static::$address, function ($value) { return $value !== '';});
        }

        return new static;
    }
}