<?php

use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\helpers\Enum;
use kartik\helpers\Html;
use kartik\widgets\FileInput;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $this View */

$this->title = Yii::t('skills', 'My files');
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'My Profile'), 'url' => ['my-profile/view']];
$this->params['breadcrumbs'][] = $this->title;

$imageTypes = ['image/png', 'image/jpeg', 'image/jpg'];
$docTypes = ['application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
$presentationTypes = ['application/vnd.ms-powerpoint',
    'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
$acceptableFileTypes = ArrayHelper::merge($imageTypes, $presentationTypes, $docTypes);
?>

<div class="my-files-view">
    <h1><?= Html::encode($this->title); ?></h1>
    <div class="alert alert-info alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul>
            <li><?= Yii::t('skills', 'You may upload up to 3 files: onepager (PowerPoint file), CV (Word file) and image file.') ?></li>
            <li><?= Yii::t('skills', 'Image will be used as your professional photo in this service.') ?></li>
            <li><?= Yii::t('skills', 'If you upload 3 files the Add button will be disabled until you delete one file.') ?></li>
        </ul>
    </div>    
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'showOnEmpty' => TRUE,
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'showFooter' => false,
        'toolbar' => FALSE,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'filename',
            ['label' => Yii::t('skills', 'Size'), 'value' => function($model) {
                    return Enum::formatBytes($model->length);
                }],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => ['view' => function ($url, $model) {
                        return Html::a(Html::icon('download-alt'), Yii::$app->urlManager->createUrl(['my-files/get', 'fileId' => (string) $model->_id]), [ 'title' => Yii::t('yii', 'Download file')
                        ]);
                    },
                            'delete' => function ($url, $model) {
                        return Html::a(Html::icon('trash'), Yii::$app->urlManager->createUrl(['my-files/delete', 'fileId' => (string) $model->_id]), [ 'title' => Yii::t('yii', 'Delete file'),
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('skills', 'Do you really want to delete this file?')
                        ]);
                    }]
                    ]
                ],
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . $this->title . ' </h3>',
                    'type' => 'info',
                    'before' => Html::button(Html::icon('plus') . 'Add', ['data-toggle' => 'modal',
                        'class' => $uploadDisabled ? 'btn' : 'btn btn-success',
                        'disabled' => $uploadDisabled ? 'disabled' : NULL,
                        'data-target' => '#w3',
                    ]),
                    'after' => false,
                    'showFooter' => FALSE
                ]
            ]);
            Modal::begin([
                'header' => Yii::t('skills', 'Upload a file'),
            ]);
            $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['my-files/upload']), 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]);
            echo $form->field($model, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => implode(',', $acceptableFileTypes)],
                'disabled' => $uploadDisabled,
                'pluginOptions' => ['allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'doc', 'docx', 'ppt', 'pptx'],]
            ]);
            ActiveForm::end();
            Modal::end();
            ?>

</div>