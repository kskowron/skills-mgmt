<?php

namespace frontend\controllers;

use common\models\Employee;
use frontend\models\EmployeeSkillsExtSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller {

    public function actionView() {
        $employeeId = (int) Yii::$app->request->getQueryParam('id');
        $employee = Employee::findOne($employeeId);
        if ($employee == NULL) {
            throw new NotFoundHttpException(Yii::t('skills', 'The requested employee does not exist.'));
        } else {
            /* var $searchModel EmployeeSkillsExtSearch */
            $searchModel = new EmployeeSkillsExtSearch();
            $searchModel->employee_ids = $employee->id;
            $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
            $dataProvider->query->andWhere(['>=', 'skill_level_id', 1]);

            return $this->render('view', ['employee' => $employee, 
                'dataProvider' => $dataProvider, 
                'searchModel' => $searchModel]);
        }
    }

}
