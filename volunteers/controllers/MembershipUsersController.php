<?php

namespace volunteers\controllers;

use volunteers\models\MembershipUsers;
use volunteers\models\MembershipUsersSearch;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MembershipUsersController implements the CRUD actions for MembershipUsers model.
 */
class MembershipUsersController extends Controller
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
     * Lists all MembershipUsers models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MembershipUsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MembershipUsers model.
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
     * Creates a new MembershipUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MembershipUsers();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->createdTime = date('Y-m-d H:i:s');
                $model->createdBy = 0;
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', ' Registration successful. Go to your email to verify your account.', true);
                    return $this->redirect(['site/login']);
                } else {
                    Yii::$app->session->setFlash('error', ' Registration unsuccessful. Please try again later.', true);
                    return $this->redirect(['site/login']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MembershipUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MembershipUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MembershipUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MembershipUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MembershipUsers::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
