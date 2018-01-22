<?php

namespace common\modules\staff\models;

use yii\base\Model;

use common\modules\staff\models\StaffGeneralInfo;
use common\modules\staff\models\StaffJobInfo;

class StaffForm extends Model
{
    // General Information
    public $idCardNumber;
    public $familyName;
    public $familyNameZh;
    public $givenName;
    public $givenNameZh;
    public $gender;
    public $education;
    public $mobilePhone;
    public $otherPhone;
    public $address;

    // Job Information
    public $englishName;
    public $entryDate;
    public $department;
    public $position;
    public $email;
    public $basicSalary;
    public $salaryCardNumber;
    public $salaryCardBank;
    public $salaryCardBranch;
    public $resignDate;

    public function rules()
    {
        return [
            // General Information
            [
                ['familyName', 'familyNameZh', 'givenName', 'givenNameZh', 'gender', 'education', 'mobilePhone'], 'required'
            ],
            [
                'idCardNumber', 'match', 'pattern' => '/^(\d{18,18}|\d{15,15}|\d{17,17}X)$/',
                                      'message' => \Yii::t('app', 'ID Card Number must contain exactly 15 or 18 digits')
            ],
            [
                'mobilePhone', 'match', 'pattern' => '/^\d{11}$/',
                                     'message' => 'Mobile Phone Number must contain exactly 11 digits'
            ],
            [
                ['idCardNumber', 'otherPhone', 'address'], 'default'
            ],
            [
                'otherPhone', 'integer'
            ],

            // Job Information
            [
                ['englishName', 'email', 'salaryCardNumber', 'salaryCardBank', 'salaryCardBranch', 'resignDate'], 'default'
            ],
            [
                ['entryDate', 'department', 'position', 'basicSalary'], 'required'
            ],
            [
                ['entryDate', 'resignDate'], 'date', 'format' => 'php:Y-m-d',
            ],
            [
                'email', 'email',
            ],

        ];
    }

    public function createStaff()
    {
        $this->submit();
    }

    public function updateStaff($staffId)
    {
        $generalInfo = StaffGeneralInfo::findOne(['staff_id' => $staffId]);
        $jobInfo = StaffJobInfo::findOne(['staff_id' => $staffId]);

        $this->submit($generalInfo, $jobInfo);
    }

    public function submit($generalInfo = null, $jobInfo = null)
    {
        if (!$generalInfo && !$jobInfo) {
            $generalInfo = new StaffGeneralInfo();
            $jobInfo = new StaffJobInfo();
        }

        $generalInfo->id_card_number = $this->idCardNumber;
        $generalInfo->family_name = $this->familyName;
        $generalInfo->family_name_zh = $this->familyNameZh;
        $generalInfo->given_name = $this->givenName;
        $generalInfo->given_name_zh = $this->givenNameZh;
        $generalInfo->gender = $this->gender;
        $generalInfo->education = $this->education;
        $generalInfo->mobile_phone = $this->mobilePhone;
        $generalInfo->other_phone = $this->otherPhone;
        $generalInfo->address = $this->address;
        $generalInfo->save();

        $jobInfo->staff_id = $generalInfo->staff_id;
        $jobInfo->english_name = $this->englishName;
        $jobInfo->entry_date = $this->entryDate != null ? $this->entryDate : date('Y-m-d');
        $jobInfo->department = $this->department;
        $jobInfo->position = $this->position;
        $jobInfo->email = $this->email;
        $jobInfo->basic_salary = $this->basicSalary;
        $jobInfo->save();
    }
}