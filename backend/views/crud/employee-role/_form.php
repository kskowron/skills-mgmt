<?php

use common\models\EmployeeRole;
use jk\helpers\Select2Helper;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var yii\web\View $this */
/* @var $form ActiveForm2 */
/* @var  $model EmployeeRole */


$s2helper = new \jarekkozak\widgets\Select2AjaxConfig(['url'=>['crud/employee-role/employee-list']]);

?>
<div class="employee-role-form">
    <?php
    $form    = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
            'employee_id' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => Select2::className(),
                'options' => $s2helper->getConfig(),
            ],
            'role' => ['type' => Form::INPUT_DROPDOWN_LIST, 'options' => ['placeholder' => 'Enter role...'], 'items'=> EmployeeRole::getRolesList()],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app',
                'Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>
</div>
