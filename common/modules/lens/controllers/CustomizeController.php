<?php
namespace common\modules\lens\controllers;

use common\modules\lens\models\Customize;
use common\modules\lens\models\CustomizeSearch;
use common\modules\lens\models\ParameterPrescriptionLensType;
use common\modules\lens\models\ParameterPrescriptionType;
use common\modules\lens\models\ParameterRefractiveIndex;
use frontend\modules\supplier\models\Supplier;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;

use app\models\LensParamsForm;
use app\models\LensParamMaterial;
use app\models\LensParamRefractiveIndex;
use app\models\LensParamColorType;
use app\models\LensParamColor;
use app\models\LensParamSurface;
use app\models\LensParamDiameter;
use app\models\LensParamCoating;
use yii\web\NotFoundHttpException;

class CustomizeController extends Controller
{
    public function actionIndex()
    {
        $model = new Customize();
        $searchModel = new CustomizeSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->get());

        $suppliers = Supplier::getSuppliers();

        $status = [
            'Created' => 'Created',
            'Ordered' => 'Ordered',
            'Finished' => 'Finished',
        ];

        $updateContents = [
            ['column' => 'status' , 'value' => $status],
        ];

        /*
         * For "Editable Column" in Grid View
         */
        if(Yii::$app->request->post('hasEditable')) {
            $customId = Yii::$app->request->post('editableKey');
            $row = $model->findOne($customId);

            $out = Json::encode(['output' => '', 'message' => '']);

            /*
             * $posted Array
             * Key = Attribute Name
             * Value = Attribute Value
             */
            $posted = current($_POST['Customize']);
            $post = ['Customize' => $posted];

            $postedKey = key($posted);
            $postedValue = $posted[$postedKey];

            if($row->load($post)) {
                $model->updateOneRecord($postedKey, $postedValue, $customId);

                $output = '';

                $out = Json::encode(['output' => $output, 'message' => '']);
            }

            echo $out;
            return;
        }

        /*
         * For tab "Create"
         */
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            if(isset($_POST['create'])) {
                $model->insertRecords();
            }

            Yii::$app->getResponse()->refresh();
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'searchModel' => $searchModel,
            'suppliers' => $suppliers,
            'updateContents' => $updateContents,
        ]);
    }

    public function actionUpdate($customNumber)
    {
        $model = $this->findModel($customNumber);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['customize/index']);
        } else {
            return $this->render('update', [
                'model' => $model
            ]);
        }
    }

    public function actionDelete($customNumber)
    {
        $oneCustomRecord = Customize::findOne(['custom_number' => $customNumber]);


        if($oneCustomRecord) {
            $oneCustomRecord->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function findModel($customNumber)
    {
        if (($model = Customize::findOne(['custom_number' => $customNumber])) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionParams()
    {
        $lensParamsModel = new LensParamsForm();

        $this->material = new lensParamMaterial();
        $materialList = $this->material->find()->asArray()->all();
        $materialList = ArrayHelper::map($materialList, 'material', 'material');

        $refractiveIndex = new lensParamRefractiveIndex();
        $refractiveIndexList = $refractiveIndex->find()->select(['refractive_index'])->column();

        $surface = new LensParamSurface();
        $surfaceList = $surface->find()->select(['surface'])->column();

        $diameter = new LensParamDiameter();

        $colorType = new LensParamColorType();
        $colorTypeList = $colorType->find()->select(['color_type'])->indexBy('color_type')->column();

        $color = new LensParamColor();
        $colorList = $color->find()->select(['color'])->indexBy('color')->column();

        $lensParamsList = [
            'materialList' => $materialList,
            'refractiveIndexList' => $refractiveIndexList,
            'surfaceList' => $surfaceList,
            'colorTypeList' => $colorTypeList,
            'colorList' => $colorList,
        ];

        if($lensParamsModel->load(Yii::$app->request->post()) && $lensParamsModel->validate()) {
            if($lensParamsModel->material) {
                $this->material->material = $lensParamsModel->material;
                $this->material->save();
            }

            if($lensParamsModel->refractive_index && $lensParamsModel->material_list) {
                $refractiveIndex->refractive_index = $lensParamsModel->refractive_index;
                $refractiveIndex->material = $lensParamsModel->material_list;
                $refractiveIndex->save();
            }

            if($lensParamsModel->surface) {
                $surface->surface = $lensParamsModel->surface;
                $surface->save();
            }

            if($lensParamsModel->diameter) {
                $diameter->diameter = $lensParamsModel->diameter;
                $diameter->save();
            }

            if($lensParamsModel->color_type) {
                $colorType->color_type = $lensParamsModel->color_type;
                $colorType->save();
            }

            if($lensParamsModel->color) {
                $color->color = $lensParamsModel->color;
                $color->save();
            }

            Yii::$app->getResponse()->refresh();
        }

        return $this->render('params', [
            'lensParamsModel' => $lensParamsModel,
            'lensParamsList' => $lensParamsList,
        ]);
    }

    public function actionAjax()
    {
        $data = '';

        if (isset($_POST['material'])) {
            $material = $_POST['material'];

            $index = ParameterRefractiveIndex::find()
                ->select('refractive_index')
                ->where(['material' => $material])
                ->orderBy('refractive_index')
                ->column();

            $index = Json::encode($index);
            return $index;
        }

        if(isset($_POST['prescription_type'])) {
            $prescriptionType = $_POST['prescription_type'];

            $data = ParameterPrescriptionLensType::find()
                ->select('prescription_lens_type')
                ->where(['prescription_type' => $prescriptionType])
                ->orderBy('prescription_lens_type')
                ->column();
        }

        $data = Json::encode($data);

        return $data;
    }
}