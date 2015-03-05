<?php

use kartik\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\EmployeeBusinessProfileSearch $searchModel
 */

$this->title = Yii::t('skills', 'My Business Profiles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'My Profile'),'url' => ['my-profile/view']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-business-profile-index">
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?php 
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'profile_order',
            [
                'attribute'=>'businessProfile',
                'value'=>function($model){
                    /* @var common\models\EmployeeBusinessProfile $model */
                    return \kartik\helpers\Html::encode($model->businessProfile->name);
                }

            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{up} {down} - {update}  {delete}',
                'buttons' => [
                'update' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                Yii::$app->urlManager->createUrl(['my-business-profile/update','id' => $model->id]),
                                ['title' => Yii::t('yii', 'Edit'),]);},
                'up' => function ($url, $model) {
                            return Html::a(Html::icon('chevron-up'),
                                Yii::$app->urlManager->createUrl(['my-business-profile/move-up','id' => $model->id]),
                                ['title' => Yii::t('skills', 'Move item UP'),]);},
                'down' => function ($url, $model) {
                            return Html::a(Html::icon('chevron-down'),
                                Yii::$app->urlManager->createUrl(['my-business-profile/move-down','id' => $model->id]),
                                ['title' => Yii::t('skills', 'Move item DOWN'),]);}
                ],
            ],
        ],
        'responsive'=>true,
        'condensed'=>true,
        'floatHeader'=>true,
        'toolbar'=>false,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type'=>'info',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),
            'showFooter'=>false,
            'after'=>false
        ],
    ]);
    Pjax::end(); ?>

</div>
