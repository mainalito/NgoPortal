<?php

namespace backend\controllers;

use app\models\InstitutionType;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FinancialInstitutionTypeController implements the CRUD actions for FinancialInstitutionType model.
 */
class InstitutionTypeController extends Controller
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
     * Lists all FinancialInstitutionType models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => InstitutionType::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'institutionTypeId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FinancialInstitutionType model.
     * @param int $institutionTypeId Institution Type ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($institutionTypeId)
    {
        return $this->render('view', [
            'model' => $this->findModel($institutionTypeId),
        ]);
    }

    /**
     * Creates a new FinancialInstitutionType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new InstitutionType();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'institutionTypeId' => $model->institutionTypeId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FinancialInstitutionType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $institutionTypeId Institution Type ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($institutionTypeId)
    {
        $model = $this->findModel($institutionTypeId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'institutionTypeId' => $model->institutionTypeId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FinancialInstitutionType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $institutionTypeId Institution Type ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($institutionTypeId)
    {
        $this->findModel($institutionTypeId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FinancialInstitutionType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $institutionTypeId Institution Type ID
     * @return InstitutionType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($institutionTypeId)
    {
        if (($model = InstitutionType::findOne(['institutionTypeId' => $institutionTypeId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
