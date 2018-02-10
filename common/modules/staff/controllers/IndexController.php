<?php

namespace common\modules\staff\controllers;

use common\modules\staff\models\StaffGeneralInfo;
use common\modules\staff\models\StaffJobInfo;
use Yii;
use yii\web\Controller;
use common\modules\staff\models\StaffForm;

class IndexController extends Controller
{
    // public $layout = '@frontend/views/layouts/erp';

    public function actionIndex()
    {
        $scenario = 'create';

        $model = new StaffForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->createStaff();

            $this->refresh();
        }

        return $this->render('index', [
            'models' => $model,
            'scenario' => $scenario,
        ]);
    }

    public function actionUpdate($staffId)
    {
        $scenario = 'update';

        $model = new StaffForm();
        $generalInfo = StaffGeneralInfo::findOne(['staff_id' => $staffId]);
        $jobInfo = StaffJobInfo::findOne(['staff_id' => $staffId]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->updateStaff($staffId);

            $this->redirect(['index/index']);
        }

        return $this->renderAjax('update', [
            'scenario' => $scenario,
            'models' => $model,
            'generalInfo' => $generalInfo,
            'jobInfo' => $jobInfo,
        ]);
    }
}