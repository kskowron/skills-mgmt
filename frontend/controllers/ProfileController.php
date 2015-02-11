<?php

namespace frontend\controllers;

use common\models\Employee;
use frontend\models\EmployeeSkillsExtSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Session;

class ProfileController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view'],
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionView() {
        $employee = Employee::findOne((int) Yii::$app->request->getQueryParam('id'));
        if ($employee == NULL) {
            throw new NotFoundHttpException(Yii::t('skills', 'The requested employee does not exist.'));
        } else {
            /* var $searchModel EmployeeSkillsExtSearch */
            $searchModel = new EmployeeSkillsExtSearch();
            $dataProvider = $searchModel->searchEmployeeSkills(Yii::$app->request->getQueryParams());

            return $this->render('view', ['employee' => $employee,
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                        'profileBackUrl' => Yii::$app->session->get('profileBackUrl', NULL)
                ]);
        }
    }

}
