<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "business_profile".
 *
 * @property integer $id
 * @property string $name
 *
 * @property \common\models\EmployeeBusinessProfile[] $employeeBusinessProfiles
 */
class BusinessProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('skills', 'ID'),
            'name' => Yii::t('skills', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeBusinessProfiles()
    {
        return $this->hasMany(\common\models\EmployeeBusinessProfile::className(), ['business_profile_id' => 'id']);
    }
}
