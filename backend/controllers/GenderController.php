<?php

namespace backend\controllers;

use backend\models\Gender;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GenderController implements the CRUD actions for Gender model.
 */
class GenderController extends Controller
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
     * Lists all Gender models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Gender::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'ID' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gender model.
     * @param int $ID ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID),
        ]);
    }

    /**
     * Creates a new Gender model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Gender();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->createdTime = date('Y-m-d H:i:s');
                $model->createdBy = Yii::$app->user->identity->id;
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', ' Status Saved Successfully.', true);
                    return $this->redirect(['view', 'ID' => $model->ID]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save status.', true);
                    return $this->redirect(Yii::$app->request->referrer);
                }
                return $this->redirect(['view', 'ID' => $model->ID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Gender model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        $model = $this->findModel($ID);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->updatedTime = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', ' Status Updated Successfully.', true);
                return $this->redirect(['view', 'ID' => $model->ID]);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update status.', true);
                return $this->redirect(Yii::$app->request->referrer);
            }

            return $this->redirect(['view', 'ID' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Gender model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID)
    {
        $this->findModel($ID)->delete();
        $model = Gender::findOne($ID);
        if ($model->load($this->request->post())) {
            $model->deletedTime = date('Y-m-d H:i:s');
            $model->deleted = 1;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', ' Status Deleted Successfully.', true);
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
     * Finds the Gender model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Gender the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Gender::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
