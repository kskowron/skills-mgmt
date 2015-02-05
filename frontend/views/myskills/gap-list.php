<?php

use common\models\Employee;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $employee common\models\Employee */
/* @var $searchModel frontend\models\MySkillsSearch */
/* @var $level array */


$this->title  = Yii::t('skills', 'Uassigned Skills List');

$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'My skills'),'url' => ['list']];

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="employee-unassigned-index">
    <div class="page-header">
        <h1><?= Html::encode($employee->fullname) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a(Yii::t('skills', 'Create {modelClass}', [
          'modelClass' => 'Employee Skill',
          ]), ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => true, // pjax is set to always true for this demo
        'toolbar' => ['{toggleData}'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'category_name',
            'name',
            [
                'format'=>'raw',

                'value'=> function ($model, $key, $index, $widget) {
                    return Html::a(\Yii::t('skills','Add Skill'), ['add-skill','id'=>$key], ['class' => 'btn btn-success btn-sm btn-block']);
                },
            ]
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type' => 'info',
            'before' => Html::a(Html::icon('repeat').' '.\Yii::t('skills','Reset List'),
                ['gap-list'], ['class' => 'btn btn-info']),
            'after' => Html::a(Html::icon('repeat').' '.\Yii::t('skills','Reset List'),
                ['gap-list'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]);
    Pjax::end();
    ?>
</div>
