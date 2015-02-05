<?php

namespace frontend\controllers;

use frontend\models\EmployeeSearchExt;
use frontend\models\SkillSearchExt;
use Yii;
use yii\web\Controller;

class SearchEmployeeController extends Controller {

    public function actionBySkill() {
        $skillSearch = new SkillSearchExt();
        $categories = $skillSearch->allWithCategories();

        // Getting skills list from GET parameter and fetching list of employees from DB
        $skillsList = Yii::$app->request->getQueryParam('skills_list');
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($skillsList, 'employee_id');

        return $this->render('by-skill', 
                             ['categories' => $categories, 
                              'skillsList' => $skillsList,
                              'employeeDataProvider'  => $employees]);
    }

    public function actionIndex() {
        return $this->render('index');
    }

}
