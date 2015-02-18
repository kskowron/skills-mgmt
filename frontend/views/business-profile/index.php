<?php

use kartik\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;

/* @var $this View */

$this->title = Yii::t('skills', 'Business profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-profile-view">
    <h1><?= Html::encode($this->title); ?></h1>
    <div class="text-left"><?= Html::encode(Yii::t('skills', 'Please select business profile to see more details.')); ?></div>
    <div>
        <?php
        echo ListView::widget(['dataProvider' => $dataProvider,
            'itemView' => function($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->name), ['business-profile/view', 'id' => $model->id]);
            }
                ]);
                ?>
    </div>
</div>
