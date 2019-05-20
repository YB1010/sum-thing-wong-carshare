<?php

namespace app\controllers;

use Yii;
use app\models\Receipt;
use app\models\ReceiptSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReceiptController implements the CRUD actions for Receipt model.
 */
class ReceiptController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Receipt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReceiptSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Receipt model.
     * @param string $email
     * @param integer $carId
     * @param string $startDate
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($email, $carId, $startDate)
    {
        return $this->render('view', [
            'model' => $this->findModel($email, $carId, $startDate),
        ]);
    }

    /**
     * Creates a new Receipt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Receipt();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'email' => $model->email, 'carId' => $model->carId, 'startDate' => $model->startDate]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Receipt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $email
     * @param integer $carId
     * @param string $startDate
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($email, $carId, $startDate)
    {
        $model = $this->findModel($email, $carId, $startDate);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'email' => $model->email, 'carId' => $model->carId, 'startDate' => $model->startDate]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Receipt model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $email
     * @param integer $carId
     * @param string $startDate
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($email, $carId, $startDate)
    {
        $this->findModel($email, $carId, $startDate)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Receipt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $email
     * @param integer $carId
     * @param string $startDate
     * @return Receipt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($email, $carId, $startDate)
    {
        if (($model = Receipt::findOne(['email' => $email, 'carId' => $carId, 'startDate' => $startDate])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
