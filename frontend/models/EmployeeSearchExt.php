<?php

namespace frontend\models;

use common\models\base\EmployeeSkill;
use common\models\Employee;
use common\models\EmployeeBusinessProfile;
use common\models\EmployeeSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class EmployeeSearchExt extends EmployeeSearch {
    
    public function searchBySkills($params) {
        $params['skills_list'] = ArrayHelper::getValue($params, 'skills_list', (int) -1);
        $params['skill_level'] = ArrayHelper::getValue($params, 'skill_level', NULL);
        
        // Searching for id of employees meeting requirements
        $q = new Query();
        $q->select(['employee_id', 'no_of_skills' => 'count(*)'])
                ->from(EmployeeSkill::tableName())
                ->where(['in', 'skill_id', $params['skills_list']])
                ->andWhere(['>=', 'skill_level_id', $params['skill_level']])
                ->groupBy('employee_id')
                ->having(['no_of_skills' => count($params['skills_list'])]);
        $sq = new Query();
        $sq->select('employee_id')->from(['es' => $q]);

        // Fetching employees with selected previously ids
        $query = Employee::find()->where(['in', 'id', array_map(function($arr) {
                        return (int) $arr['employee_id'];
                    }, $sq->all())]);
        
        // Setting sort order if not provided by user
        if(ArrayHelper::getValue($params, 'sort', NULL) == NULL) {
            $query->orderBy('lastName asc');
        }
       
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        return $dataProvider;
    }
    
    /** 
     * Searches for employees matching given criteria
     * 
     * @param type $params
     * @return type
     */
    public function searchAll($params) {
        $dataProvider = $this->search($params);
        if(ArrayHelper::getValue($params, 'sort', NULL) == NULL) {
            $dataProvider->query->orderBy('lastName, firstName');
        }
        return $dataProvider;
    }
    
    public function searchByBusinessProfile($params) {
        $dataProvider = $this->searchAll($params);
        $q = new Query();
        $q->select('employee_id')->from(EmployeeBusinessProfile::tableName())->where('business_profile_id = ' . $params['id']);
        $dataProvider->query->andWhere(['in', 'id', $q]);
        return $dataProvider;
    }

}
