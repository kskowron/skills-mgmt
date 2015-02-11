<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "employee_role".
 */
class EmployeeRole extends \common\models\base\EmployeeRole
{
    const REGULAR_USER  = 0;
    const ADMINISTRATOR = 10;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'role'], 'required'],
            [['employee_id'], 'exist', 'targetClass' => 'common\models\Employee',
                'targetAttribute' => 'id'],
            [['role'], 'in', 'range' => [self::REGULAR_USER, self::ADMINISTRATOR]]
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

    public static function getRolesList()
    {
        return [
            self::REGULAR_USER => \Yii::t('skills', 'Regular Employee'),
            self::ADMINISTRATOR => \Yii::t('skills', 'Administrator')
        ];
    }
}