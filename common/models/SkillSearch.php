<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Skill;

/**
 * SkillSearch represents the model behind the search form about `common\models\Skill`.
 */
class SkillSearch extends Skill
{
    public function rules()
    {
        return [
            [['id', 'category_id', 'created_at', 'updated_at'], 'integer'],
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
        $query = Skill::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    /**
     * Create query for unassigned skills
     * 
     * @param int $employee_id
     * @return \yii\db\Query
     */
    public function getUnassignedSkillsQuery($employee_id){
        $subQuery = EmployeeSkill::find()->andWhere('employee_id = :id', [':id'=>$employee_id]);
        /* @var $query Query */
        $query = self::find();
        $query->leftJoin(['a'=>$subQuery], self::tableName().'.id = a.skill_id');
        $query->leftJoin(['b'=>  Category::tableName()],self::tableName().'.category_id = b.id');
        $query->andWhere('a.skill_id IS NULL');
        return $query;
    }

}
