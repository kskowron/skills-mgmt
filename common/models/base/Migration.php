<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "migration".
 *
 * @property string $version
 * @property integer $apply_time
 */
class Migration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'migration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['version'], 'required'],
            [['apply_time'], 'integer'],
            [['version'], 'string', 'max' => 180]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'version' => Yii::t('skills', 'Version'),
            'apply_time' => Yii::t('skills', 'Apply Time'),
        ];
    }
}
