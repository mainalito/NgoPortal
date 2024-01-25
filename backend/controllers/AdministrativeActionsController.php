<?php

namespace backend\controllers;

use app\models\AdministrativeActions;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdministrativeActionsController implements the CRUD actions for AdministrativeActions model.
 */
class AdministrativeActionsController extends Controller
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
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => [
                                'index', 'view', 'create', 'update', 'delete'
                            ],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all AdministrativeActions models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AdministrativeActions::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'actionId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdministrativeActions model.
     * @param int $actionId Action ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($actionId)
    {
        return $this->render('view', [
            'model' => $this->findModel($actionId),
        ]);
    }

    /**
     * Creates a new AdministrativeActions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AdministrativeActions();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'actionId' => $model->actionId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdministrativeActions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $actionId Action ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($actionId)
    {
        $model = $this->findModel($actionId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'actionId' => $model->actionId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdministrativeActions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $actionId Action ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($actionId)
    {
        $this->findModel($actionId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdministrativeActions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $actionId Action ID
     * @return AdministrativeActions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($actionId)
    {
        if (($model = AdministrativeActions::findOne(['actionId' => $actionId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
