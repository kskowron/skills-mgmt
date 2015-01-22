<?php

class Competence extends \common\models\base\Competence
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

