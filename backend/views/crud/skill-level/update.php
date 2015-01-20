<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\SkillLevel $model
 */

$this->title = Yii::t('skills', 'Update {modelClass}: ', [
    'modelClass' => 'Skill Level',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Skill Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('skills', 'Update');
?>
<div class="skill-level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
