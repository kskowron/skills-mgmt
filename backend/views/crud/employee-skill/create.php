<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\EmployeeSkill $model
 */

$this->title = Yii::t('skills', 'Create {modelClass}', [
    'modelClass' => 'Employee Skill',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Employee Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-skill-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
