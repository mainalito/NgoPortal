<?php

namespace volunteers\controllers;

use app\models\User;
use volunteers\models\VolunteerProfile;
use volunteers\models\VolunteerSkills;
use volunteers\models\VolunteerSkillsSearch;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VolunteerSkillsController implements the CRUD actions for VolunteerSkills model.
 */
class VolunteerSkillsController extends Controller
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
     * Lists all VolunteerSkills models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VolunteerSkillsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VolunteerSkills model.
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
     * Creates a new VolunteerSkills model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new VolunteerSkills();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                $model->createdTime = date('Y-m-d H:i:s');
                if ($model->save()){

                    Yii::$app->session->setFlash('success', ' Skill Added Successfully.');
                    return $this->redirect(Yii::$app->request->referrer);
                } else{
                    Yii::$app->session->setFlash('error', ' Skill Could NOT be added.');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        $volunteerProfile = VolunteerProfile::find()->where(['userId' => Yii::$app->user->identity->id])->one();
        $volunteerSkills = VolunteerSkills::find()->where(['volunteerProfileId' => $volunteerProfile->id])->all();
        return $this->render('create', [
            'model' => $model,
            'volunteerSkills' => $volunteerSkills,
            'volunteerProfile' => $volunteerProfile,
        ]);
    }

    /**
     * Updates an existing VolunteerSkills model.
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
     * Deletes an existing VolunteerSkills model.
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
     * Finds the VolunteerSkills model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return VolunteerSkills the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VolunteerSkills::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
