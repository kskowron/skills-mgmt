<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Skill $model
 */

$this->title = Yii::t('skills', 'Create {modelClass}', [
    'modelClass' => 'Skill',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skill-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
