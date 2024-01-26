<?php

namespace backend\controllers;

use common\models\Templates;
use common\models\TemplatesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TemplatesController implements the CRUD actions for Templates model.
 */
class TemplatesController extends Controller
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
     * Lists all Templates models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TemplatesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Templates model.
     * @param int $templateId Template ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($templateId)
    {
        return $this->render('view', [
            'model' => $this->findModel($templateId),
        ]);
    }

    /**
     * Creates a new Templates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Templates();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'templateId' => $model->templateId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Templates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $templateId Template ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($templateId)
    {
        $model = $this->findModel($templateId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'templateId' => $model->templateId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Templates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $templateId Template ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($templateId)
    {
        $this->findModel($templateId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Templates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $templateId Template ID
     * @return Templates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($templateId)
    {
        if (($model = Templates::findOne(['templateId' => $templateId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
