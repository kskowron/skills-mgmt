<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "employee_skill".
 */
class EmployeeSkill extends \common\models\base\EmployeeSkill
{

    public function rules()
    {
        return [
            [['skill_id', 'skill_level_id', 'employee_id'], 'required'],
            [['skill_id', 'skill_level_id', 'last_activity', 'employee_id'], 'integer'],
            [['years_of_experience'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}