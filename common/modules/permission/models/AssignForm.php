<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/10
 * Time: 8:05
 */

namespace common\modules\permission\models;

use yii\base\Model;

class AssignForm extends Model
{
    public $role;
    public $userId;

    public function rules()
    {
        return [
            [['role', 'userId'], 'required'],
        ];
    }
}