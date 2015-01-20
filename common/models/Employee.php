<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 */
class Employee extends \common\models\base\Employee
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