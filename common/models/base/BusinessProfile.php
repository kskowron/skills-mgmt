<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "business_profile".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property EmployeeBusinessProfile[] $employeeBusinessProfiles
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
            [['description'], 'string'],
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
            'description' => Yii::t('skills', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeBusinessProfiles()
    {
        return $this->hasMany(EmployeeBusinessProfile::className(), ['business_profile_id' => 'id']);
    }
}
