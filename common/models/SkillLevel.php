<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "skill_level".
 */
class SkillLevel extends \common\models\base\SkillLevel
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}