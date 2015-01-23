<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\EmployeeBusinessProfile $model
 */

$this->title = Yii::t('skills', 'Update {modelClass}: ', [
    'modelClass' => 'Employee Business Profile',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Employee Business Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('skills', 'Update');
?>
<div class="employee-business-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
