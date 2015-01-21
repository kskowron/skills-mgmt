<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Category $model
 */

$this->title = Yii::t('skills', 'Create {modelClass}', [
    'modelClass' => 'Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
