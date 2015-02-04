<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `common\models\Employee`.
 */
class EmployeeSearch extends Employee {

    public function rules() {
        return [
            [['id', 'user_id', 'location_id', 'created_at', 'updated_at'], 'integer'],
            [['firstName', 'lastName'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = Employee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'location_id' => $this->location_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'firstName', $this->firstName])
                ->andFilterWhere(['like', 'lastName', $this->lastName]);

        return $dataProvider;
    }

    public function searchBySkills($skillSet) {
        if (!is_array($skillSet) || count($skillSet) < 1) {
            $skillSet = [-1];
        }
        
        // Searching for id of employees meeting requirements
        $q = new \yii\db\Query();
        $q->select(['employee_id', 'no_of_skills' => 'count(*)'])
                ->from(base\EmployeeSkill::tableName())
                ->where(['in', 'skill_id', $skillSet])
                ->andWhere(['or', 'years_of_experience>0', 'last_activity>0'])
                ->groupBy('employee_id')
                ->having(['no_of_skills' => count($skillSet)]);
        $sq = new \yii\db\Query();
        $sq->select('employee_id')->from(['es' => $q]);

        // Fetching employees with selected previously ids
        $query = Employee::find()->distinct()->where(['in', 'id', array_map(function($arr) {
                        return (int) $arr['employee_id'];
                    }, $sq->all())])->orderBy('lastName');
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        return $dataProvider;
    }

}
