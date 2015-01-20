<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "employee_skill".
 *
 * @property integer $id
 * @property integer $skill_id
 * @property integer $skill_level_id
 * @property integer $employee_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\Employee $employee
 * @property \common\models\Skill $skill
 * @property \common\models\SkillLevel $skillLevel
 */
class EmployeeSkill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee_skill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skill_id', 'skill_level_id', 'employee_id', 'created_at', 'updated_at'], 'required'],
            [['skill_id', 'skill_level_id', 'employee_id', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('skills', 'ID'),
            'skill_id' => Yii::t('skills', 'Skill ID'),
            'skill_level_id' => Yii::t('skills', 'Skill Level ID'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(\common\models\Skill::className(), ['id' => 'skill_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkillLevel()
    {
        return $this->hasOne(\common\models\SkillLevel::className(), ['id' => 'skill_level_id']);
    }
}
