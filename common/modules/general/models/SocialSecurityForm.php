<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-06
 * Time: 17:30
 */

namespace common\modules\general\models;


use yii\base\Model;

class SocialSecurityForm extends Model
{
    public $month;
    public $base;
    public $pensionCompany;
    public $pensionPersonal;
    public $healthCompany;
    public $healthPersonal;
    public $criticalIllnessCompany;
    public $criticalIllnessPersonal;
    public $employmentInjuryCompany;
    public $employmentInjuryPersonal;
    public $maternityCompany;
    public $maternityPersonal;
    public $unemploymentCompany;
    public $unemploymentPersonal;
}