<?php

namespace common\models;

use common\models\Employee;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\Json;

/**
 * EmployeeSearch represents the model behind the search form about `common\models\Employee`.
 */
class EmployeeSearch extends Employee
{

    public function rules()
    {
        return [
            [['id', 'user_id', 'location_id', 'created_at', 'updated_at'], 'integer'],
            [['firstName', 'lastName'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
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
        ]);

        $query->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName]);

        return $dataProvider;
    }


    /**
     * Search employee by hist first or last name or id. Returns array of
     * 
     * [
     *   0=>['id'=>id, 'text'=>value ]
     *   ...
     * ]
     * 
     * @param string $search part of last or first name
     * @param int $id employee id
     * @param boolean $json if true result is json encoded
     * @return array|string 
     */
    public function getEmployeeList($search, $id = NULL,$json=TRUE)
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query;
            $query->select([ 'id'=>'id','text'=>'concat(firstName,\' \',lastName)'])
                ->from(Employee::tableName())
                ->orFilterWhere(['like', 'firstName', $search])
                ->orFilterWhere(['like', 'lastName', $search])
                ->limit(20);
            $command = $query->createCommand();
            $data    = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0 && ($employee = Employee::findOne($id)) !== null) {
            $out['results'] = ['id' => $id, 'text' => $employee->fullname];
        } else {
            $out['results'] = ['id' => 0, 'text' => Yii::t('skills', 'No employees')];
        }
        return $json?Json::encode($out):$out;
    }

}