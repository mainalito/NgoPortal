<?php

namespace frontend\controllers;

use app\models\ComplianceData;
use app\models\ComplianceSubmissions;
use common\models\ComplianceMatrix;
use common\models\RegulationItems;
use common\models\SectionColumns;
use common\models\Sections;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ComplianceSubmissionsController implements the CRUD actions for ComplianceSubmissions model.
 */
class ComplianceSubmissionsController extends Controller
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
                                'index', 'view', 'create', 'update', 'compliance', 'documentation', 'summary', 'data', 'submit', 'delete'
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
     * Lists all ComplianceSubmissions models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ComplianceSubmissions::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'submissionId' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ComplianceSubmissions model.
     * @param int $submissionId Submission ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($submissionId)
    {
        $model = $this->findModel($submissionId);
        $sections = Sections::find()->all();
        return $this->render('create-view', [
            'model' => $model,
            'sections' => $sections,
        ]);
    }

    /**
     * Creates a new ComplianceSubmissions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ComplianceSubmissions();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $section = Sections::find()->andWhere(['isStart' => 1])->one();
                return $this->redirect(['compliance', 'submissionId' => $model->submissionId, 'sectionId' => $section->sectionId]);
            }
        }

        $years = array_combine(range(2015, date("Y")), range(2015, date("Y")));
        return $this->render('create', [
            'model' => $model,
            'years' => $years
        ]);
    }

    /**
     * Updates an existing ComplianceSubmissions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $submissionId Submission ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($submissionId)
    {
        $model = $this->findModel($submissionId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $section = Sections::find()->andWhere(['isStart' => 1])->one();
            return $this->redirect(['compliance', 'submissionId' => $model->submissionId, 'sectionId' => $section->sectionId]);
        }

        $years = array_combine(range(2015, date("Y")), range(2015, date("Y")));
        return $this->render('update', [
            'model' => $model,
            'years' => $years
        ]);
    }

    /**
     * Creates a new Compliance Submissions form.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCompliance($submissionId, $sectionId)
    {
        $model = $this->findModel($submissionId);
        if (Yii::$app->request->post() && isset(Yii::$app->request->post()["status"])) {
            $statuses = Yii::$app->request->post()["status"];
            foreach ($statuses as $key => $status) {
                $jsonString = str_replace("'", "\"", $key);
                $formObject = json_decode($jsonString);
                $matrix = ComplianceMatrix::find()->andWhere(['columnId' => $formObject->column, 'itemId' => $formObject->row])->one();
                if (!is_null($matrix)) {
                    $this->add_compliance($matrix, $formObject, $status);
                }
            }
        }
        if (Yii::$app->request->post() && isset(Yii::$app->request->post()["description"])) {
            $descriptions = Yii::$app->request->post()["description"];
            foreach ($descriptions as $key => $description) {
                $jsonString = str_replace("'", "\"", $key);
                $formObject = json_decode($jsonString);
                $matrix = ComplianceMatrix::find()->andWhere(['columnId' => $formObject->column, 'itemId' => $formObject->row])->one();
                if (!is_null($matrix) && $description != '') {
                    $this->add_compliance($matrix, $formObject, $description);
                }
            }
        }
        $sections = Sections::find()->all();
        $items = RegulationItems::find()->andWhere(['sectionId' => $sectionId])->all();
        $columns = SectionColumns::find()->andWhere(['sectionId' => $sectionId])->all();
        $require_columns = SectionColumns::find()->andWhere(['sectionId' => $sectionId, 'requireData' => 1])->all();
        $data = $this->get_data($model->submissionId);//ComplianceData::find()->andWhere(['submissionId' => $model->submissionId])->all();
        return $this->render('compliance', [
            'model' => $model,
            'sections' => $sections,
            'items' => $items,
            'columns' => $columns,
            'require_columns' => $require_columns,
            'index' => $sectionId + 1,
            'data' => $data
        ]);
    }

    public function actionData($submissionId, $sectionId)
    {
        $model = $this->findModel($submissionId);
        $sections = Sections::find()->all();
        $items = RegulationItems::find()->andWhere(['sectionId' => $sectionId])->all();
        $columns = SectionColumns::find()->andWhere(['sectionId' => $sectionId])->all();
        $require_columns = SectionColumns::find()->andWhere(['sectionId' => $sectionId, 'requireData' => 1])->all();
        $data = $this->get_data($model->submissionId);
        return $this->renderPartial('_data', [
            'model' => $model,
            'sections' => $sections,
            'items' => $items,
            'columns' => $columns,
            'require_columns' => $require_columns,
            'data' => $data
        ]);
    }

    public function actionDocumentation($submissionId)
    {
        $model = $this->findModel($submissionId);
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file) {
                    $filename = 'documents/' . $model->file->baseName . '.' . $model->file->extension;
                    $model->file->saveAs($filename);
                    $model->file = NULL;
                    // Save file content to the database
                    $model->attachments = file_get_contents($filename);
                    if (file_exists($filename))
                        unlink($filename);
                }
                if ($model->save()) {
                    return $this->redirect(['summary', 'submissionId' => $model->submissionId]);
                }
            }
        }

        $sections = Sections::find()->all();
        return $this->render('create-other', [
            'model' => $model,
            'sections' => $sections,
            'index' => 5
        ]);
    }

    public function actionSummary($submissionId)
    {
        $model = $this->findModel($submissionId);
        $sections = Sections::find()->all();
        return $this->render('create-summary', [
            'model' => $model,
            'sections' => $sections,
            'index' => 6
        ]);
    }

    public function actionSubmit($submissionId){
        $model = $this->findModel($submissionId);
        $model->complied = ComplianceData::find()->where(['submissionId' => $model->submissionId, 'value' => 'C'])->count();
        $model->notComplied = ComplianceData::find()->where(['submissionId' => $model->submissionId, 'value' => 'D'])->count();
        $model->submitted = 1;
        if($model->save()){
            return $this->redirect(['view', 'submissionId' => $model->submissionId]);
        }
    }

    private function add_compliance($matrix, $formObject, $status)
    {
        $exists = ComplianceData::find()->andWhere(['matrixId' => $matrix->matrixId, 'submissionId' => $formObject->submissionId])->one();
        if (is_null($exists)) {
            $model = new ComplianceData();
        } else {
            $model = $exists;
        }
        $model->matrixId = $matrix->matrixId;
        $model->submissionId = $formObject->submissionId;
        $model->value = $status;
        $model->save();
    }

    private function get_data($submissionId)
    {
        $sql = "select * from compliance_data
                join compliance_matrix on compliance_matrix.matrixId = compliance_data.matrixId
                where submissionId = $submissionId ";
        $data = ComplianceData::findBySql($sql)->asArray()->all();

        return ArrayHelper::index($data, 'columnId', [function ($element) {
            return $element['itemId'];
        }]);
    }

    /**
     * Deletes an existing ComplianceSubmissions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $submissionId Submission ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($submissionId)
    {
        $this->findModel($submissionId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ComplianceSubmissions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $submissionId Submission ID
     * @return ComplianceSubmissions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($submissionId)
    {
        if (($model = ComplianceSubmissions::findOne(['submissionId' => $submissionId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
