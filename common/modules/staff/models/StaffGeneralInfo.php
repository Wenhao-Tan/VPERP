<?php
namespace common\modules\staff\models;

use yii\db\ActiveRecord;
use common\modules\staff\models\StaffJobInfo;

class StaffGeneralInfo extends ActiveRecord
{
    public function getStaffJobInfo()
    {
        return $this->hasOne(StaffJobInfo::classname(), ['staff_id' => 'staff_id']);
    }

    public function getFullName($id, $lang = 'zh')
    {
        $staff = $this->findOne($id);

        if ($lang == 'zh') {
            $givenName = $staff->given_name_zh;
            $familyName = $staff->family_name_zh;

            $fullName = $familyName . $givenName;
        } else {
            $givenName = $staff->given_name;
            $familyName = $staff->family_name;

            $fullName = $givenName . ' ' . $familyName;
        }

        return $fullName;
    }
}