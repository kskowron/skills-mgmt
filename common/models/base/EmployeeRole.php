<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "employee_role".
 *
 * @property integer $id
 * @property integer $role
 * @property integer $employee_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\Employee $employee
 */
class EmployeeRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'employee_id', 'created_at', 'updated_at'], 'required'],
            [['role', 'employee_id', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('skills', 'ID'),
            'role' => Yii::t('skills', 'Role'),
            'employee_id' => Yii::t('skills', 'Employee ID'),
            'created_at' => Yii::t('skills', 'Created At'),
            'updated_at' => Yii::t('skills', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(\common\models\Employee::className(), ['id' => 'employee_id']);
    }
}
