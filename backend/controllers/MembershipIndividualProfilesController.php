<?php

namespace backend\controllers;

use backend\models\Countries;
use backend\models\MembershipIndividualProfiles;
use backend\models\MembershipUsers;
use common\models\Notifications;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * MembershipIndividualProfilesController implements the CRUD actions for MembershipIndividualProfiles model.
 */
class MembershipIndividualProfilesController extends Controller
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
     * Lists all MembershipIndividualProfiles models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => MembershipIndividualProfiles::find(),
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

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MembershipIndividualProfiles model.
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
     * Creates a new MembershipIndividualProfiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MembershipIndividualProfiles();
    
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Check if a user or individual profile with the same email already exists
                $membershipUser = User::find()->where(['email' => $model->email])->one();
                $membershipIndividualProfile = MembershipIndividualProfiles::find()->where(['email' => $model->email])->one();
    
                if ($membershipUser || $membershipIndividualProfile) {
                    Yii::$app->session->setFlash('error', 'Account is already registered');
                    return $this->redirect(Yii::$app->request->referrer);
                }
    
                // Save the individual profile
                if ($model->save()) {
                    
                    $membershipUser = User::find()->where(['email' => $model->email])->one();
    
                    // If a user doesn't exist, create one
                    if (!$membershipUser) {
                        $membershipUser = new User();
                        $membershipUser->email = $model->email;
                        $membershipUser->firstname = $model->firstname;
                        $membershipUser->createdBy = $model->createdBy;
                        $membershipUser->createdTime = $model->createdTime;
                        $membershipUser->lastnames = $model->lastName;
                        $membershipUser->othernames = $model->otherNames;
    
                        
                        $membershipUser->save(false);
    
                        // Update the membershipUserId in the individual profile
                        $model->membershipUserId = $membershipUser->id;
                        $model->save(false);
    
                        
                        self::sendEmailUser($membershipUser);
    
                        Yii::$app->session->setFlash('success', 'Account registered successfully');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
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
     * Updates an existing MembershipIndividualProfiles model.
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
     * Deletes an existing MembershipIndividualProfiles model.
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
     * Finds the MembershipIndividualProfiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MembershipIndividualProfiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MembershipIndividualProfiles::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // YourController.php
    public function actionGetCountryInfo($countryId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $country = Countries::findOne($countryId);

        return [
            'usePassport' => $country->usePassport,
        ];
    }

    private function sendEmailUser($membershipUser)
    {
        $notification = new Notifications();
        $notification->sendMessage(
            'LINKLOGIN',
            $membershipUser->email,
            $parameters = ['FullName' => $membershipUser->firstname, 
            'LINK' => Yii::$app->params['frontendURL'].'/site/members-account-update/'.$membershipUser->id]
        );

    }
}
