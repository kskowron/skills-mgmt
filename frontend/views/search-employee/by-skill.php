<?php

use common\models\EmployeeBusinessProfile;
use kartik\builder\Form;
use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */

$this->title = Yii::t('skills', 'Search employees by skills');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-search-skill">

    <div class="page-header">
        <h1><?= Html::encode($this->title); ?></h1>
    </div>

    <div>
        <?php
        $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'id' => $model->formName(),
                    'method' => 'get',
                    'action' => ['search-employee/by-skill']]);

        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 2,
            'attributes' => [
                'skills_list' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => 'kartik\widgets\Select2',
                    'label' => Yii::t('skills', 'Choose skills to search for'),
                    'options' => [
                        'data' => $data,
                        'options' => [
                            'multiple' => TRUE,
                            'placeholder' => Html::encode(Yii::t('skills', 'Choose skills')),
                        ],
                        'pluginOptions' => ['allowClear' => true],
                    ]
                ],
                'skill_level' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => 'kartik\widgets\Select2',
                    'options' => ['data' => $levels],
                    'label' => Yii::t('skills', 'Choose lowest skill level')
                
                ]
            ]
        ]);
        ?>
    </div>
    <div class="text-right">
        <?php
        echo Html::submitButton('Search', ['class' => 'btn btn-primary']);
        ActiveForm::end();
        ?>
    </div>
    <br />
    <div>
<?php
if (!is_null($dataProvider)) {
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'lastName',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a(Html::encode($data->lastName), Yii::$app->urlManager->createUrl(['profile/view',
                                        'id' => $data->id]), ['title' => Yii::t('app', 'See details')]);
                }],
                    [
                        'attribute' => 'firstName',
                        'format' => 'raw',
                        'value' => function($data) {
                            return Html::a(Html::encode($data->firstName), Yii::$app->urlManager->createUrl(['profile/view',
                                                'id' => $data->id]), ['title' => Yii::t('app', 'See details')]);
                        }],
                            [
                                'label' => 'Business profile',
                                'format' => 'raw',
                                'value' => function($data) {
                                    $businessProfiles = array();
                                    /* @var $value EmployeeBusinessProfile */
                                    foreach ($data->getEmployeeBusinessProfiles()->orderBy('profile_order')->all() as $key => $value) {
                                        array_push($businessProfiles, Html::a($value->businessProfile->name, Yii::$app->urlManager->createUrl(['profile/view',
                                                            'id' => $data->id])));
                                    }
                                    return implode(', ', $businessProfiles);
                                }
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
                                    'before' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['search-employee/by-skill'], ['class' => 'btn btn-info']),
                                    'showFooter' => true
                                ]
                            ]);
                            Pjax::end();
                        }
                        ?>
    </div>    

</div>