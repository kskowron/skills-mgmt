<?php
/* @var $this View */

use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = Yii::t('skills', 'Browse employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Yii::t('skill', 'Employees'); ?></h1>

<div class="search-employee-all-employees">
    <?php
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
                            [
                                'label' => 'Business profile',
                                'format' => 'raw',
                                'value' => function($data) {
                                    $businessProfiles = array();
                                    /* @var $value EmployeeBusinessProfile */
                                    foreach ($data->getEmployeeBusinessProfiles()->orderBy('profile_order')->all() as $key => $value) {
                                        array_push($businessProfiles, Html::a($value->businessProfile->name, Yii::$app->urlManager->createUrl(['business-profile/view',
                                                            'id' => $value->businessProfile->id])));
                                    }
                                    return implode(', ', $businessProfiles);
                                }
                                    ]
                                ],
                                'panel' => [
                                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode(Yii::t('skills', 'Search results')) . ' </h3>',
                                    'type' => 'info',
                                    'before' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['search-employee/all-employees'], ['class' => 'btn btn-info']),
                                    'showFooter' => true
                                ]
                            ]);
                            Pjax::end();
                            ?>
</div>
