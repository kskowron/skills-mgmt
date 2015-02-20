<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "employee_business_profile".
 *
 * @property integer $id
 * @property integer $business_profile_id
 * @property integer $employee_id
 * @property integer $profile_order
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\Employee $employee
 * @property \common\models\BusinessProfile $businessProfile
 */
class EmployeeBusinessProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee_business_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['business_profile_id', 'employee_id', 'profile_order'], 'required'],
            [['business_profile_id', 'employee_id','profile_order'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('skills', 'ID'),
            'business_profile_id' => Yii::t('skills', 'Business Profile ID'),
            'employee_id' => Yii::t('skills', 'Employee ID'),
            'profile_order' => Yii::t('skills', 'Profile Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(\common\models\Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessProfile()
    {
        return $this->hasOne(\common\models\BusinessProfile::className(), ['id' => 'business_profile_id']);
    }
}
