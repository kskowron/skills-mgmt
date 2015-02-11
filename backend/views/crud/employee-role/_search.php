<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\EmployeeSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="employee-role-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'role') ?>
    <?= $form->field($model, 'employee_id') ?>\
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('skills', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('skills', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
