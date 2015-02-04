<?php

namespace frontend\controllers;

use common\models\EmployeeSearch;
use frontend\models\SkillSearchExt;

class SearchController extends \yii\web\Controller {

    public function actionBySkill() {
        $skillSearch = new SkillSearchExt();
        $categories = $skillSearch->allWithCategories();

        // Getting skills list from GET parameter and fetching list of employees from DB
        $skillsList = \Yii::$app->request->getQueryParam('skills_list');
        $employeeSearch = new EmployeeSearch();
        $employees = $employeeSearch->searchBySkills($skillsList, 'employee_id');

        return $this->render('byskill', 
                             ['categories' => $categories, 
                              'skillsList' => $skillsList,
                              'employeeDataProvider'  => $employees]);
    }

    public function actionIndex() {
        return $this->render('index');
    }

}
