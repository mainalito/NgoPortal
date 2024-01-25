<?php

namespace backend\controllers;

use backend\models\JobListings;
use backend\models\JobListingsSearch;
use backend\models\TimeCommitments;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobListingsController implements the CRUD actions for JobListings model.
 */
class JobListingsController extends Controller
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
     * Lists all JobListings models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new JobListingsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JobListings model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JobListings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new JobListings();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->createdTime = date('Y-m-d H:i:s');
                $model->createdBy = Yii::$app->user->identity->id;
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', ' Job Saved Successfully.', true);
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save status.', true);
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        $timeCommitments = TimeCommitments::find()->all();
        return $this->render('create', [
            'model' => $model,
            'timeCommitments' => $timeCommitments
        ]);
    }

    /**
     * Updates an existing JobListings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->updatedTime = date('Y-m-d H:i:s');
        if ($model->save()) {
            Yii::$app->session->setFlash('success', ' Job Updated Successfully.', true);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to update status.', true);
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
        $timeCommitments = TimeCommitments::find()->all();


        return $this->render('update', [
            'model' => $model,
            'timeCommitments' => $timeCommitments

        ]);
    }

    /**
     * Deletes an existing JobListings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $model = JobListings::findOne($id);
        if ($model->load($this->request->post())) {
            $model->deletedTime = date('Y-m-d H:i:s');
            $model->deleted = 1;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', ' Job Deleted Successfully.', true);
                return $this->redirect(['index']);
            }
            else {
                Yii::$app->session->setFlash('error', 'Failed to delete status.', true);
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the JobListings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return JobListings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobListings::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
