<?php

namespace frontend\controllers;

use common\models\SkillLevel;
use frontend\models\EmployeeSearchExt;
use frontend\models\SkillSearchExt;
use Yii;
use yii\web\Controller;

class SearchEmployeeController extends Controller {

    public function actionBySkill() {
        $skillSearch = new SkillSearchExt();
        $categories = $skillSearch->allWithCategories();
        
        print_r(Yii::$app->request->getQueryParams());

        // Getting skills list from GET parameter and fetching list of employees from DB
        $skillsList = Yii::$app->request->getQueryParam('skills_list');
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($skillsList, 'employee_id');
        
        print_r(SkillLevel::find()->asArray()->all());

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
