<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 */
class Category extends \common\models\base\Category
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