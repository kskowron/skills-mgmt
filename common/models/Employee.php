<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "employee".
 */
class Employee extends \common\models\base\Employee
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_id'], 'integer'],
            [['location_id', 'firstName', 'lastName'], 'required'],
            [['firstName', 'lastName'], 'string', 'max' => 60]
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

    /**
     * Gets location name
     */
    public function getLocationName()
    {
        If (($model = parent::getLocation()->one()) == NULL) {
            return NULL;
        }
        return $model->name;
    }
}