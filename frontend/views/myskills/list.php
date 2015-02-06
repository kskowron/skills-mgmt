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


$this->title = Yii::t('skills', 'My skills');
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
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => true, // pjax is set to always true for this demo
        'toolbar' => ['{toggleData}'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'category_name',
            'skill_name',
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'level_name',
                'editableOptions' => [
                    'header' => 'New Skill',
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data' => $levels,
                    'placement'=> \kartik\popover\PopoverX::ALIGN_LEFT,
                    'options' => [
                        'class' => 'form-control',
                        'prompt' => \Yii::t('skills', 'Select new skill level')
                    ],
                    'editableValueOptions' => ['class' => 'text-danger']
                ],
                'hAlign' => 'left',
                'vAlign' => 'middle',
                'width' => '100px',
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'last_activity',
                'header' => 'Year of last activity',
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data' => $years,
                    'placement'=> \kartik\popover\PopoverX::ALIGN_LEFT,
                    'options' => [
                        'class' => 'form-control',
                        'prompt' => \Yii::t('skills', 'Select year')
                    ],
                    'editableValueOptions' => ['class' => 'text-danger']
                ],
                'hAlign' => 'right',
                'vAlign' => 'middle',
                'width' => '100px',
                //'format' => ['integer', 4],
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'years_of_experience',
                'header' => 'Years of experience',
                'editableOptions' => [
                    //'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data' => $duration,
                    'placement'=> \kartik\popover\PopoverX::ALIGN_LEFT,
                    'options' => [
                        'class' => 'form-control',
                        'prompt' => \Yii::t('skills', 'Select duration')
                    ],
                    'editableValueOptions' => ['class' => 'text-danger']
                ],
                'hAlign' => 'right',
                'vAlign' => 'middle',
                'width' => '100px',
                //'format' => ['integer', 4],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}  {delete}',
                'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['myskills/update-skill','id' => $model->id,'edit'=>'t']), [
                                                    'title' => Yii::t('yii', 'Edit'),
                    ]);},
                'delete' => function ($url, $model) {
                    return Html::a(Html::icon('trash'),
                            Yii::$app->urlManager->createUrl(['myskills/delete-skill','id' => $model->id,'delete'=>'t']),
                            [ 'title' => Yii::t('yii', 'Delete Skill'),
                             'data-method' => 'post',
                             'data-confirm' => Yii::t('skills', 'Do you really want to delete this skill?')

                    ]);}

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
            'before' => Html::a(Html::icon('repeat').' '.\Yii::t('skills','Reset List'),
                ['list'], ['class' => 'btn btn-info'])
            . Html::a(Html::icon('find').' '.\Yii::t('skills','Unassigned skills'),
                ['gap-list'], ['class' => 'btn btn-info pull-right','data-pjax'=>0]),
            'after' => Html::a(Html::icon('repeat').' '.\Yii::t('skills','Reset List'),
                ['list'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]);
    Pjax::end();
    ?>
</div>
