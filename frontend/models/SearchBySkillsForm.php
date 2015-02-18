<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class SearchBySkillsForm extends Model {

    public $skills_list = [];
    public $skill_level = NULL;

    public function rules() {
        return [[['skills_list', 'skill_level'], 'required']];
    }

}
