<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-01-09
 * Time: 15:46
 */

namespace common\modules\permission\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\rbac\DbManager;

use common\modules\permission\models\AuthForm;
use common\modules\permission\models\AssignForm;

class IndexController extends Controller
{
    public $layout = '@frontend/views/layouts/erp';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['admin'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $model       = new AuthForm();
        $assignModel = new AssignForm();

        if ($assignModel->load(Yii::$app->request->post()) && $assignModel->validate()) {
            $auth = Yii::$app->authManager;
            $dbManager = new DbManager();

            $role = $dbManager->getRole($assignModel->role);
            $userId = $assignModel->userId;

            $auth->assign($role, $userId);

            $this->refresh();
        }

        return $this->render('index', [
            'models' => $model,
            'assignModel' => $assignModel,
        ]);
    }

    public function actionDelete($itemName, $userId)
    {

    }
}