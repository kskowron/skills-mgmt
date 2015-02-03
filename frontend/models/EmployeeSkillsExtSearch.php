<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use common\models\Category;
use common\models\Employee;
use common\models\EmployeeSkillSearch;
use common\models\Skill;
use common\models\SkillLevel;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * Class for extended searching employees skills EmployeeSkillsExtSearch
 *
 * @property string $category_name category skill name
 * @property string $skill_name skill name
 * @property string $level_name skill level name
 * @property string|array $employee_ids one or array employee ids 
 *
 *
 * @author jaroslaw.kozak68@gmail.com
 */
class EmployeeSkillsExtSearch extends EmployeeSkillSearch
{
    protected $category_name;
    protected $skill_name;
    protected $level_name;
    protected $employee_ids = null;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),
                [
                [['category_name', 'skill_name', 'level_name'], 'safe'],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),
                [
                'category_name' => Yii::t('skills', 'Category Name'),
                'skill_name' => Yii::t('skills', 'Skill Name'),
                'level_name' => Yii::t('skills', 'Level Name'),
        ]);
    }

    public function search($params)
    {

        if (($employee = Employee::findOne(['user_id' => Yii::$app->user->id])) !== NULL) {
            $this->employee_ids = $employee->id;
        }

        /* @var $query Query */
        $query = MySkillsSearch::find();
        //Join Skills table
        $query->leftJoin(['a' => Skill::tableName()], 'skill_id = a.id');
        //Join category name
        $query->leftJoin(['b' => Category::tableName()], 'a.category_id = b.id');
        //Join level name
        $query->leftJoin(['c' => SkillLevel::tableName()],
            'skill_level_id = c.id');


        //Only chosen employee ids 
        if ($this->employee_ids !== NULL) {
            if (is_array($this->employee_ids)) {
                $query->andWhere(['employee_id' => $this->employee_ids]);
            } else {
                $query->andWhere('employee_id = :emp_id',
                    ['emp_id' => $this->employee_ids]);
            }
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'category_name' => [
                    'asc' => ['b.name' => SORT_ASC, 'a.name' => SORT_ASC],
                    'desc' => ['b.name' => SORT_DESC, 'a.name' => SORT_ASC],
                    'default' => SORT_ASC
                ],
                'skill_name' => [
                    'asc' => ['a.name' => SORT_ASC, 'b.name' => SORT_ASC],
                    'desc' => ['a.name' => SORT_ASC, 'b.name' => SORT_ASC],
                ],
                'level_name' => [
                    'asc' => ['c.name' => SORT_ASC, 'b.name' => SORT_ASC, 'a.name' => SORT_ASC],
                    'desc' => ['c.name' => SORT_DESC, 'b.name' => SORT_DESC, 'a.name' => SORT_ASC],
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'a.name', $this->skill_name]);
        $query->andFilterWhere(['like', 'b.name', $this->category_name]);
        $query->andFilterWhere(['like', 'c.name', $this->level_name]);

        return $dataProvider;
    }

    public function setCategory_name($category_name)
    {
        $this->category_name = $category_name;
    }

    public function getCategory_name()
    {
        if ($this->skill !== NULL && $this->skill->category !== NULL) {
            return $this->skill->category->name;
        }
        return $this->category_name;
    }

    function getSkill_name()
    {
        if ($this->skill !== null) {
            return $this->skill->name;
        }
        return $this->skill_name;
    }

    function setSkill_name($skill_name)
    {
        $this->skill_name = $skill_name;
    }

    function getLevel_name()
    {
        if ($this->skillLevel !== NULL) {
            return $this->skillLevel->name;
        }
        return $this->level_name;
    }

    function setLevel_name($level_name)
    {
        $this->level_name = $level_name;
    }

    function getEmployee_ids()
    {
        return $this->employee_ids;
    }

    function setEmployee_ids($employee_ids)
    {
        $this->employee_ids = $employee_ids;
    }
}