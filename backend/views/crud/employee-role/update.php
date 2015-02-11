<?php

use yii\helpers\Html;

 /* @var $this yii\web\View */
 /* @var $model common\models\EmployeeRole */

$this->title = Yii::t('skills', 'Update {modelClass}: ', [
    'modelClass' => 'Employee Role',
]) . ' ' . $model->employee->fullname;

$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Employee Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->employee->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('skills', 'Update');
?>
<div class="employee-role-update">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
