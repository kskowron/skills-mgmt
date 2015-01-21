<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var common\models\Employee $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'user_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter User ID...']], 

'location_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Location ID...']], 

'created_at'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Created At...']], 

'updated_at'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Updated At...']], 

'firstName'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter First Name...', 'maxlength'=>60]], 

'lastName'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Last Name...', 'maxlength'=>60]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
