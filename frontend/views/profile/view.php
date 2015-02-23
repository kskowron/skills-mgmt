<?php

use common\lib\util\ImageHelper;
use common\models\Employee;
use common\models\EmployeeBusinessProfile;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\helpers\Enum;
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $employee Employee */
$this->title = Yii::t('skills', 'Employee\'s profile');
$this->params['breadcrumbs'][] = $this->title;

$files = [];
foreach ($employee->getDocuments() as $file) {
    array_push($files, Html::a($file->filename, ['employee-files/get', 'fileId' => (string)$file->_id]));
}
$links = implode(', ', $files);

?>

<div class="profile-view">
    <div class="page-header">
        <h1><?= Enum::properize($employee->firstName . ' ' . $employee->lastName) . ' ' . Html::encode(Yii::t('skills', 'profile')); ?></h1>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?php 
                echo ImageHelper::businessPhoto($employee); 
            ?>
        </div>
        <div class="col-md-9">
            <?php
            echo DetailView::widget([
                'model' => $employee,
                                    'bordered' => false,
                'striped' => false,
                'attributes' => [
                    'firstName',
                    'lastName',
                    [
                        'attribute' => 'locationName',
                    ],
                    [
                        'attribute'=> 'primaryBusinessProfile',
                        'displayOnly'=>true
                    ],
                    [
                        'attribute'=> 'secondaryBusinessProfiles',
                        'displayOnly'=>true
                    ],
                    [
                        'label' => Yii::t('skills', 'Files'),
                        'value' => $links,
                        'format' => 'raw',
                        'displayOnly' => true,
                    ]
                ]
            ]);
            ?>
        </div>
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
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' .
                Html::encode(Yii::t('skills', 'Skills and competences list')) . ' </h3>',
                'type' => 'info',
                'before' => Html::a(Html::icon('repeat') . ' ' .
                        Yii::t('skills', 'Reset List'), ['profile/view', 'id' => $employee->id], ['class' => 'btn btn-info']) . 
                        ($profileBackUrl !== NULL ? ' ' . Html::a(Html::icon('arrow-left') . ' ' .
                        Yii::t('skills', 'Back to search results'), $profileBackUrl, ['class' => 'btn btn-info']) : ''),
                'after' => Html::a(Html::icon('repeat') . ' ' .
                        Yii::t('skills', 'Reset List'), ['profile/view', 'id' => $employee->id], ['class' => 'btn btn-info']),
                'showFooter' => false
            ],
        ]);
        Pjax::end();
        ?>
    </div>
</div>




