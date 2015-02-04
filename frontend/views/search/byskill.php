<?php
/* @var $this View */

use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\helpers\Html;
use kartik\widgets\Select2;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = Yii::t('skills', 'Search employees by skills');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1><?= Html::encode($this->title); ?></h1>
</div>

<div>
    <?php
    $encouragement = Yii::t('skills', 'Choose skills');

    $form = ActiveForm::begin(['method' => 'get', 'action' => ['search/by-skill']]);
    echo '<label class="control-label">' . Html::encode($encouragement) . '</label>';
    echo Select2::widget([
        'name' => 'skills_list',
        'data' => $categories,
        'value' => $skillsList,
        'addon' => ['append' => [
                'content' => Html::submitButton(Html::icon('search'), [
                    'class' => 'btn btn-primary',
                    'title' => Yii::t('skills', 'Search'),
                    'data-toggle' => 'tooltip'
                ]),
                'asButton' => true
            ]],
        'options' => [
            'placeholder' => Html::encode($encouragement),
            'multiple' => true
        ],
    ]);

    $form->end();
    ?>
</div>

<div>
    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $employeeDataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'firstName',
            'lastName',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a(Html::icon('eye-open'),
                            Yii::$app->urlManager->createUrl(['search/show-employer','id' => $model->id]),
                            [ 'title' => Yii::t('yii', 'See details'),
                             'data-method' => 'get',

                    ]);}

                ]
            ]
        ],
        'showOnEmpty' => false,
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode(Yii::t('skills', 'Search results')) . ' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['search/by-skill'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ]
]);
Pjax::end();
?>
</div>