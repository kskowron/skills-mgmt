<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Employee $model
 */

$this->title = Yii::t('skills', 'Update {modelClass}: ', [
    'modelClass' => 'Employee',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('skills', 'Update');
?>
<div class="employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
