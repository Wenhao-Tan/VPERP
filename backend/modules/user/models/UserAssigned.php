<?php
namespace backend\modules\user\models;

use common\models\UserExtend;
use yii\db\ActiveRecord;

class UserAssigned extends ActiveRecord
{
    public function getUser()
    {
        return $this->hasOne(UserExtend::className(), ['username' => 'username']);
    }

    public static function getCurrentStaffId()
    {
        $user = \Yii::$app->getUser();
        $username = $user->identity->username;

        $staffId= UserAssigned::findOne($username)->staff_id;

        return $staffId;
    }

    public static function getCurrentStaff()
    {
        return UserAssigned::getCurrentStaff();
    }

}