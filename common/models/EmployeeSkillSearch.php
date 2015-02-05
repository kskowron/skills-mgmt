<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EmployeeSkill;

/**
 * EmployeeSkillSearch represents the model behind the search form about `common\models\EmployeeSkill`.
 */
class EmployeeSkillSearch extends EmployeeSkill
{

    public function rules()
    {
        return [
            [['id', 'skill_id', 'skill_level_id', 'employee_id', 'last_activity',],
                'integer'],
            [['years_of_experience'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = EmployeeSkill::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'skill_id' => $this->skill_id,
            'skill_level_id' => $this->skill_level_id,
            'employee_id' => $this->employee_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}