<?php

namespace frontend\controllers;

use common\models\Employee;
use frontend\models\EmployeeSkillsExtSearch;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller {

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
                'searchModel' => $searchModel]);
        }
    }

}
