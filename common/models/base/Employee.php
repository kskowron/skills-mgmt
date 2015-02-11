<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "employee".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $location_id
 * @property string $firstName
 * @property string $lastName
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\Location $location
 * @property \common\models\User $user
 * @property \common\models\EmployeeBusinessProfile[] $employeeBusinessProfiles
 * @property \common\models\EmployeeRole[] $employeeRoles
 * @property \common\models\EmployeeSkill[] $employeeSkills
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'location_id', 'firstName', 'lastName', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'location_id', 'created_at', 'updated_at'], 'integer'],
            [['firstName', 'lastName'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('skills', 'ID'),
            'user_id' => Yii::t('skills', 'User ID'),
            'location_id' => Yii::t('skills', 'Location ID'),
            'firstName' => Yii::t('skills', 'First Name'),
            'lastName' => Yii::t('skills', 'Last Name'),
            'created_at' => Yii::t('skills', 'Created At'),
            'updated_at' => Yii::t('skills', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(\common\models\Location::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeBusinessProfiles()
    {
        return $this->hasMany(\common\models\EmployeeBusinessProfile::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeRoles()
    {
        return $this->hasMany(\common\models\EmployeeRole::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeSkills()
    {
        return $this->hasMany(\common\models\EmployeeSkill::className(), ['employee_id' => 'id']);
    }
}
