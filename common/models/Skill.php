<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "skill".
 */
class Skill extends \common\models\base\Skill
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