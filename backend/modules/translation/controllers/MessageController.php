<?php

namespace backend\modules\translation\controllers;

use Yii;
use backend\modules\translation\models\Message;
use backend\modules\translation\models\MessageSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MessageController implements the CRUD actions for Message models.
 */
class MessageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->post('hasEditable')) {
            $editableKey = json_decode(Yii::$app->request->post('editableKey'));

            $id = $editableKey->id;
            $language = $editableKey->language;
            $model = Message::findOne(['id' => $id, 'language' => $language]);

            $out = Json::encode(['output' => '', 'message' => '']);

            $posted = current($_POST['Message']);
            $post = ['Message' => $posted];

            if ($model->load($post)) {
                $model->save();

                $output = '';

                $out = Json::encode(['output' => $output, 'message' => '']);
            }

            echo $out;
            return;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Message models.
     * @param integer $id
     * @param string $language
     * @return mixed
     */
    public function actionView($id, $language)
    {
        return $this->render('view', [
            'models' => $this->findModel($id, $language),
        ]);
    }

    /**
     * Creates a new Message models.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'language' => $model->language]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Message models.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $language
     * @return mixed
     */
    public function actionUpdate($id, $language)
    {
        $model = $this->findModel($id, $language);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'language' => $model->language]);
        } else {
            return $this->render('update', [
                'models' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Message models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $language
     * @return mixed
     */
    public function actionDelete($id, $language)
    {
        $this->findModel($id, $language)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Message models based on its primary key value.
     * If the models is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $language
     * @return Message the loaded models
     * @throws NotFoundHttpException if the models cannot be found
     */
    protected function findModel($id, $language)
    {
        if (($model = Message::findOne(['id' => $id, 'language' => $language])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
