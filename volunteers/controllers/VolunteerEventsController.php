<?php

namespace volunteers\controllers;

use backend\models\VolunteerEvents;
use backend\models\VolunteerEventsParticipants;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VolunteerEventsController implements the CRUD actions for VolunteerEvents model.
 */
class VolunteerEventsController extends Controller
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
     * Lists all VolunteerEvents models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => VolunteerEvents::find()->where(['isPublished' => 1]),
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
     * Displays a single VolunteerEvents model.
     * @param int $id ID
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

      
        $eventParticipant = VolunteerEventsParticipants::find()
            ->where(['volunteerEventId' => $id, 'volunteerProfileId' => Yii::$app->user->id])
            ->one();

        // If not found, create a new instance
        if (!$eventParticipant) {
            $eventParticipant = new VolunteerEventsParticipants();
            $eventParticipant->volunteerProfileId = Yii::$app->user->id;
            $eventParticipant->volunteerEventId = $model->id;
        }

        if ($this->request->isPost) {
            if ($eventParticipant->load($this->request->post()) && $eventParticipant->save()) {
                Yii::$app->session->setFlash('success', 'You have successfully confirmed the event');
                return $this->redirect(['view', 'id' => $eventParticipant->id]);
            }
        }

        return $this->render('view', [
            'model' => $model,
            'eventParticipant' => $eventParticipant
        ]);
    }


    /**
     * Creates a new VolunteerEvents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new VolunteerEvents();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VolunteerEvents model.
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
     * Deletes an existing VolunteerEvents model.
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
     * Finds the VolunteerEvents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return VolunteerEvents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VolunteerEvents::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
