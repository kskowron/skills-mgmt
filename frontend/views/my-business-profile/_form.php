<?php

use common\models\EmployeeBusinessProfile;
use jarekkozak\widgets\Select2AjaxConfig;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm as ActiveForm2;

/**
 * @var View $this
 * @var EmployeeBusinessProfile $model
 * @var ActiveForm2 $form
 */

$s2helper = new Select2AjaxConfig(['url'=>['my-business-profile/business-profiles-list']]);
?>
<div class="employee-business-profile-form">
    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
            'business_profile_id' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => Select2::className(),
                'options' => $s2helper->getConfig(['placeholder' => 'Enter Business Profile...']),
            ],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app','Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>
</div>
