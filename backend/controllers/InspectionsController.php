<?php

namespace backend\controllers;

use app\models\AdministrativeActions;
use app\models\InstitutionType;
use app\models\Inspections;
use app\models\InspectionTypes;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * InspectionsController implements the CRUD actions for Inspections model.
 */
class InspectionsController extends Controller
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
                                'index', 'view', 'create', 'update', 'delete', 'download', 'require-unique'
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
     * Lists all Inspections models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Inspections::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'inspectionId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionRequireUnique()
    {
        $p = (object)$_POST;
        $source = AdministrativeActions::findOne($p->action_id);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'has_amount' => $source->hasAmount,
            'has_text' => $source->hasText
        ];
    }
    public function actionDownload($inspectionId)
    {
        $model = $this->findModel($inspectionId);
        $file = base64_decode($model->attachment);

        if ($model !== null) {
            $filename = $model->inspectionType->inspectionTypeName. ' inspection at ' . $model->financialInstitution->financialInstitutionName.'.pdf';
            Yii::$app->response->format = Response::FORMAT_RAW;
            Yii::$app->response->headers->add('Content-Type', 'application/octet-stream');
            Yii::$app->response->headers->add('Content-Disposition', 'attachment; filename="' . $filename .'"');

            Yii::$app->response->sendContentAsFile($file, $filename);
            Yii::$app->end();
        } else {
            throw new \yii\web\NotFoundHttpException('The requested file does not exist.');
        }
    }

    /**
     * Displays a single Inspections model.
     * @param int $inspectionId Inspection ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($inspectionId)
    {
        return $this->render('view', [
            'model' => $this->findModel($inspectionId),
        ]);
    }

    /**
     * Creates a new Inspections model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Inspections();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())){
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file) {
                    $filename = 'documents/' . $model->file->baseName . '.' . $model->file->extension;
                    $model->file->saveAs($filename);
                    $model->file = NULL;
                    // Save file content to the database
                    $model->attachment = base64_encode(file_get_contents($filename));
                    if (file_exists($filename))
                        unlink($filename);
                }
                if($model->save()) {
                    return $this->redirect(['view', 'inspectionId' => $model->inspectionId]);
                }
            }
        }


        $inspection_types = ArrayHelper::map(InspectionTypes::find()->all(), 'inspectionTypeId', 'inspectionTypeName');
        $institution_types = ArrayHelper::map(InstitutionType::find()->all(),'institutionTypeId', 'institutionTypeName');
        $actions = ArrayHelper::map(AdministrativeActions::find()->all(), 'actionId', 'actionName');
        return $this->render('create', [
            'model' => $model,
            'inspection_types' => $inspection_types,
            'institution_types' => $institution_types,
            'actions' => $actions
        ]);
    }

    /**
     * Updates an existing Inspections model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $inspectionId Inspection ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($inspectionId)
    {
        $model = $this->findModel($inspectionId);

        if ($this->request->isPost && $model->load($this->request->post())){
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file) {
                $filename = 'documents/' . $model->file->baseName . '.' . $model->file->extension;
                $model->file->saveAs($filename);
                $model->file = NULL;
                // Save file content to the database
                $model->attachment = base64_encode(file_get_contents($filename));
                if (file_exists($filename))
                    unlink($filename);
            }
            if ($model->save()) {
                return $this->redirect(['view', 'inspectionId' => $model->inspectionId]);
            }
        }
        $model->dateOfInspection = date('Y-m-d', strtotime($model->dateOfInspection));

        $inspection_types = ArrayHelper::map(InspectionTypes::find()->all(), 'inspectionTypeId', 'inspectionTypeName');
        $institution_types = ArrayHelper::map(InstitutionType::find()->all(),'institutionTypeId', 'institutionTypeName');
        $actions = ArrayHelper::map(AdministrativeActions::find()->all(), 'actionId', 'actionName');
        return $this->render('update', [
            'model' => $model,
            'inspection_types' => $inspection_types,
            'institution_types' => $institution_types,
            'actions' => $actions
        ]);
    }

    /**
     * Deletes an existing Inspections model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $inspectionId Inspection ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($inspectionId)
    {
        $this->findModel($inspectionId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inspections model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $inspectionId Inspection ID
     * @return Inspections the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($inspectionId)
    {
        if (($model = Inspections::findOne(['inspectionId' => $inspectionId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
