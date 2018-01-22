<?php

namespace backend\modules\translation\controllers;

use yii\web\Controller;

/**
 * Default controller for the `translation` module
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
}
