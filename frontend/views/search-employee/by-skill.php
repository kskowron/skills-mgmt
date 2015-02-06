<?php
use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\helpers\Html;
use kartik\widgets\Select2;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */

$this->title                   = Yii::t('skills', 'Search employees by skills');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-search-skill">

    <div class="page-header">
        <h1><?= Html::encode($this->title); ?></h1>
    </div>

    <?php
    $encouragement                 = Yii::t('skills', 'Choose skills');
    $searchFormId                  = 'searchForm0';

    $form = ActiveForm::begin(['method' => 'get', 'action' => ['search-employee/by-skill'],
            'id' => $searchFormId]);
    echo '<label class="control-label">'.Html::encode($encouragement).'</label>';

    echo Select2::widget([
        'name' => 'skills_list',
        'data' => $categories,
        'value' => $skillsList,
        'size' => Select2::MEDIUM,
        'addon' => [
            'append' => [
                'content' => \yii\bootstrap\ButtonDropdown::widget([
                    'label' => Yii::t('skill',
                        'Choose lowest skill level and search'),
                    'encodeLabel' => false,
                    'dropdown' => [
                        'items' => array_map(function($value) {
                                return '<li>'.Html::submitButton($value['name'],
                                        ['name' => 'skill_level', 'value' => $value['id'],
                                        'class' => 'btn btn-default btn-block dropdown-toggle']).'</li>';
                            }, $skillLevels),
                        ],
                        'options' => ['class' => 'btn-default']
                    ]),
                    'asButton' => true
                ]
            ],
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
                ['label' => Yii::t('skill', 'Employee'),
                    'attribute' => 'lastName',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a(Html::encode($data->firstName.' '.$data->lastName),
                                Yii::$app->urlManager->createUrl(['search-employee/show-employer',
                                    'id' => $data->id]),
                                ['title' => Yii::t('app', 'See details')]);
                    }],
                ],
                'showOnEmpty' => false,
                'responsive' => true,
                'hover' => true,
                'condensed' => true,
                'floatHeader' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode(Yii::t('skills',
                            'Search results')).' </h3>',
                    'type' => 'info',
                    'before' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List',
                        ['search-employee/by-skill'],
                        ['class' => 'btn btn-info']),
                    'showFooter' => false
                ]
            ]);
            Pjax::end();
            ?>
</div>