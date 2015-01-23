<?php

namespace common\models;

use Yii;
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
            [['id', 'business_profile_id', 'employee_id'], 'integer'],
            [['profile_order'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

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
            'employee_id' => $this->employee_id,
        ]);

        $query->andFilterWhere(['like', 'profile_order', $this->profile_order]);

        return $dataProvider;
    }
}
