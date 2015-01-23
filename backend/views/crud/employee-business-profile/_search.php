<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\EmployeeBusinessProfileSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="employee-business-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'business_profile_id') ?>

    <?= $form->field($model, 'employee_id') ?>

    <?= $form->field($model, 'profile_order') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('skills', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('skills', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
