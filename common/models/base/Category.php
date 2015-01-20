<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\Skill[] $skills
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
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
            'created_at' => Yii::t('skills', 'Created At'),
            'updated_at' => Yii::t('skills', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(\common\models\Skill::className(), ['category_id' => 'id']);
    }
}
