<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "employee".
 *
 * @property string $fullname Employee fullname, firstName lastNema
 *                            or use getFullname(true) to reverse order
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

    public function getFullname($lastFirst = false)
    {
        if ($lastFirst) {
            return $this->lastName.' '.$this->firstName;
        }
        return $this->firstName.' '.$this->lastName;
    }

    public function isAdministrator()
    {
        foreach ($this->employeeRoles as $key => $value) {
            if($value->role == EmployeeRole::ADMINISTRATOR){
                return TRUE;
            }
        }
        return FALSE;
    }
}