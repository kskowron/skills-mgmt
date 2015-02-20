<?php

use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\helpers\Html;
use kartik\widgets\FileInput;
use yii\web\View;

/* @var $this View */

$this->title = Yii::t('skills', 'My files');
$this->params['breadcrumbs'][] = ['label' => Yii::t('skills', 'My Profile'), 'url' => ['my-profile/view']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-files-view">
    <h1><?= Html::encode($this->title); ?></h1>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['label' => Yii::t('skills', 'File contents')],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => ['view' => function ($url, $model) {
                        return Html::a(Html::icon('eye-open'), Yii::$app->urlManager->createUrl(['my-files/get', 'fileId' => (string) $model->_id]), [ 'title' => Yii::t('yii', 'Download file')
                        ]);
                    },
                            'delete' => function ($url, $model) {
                        return Html::a(Html::icon('trash'), Yii::$app->urlManager->createUrl(['my-files/delete', 'fileId' => (string) $model->_id]), [ 'title' => Yii::t('yii', 'Delete file'),
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('skills', 'Do you really want to delete this file?')
                        ]);
                    }]
                    ]
                ]
            ]);
            ?>
            <div>
                <?php
                $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['my-files/upload']), 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]);
                echo $form->field($model, 'file')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'disabled' => $uploadDisabled,
                    'pluginOptions' => ['allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'doc', 'docx', 'ppt', 'pptx'],]
                ]);
                ActiveForm::end();
                ?>
    </div>


</div>