<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var common\models\EmployeeBusinessProfile $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="employee-business-profile-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'business_profile_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Business Profile ID...']], 

'employee_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Employee ID...']], 

'profile_order'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Profile Order...', 'maxlength'=>1]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
