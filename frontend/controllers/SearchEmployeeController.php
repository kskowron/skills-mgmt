<?php

namespace frontend\controllers;

use common\models\SkillLevel;
use frontend\models\EmployeeSearchExt;
use frontend\models\SkillSearchExt;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SearchEmployeeController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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

        // Getting skills list from GET parameter and fetching list of employees from DB
        $skillsList = Yii::$app->request->getQueryParam('skills_list');
        $skillLevel = (int) Yii::$app->request->getQueryParam('skill_level');
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($skillsList, 'employee_id', $skillLevel);

        return $this->render('by-skill', 
                             ['categories' => $categories, 
                              'skillsList' => $skillsList,
                              'employeeDataProvider'  => $employees,
                              'skillLevels' => SkillLevel::find()->asArray()->all()]);
    }

    public function actionIndex() {
        return $this->render('index');
    }

}
