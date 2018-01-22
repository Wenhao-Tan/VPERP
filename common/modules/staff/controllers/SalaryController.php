<?php
namespace common\modules\staff\controllers;

use Yii;
use common\modules\staff\models\Salary;
use common\modules\staff\models\StaffJobInfo;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class SalaryController extends Controller
{
    public $layout = '@frontend/views/layouts/erp';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Salary::find(),
            'sort' => ['defaultOrder' => ['month' => 'desc']],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd($staff_id) {
        $model = new Salary();
        $action = 'add';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->submit();

            $this->redirect(['index/index']);
        }

        return $this->renderAjax('add', [
            'models' => $model,
            'action' => $action,
        ]);
    }

    public function actionMultipleAdd()
    {
        $staffIds = StaffJobInfo::find()->indexBy('staff_id')->column();

        foreach ($staffIds as $staffId) {
            $salaries[$staffId] = new Salary();
        }

        if (Model::loadMultiple($salaries, Yii::$app->request->post()) && Model::validateMultiple($salaries)) {
            $month = $_POST['month'];

            foreach ($salaries as $salary) {
                $salary->salary_id = str_replace('-', '', $month) . $salary->staff_id;

                $salary->month = $month;

                $salary->total_salary = $salary->basic_salary + $salary->commission - $salary->deduction;

                $social_security_charges = $salary->pension + $salary->medical + $salary->critical_illness +
                    $salary->employment_injury + $salary->maternity + $salary->unemployment;

                $salary->net_pay = $salary->total_salary - $social_security_charges;

                $salary->save();
            }

            return $this->redirect('index');
        }

        return $this->render('multiple-add', [
            'salaries' => $salaries,
        ]);
    }
}