<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\EmployeeBusinessProfile $model
 */

$this->title = Yii::t('skills', 'Create {modelClass}', [
    'modelClass' => 'Employee Business Profile',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'My Profile'),'url' => ['my-profile/view']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'My Business Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-business-profile-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
