<?php

namespace common\models\base;

use Yii;

class Competence extends \yii\db\ActiveRecord 
{
    public static function tableName() {
        return 'competence';
    }
    
    public function rules() 
    {
        return [
            [['created_at', 'updated_ad'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['name', 'created_at', 'updated_ad'], 'required']
        ];
    }
    
    public function attributeLabels() 
    {
        return [
            'id' => Yii::t('competences', 'ID'),
            'name' => Yii::t('competences', 'Competence name')
        ];
    }
}

