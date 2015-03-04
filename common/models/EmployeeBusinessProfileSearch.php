<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EmployeeBusinessProfile;

/**
 * EmployeeBusinessProfileSearch represents the model behind the search form about `common\models\EmployeeBusinessProfile`.
 */
class EmployeeBusinessProfileSearch extends EmployeeBusinessProfile
{

    public function rules()
    {
        return [
            [['id', 'business_profile_id', 'employee_id', 'profile_order'], 'integer'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * General employee skills search
     * 
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EmployeeBusinessProfile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'business_profile_id' => $this->business_profile_id,
            'profile_order' => $this->profile_order,
            'employee_id' => $this->employee_id
        ]);
        return $dataProvider;
    }

    /**
     * Search for business profiles for given employee
     * 
     * @param int $employee_id
     * @return ActiveDataProvider
     */
    public function employeeProfilesSearch($employee_id)
    {
        $query = EmployeeBusinessProfile::find();

        $query->andFilterWhere([
            'employee_id' => $employee_id,
        ])->orderBy('profile_order');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}