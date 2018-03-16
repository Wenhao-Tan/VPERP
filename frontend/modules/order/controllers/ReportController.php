<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/7/19
 * Time: 11:30
 */

namespace frontend\modules\order\controllers;

use Yii;
use frontend\modules\order\models\Report;
use yii\web\Controller;

class ReportController extends Controller
{
    public function actionIndex()
    {

        return $this->render('index', [

        ]);
    }
}