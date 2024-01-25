<?php

namespace backend\controllers;

use app\models\InspectionTypes;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * InspectionTypesController implements the CRUD actions for InspectionTypes model.
 */
class InspectionTypesController extends Controller
{
   
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all InspectionTypes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => InspectionTypes::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'inspectionTypeId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InspectionTypes model.
     * @param int $inspectionTypeId Inspection Type ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($inspectionTypeId)
    {
        return $this->render('view', [
            'model' => $this->findModel($inspectionTypeId),
        ]);
    }

    /**
     * Creates a new InspectionTypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new InspectionTypes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'inspectionTypeId' => $model->inspectionTypeId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InspectionTypes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $inspectionTypeId Inspection Type ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($inspectionTypeId)
    {
        $model = $this->findModel($inspectionTypeId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'inspectionTypeId' => $model->inspectionTypeId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InspectionTypes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $inspectionTypeId Inspection Type ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($inspectionTypeId)
    {
        $this->findModel($inspectionTypeId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InspectionTypes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $inspectionTypeId Inspection Type ID
     * @return InspectionTypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($inspectionTypeId)
    {
        if (($model = InspectionTypes::findOne(['inspectionTypeId' => $inspectionTypeId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
