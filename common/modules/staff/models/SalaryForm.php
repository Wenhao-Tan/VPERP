<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/30
 * Time: 20:55
 */

namespace common\modules\staff\models;


use yii\base\Model;

class SalaryForm extends Model
{
    public $staffId;
    public $month;
    public $workingDays;
    public $basicSalary;
    public $commission;
    public $medicalInsurance;
    public $pension;
    public $unemploymentInsurance;

    public function rules()
    {
        return [
            [
                ['staffId', 'month', 'workingDays', 'basicSalary'], 'required'
            ],
            [
                ['medicalInsurance', 'pension', 'unemploymentInsurance'], 'default'
            ],
            [
                ['month'], 'date', 'format' => 'php:Y-m-d'
            ],
            [
                ['workingDays', 'basicSalary', 'commission',
                    'medicalInsurance', 'pension', 'unemploymentInsurance'], 'number'
            ]
        ];
    }

    public function submit()
    {
        $salary = new Salary();

        $salary->salary_id = str_replace('-', '', $this->month) . $this->staffId;
        $salary->staff_id = $this->staffId;
        $salary->month = $this->month;
        $salary->working_days = $this->workingDays;
        $salary->basic_salary = $this->basicSalary;
        $salary->commission = $this->commission;
        $salary->medical_insurance = $this->medicalInsurance;
        $salary->pension = $this->pension;
        $salary->unemployment_insurance = $this->unemploymentInsurance;

        $salary->total_salary = $this->basicSalary + $this->commission;

        $socialSecurity = $this->medicalInsurance + $this->pension + $this->unemploymentInsurance;
        $salary->net_pay = $salary->total_salary - $socialSecurity;

        $salary->save();
    }
}