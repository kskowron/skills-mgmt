<?php

use common\models\Location;
use kartik\detail\DetailView;
use kartik\helpers\Html as Html2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var View $this */
/* @var Employee $model */

if ($model->id == NULL) {
    $this->title = Yii::t('skills', 'Create your own profile');
} else {
    $this->title = Yii::t('skills', 'My profile view');
}
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="employee-view">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= Html::img(Url::base(true) . '/img/person-placeholder.jpg', ['class' => 'img-thumbnail img-responsive']); ?>
        </div>
        <div class="col-md-9">
            <?=
            DetailView::widget([
                'model' => $model,
                'condensed' => false,
                'hover' => true,
                'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT
                        : DetailView::MODE_VIEW,
                'panel' => [
                    'heading' => $this->title,
                    'type' => DetailView::TYPE_INFO,
                ],
                'attributes' => [
                    'lastName',
                    'firstName',
                    [
                        'attribute' => 'location_id',
                        'format' => 'raw',
                        'value' => Html::encode($model->getLocationName()),
                        'type' => DetailView::INPUT_SELECT2,
                        'widgetOptions' => [
                            'data' => ArrayHelper::map(Location::find()->orderBy('name')->asArray()->all(),
                                'id', 'name'),
                            'options' => ['placeholder' => 'Select ...'],
                            'pluginOptions' => ['allowClear' => true]
                        ],
                        'inputWidth' => '40%'
                    ],
                ],
//        'deleteOptions' => [
//            'url' => ['delete', 'id' => $model->id],
//            'data' => [
//                'confirm' => Yii::t('skills',
//                    'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ],
                'enableEditMode' => true,
            ])
            ?>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-3">
            <?= Html2::a(Yii::t('skills',
                    'My Skills'), ['my-skills/list'],
                ['class' => 'btn btn-primary btn-block'])
            ?>
        </div>
        <div class="col-lg-3">
            <?= Html2::a(Yii::t('skills', 'My Files'), ['my-files/view'],
                ['class' => 'btn btn-primary btn-block'])
            ?>
        </div>
        <div class="col-lg-3">
        </div>
    </div>

</div>
