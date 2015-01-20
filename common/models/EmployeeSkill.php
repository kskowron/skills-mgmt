<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee_skill".
 */
class EmployeeSkill extends \common\models\base\EmployeeSkill
{
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