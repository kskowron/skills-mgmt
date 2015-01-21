<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var common\models\EmployeeSkill $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="employee-skill-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'skill_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Skill ID...']], 

'skill_level_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Skill Level ID...']], 

'employee_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Employee ID...']], 

'created_at'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Created At...']], 

'updated_at'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Updated At...']], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
