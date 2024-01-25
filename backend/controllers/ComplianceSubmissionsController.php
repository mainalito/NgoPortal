<?php

namespace backend\controllers;

use app\models\ComplianceSubmissions;
use common\models\ComplianceData;
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
use kartik\mpdf\Pdf;

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
                                'index', 'view', 'test-view', 'report', 'create', 'update', 'data', 'delete'
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

    public function actionTestView($submissionId)
    {
        $model = $this->findModel($submissionId);
        $sections = Sections::find()->all();
        return $this->render('test-view', [
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

    public function actionReport($submissionId) {
        // get your HTML raw content without any layouts or scripts
        $model = $this->findModel($submissionId);
        $sections = Sections::find()->all();
        $content = $this->renderPartial('_reportView', [
            'model' => $model,
            'sections' => $sections,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['Krajee Report Header'],
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
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
