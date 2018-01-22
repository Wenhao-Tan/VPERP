<?php
namespace common\modules\staff\models;

use yii\db\ActiveRecord;
use common\modules\staff\models\StaffGeneralInfo;

class StaffJobInfo extends ActiveRecord
{
    public function getStaffGeneralInfo()
    {
        $this->hasOne(StaffGeneralInfo::classname(), ['staff_id' => 'staff_id']);
    }

    public function getModel($staffId)
    {
        $model = $this->findOne($staffId);

        return $model;
    }

    public function getBasicSalary($staffId)
    {
        $staff = $this->getModel($staffId);

        $basicSalary = $staff->basic_salary;

        return $basicSalary;
    }

    public function getSocialSecurityBase($staffId)
    {

    }
}