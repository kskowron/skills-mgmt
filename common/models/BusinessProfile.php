<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "business_profile".
 */
class BusinessProfile extends \common\models\base\BusinessProfile
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
