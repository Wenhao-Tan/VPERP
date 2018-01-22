<?php
namespace backend\modules\user\controllers;

use backend\modules\user\models\SetPasswordForm;
use common\models\User;
use Yii;
use yii\web\Controller;

use frontend\models\SignupForm;
use backend\modules\user\models\AssignForm;

class IndexController extends Controller
{
    public $layout = '@frontend/views/layouts/erp.php';

    public function actionIndex()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $this->refresh();
            }
        }

        $modelAssignForm = new AssignForm();
        if ($modelAssignForm->load(Yii::$app->request->post())) {
            $modelAssignForm->assign();
            $this->refresh();
        }

        return $this->render('index', [
            'models' => $model,
            'modelAssignForm' => $modelAssignForm,
        ]);
    }

    public function actionSetPassword($id)
    {

        $user = User::findOne($id);
        $model = new SetPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $password = $model->password;
            $user->setPassword($password);
            $user->save();
        }

        return $this->renderPartial('set-password',[
            'user' => $user,
            'models' => $model,
        ]);
    }
}