<?php

namespace frontend\modules\frame\controllers;

use Yii;
use yii\web\Controller;
use frontend\modules\frame\models\Parameter;

/**
 * Default controller for the `frame` module
 */
class DefaultController extends Controller
{
    public $layout = 'frame.php';

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
