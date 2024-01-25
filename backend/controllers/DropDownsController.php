<?php

namespace backend\controllers;

use app\models\Departments;
use app\models\FinancialInstitutions;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 *
 * Get Dependent drop downs
 *
 * Locations
 * Region feeds Districts feed County feed Sub County feed Parish. Village will be a text field
 */
class DropDownsController extends Controller
{
    private $dependencyDropdownFirstParam;


    public function beforeAction($action)
    {
        $this->dependencyDropdownFirstParam = Yii::$app->request->post('depdrop_parents') ?? NULL;
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['financial-institution'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionFinancialInstitution()
    {
        echo $this->_generate_dropDown(
            User::find()
                ->where(['organizationTypeId' => $this->dependencyDropdownFirstParam, 'status' => 10])
                ->all()
            , 'organizationName'
        );
    }

    private function _generate_dropDown($data, $value)
    {

        $response = [];

        foreach ($data as $datum)
            $response[] = [
                'id' => $datum->id,
                'name' => $datum->$value,
            ];

        return json_encode([
            'output' => $response,
            'selected' => [],
        ]);
    }
}