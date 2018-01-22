<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/4
 * Time: 6:22
 */

namespace backend\modules\user\models;

use common\models\User;
use yii\base\Model;
use backend\modules\user\models\UserAssigned;

class AssignForm extends Model
{
    public $username;
    public $staffId;

    public function rules()
    {
        return [
            [['username', 'staffId'], 'default']
        ];
    }

    public function assign()
    {
        $userAssigned = new UserAssigned();

        $userAssigned->username = $this->username;
        $userAssigned->staff_id = $this->staffId;
        $userAssigned->assigned = true;
        $userAssigned->save();
    }
}