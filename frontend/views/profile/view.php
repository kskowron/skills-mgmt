<?php

use common\models\Employee;
use common\models\EmployeeBusinessProfile;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $employee Employee */
$this->title = Yii::t('skills', 'Employee\'s profile');
$this->params['breadcrumbs'][] = $this->title;


$businessProfiles = array();
if ($employee->employeeBusinessProfiles !== NULL) {
    /* @var $value EmployeeBusinessProfile */
    foreach ($employee->getEmployeeBusinessProfiles()->orderBy('profile_order')->all() as $key => $value) {
        array_push($businessProfiles, Html::encode($value->businessProfile->name));
    }
}
?>

<div class="profile-view">
    <div class="page-header">
        <h1><?= Html::encode(Yii::t('skills', 'Profile of ') . $employee->firstName . ' ' . $employee->lastName); ?></h1>
    </div>
    <div class="profile-view-employee">
        <?php
        echo DetailView::widget([
            'model' => $employee,
            'attributes' => [
                'firstName',
                'lastName',
                [
                    'attribute' => 'id',
                    'label' => Yii::t('skills', 'Business profile'),
                    'value' => implode(', ', $businessProfiles),
                    'format' => 'raw'
                ],
                ['attribute' => 'location_id',
                    'label' => Yii::t('skills', 'Location'),
                    'format' => 'raw',
                    'value' => Html::encode($employee->getLocationName()),],
            ]
        ]);
        ?>
    </div>
    <div class="profile-view-skills">
        <?php
        Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'category_name',
                'skill_name',
                'level_name',
                'years_of_experience',
                'last_activity'
            ],
            'responsive' => true,
            'hover' => true,
            'condensed' => true,
            'pjax' => true,
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'toolbar' => ['{toggleData}'],
            'floatHeader' => true,
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode(Yii::t('skills', 'Skills and competences list')) . ' </h3>',
                'type' => 'info',
                'before' => Html::a(Html::icon('repeat') . ' ' . Yii::t('skills', 'Reset List'), ['list'], ['class' => 'btn btn-info']),
                'after' => Html::a(Html::icon('repeat') . ' ' . Yii::t('skills', 'Reset List'), ['list'], ['class' => 'btn btn-info']),
                'showFooter' => false
            ],
        ]);
        Pjax::end();
        ?>
    </div>
</div>




