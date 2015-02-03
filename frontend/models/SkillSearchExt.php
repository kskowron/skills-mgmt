<?php

namespace frontend\models;

use common\models\base\Category;
use common\models\Skill;
use common\models\SkillSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class SkillSearchExt extends SkillSearch {

    private function allWithCategoryNames() {
        $retVal = NULL;
        
        /* var $query Query */
        $query = new Query();
        $query->select(['categoryName' => 'c.name', 'skillId' => 's.id', 'skillName' => 's.name']);
        $query->from(['c' => 'category']);
        $query->innerJoin(['s' => 'skill'], 's.category_id = c.id');
        $query->orderBy(['categoryName' => SORT_ASC, 'skillName' => SORT_ASC]);
        $retVal = $query->all();
        
        return $retVal;
    }
    
    public function allWithCategories() {
        $retVal = NULL;
        $categories = $this->allWithCategoryNames();
        
        if(is_array($categories) && count($categories)>0) {
            $retVal = ArrayHelper::map($categories, 'skillId', 'skillName', 'categoryName');
        }
        
        return $retVal;
    }
}
