<?php

use kartik\helpers\Enum;
use kartik\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ListView;

/* @var $this View */

$this->title = Yii::t('skills', 'Business profile details');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-profile-view">
    <h1><?= Html::encode($businessProfile->name); ?></h1>
    <div class="text-left"><?= Html::encode($businessProfile->description); ?></div>
    <br />
     
    <br />
    <div class="row">
        <div class="col-lg-6">
            <?= Html::button(Yii::t('skills', 'Show people of ' . mb_strtolower(Enum::properize(Html::encode($businessProfile->name))) . ' profile'), 
                                ['class' => 'btn btn-primary', 'data-toggle' => 'collapse', 
                                 'data-target' => '#emploeesOfSelectedProfile',
                                 'aria-expanded' => 'false', 'aria-controls' => 'emploeesOfSelectedProfile']); 
            ?>
        </div>
        <div class="col-lg-6 text-right">
            <?php
                $form = ActiveForm::begin(['type' => ActiveForm::TYPE_INLINE,
                            'method' => 'get',
                            'action' => ['business-profile/view']]);

                echo $form->field($model, 'id')->widget(Select2::className(), [
                    'data' => $profiles,
                    'options' => [
                        'placeholder' => Yii::t('skills', 'Choose business profile'),
                    ],
                    'addon' => [
                        'append' => [
                            'content' => Html::submitButton(Yii::t('skills', 'Show'), ['class' => 'btn btn-default']),
                            'asButton' => true
                        ]
                    ]
                ]);

                ActiveForm::end();
            ?>   
        </div>
    </div>
    <br />
    <div class="collapse" id="emploeesOfSelectedProfile">
        <div class="row">
            <?php
                echo ListView::widget(['dataProvider' => $dataProvider,
                    'layout' => '{items}{pager}',
                    'itemOptions' => ['tag' => 'div', 'class' => 'col-lg-3'],
                    'sorter' => ['attributes' => ['firstName', 'lastName']],
                    'itemView' => function($model, $key, $index, $widget) {
                        $content = '<div class="thumbnail">';
                        //$content .= Html::img(Url::base(true) . '/img/person-placeholder.jpg');
                        $content = common\lib\util\ImageHelper::businessPhoto($model);
                        $content .= '<div class="caption">'; 
                        $content .= '<h3>'. $model->firstName . ' ' . $model->lastName . '</h3>';
                        $content .= '<p>' . $model->location->name . '</p>';
                        $content .= '<p>' . Html::a(Html::button(Yii::t('skills', 'View profile'), 
                                                                        ['class' => 'btn btn-primary']), 
                                                    ['profile/view', 'id' => $model->id]) .'</p>';
                        $content .= '</div></div>';
                        return $content;
                    }
                        ]);
            ?>
        </div>
    </div>
</div>
