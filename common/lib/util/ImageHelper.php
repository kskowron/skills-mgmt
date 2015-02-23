<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\lib\util;

use kartik\helpers\Html;
use yii\base\Object;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Description of ImageHelper
 *
 * @author ksawery.skowron
 */
class ImageHelper extends Object {

    public static function businessPhoto($employee) {
        $photo = $employee->getPhoto();
        if ($photo !== NULL) {
            return Html::img(['employee-files/get-image', 'fileId' => (string) $photo->_id], ['class' => 'img-thumbnail img-responsive', 'alt' => $employee->firstName . ' ' . $employee->lastName]);
        } else {
            return Html::img(Url::base(true) . '/img/person-placeholder.jpg', ['class' => 'img-thumbnail img-responsive']);
        }
    }

}
