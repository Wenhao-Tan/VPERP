<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-01-11
 * Time: 15:27
 */

namespace backend\modules\user\models;


use yii\base\Model;

class SetPasswordForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            ['username', 'default'],
            ['password', 'required'],
        ];
    }
}