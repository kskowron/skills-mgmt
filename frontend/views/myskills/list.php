<?php

use common\models\Employee;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $employee common\models\Employee */

$this->title                   = Yii::t('skills', 'My skills');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-skill-index">
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'category_name',
            'skill_name',
            'level_name',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                Yii::$app->urlManager->createUrl(['employee-skill/view',
                                    'id' => $model->id, 'edit' => 't']),
                                [
                                'title' => Yii::t('yii', 'Edit'),
                        ]);
                    }
                    ],
                ],
            ],
            'responsive' => true,
            'hover' => true,
            'condensed' => true,
            'floatHeader' => true,
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
                'type' => 'info',
                'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add',['create'], ['class' => 'btn btn-success']), 
                 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List' ,['list'], ['class' => 'btn btn-info']),
                'showFooter' => false
            ],
        ]);
        Pjax::end();
        ?>
</div>
