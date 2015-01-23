<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\BusinessProfile $model
 */

$this->title = Yii::t('skills', 'Create {modelClass}', [
    'modelClass' => 'Business Profile',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Business Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-profile-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
