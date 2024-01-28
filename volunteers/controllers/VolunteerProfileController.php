<?php

namespace volunteers\controllers;

use common\models\User;
use volunteers\models\VolunteerProfile;
use volunteers\models\VolunteerProfileSearch;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VolunteerProfileController implements the CRUD actions for VolunteerProfile model.
 */
class VolunteerProfileController extends Controller
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
     * Lists all VolunteerProfile models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VolunteerProfileSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VolunteerProfile model.
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
     * Creates a new VolunteerProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $id = base64_decode($id);
        $user = User::findOne($id);
        $individual = VolunteerProfile::find()->where(['userId' => $id])->one();
        $model = null;
        if (is_null($individual)) {

            $model = new VolunteerProfile();
        } else {
            $model = VolunteerProfile::find()->where(['userId' => $id])->one();

        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->createdTime = date('Y-m-d H:i:s');
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', ' Profile Updated Successfully.', true);
                    return $this->redirect(['site/profile']);
                } else {
                    Yii::$app->session->setFlash('error', ' Problem Updating profile.', true);
                    return $this->redirect(Yii::$app->request->referrer);

                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user
        ]);
    }

    /**
     * Updates an existing VolunteerProfile model.
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
     * Deletes an existing VolunteerProfile model.
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
     * Finds the VolunteerProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return VolunteerProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VolunteerProfile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
