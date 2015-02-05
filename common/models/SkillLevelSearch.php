<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SkillLevel;

/**
 * SkillLevelSearch represents the model behind the search form about `common\models\SkillLevel`.
 */
class SkillLevelSearch extends SkillLevel
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = SkillLevel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    /**
     * Returns array of available skill levels
     *
     * @return \yii\db\Query
     */
    public function getLevelList(){
        $query = new \yii\db\Query();
        $query->select(['id','name'])->from(self::tableName())->orderBy('id');
        return $query;
    }
}
