<?php

use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */

$this->title = Yii::t('skills', 'Business profile details');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-profile-view">
    <h1><?= Html::encode($businessProfile->name); ?></h1>
    <div class="text-left"><?= Html::encode($businessProfile->description); ?></div>
    <br />
    <div>
        <?php
        if ($dataProvider) {
            Pjax::begin();
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showOnEmpty' => false,
                'responsive' => true,
                'hover' => true,
                'condensed' => true,
                'floatHeader' => true,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['label' => Yii::t('skill', 'Last name'),
                        'attribute' => 'lastName',
                        'format' => 'raw',
                        'value' => function($data) {
                            return Html::a(Html::encode($data->lastName), Yii::$app->urlManager->createUrl(['profile/view',
                                                'id' => $data->id]), ['title' => Yii::t('app', 'See details')]);
                        }],
                            ['label' => Yii::t('skill', 'First name'),
                                'attribute' => 'firstName',
                                'format' => 'raw',
                                'value' => function($data) {
                                    return Html::a(Html::encode($data->firstName), Yii::$app->urlManager->createUrl(['profile/view',
                                                        'id' => $data->id]), ['title' => Yii::t('app', 'See details')]);
                                }],
                                        ],
                                        'panel' => [
                                            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode(Yii::t('skills', 'People of ' . Html::encode($businessProfile->name) . ' profile')) . ' </h3>',
                                            'type' => 'info',
                                            'before' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['business-profile/view', 'id' => $businessProfile->id], ['class' => 'btn btn-info']),
                                            'showFooter' => true
                                        ]
                                    ]);
                                    Pjax::end();
                                }
                                ?>
    </div>
</div>
