<?php

namespace frontend\controllers;

use common\models\SkillLevel;
use frontend\models\EmployeeSearchExt;
use frontend\models\SkillSearchExt;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class SearchEmployeeController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['by-skill'],
                'rules' => [
                    [
                        'actions' => ['by-skill'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionBySkill() {
        $skillSearch = new SkillSearchExt();
        $categories = $skillSearch->allWithCategories();

        $params = Yii::$app->request->getQueryParams();
        
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($params);

        return $this->render('by-skill', ['categories' => $categories,
                    'skillsList' => ArrayHelper::getValue($params, 'skills_list', []),
                    'searchModel' => $employeeSearch,
                    'dataProvider' => $employees,
                    'skillLevels' => SkillLevel::find()->asArray()->all()]);
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionAllEmployees() {
        $searchModel = new EmployeeSearchExt();
        $dataProvider = $searchModel->searchAll(Yii::$app->request->getQueryParams());

        return $this->render('all-employees', ['searchModel' => $searchModel,
                    'dataProvider' => $dataProvider]);
    }

}
