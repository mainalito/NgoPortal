<?php

namespace volunteers\controllers;

use backend\models\JobListings;
use backend\models\TaskApproval;
use common\models\TaskTypeValidation;
use common\models\User;
use volunteers\models\JobApplication;
use volunteers\models\JobApplicationSearch;
use volunteers\models\VolunteerProfile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * JobApplicationController implements the CRUD actions for JobApplication model.
 */
class JobApplicationController extends Controller
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
     * Lists all JobApplication models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new JobApplicationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public
    function actionCurrentJobs()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => JobApplication::find()->where(['approvalStatusId' => 2, 'createdBy' => Yii::$app->user->identity->id]),


            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);


        return $this->render('current-jobs', [
            'dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single JobApplication model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JobApplication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public
    function actionCreate($id)
    {
        $id = base64_decode($id);
        $job = JobListings::findOne($id);
        $profile = VolunteerProfile::find()->where(['userId' => Yii::$app->user->identity->id])->one();
        if (is_null($profile)) {
            Yii::$app->session->setFlash('error', 'Please update your profile first to access the job application.', true);
            return $this->redirect(Yii::$app->request->referrer);
        }
        $jobApplication = JobApplication::find()->where(['jobListingId' => $id, 'volunteerProfileId' => $profile->id])->one();

        if (!is_null($jobApplication)) {
            Yii::$app->session->setFlash('error', 'You have already applied for this job.', true);
            return $this->redirect(Yii::$app->request->referrer);
        } else {

            $model = new JobApplication();
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->createdTime = date('Y-m-d H:i:s');
                $modelId = $model->id;

                /* Save the uploaded file */
                $file = UploadedFile::getInstance($model, 'cv');
                if ($file) {
                    $localPath = Yii::$app->params['path_local'] . '/uploads/';
                    $folderPath = 'jobApplication/' . $modelId . '/';
                    $save_path = $localPath . $folderPath;
                    if (!is_dir($save_path)) {
                        mkdir($save_path, 0777, true);
                    }

                    $fileName = $file->name;
                    $filePath = $save_path . $fileName;

                    if ($file->saveAs($filePath)) {
                        $model->cv = $folderPath . $fileName;
                    }
                }

                /* Save the model */
                if ($model->save()) {
                    (new \backend\models\TaskApproval)->createTaskWorkflow(TaskTypeValidation::Volunteer, $model->id, 'Application for Job', Yii::$app->user->identity->id);
                    Yii::$app->session->setFlash('success', ' Job Application Successful. You will be notified once your application is reviewed.', true);
                    return $this->redirect(['job-listings/index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'job' => $job,
            'profile' => $profile

        ]);
    }

    /**
     * Updates an existing JobApplication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
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
     * Deletes an existing JobApplication model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JobApplication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return JobApplication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = JobApplication::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
