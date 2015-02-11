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
    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
//            'years_of_experience' => [
//                'type' => Form::INPUT_WIDGET,
//                'options' => ['placeholder' => 'Enter you experience in years...'],
//                'items' => $years_of_experience
//            ],

            'years_of_experience' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => '\kartik\typeahead\Typeahead',
                'options' => [
                    'options' => ['placeholder' => 'Enter you experience in years...'],
                    'dataset' => [
                        [
                            'local' => $years_of_experience,
                            'limit' => 10
                        ]
                    ]
                ],
            ],
            'last_activity' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'options' => ['placeholder' => 'Enter year of last use...'],
                'items' => $last_activity
            ],
            'skill_level_id' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'options' => ['placeholder' => 'Enter Skill Level...'],
                'items' => $levels
            ],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app',
                'Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>
</div>
