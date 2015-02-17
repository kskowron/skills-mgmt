<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use common\models\Employee;
use common\models\SkillSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * Description of AvailableSkillsSearch
 *
 * @property string $category_name Name of skills category
 * @author jarek
 */
class AvailableSkillsSearch extends SkillSearch
{

    public $loggedEmployee;

    protected $category_name;

    public function init()
    {
        parent::init();
        $this->loggedEmployee = Employee::findOne(['user_id' => Yii::$app->user->id]);
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),
            [[['category_name'],'safe']]);
    }

    public function search($params)
    {
        $query = self::getUnassignedSkillsQuery($this->loggedEmployee->id);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'category_name' => [
                    'asc' => ['b.name' => SORT_ASC, 'name' => SORT_ASC],
                    'desc' => ['b.name' => SORT_DESC, 'name' => SORT_ASC],
                    'default' => SORT_ASC
                ],
                'name' => [
                    'asc' => ['name' => SORT_ASC, 'b.name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC, 'b.name' => SORT_ASC],
                ],
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 't.name', $this->name]);
        $query->andFilterWhere(['like', 'b.name', $this->category_name]);

        return $dataProvider;
    }

    function getCategory_name()
    {
        if($this->category!==NULL){
            return $this->category->name;
        }
        return $this->category_name;
    }

    function setCategory_name($category_name)
    {
        $this->catetory_name = $catetory_name;
    }

}