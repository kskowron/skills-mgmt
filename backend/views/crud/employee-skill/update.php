<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\EmployeeSkill $model
 */

$this->title = Yii::t('skills', 'Update {modelClass}: ', [
    'modelClass' => 'Employee Skill',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Employee Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('skills', 'Update');
?>
<div class="employee-skill-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
