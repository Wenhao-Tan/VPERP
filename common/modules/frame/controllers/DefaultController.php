<?php

namespace common\modules\frame\controllers;

use Yii;
use yii\web\Controller;
use common\modules\frame\models\Parameter;

/**
 * Default controller for the `frame` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new Parameter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        }
    }
}
