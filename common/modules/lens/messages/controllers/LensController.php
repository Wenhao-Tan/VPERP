<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2016/5/26
 * Time: 20:34
 */

namespace frontend\controllers;

use app\models\LensCustomSearch;
use app\models\LensParamFunction;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;

use app\models\LensCustomForm;
use app\models\LensCustom;
use app\models\Supplier;

use app\models\LensParamsForm;
use app\models\LensParamMaterial;
use app\models\LensParamRefractiveIndex;
use app\models\LensParamDiopterType;
use app\models\LensParamColorType;
use app\models\LensParamColor;
use app\models\LensParamSurface;
use app\models\LensParamDiameter;
use app\models\LensParamCoating;

class LensController extends Controller
{

    public $layout = 'erp';

    public $material;
    public $refractiveIndex;
    public $diopterType;
    public $colorType;
    public $color;
    public $surface;
    public $diameter;
    public $coating;
    public $function;

    public function actionCustom()
    {
        $customForm = new LensCustomForm();
        $custom = new LensCustom();
        $customSearch = new LensCustomSearch();
        $supplier = new Supplier();

        $dataProvider = $customSearch->search(Yii::$app->request->get());

        $lensParamsList = $custom->prepareParamsData();
        $customSupplier = $custom->getSupplier();

        $supplierCode = $supplier->getCode('code');
        $status = [
            'Created' => 'Created',
            'Ordered' => 'Ordered',
            'Finished' => 'Finished',
        ];

        $updateContents = [
            ['column' => 'supplier', 'value' => $supplierCode],
            ['column' => 'status' , 'value' => $status],
        ];

        /*
             * For "Editable Column" in Grid View
             */
        if(Yii::$app->request->post('hasEditable')) {
            $customId = Yii::$app->request->post('editableKey');
            $row = $custom->findOne($customId);

            $out = Json::encode(['output' => '', 'message' => '']);

            /*
             * $posted Array
             * Key = Attribute Name
             * Value = Attribute Value
             */
            $posted = current($_POST['LensCustom']);
            $post = ['LensCustom' => $posted];

            $postedKey = key($posted);
            $postedValue = $posted[$postedKey];

            if($row->load($post)) {
                $custom->updateOneRecord($postedKey, $postedValue, $customId);

                $output = '';

                $out = Json::encode(['output' => $output, 'message' => '']);
            }

            echo $out;
            return;
        }

        /*
         * For tab "Create"
         */
        if($customForm->load(Yii::$app->request->post()) && $customForm->validate()) {
            if(isset($_POST['create'])) {
                $custom->insertRecords($customForm);
            }

            Yii::$app->getResponse()->refresh();
        }

        return $this->render('custom', [
            'customForm' => $customForm,
            'custom' => $custom,
            'customSearch' => $customSearch,
            'lensParamsList' => $lensParamsList,
            'customSupplier' => $customSupplier,
            'updateContents' => $updateContents,
            'dataProvider' => $dataProvider,
            'supplierCode' => $supplierCode,
        ]);
    }

    public function actionCustomUpdate($customNumber = null)
    {
        $custom = new LensCustom();

        if ($customNumber !== null)
        {
            $supplier = new Supplier();

            $query = LensCustom::find()->where(['custom_number' => $customNumber]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            $lensParamsList = $custom->prepareParamsData();
            $supplierCode = $supplier->getCode('code');

            /*
             * For "Editable Column" in Grid View
             */
            if(Yii::$app->request->post('hasEditable')) {
                $customId = Yii::$app->request->post('editableKey');
                $row = $custom->findOne($customId);

                $out = Json::encode(['output' => '', 'message' => '']);

                /*
                 * $posted Array
                 * Key = Attribute Name
                 * Value = Attribute Value
                 */
                $posted = current($_POST['LensCustom']);
                $post = ['LensCustom' => $posted];

                $postedKey = key($posted);
                $postedValue = $posted[$postedKey];

                if($row->load($post)) {
                    $custom->updateOneRecord($postedKey, $postedValue, $customId);

                    $output = '';

                    $out = Json::encode(['output' => $output, 'message' => '']);
                }

                echo $out;
                return;
            }

            return $this->renderAjax('custom-update',[
                'dataProvider' => $dataProvider,
                'lensParamsList' => $lensParamsList,
                'supplierCode' => $supplierCode,
            ]);
        }
        else
        {
            $pks = $_POST['pks'];
            $column = $_POST['column'];
            $value = $_POST['value'];

            $custom->updateRecords($column, $value, $pks);
        }

    }

    public function actionCustomDelete($customNumber)
    {
        $oneCustomRecord = LensCustom::findOne(['custom_number' => $customNumber]);


        if($oneCustomRecord) {
            $oneCustomRecord->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
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
            $this->refractiveIndex = new LensParamRefractiveIndex();
            $material = $_POST['material'];

            $index = $this->refractiveIndex->find()
                ->select('refractive_index')
                ->where(['material' => $material])
                ->orderBy('refractive_index')
                ->column();

            $index = Json::encode($index);
            return $index;
        }

        if(isset($_POST['prescription_type'])) {
            $this->diopterType = new LensParamDiopterType();
            $diopterType = $_POST['prescription_type'];

            $data = $this->diopterType->find()
                ->select('diopter_lens_type')
                ->where(['prescription_type' => $diopterType])
                ->orderBy('diopter_lens_type')
                ->column();
        }

        $data = Json::encode($data);

        return $data;
    }
}