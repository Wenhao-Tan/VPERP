<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/6
 * Time: 7:39
 */

namespace backend\modules\user\models;


use common\models\User;

class UserExtend extends User
{
    public function getUserAssigned()
    {
        return $this->hasOne(UserAssigned::className(), ['username' => 'username']);
    }
}