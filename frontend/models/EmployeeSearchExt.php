<?php

namespace frontend\models;

use common\models\base\EmployeeSkill;
use common\models\Employee;
use common\models\EmployeeSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;

class EmployeeSearchExt extends EmployeeSearch {
    
    public function searchBySkills($skillSet) {
        if (!is_array($skillSet) || count($skillSet) < 1) {
            $skillSet = [-1];
        }
        
        // Searching for id of employees meeting requirements
        $q = new Query();
        $q->select(['employee_id', 'no_of_skills' => 'count(*)'])
                ->from(EmployeeSkill::tableName())
                ->where(['in', 'skill_id', $skillSet])
                ->andWhere(['or', 'years_of_experience>0', 'last_activity>0'])
                ->groupBy('employee_id')
                ->having(['no_of_skills' => count($skillSet)]);
        $sq = new Query();
        $sq->select('employee_id')->from(['es' => $q]);

        // Fetching employees with selected previously ids
        $query = Employee::find()->distinct()->where(['in', 'id', array_map(function($arr) {
                        return (int) $arr['employee_id'];
                    }, $sq->all())])->orderBy('lastName');
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        return $dataProvider;
    }
}
