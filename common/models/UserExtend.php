<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/6
 * Time: 7:39
 */

namespace common\models;

use common\models\User;
use backend\modules\user\models\UserAssigned;

class UserExtend extends User
{
    public function getUserAssigned()
    {
        return $this->hasOne(UserAssigned::className(), ['username' => 'username']);
    }
}