<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\SkillLevel $model
 */

$this->title = Yii::t('skills', 'Create {modelClass}', [
    'modelClass' => 'Skill Level',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Skill Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skill-level-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
