<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/10
 * Time: 7:36
 */

namespace common\modules\permission\models;

use yii\base\Model;

class AuthForm extends Model
{
    public $permission;
    public $role;

    public function rules()
    {
        return [
            [['permission', 'role'], 'default'],
        ];
    }
}