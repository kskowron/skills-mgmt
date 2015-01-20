<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "location".
 */
class Location extends \common\models\base\Location
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