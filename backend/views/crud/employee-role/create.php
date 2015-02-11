<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\EmployeeRole $model
 */

$this->title = Yii::t('skills', 'Create {modelClass}', [
    'modelClass' => 'Employee Role',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Employee Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-role-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
