<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/12/13
 * Time: 19:30
 */

namespace common\modules\test\controllers;


use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}