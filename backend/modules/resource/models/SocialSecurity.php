<?php

namespace backend\modules\resource\models;

use Yii;
use common\modules\staff\models\StaffJobInfo;

/**
 * This is the models class for table "hr_social_security".
 *
 * @property integer $id
 * @property string $month
 * @property string $base_value
 * @property string $pension_c
 * @property string $pension_p
 * @property string $medical_c
 * @property string $medical_p
 * @property string $critical_illness_c
 * @property string $critical_illness_p
 * @property string $employment_injury_c
 * @property string $employment_injury_p
 * @property string $maternity_c
 * @property string $maternity_p
 * @property string $unemployment_c
 * @property string $unemployment_p
 */
class SocialSecurity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hr_social_security';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['month', 'base_value'], 'required'],
            [['month'], 'safe'],
            [['base_value', 'pension_c', 'pension_p', 'medical_c', 'medical_p', 'critical_illness_c', 'critical_illness_p', 'employment_injury_c', 'employment_injury_p', 'maternity_c', 'maternity_p', 'unemployment_c', 'unemployment_p'], 'number'],
            [['month'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('social-security', 'ID'),
            'month' => Yii::t('social-security', 'Month'),
            'base_value' => Yii::t('social-security', 'Base Value'),
            'pension_c' => Yii::t('social-security', 'Pension (Company %)'),
            'pension_p' => Yii::t('social-security', 'Pension (Personal %)'),
            'medical_c' => Yii::t('social-security', 'Medical (Company %)'),
            'medical_p' => Yii::t('social-security', 'Medical (Personal %)'),
            'critical_illness_c' => Yii::t('social-security', 'Critical Illness (Company ￥)'),
            'critical_illness_p' => Yii::t('social-security', 'Critical Illness (Personal ￥)'),
            'employment_injury_c' => Yii::t('social-security', 'Employment Injury (Company %)'),
            'employment_injury_p' => Yii::t('social-security', 'Employment Injury (Personal %)'),
            'maternity_c' => Yii::t('social-security', 'Maternity (Company %)'),
            'maternity_p' => Yii::t('social-security', 'Maternity (Personal %)'),
            'unemployment_c' => Yii::t('social-security', 'Unemployment (Company %)'),
            'unemployment_p' => Yii::t('social-security', 'Unemployment (Personal %)'),
        ];
    }

    public function getLastMonth()
    {
        $timestamp = strtotime('now');
        $lastMonth = date('Y-m-01', strtotime(date('Y', $timestamp) . '-' . (date('m', $timestamp) - 1)));

        return $lastMonth;
    }
    
    public function getModel($month)
    {
        if ($month == 'default') {
            $currentMonth = '0000-00-00';
        } elseif ($month == 'last_month') {
            $currentMonth = $this->getLastMonth();
        }

        $model = $this->findOne(['month' => $currentMonth]);
        
        return $model;
    }

    public function getBaseValue($month)
    {
        $model = $this->getModel($month);

        $baseValue = $model->base_value;

        return $baseValue;
    }

    public function getInsuranceCharges($type, $staffId, $insurance = '', $month = 'last_month')
    {
        // $models = $this->getModel($month);

        $model = $this->findOne(['month' => $month]);

        $jobInfo = new StaffJobInfo();

        $baseValue = $jobInfo->findOne($staffId)->social_security_base;
        if ($baseValue == null) {
            $baseValue = $model->base_value;
        } elseif ($baseValue == 0.00) {
            $model->critical_illness_p = 0;
            $model->critical_illness_c = 0;
        }

        $rate = [];
        $charge = [];

        if ($type == 'company') {
            $rate['pension'] = $model->pension_c;
            $rate['medical'] = $model->medical_c;
            $rate['employment_injury'] = $model->employment_injury_c;
            $rate['maternity'] = $model->maternity_c;
            $rate['unemployment'] = $model->unemployment_c;

            $charge['critical_illness'] = $model->critical_illness_c;
        } else if ($type == 'personal') {
            $rate['pension'] = $model->pension_p;
            $rate['medical'] = $model->medical_p;
            $rate['employment_injury'] = $model->employment_injury_p;
            $rate['maternity'] = $model->maternity_p;
            $rate['unemployment'] = $model->unemployment_p;

            $charge['critical_illness'] = $model->critical_illness_p;
        }

        if ($insurance == '') {
            $rates = array_sum($rate) / 100;
            $charges = $baseValue * $rates + $charge['critical_illness'];
        } elseif ($insurance == 'critical_illness') {
            $charges = $charge[$insurance];
        } else {
            $charges = $baseValue * $rate[$insurance] / 100;
        }

        $charges = round($charges,2);
        $charges = number_format((float)$charges, 2, '.', ',');

        return $charges;
    }
}
