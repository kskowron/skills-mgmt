<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class SearchBusinessProfileForm extends Model {

    public $id = NULL;

    public function rules() {
        return [[['id'], 'required']];
    }

}
